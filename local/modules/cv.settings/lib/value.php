<?php

namespace Cv\Settings;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;


class ValueTable extends Entity\DataManager
{
    /**
     * @return string
     */
    public static function getTableName()
    {
        return 'cv_values';
    }


    /**
     * @return array
     */
    public static function getMap(): array
    {
        return array(
            new Entity\IntegerField('ID', [
                'primary' => true,
                "autocomplete" => true
            ]),
            new Entity\IntegerField('SETTING_ID', [
                'required' => true,
            ]),
            new Entity\StringField('TEXT', [
                'required' => true,
            ]),
            (new Reference(
                'SETTING',
                SettingsTable::class,
                Join::on('this.SETTING_ID', 'ref.ID')
            ))
        );
    }
}