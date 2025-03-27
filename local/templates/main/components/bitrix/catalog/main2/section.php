<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
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

/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;


$this->setFrameMode(true);
echo("@@@@");
?>
<section class="bread">
    <div class="container">
        <div class="bread__inner">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "main",
                array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            ); ?>
            <h1><?= $APPLICATION->ShowTitle() ?></h1>
        </div>
    </div>
</section>

<section class="catalog-page">
    <div class="container">
        <div class="catalog-page__inner">
            <div class="catalog-page__left">
                <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "tree",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "CACHE_TYPE" => "N",
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                        "TOP_DEPTH" => 4,
                        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",

                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
                <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "main",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
              
                ?>

            </div>

            <div class="catalog-page__right">
                <div class="catalog-page__top">

<!--                                        <div class="catalog-page__kl">-->
<!--                                            <div class="catalog-page__kl-in">-->
<!--                                                <a href="#" class="catalog-page__kl-item">3 тонны</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">10 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item active">1 тонна</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">5 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">1.5 тонны</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">2.5 тонны</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">46 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">4.5 тонны</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">8 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">18 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">8.5 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">1.8 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">3 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">10 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">1 тонна</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">30 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">5 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">5 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">20 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">Китайские</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">20 тонн</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">Китайские</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">Японские</a>-->
<!--                                                <a href="#" class="catalog-page__kl-item">Корейские</a>-->
<!--                                            </div>-->
<!---->
<!--                                            <div class="catalog-page__kl-btn">-->
<!--                                                <span class="cl">Показать еще</span>-->
<!--                                                <span class="op">Скрыть</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="catalog-page__firm">-->
<!--                                            <a href="#" class="catalog-page__firm-item">Zauberg</a>-->
<!--                                            <a href="#" class="catalog-page__firm-item">Heli</a>-->
<!--                                            <a href="#" class="catalog-page__firm-item">Toyota</a>-->
<!--                                            <a href="#" class="catalog-page__firm-item">TCM</a>-->
<!--                                            <a href="#" class="catalog-page__firm-item">JAC</a>-->
<!--                                            <a href="#" class="catalog-page__firm-item">Doosan</a>-->
<!--                                            <a href="#" class="catalog-page__firm-item">Komatsu</a>-->
<!--                                        </div>-->

                    <div class="catalog-page__fl-m">Фильтры</div>

                    <div class="catalog-page__bt">
                        <div class="catalog-page__sort">
                            <div class="catalog-page__sort-title">Сортировка:</div>
                            <?php
                            if ($_GET["sort"]) {
                                $_SESSION["sort"] = $_GET["sort"];
                            } else {
                                $_GET["sort"] = $_SESSION["sort"];
                            }

                            switch ($_GET["sort"]) {
                                case "price-desc":
                                    $sortName = "Сначала дорогие";
                                    break;
                                case "price-asc":
                                    $sortName = "Cначала недорогие";
                                    break;
                                case "date":
                                    $sortName = "Сначала новые";
                                    break;
                                default:
                                    $sortName = "По умолчанию";
                            }
                            if ($_GET["sort"] == "price-desc" || $_GET["sort"] == "price-asc") {
                                $filter["SORT"] = "PROPERTY_PRICE_SALE";
                            }
                            if ($_GET["sort"] == "price-desc") {
                                $filter["SORT_ORDER"] = "DESC";
                            }
                            if ($_GET["sort"] == "price-asc") {
                                $filter["SORT_ORDER"] = "ASC";
                            }
                            if ($_GET["sort"] == "date") {
                                $filter["SORT"] = "DATE_CREATE";
                                $filter["SORT_ORDER"] = "DESC";
                            } ?>

                            <div class="catalog-page__sort-in">
                                <div class="catalog-page__sort-tt"><?= $sortName ?></div>
                                <div class="catalog-page__sort-drop">
                                    <div onclick="location.replace('?sort=price-asc')"
                                         class="catalog-page__sort-drop-item <?= $_SESSION["sort"] == "price-asc" ? "active" : "" ?>">
                                        Cначала недорогие
                                    </div>
                                    <div onclick="location.replace('?sort=price-desc')"
                                         class="catalog-page__sort-drop-item <?= $_SESSION["sort"] == "price-desc" ? "active" : "" ?>">
                                        Сначала дорогие
                                    </div>
                                    <div onclick="location.replace('?sort=date')"
                                         class="catalog-page__sort-drop-item <?= $_SESSION["sort"] == "date" ? "active" : "" ?>">
                                        Сначала новые
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php


                $sectionId = $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => "PROPERTY_ALLOW_SALE",
                        "ELEMENT_SORT_ORDER" => "DESC",
                        "ELEMENT_SORT_FIELD2" => $filter["SORT"] ? $filter["SORT"] : $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $filter["SORT_ORDER"] ? $filter["SORT_ORDER"] : $arParams["ELEMENT_SORT_ORDER2"],


                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                        'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                        'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                        'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                        'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                        'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                        "ADD_SECTIONS_CHAIN" => "Y",
                    ),
                    $component
                );
                unset($GLOBALS["arrFilter"]);
                ?>
            </div>
        </div>

        <?php $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "bottom_text",
            array(
                "ADD_ELEMENT_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_ID" => 112,
                "IBLOCK_ID" => "2",
                "IBLOCK_TYPE" => "areas",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_TITLE" => "N",
                "PROPERTY_CODE" => [],
                "FIELD_CODE" => ["PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT"],
                "SECTION" => $sectionId
            )
        ); ?>

    </div>
</section>

<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "bottom_article",
    array(
        "ADD_ELEMENT_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_ID" => 112,
        "IBLOCK_ID" => "2",
        "IBLOCK_TYPE" => "areas",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_TITLE" => "N",
        "PROPERTY_CODE" => ["*"],
        "FIELD_CODE" => ["PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT"],
        "MY_SECTION" => $sectionId
    )
); ?>



