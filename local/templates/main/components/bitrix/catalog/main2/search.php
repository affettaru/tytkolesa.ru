<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
//header("location: /catalog/");
///** @var array $arParams */
///** @var array $arResult */
///** @global CMain $APPLICATION */
///** @global CUser $USER */
///** @global CDatabase $DB */
///** @var CBitrixComponentTemplate $this */
///** @var string $templateName */
///** @var string $templateFile */
///** @var string $templateFolder */
///** @var string $componentPath */
//
///** @var CBitrixComponent $component */
//
//use Bitrix\Main\Loader;
//use Bitrix\Main\ModuleManager;
//
//$this->setFrameMode(true);
////"RESTART" => "Y"
//?>
<!--<section class="bread">-->
<!--    <div class="container">-->
<!--        <div class="bread__inner">-->
<!--            --><?php
//            $APPLICATION->IncludeComponent(
//                "bitrix:breadcrumb",
//                "main",
//                array(
//                    "PATH" => "",
//                    "SITE_ID" => "s1",
//                    "START_FROM" => "0"
//                )
//            ); ?>
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!---->
<!--<section class="catalog-page">-->
<!--    <div class="container">-->
<!--        <div class="catalog-page__inner">-->
<!---->
<!--            <div class="catalog-page__left">-->
<!--                --><?php
//                $APPLICATION->IncludeComponent(
//                    "bitrix:catalog.section.list",
//                    "tree",
//                    array(
//                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
//                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
//                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
//                        "CACHE_TIME" => $arParams["CACHE_TIME"],
//                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
//                        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
//                        "TOP_DEPTH" => 4,
//                        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
//                        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
//                        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
//                        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
//                        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
//                        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
//
//                    ),
//                    $component,
//                    array("HIDE_ICONS" => "Y")
//                );
//                ?>
<!---->
<!--                --><?php
//                $APPLICATION->IncludeComponent(
//                    "bitrix:catalog.smart.filter",
//                    "main",
//                    array(
//                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
//                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
//                        "SECTION_ID" => $arCurSection['ID'],
//                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
//                        "FILTER_NAME" => $arParams["FILTER_NAME"],
//                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
//                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
//                        "CACHE_TIME" => $arParams["CACHE_TIME"],
//                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
//                        "SAVE_IN_SESSION" => "N",
//                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
//                        "XML_EXPORT" => "N",
//                        "SECTION_TITLE" => "NAME",
//                        "SECTION_DESCRIPTION" => "DESCRIPTION",
//                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
//                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
//                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
//                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
//                        "SEF_MODE" => $arParams["SEF_MODE"],
//                        "SEF_RULE" => "/catalog/filter/#SMART_FILTER_PATH#/apply/",
//                        "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
//                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
//                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
//                    ),
//                    $component,
//                    array('HIDE_ICONS' => 'Y')
//                );
//                echo "<pre>"; var_dump($arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"]); echo "</pre>";
//                ?>
<!---->
<!--            </div>-->
<!---->
<!--            <div class="catalog-page__right">-->
<!---->
<!--                --><?php
//                $filter = ["%NAME" => $_GET["q"]];
//                $GLOBALS[$arParams["FILTER_NAME"]] = array_merge($GLOBALS[$arParams["FILTER_NAME"]], $filter);
//
//                $sectionId = $APPLICATION->IncludeComponent(
//                    "bitrix:catalog.section",
//                    "search",
//                    array(
//                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
//                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
//                        "ELEMENT_SORT_FIELD" => "PROPERTY_ALLOW_SALE",
//                        "ELEMENT_SORT_ORDER" => "DESC",
//                        "ELEMENT_SORT_FIELD2" => $filter["SORT"] ? $filter["SORT"] : $arParams["ELEMENT_SORT_FIELD2"],
//                        "ELEMENT_SORT_ORDER2" => $filter["SORT_ORDER"] ? $filter["SORT_ORDER"] : $arParams["ELEMENT_SORT_ORDER2"],
//
//
//                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
//                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
//                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
//                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
//                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
//                        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
//                        "BASKET_URL" => $arParams["BASKET_URL"],
//                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
//                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
//                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
//                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
//                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
//                        "FILTER_NAME" => $arParams["FILTER_NAME"],
//                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
//                        "CACHE_TIME" => $arParams["CACHE_TIME"],
//                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
//                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
//                        "SET_TITLE" => $arParams["SET_TITLE"],
//                        "MESSAGE_404" => $arParams["MESSAGE_404"],
//                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
//                        "SHOW_404" => $arParams["SHOW_404"],
//                        "FILE_404" => $arParams["FILE_404"],
//                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
//                        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
//                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
//                        "PRICE_CODE" => $arParams["PRICE_CODE"],
//                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
//                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
//
//                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
//                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
//                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
//                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
//                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
//
//                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
//                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
//                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
//                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
//                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
//                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
//                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
//                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
//                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
//                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
//                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
//
//                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
//                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
//                        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
//                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
//                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
//                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
//                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
//                        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
//
//                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
//                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
//                        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
//                        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
//                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
//                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
//                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
//                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
//
//                        'LABEL_PROP' => $arParams['LABEL_PROP'],
//                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
//                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
//
//                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
//                        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
//                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
//                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
//                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
//                        'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
//                        'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
//                        'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
//                        'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
//                        'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
//
//                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
//                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
//                        'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
//                        "ADD_SECTIONS_CHAIN" => "Y",
//                    ),
//                    $component
//                );
//                unset($GLOBALS["arrFilter"]);
//                ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="catalog-page__descr">-->
<!--            --><?php //= html_entity_decode($GLOBALS["CONTACTS"]["SEARCH_TEXT"]["TEXT"]) ?>
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!---->
<?php //$APPLICATION->IncludeComponent(
//    "bitrix:news.detail",
//    "bottom_article",
//    Array(
//        "ADD_ELEMENT_CHAIN" => "N",
//        "ADD_SECTIONS_CHAIN" => "N",
//        "CACHE_GROUPS" => "Y",
//        "CACHE_TIME" => "36000000",
//        "CACHE_TYPE" => "A",
//        "CHECK_DATES" => "Y",
//        "DETAIL_URL" => "",
//        "DISPLAY_BOTTOM_PAGER" => "Y",
//        "DISPLAY_DATE" => "Y",
//        "DISPLAY_NAME" => "Y",
//        "DISPLAY_PICTURE" => "Y",
//        "DISPLAY_PREVIEW_TEXT" => "Y",
//        "DISPLAY_TOP_PAGER" => "N",
//        "ELEMENT_ID" => $GLOBALS["CONTACTS"]["SEARCH_ARTICLE"],
//        "IBLOCK_ID" => "2",
//        "IBLOCK_TYPE" => "areas",
//        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
//        "SET_BROWSER_TITLE" => "N",
//        "SET_META_DESCRIPTION" => "N",
//        "SET_META_KEYWORDS" => "N",
//        "SET_TITLE" => "N",
//        "PROPERTY_CODE" => ["*"],
//        "FIELD_CODE" => ["PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_TEXT"],
//    )
//); ?>
<!---->
<!---->
<!---->
