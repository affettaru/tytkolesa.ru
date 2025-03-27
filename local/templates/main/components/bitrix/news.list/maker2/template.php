<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
}
use Bitrix\Highloadblock\HighloadBlockTable;
// подключаем модуль highloadblock
// \Bitrix\Main\Loader::includeModule("highloadblock");
// $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
//     array(
//         "filter" => array(
//             '=TABLE_NAME' => 'b_hlbd_proizvoditeli'
//         )
//     )
// )->fetch();
// $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
// $entity_data_class = $entity->getDataClass();
?>
<?php
if (!empty($arResult["ITEMS"])): 
?>
                <?php $i=0;
                foreach ($arResult["ITEMS"] as $arItem): $i++;
                // $res = $entity_data_class::getList(array(
                //     'select' => array('ID', 'UF_NAME', 'UF_FILE'),
                //     'filter' => array('=NAME' => 1)
                // ));
                // echo "<pre>Template arResult: "; print_r($arItem); echo "</pre>";
                ?>
                
                    <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>500, 'height'=>'500'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                    <li><a href="/catalog/shiny/filter/u_marka-is-<?=$arItem["PROPERTIES"]["MAKER"]["VALUE"]?>/apply/"><img src="<?=$file["src"]?>" alt="<?=$arItem["NAME"]?>"  title="<?= $arItem["NAME"] ?> tytkolesa.ru"/></a></li>
                <?endforeach;?>   
<?endif; ?>

