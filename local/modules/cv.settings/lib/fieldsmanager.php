<?php /** @noinspection ALL */

namespace Cv\Settings;

use Cassandra\Value;
use Cv\Settings\SettingsTable;
use Cv\Settings\ValueTable;

/**
 * @property FieldsManager $Instance
 * @property FieldsManager $fields
 */
class FieldsManager
{
    private static FieldsManager $Instance;
    private array $fields;


    /**
     * @return FieldsManager
     */
    public static function getInstance(): FieldsManager
    {
        if(!isset(self::$Instance)) self::$Instance = new self();
        return self::$Instance;
    }


    /**
     * @param bool $cache
     * @return array
     */
    public function getFields(bool $cache = false): array
    {
        $requestParams = [
            "select" => ["NAME", "CODE", "MULTIPLE", "ID", "VALUE_" => "VALUE"],
        ];
        if ($cache === true) $requestParams["cache"] = [
                "ttl" => 86400,
                'cache_joins' => true
            ];

        $fields = SettingsTable::getList($requestParams)->fetchAll();

        $arrValues = [];
        foreach ($fields as $field) {
            $arrValues[$field["CODE"]]["NAME"] = $field["NAME"];
            $arrValues[$field["CODE"]]["VALUE"][$field["VALUE_ID"]] = $field["VALUE_TEXT"];
            $arrValues[$field["CODE"]]["ID"] = $field["ID"];
            $arrValues[$field["CODE"]]["MULTIPLE"] = $field["MULTIPLE"];
        }

        return $arrValues;
    }


    /**
     * @param string $code
     * @return array
     */
    public function getVal(string $code): array|string
    {
        if(!isset($this->fields)){
            $value = [];
            $dbRes = ValueTable::getList([
                'count_total' => true,
                "cache" => [
                    "ttl" => 86400,
                    'cache_joins' => true
                ],
                "select" => ["*", "SET_" => "SETTING"],
            ]);
            $fields = [];

            while ($row = $dbRes->fetch()) {
                if(!empty($row["SET_MULTIPLE"])) $fields[$row["SET_CODE"]][] = $row["TEXT"];
                else $fields[$row["SET_CODE"]] = $row["TEXT"];
            }
            $this->fields = $fields;
        }else{
            $fields = $this->fields;
        }

        if(!isset($fields[$code])) return "";
        return $fields[$code];
    }


    /**
     * @param object $result
     * @return string
     */
    public function GetErrorsString(object $result): string
    {
        $errorStr = "";
        $errors = $result->getErrorMessages();
        foreach ($errors as $error) {
            $errorStr .= $error . "\n";
        }

        return $errorStr;
    }
}