<?php

use Bitrix\Main\Error;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Order;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var OpenSourceOrderComponent $component */

CJSCore::Init(['jquery']);?>
<div class="cart__title">
    <div class="cart__title__icon active"><svg>
            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-cart"></use>
        </svg></div>
    <div class="cart__title__text d-none d-lg-block">Ваша корзина</div>
    <div class="cart__title__line"></div>
    <div class="cart__title__icon active"><svg>
            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-cart-check"></use>
        </svg></div>
    <div class="cart__title__text d-none d-lg-block">Заявка отправлена</div>
</div>
</div>
<div class="h1">Спасибо за покупку!</div>
<div class="cart__numberorder">Номер Вашего заказа <?= $arResult['ID']?>.</div>
<div class="block__text">
    <p class="text__big">Наши специалисты свяжутся в ближайшее время. </p>
</div>
<!-- <?= Loc::getMessage('OPEN_SOURCE_ORDER_TEMPLATE_ORDER_CREATED', [
    '#ORDER_ID#' => $arResult['ID']
]) ?> -->

<script>
    $(".cart__basket1").css("display","none");
    </script>
