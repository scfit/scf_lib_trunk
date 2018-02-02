<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 14.07.17
 * Time: 10:27
 */

namespace ScfLib\Kendo;

use \PDO as PDO;

class DataSource {

    protected $stringOperators = array(
        'eq' => 'LIKE',
        'neq' => 'NOT LIKE',
        'null' => 'IS NULL',
        'notnull' => 'IS NOT NULL',
        'doesnotcontain' => 'NOT LIKE',
        'contains' => 'LIKE',
        'startswith' => 'LIKE',
        'endswith' => 'LIKE',
        'between' => 'BETWEEN'
    );
    protected $arrayOperators = array(
        'eq' => 'IN',
        'neq' => 'NOT IN'
    );
    protected $dbArrayOperators = array(
        'custom' => 'CUSTOM',
    );
    protected $operators = array(
        'eq' => '=',
        'null' => 'IS NULL',
        'notnull' => 'IS NOT NULL',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
        'neq' => '!='
    );
    protected $aggregateFunctions = array(
        'average' => 'AVG',
        'min' => 'MIN',
        'max' => 'MAX',
        'count' => 'COUNT',
        'sum' => 'SUM'
    );
    protected $columnTypes = array(
        'integer',
        'boolean',
        'string',
        'date',
        'int_array',
        'db_string_array'
    );

    /**
     *
     * @var PDO
     */
    private $db;

    /**
     * @var string
     */
    private $sql = null;

    /**
     * @var string
     */
    private $sqlTotal = null;

    /**
     * @var array
     */
    private $properties = null;

    /**
     * Datasource constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    /**
     * @param string $name
     * @param string $alias
     * @param string $type
     * @throws DataSourceException
     */
    public function addProperty($name, $alias, $type) {
        if (in_array($type, $this->columnTypes) === false) {
            throw new DataSourceException("column type $type does not exist");
        }
        $this->properties[$name] = array(
            'alias' => $alias,
            'type' => $type
        );
    }

    /**
     * @param string $name
     * @return array
     * @throws DataSourceException
     */
    public function getProperty($name) {
        if (isset($this->properties[$name]) === false) {
            throw new DataSourceException("property $name does not exist");
        }
        return $this->properties[$name];
    }

    /**
     * @return array
     */
    public function getPropertyNames() {
        return array_keys($this->properties);
    }

    /**
     * @return array
     * @throws DataSourceException
     */
    public function getProperties() {
        if ($this->properties === null) {
            throw new DataSourceException("column properties required, please addProperty");
        }
        return $this->properties;
    }

    /**
     * @param string $sql
     */
    public function setSql($sql) {
        $this->sql = trim($sql) . " ";
    }

    /**
     * @return string
     * @throws DataSourceException
     */
    public function getSql() {
        if ($this->sql === null) {
            throw new DataSourceException("no sql statement present, please setSql");
        }
        return $this->sql;
    }

    /**
     * @param string $sqlTotal
     */
    public function setSqlTotal($sqlTotal) {
        $this->sqlTotal = $sqlTotal;
    }

    /**
     * @return mixed|string
     */
    public function getSqlTotal() {
        if ($this->sqlTotal === null) {
            $propId = $this->getProperty('id');
            $pattern = '/SELECT[a-z\.\s\,0-9_\*]*FROM/i';
            $replace = "SELECT COUNT({$propId['alias']}) FROM";
            $sql = preg_replace($pattern, $replace, $this->getSql(), 1);
        } else {
            $sql = $this->sqlTotal;
        }
        return $sql;
    }

    /**
     * @param array|null $requestParams
     * @return array
     */
    public function getData(array $requestParams = null) {
        $sql = $this->getSql();

        if (strpos(strtolower($sql), 'where') === false) {
            $sql.= ' WHERE 1=1 :where';
        }
        if (isset($requestParams['filter'])) {
            $where = ' AND ' . $this->filter($requestParams['filter']) . ' ';
            $sql = str_replace(':where', $where, $sql);
        } else {
            $sql = str_replace(':where', '', $sql);
        }

        $sort = $this->mergeSortDescriptors($requestParams);
        if (count($sort) > 0) {
            $pattern = '/ORDER BY [a-z\.\_\-\(\)]* [desc|asc]+/i';
            $replace = $this->sort($sort);
            $replacement = preg_replace($pattern, $replace, $sql, 1);
            if ($replacement === null) {
                $sql .= $replace;
            } else {
                $sql = $replacement;
            }
        }

        if (isset($requestParams['skip']) && isset($requestParams['take'])) {
            $requestParams['skip'] = intval($requestParams['skip']);
            $requestParams['take'] = intval($requestParams['take']);

            $pattern = '/LIMIT \d* OFFSET \d/i';
            $replace = 'LIMIT :take OFFSET :skip';
            $replacement = preg_replace($pattern, $replace, $sql, 1);
            if ($replacement === null) {
                $sql .= $replace;
            } else {
                $sql = $replacement;
            }
        }
        //echo $sql; exit;

        $statement = $this->db->prepare($sql);
        if (isset($requestParams['filter'])) {
            $this->bindFilterValues($statement, $requestParams['filter']);
        }

        if (isset($requestParams['skip']) && isset($requestParams['take'])) {
            $statement->bindValue(':skip', (int) $requestParams['skip'], PDO::PARAM_INT);
            $statement->bindValue(':take', (int) $requestParams['take'], PDO::PARAM_INT);
        }
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @param array $requestParams
     * @return string
     */
    public function getTotal(array $requestParams) {
        $sql = $this->getSqlTotal($requestParams);
        if (strpos(strtolower($sql), 'where') === false) {
            $sql.= ' WHERE 1=1 :where';
        }
        if (isset($requestParams['filter'])) {
            $where = ' AND ' . $this->filter($requestParams['filter']) . ' ';
            $sql = str_replace(':where', $where, $sql);
        } else {
            $sql = str_replace(':where', '', $sql);
        }
        $statement = $this->db->prepare($sql);
        if (isset($requestParams['filter'])) {
            $this->bindFilterValues($statement, $requestParams['filter']);
        }
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    /**
     *
     * @param array $requestParams
     * @return array
     */
    public function getResult(array $requestParams) {
        return array(
            'data' => $this->getData($requestParams),
            'total' => $this->getTotal($requestParams)
        );
    }

    /**
     * @param $all
     * @param $filter
     */
    private function flatten(&$all, $filter) {
        if (isset($filter['filters'])) {
            $filters = $filter['filters'];
            for ($index = 0; $index < count($filters); $index++) {
                $this->flatten($all, $filters[$index]);
            }
        } else {
            $all[] = $filter;
        }
    }

    /**
     * @param array $filter
     * @return null|string
     */
    private function filter(array $filter) {
        $all = array();
        $this->flatten($all, $filter);
        $where = $this->where($filter, $all);
        return $where;
    }

    /**
     * @param $filter
     * @param $all
     * @return null|string
     */
    private function where($filter, $all) {
        if (isset($filter['filters']) && empty($filter['filters']) === false) {
            $logic = ' AND ';
            if ($filter['logic'] == 'or') {
                $logic = ' OR ';
            }
            $filters = $filter['filters'];
            $wheres = array();
            for ($index = 0; $index < count($filters); $index++) {
                $tmp = $this->where($filters[$index], $all);
                if ($tmp !== null) {
                    $wheres[] = $tmp;
                }
            }
            $where = implode($logic, $wheres);
            return "($where)";
        }

        $field = $filter['field'];
        $properties = $this->getProperties();
        $propertyNames = $this->getPropertyNames();

        if (in_array($field, $propertyNames)) {
            $type = "string";
            $index = array_search($filter, $all);
            $value = ":filter$index";

            if (isset($properties[$field])) {
                $type = $properties[$field]['type'];
            } else if ($this->isDate($filter['operator'])) {
                $type = "date";
            } else if (array_key_exists($filter['operator'], $this->operators) && !$this->isString($filter['operator'])) {
                $type = "number";
            }

            if ($type == "string") {
                $operator = $this->stringOperators[strtolower($filter['operator'])];
            } else if ($type == "int_array") {
                $operator = $this->arrayOperators[strtolower($filter['operator'])];
            } else if ($type == "db_string_array") {
                $operator = $this->dbArrayOperators[strtolower($filter['operator'])];
            } else {
                $operator = $this->operators[$filter['operator']];
            }

            $alias = $properties[$field]['alias'];

            // format string to lowercase
            if ( $type == "string" && preg_match('/lower\(.*\)/',$alias) === 0 && $operator !== 'BETWEEN' ) {
                $alias = "lower(trim($alias))";
            }

            if ($operator === 'IS NULL' || $operator === 'IS NOT NULL') {
                return "$alias $operator";
            } else if ($operator === 'IN') {
                return "$alias = ANY($value)";
            } else if ($operator === 'NOT IN') {
                return "NOT $alias = ANY($value)";
            } else if ($operator === 'CUSTOM') {
                $value = str_replace(':'.$field, urldecode(pg_escape_string($filter['value'])), $alias);
                return $value;
            } else if ($operator === 'BETWEEN') {
                if (substr_count($filter['value'],'/') === 4 && substr_count($filter['value'],'-') === 1) {
                    $aryValue = explode('-', $filter['value']);

                    if (trim($aryValue[1]) == trim($aryValue[0])) {
                        $aryValue[0] = $aryValue[0] . ' 00:00:00';
                        $aryValue[1] = $aryValue[1] . ' 23:59:59';
                    }
                    $response = $alias . " BETWEEN '" . trim($aryValue[0]) . "' AND '" . trim($aryValue[1]) . "'";
                } else {
                    $aryValue = explode(':', $filter['value']);
                    if (trim($aryValue[1]) == trim($aryValue[0])) {
                        $aryValue[0] = $aryValue[0] . ' 00:00:00';
                        $aryValue[1] = $aryValue[1] . ' 23:59:59';
                    }
                    $response = $alias . " BETWEEN '" . $aryValue[0] . "' AND '" . $aryValue[1] . "'";
                }
                return $response;
            } else {
                return "$alias $operator $value";
            }
        }
        return null;
    }

    /**
     * @param $sort
     * @return string
     */
    private function sort($sort) {
        $keys = array_keys($sort);
        if( in_array(0,$keys,true) === false ) {
            $sort = [$sort];
        }
        $count = count($sort);
        $sql = '';
        if ($count > 0) {
            $sql = ' ORDER BY ';
            $order = array();
            $properties = $this->getProperties();
            for ($index = 0; $index < $count; $index ++) {
                $field = $sort[$index]['field'];
                if (in_array($field, $this->getPropertyNames())) {
                    $dir = 'ASC';
                    if ($sort[$index]['dir'] == 'desc') {
                        $dir = 'DESC NULLS LAST';
                    }
                    $alias = $properties[$field]['alias'];
                    $order[] = "$alias $dir";
                }
            }
            $sql .= implode(',', $order);
        }
        return $sql;
    }

    /**
     * @param $statement
     * @param $filter
     */
    private function bindFilterValues(&$statement, $filter) {
        $filters = array();
        $this->flatten($filters, $filter);
        $properties = $this->getProperties();

        for ($index = 0; $index < count($filters); $index++) {
            $value = $filters[$index]['value'];
            $operator = $filters[$index]['operator'];
            $field = $filters[$index]['field'];

            // get column type
            if (isset($properties[$field])) {
                $type = $properties[$field]['type'];
            }

            // format int_array values
            if( isset($type) && $type == 'int_array' ) {
                if( is_array($value) ) {
                    $value = \ScfLib\ArrayHelper::toPGArray($value);
                }
            }

            // format string to lowercase
            if( $type === 'string' ) {
                $value = trim(strtolower($value));
            }

            // format string values
            if ($operator == 'contains' || $operator == 'doesnotcontain') {
                $value = "%$value%";
            } else if ($operator == 'startswith') {
                $value = "$value%";
            } else if ($operator == 'endswith') {
                $value = "%$value";
            }

            // format int, date, bool values
            if ($operator !== 'null' && $operator !== 'notnull' && $operator !== 'custom' && $operator !== 'between') {
                $statement->bindValue(":filter$index", $value);
            }
        }
    }

    /**
     * @param $requestParams
     * @return array
     */
    private function mergeSortDescriptors($requestParams) {
        $sort = isset($requestParams['sort']) && count($requestParams['sort']) ? $requestParams['sort'] : array();
        $groups = isset($requestParams['group']) && count($requestParams['group']) ? $requestParams['group'] : array();
        return array_merge($sort, $groups);
    }
}