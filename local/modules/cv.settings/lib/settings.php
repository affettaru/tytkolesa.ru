<?php

namespace Cv\Settings;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

class SettingsTable extends Entity\DataManager
{
    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'cv_settings';
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
            new Entity\StringField('NAME', [
                'required' => true,
            ]),
            new Entity\StringField('CODE', [
                'required' => true,
                "validation" => function () {
                    return [
                        new Entity\Validator\Unique
                    ];
                }
            ]),
            new Entity\BooleanField('MULTIPLE', []),
            (new Reference(
                'VALUE',
                ValueTable::class,
                Join::on('this.ID', 'ref.SETTING_ID')
            ))

        );
    }
}