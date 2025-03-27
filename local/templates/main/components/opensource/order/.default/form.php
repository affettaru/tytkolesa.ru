<?php

use Bitrix\Main\Error;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\Json;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var OpenSourceOrderComponent $component */

?>
<!-- <div class="cart__body row">
<div class="col-12 col-lg-8"> -->
<form class="form__wrapper" action="" method="post" name="os-order-form" id="os-order-form">
<div class="h2">Ввод личных данных</div>
    <input type="hidden" name="person_type_id" value="<?=$arParams['PERSON_TYPE_ID']?>">
    <div class="form__line row">
        <?php foreach ($arResult['PROPERTIES'] as $propCode => $arProp): ?>
            <!-- <div class="col-12"> -->
                    <!-- <label for="<?= $arProp['FORM_LABEL'] ?>">
                        <?= $arProp['NAME'] ?> -->
                        <!-- <?php if($arProp['IS_REQUIRED']) printf(
                            '<span class="required" style="color: red;" title="%s">*</span>',
                            Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_FIELD_REQUIRED')
                        ); ?> -->
                    <!-- </label> -->
            <!-- </div> -->
                    <? foreach ($arProp['ERRORS'] as $error):
                        /** @var Error $error */
                        ?>
                        <div class="error "><?= $error->getMessage() ?></div>
                    <? endforeach; ?>
              
                    <?php
                    switch ($arProp['TYPE']):
                        case 'LOCATION':
                            ?>

                            <div class="location" style="display:none">
                                <select class="location-search" name="<?= $arProp['FORM_NAME'] ?>"
                                        id="<?= $arProp['FORM_LABEL'] ?>">
                                    <option
                                            data-data='<?echo Json::encode($arProp['LOCATION_DATA'])?>'
                                            value="<?= $arProp['VALUE'] ?>"><?=$arProp['LOCATION_DATA']['label']?></option>
                                </select>
                            </div>
                            <?
                            break;

                        case 'ENUM':
                            foreach ($arProp['OPTIONS'] as $code => $name):?>
                                <label class="enum-option">
                                    <input type="radio" name="<?= $arProp['FORM_NAME'] ?>" value="<?= $code ?>">
                                    <?= $name ?>
                                </label>
                            <?endforeach;
                            break;

                        case 'DATE':
                            $APPLICATION->IncludeComponent(
                                'bitrix:main.calendar',
                                '',
                                [
                                    'SHOW_INPUT' => 'Y',
                                    'FORM_NAME' => 'os-order-form',
                                    'INPUT_NAME' => $arProp['FORM_NAME'],
                                    'INPUT_VALUE' => $arProp['VALUE'],
                                    'SHOW_TIME' => 'Y',
                                    //'HIDE_TIMEBAR' => 'Y',
                                    'INPUT_ADDITIONAL_ATTR' => 'placeholder="выберите дату"'
                                ]
                            );
                            break;

                        case 'Y/N':
                            ?>
                            <input id="<?= $arProp['FORM_LABEL'] ?>" type="checkbox"
                                   name="<?= $arProp['FORM_NAME'] ?>"
                                   value="Y">
                            <?
                            break;

                        default:
                        // echo "<pre>Template arResult: "; print_r($arProp); echo "</pre>";
                        if($arProp['FORM_NAME']!="properties[ADDRESS]"){
                            if($arProp['FORM_NAME']=="properties[TEXT]"){?>
                                <div class="col-12">
                                    <textarea id="<?= $arProp['FORM_LABEL']?>" class="form__input" name="<?= $arProp['FORM_NAME'] ?>" value="<?= $arProp['VALUE'] ?>" rows="3" placeholder="Сообщение"></textarea>
                                </div>
                            <?}else{?>
                            <div class="col-12  <?php if($arProp['FORM_NAME']=="properties[PHONE]"||$arProp['FORM_NAME']=="properties[EMAIL]") printf('col-md-6')?>">
                                <input id="<?= $arProp['FORM_LABEL']?>" type="text" class="form__input"
                                   name="<?= $arProp['FORM_NAME'] ?>"
                                   value="<?= $arProp['VALUE'] ?>"
                                   placeholder="<?= $arProp['NAME'] ?><?php if($arProp['IS_REQUIRED']) printf('*')?>">
                            </div>
                        <?}}?>
                       
                            
                        <? endswitch; ?>
               
        <? endforeach; ?>
        <div class="col-12 col-lg-11"><label class="form__check form__check__mini"><input type="checkbox" checked="checked" /><span class="form__check__text"> Нажимая кнопку «Оформить заказ», я&nbsp;даю согласие на&nbsp;обработку своих персональных данных в&nbsp;соответствии с&nbsp;<a href="/policy/" target="_blank" rel="noopener noreferrer">Политикой конфиденциальности</a></span></label></div>
    </div>
    


    <!-- <input type="hidden" name="person_type_id" value="<?=$arParams['PERSON_TYPE_ID']?>">

    <h2><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_PROPERTIES_TITLE')?>:</h2>
    <table>
        <?php foreach ($arResult['PROPERTIES'] as $propCode => $arProp): ?>
            <tr>
                <td>
                    <label for="<?= $arProp['FORM_LABEL'] ?>">
                        <?= $arProp['NAME'] ?>
                        <?php if($arProp['IS_REQUIRED']) printf(
                            '<span class="required" style="color: red;" title="%s">*</span>',
                            Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_FIELD_REQUIRED')
                        ); ?>
                    </label>
                    <? foreach ($arProp['ERRORS'] as $error):
                        /** @var Error $error */
                        ?>
                        <div class="error"><?= $error->getMessage() ?></div>
                    <? endforeach; ?>
                </td>
                <td>
                    <?php
                    switch ($arProp['TYPE']):
                        case 'LOCATION':
                            ?>
                            <div class="location">
                                <select class="location-search" name="<?= $arProp['FORM_NAME'] ?>"
                                        id="<?= $arProp['FORM_LABEL'] ?>">
                                    <option
                                            data-data='<?echo Json::encode($arProp['LOCATION_DATA'])?>'
                                            value="<?= $arProp['VALUE'] ?>"><?=$arProp['LOCATION_DATA']['label']?></option>
                                </select>
                            </div>
                            <?
                            break;

                        case 'ENUM':
                            foreach ($arProp['OPTIONS'] as $code => $name):?>
                                <label class="enum-option">
                                    <input type="radio" name="<?= $arProp['FORM_NAME'] ?>" value="<?= $code ?>">
                                    <?= $name ?>
                                </label>
                            <?endforeach;
                            break;

                        case 'DATE':
                            $APPLICATION->IncludeComponent(
                                'bitrix:main.calendar',
                                '',
                                [
                                    'SHOW_INPUT' => 'Y',
                                    'FORM_NAME' => 'os-order-form',
                                    'INPUT_NAME' => $arProp['FORM_NAME'],
                                    'INPUT_VALUE' => $arProp['VALUE'],
                                    'SHOW_TIME' => 'Y',
                                    //'HIDE_TIMEBAR' => 'Y',
                                    'INPUT_ADDITIONAL_ATTR' => 'placeholder="выберите дату"'
                                ]
                            );
                            break;

                        case 'Y/N':
                            ?>
                            <input id="<?= $arProp['FORM_LABEL'] ?>" type="checkbox"
                                   name="<?= $arProp['FORM_NAME'] ?>"
                                   value="Y">
                            <?
                            break;

                        default:
                            ?>
                            <input id="<?= $arProp['FORM_LABEL'] ?>" type="text"
                                   name="<?= $arProp['FORM_NAME'] ?>"
                                   value="<?= $arProp['VALUE'] ?>">
                        <? endswitch; ?>
                </td>
            </tr>
        <? endforeach; ?>
    </table>

    <h2><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_DELIVERIES_TITLE')?>:</h2>
    <? foreach ($arResult['DELIVERY_ERRORS'] as $error):
        /** @var Error $error */
        ?>
        <div class="error"><?= $error->getMessage() ?></div>
    <? endforeach;
    foreach ($arResult['DELIVERY_LIST'] as $arDelivery):?>
        <label>
            <input type="radio" name="delivery_id"
                   value="<?= $arDelivery['ID'] ?>"
                <?= $arDelivery['CHECKED'] ? 'checked' : '' ?>
            >
            <?= $arDelivery['NAME'] ?>,
            <?= $arDelivery['PRICE_DISPLAY'] ?>
        </label>
        <br>
    <? endforeach; ?>

    <h2><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_PAY_SYSTEMS_TITLE')?>:</h2>
    <? foreach ($arResult['PAY_SYSTEM_ERRORS'] as $error):
        /** @var Error $error */
        ?>
        <div class="error"><?= $error->getMessage() ?></div>
    <? endforeach;
    foreach ($arResult['PAY_SYSTEM_LIST'] as $arPaySystem): ?>
        <label>
            <input type="radio" name="pay_system_id"
                   value="<?= $arPaySystem['ID'] ?>"
                <?= $arPaySystem['CHECKED'] ? 'checked' : '' ?>
            >
            <?= $arPaySystem['NAME'] ?>
        </label>
        <br>
    <? endforeach; ?>

    <h2><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_BASKET_TITLE')?></h2>
    <table>
        <tr>
            <th><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_BASKET_NAME_COLUMN')?></th>
            <th><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_BASKET_COUNT_COLUMN')?></th>
            <th><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_BASKET_UNIT_PRICE_COLUMN')?></th>
            <th><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_BASKET_DISCOUNT_COLUMN')?></th>
            <th><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_BASKET_TOTAL_COLUMN')?></th>
        </tr>
        <? foreach ($arResult['BASKET'] as $arBasketItem): ?>
            <tr>
                <td>
                    <?= $arBasketItem['NAME'] ?>
                    <? if (!empty($arBasketItem['PROPERTIES'])): ?>
                        <div class="basket-properties">
                            <? foreach ($arBasketItem['PROPERTIES'] as $arProp): ?>
                                <?= $arProp['NAME'] ?>
                                <?= $arProp['VALUE'] ?>
                                <br>
                            <? endforeach; ?>
                        </div>
                    <? endif; ?>
                </td>
                <td><?= $arBasketItem['QUANTITY_DISPLAY'] ?></td>
                <td><?= $arBasketItem['BASE_PRICE_DISPLAY'] ?></td>
                <td><?= $arBasketItem['PRICE_DISPLAY'] ?></td>
                <td><?= $arBasketItem['SUM_DISPLAY'] ?></td>
            </tr>
        <? endforeach; ?>
    </table>

    <h2><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_ORDER_TOTAL_TITLE')?></h2>
    <h3><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_PRODUCTS_PRICES_TITLE')?>:</h3>
    <table>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_PRODUCTS_BASE_PRICE')?></td>
            <td><?= $arResult['PRODUCTS_BASE_PRICE_DISPLAY'] ?></td>
        </tr>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_PRODUCTS_PRICE')?></td>
            <td><?= $arResult['PRODUCTS_PRICE_DISPLAY'] ?></td>
        </tr>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_PRODUCTS_DISCOUNT')?></td>
            <td><?= $arResult['PRODUCTS_DISCOUNT_DISPLAY'] ?></td>
        </tr>
    </table>

    <h3><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_DELIVERY_PRICES_TITLE')?>:</h3>
    <table>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_DELIVERY_BASE_PRICE')?></td>
            <td><?= $arResult['DELIVERY_BASE_PRICE_DISPLAY'] ?></td>
        </tr>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_DELIVERY_PRICE')?></td>
            <td><?= $arResult['DELIVERY_PRICE_DISPLAY'] ?></td>
        </tr>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_DELIVERY_DISCOUNT')?></td>
            <td><?= $arResult['DELIVERY_DISCOUNT_DISPLAY'] ?></td>
        </tr>
    </table>

    <h3><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_SUM_TITLE')?>:</h3>
    <table>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_TOTAL_BASE_PRICE')?></td>
            <td><?= $arResult['SUM_BASE_DISPLAY'] ?></td>
        </tr>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_TOTAL_DISCOUNT')?></td>
            <td><?= $arResult['DISCOUNT_VALUE_DISPLAY'] ?></td>
        </tr>
        <tr>
            <td><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_TOTAL_PRICE')?></td>
            <td><?= $arResult['SUM_DISPLAY'] ?></td>
        </tr>
    </table> -->

    <input type="hidden" name="save" value="y">

    <button id="submit" type="submit" style="display:none"><?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_MAKE_ORDER_BUTTON')?></button>


</form>

