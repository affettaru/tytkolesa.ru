<?php

namespace Cv\Settings;

use Bitrix\Main\Entity\Event;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

class EventHandler
{
    /**
     * @param Event $event
     * @return void
     * @throws LoaderException
     */
    public function OnPageStart()
    {
        Loader::includeModule("cv.sale");


        $value = [];
        $dbRes = \Cv\Settings\ValueTable::getList([
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
        $GLOBALS["SETTINGS"] = $fields;
    }
}