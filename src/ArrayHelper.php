<?php

namespace ScfLib;

/**
 * Class ArrayHelper
 * @package ScfLib
 */
class ArrayHelper {

    /**
     * Converts PHP tp POSTGRES Array
     * @param array $set
     * @return string
     */
    public static function toPGArray($set) {
        if (is_null($set) || !is_array($set)) {
            return 'NULL';
        }

        // can be called with a scalar or array
        settype($set, 'array');

        $result = array();
        foreach ($set as $t) {
            // Element is array : recursion
            if (is_array($t)) {
                $result[] = self::toPGArray($t);
            } else {
                // PHP NULL
                if (is_null($t)) {
                    $result[] = 'NULL';
                }
                // PHP TRUE::boolean
                elseif (is_bool($t) && $t == TRUE) {
                    $result[] = 'TRUE';
                }
                // PHP FALSE::boolean
                elseif (is_bool($t) && $t == FALSE) {
                    $result[] = 'FALSE';
                }
                // Other scalar value
                else {
                    // Escape
                    $t = pg_escape_string($t);

                    // quote only non-numeric values
                    if (!is_numeric($t)) {
                        $t = '\'' . $t . '\'';
                    }
                    $result[] = $t;
                }
            }
        }
        return '{' . implode(",", $result) . '}'; // format
    }
}