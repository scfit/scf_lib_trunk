<?php

use PHPUnit\Framework\TestCase;

/**
 * Class DataSourceTest
 * @covers \ScfLib\Kendo\DataSource
 */
class DataSourceTest extends TestCase
{

    public function testResult()
    {
        $ds = new \ScfLib\Kendo\DataSource($this->getPDO());
        $ds->addProperty('id','t.id','integer');
        $ds->setSql('SELECT * FROM task AS t');
        $ds->setSqlTotal('SELECT COUNT(*) FROM task AS t');
        $actual = $ds->getResult([]);

        $expected = [
            'data' => [
                [
                    'id' => 1,
                    'task_name' => 'test'
                ]
            ],
            'total' => 1
        ];

        $this->assertEquals($expected,$actual,'DataSource Result');
    }

    public function testDataSourceException()
    {
        $this->expectException(\ScfLib\Kendo\DataSourceException::class);
        $ds = new \ScfLib\Kendo\DataSource($this->getPDO());
        $ds->getSql();
    }

    private function getPDO()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $pdo->exec("CREATE TABLE task (id INTEGER PRIMARY KEY,task_name TEXT NOT NULL ); ");
        $pdo->exec("INSERT INTO task (task_name) VALUES('test');");
        return $pdo;
    }
}