<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
?>
            <?php
            $GLOBALS["arrFilter"]["!ID"] = $arParams["ELEMENT_ID"];
            $APPLICATION->IncludeComponent(
	            "bitrix:catalog.section",
	            "main",
	            array(
		            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
		            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
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
		            "FILTER_NAME" => "arrFilter",
		            "CACHE_TYPE" => "N", // breadcrumb 
		            "CACHE_TIME" => $arParams["CACHE_TIME"],
		            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
		            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		            "SET_TITLE" => $arParams["SET_TITLE"],
		            "MESSAGE_404" => $arParams["MESSAGE_404"],
		            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
		            "SHOW_404" => $arParams["SHOW_404"],
		            "FILE_404" => $arParams["FILE_404"],
		            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		            "PAGE_ELEMENT_COUNT" => 4,
		            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		            "PRICE_CODE" => $arParams["PRICE_CODE"],
		            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		            
		            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
		            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
		            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
		            
		            
		            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		            "SECTION_CODE" => $arParams["SECTION_CODE"],
		            "ADD_SECTIONS_CHAIN" => "N",
                    "TITLE" => "Похожие товары",
		            "DISPLAY_BOTTOM_PAGER" => "N"
	            ),
            );
require $_SERVER["DOCUMENT_ROOT"] . "/local/templates/main/inc/bottom_forms.php"
?>

