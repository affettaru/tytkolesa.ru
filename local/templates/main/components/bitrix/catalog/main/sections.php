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

// if($_SESSION['url']==1){
//     $isRent=1;
// }
?>
    
    <section class="title-main">
        <div class="container">
            <div class="title-main__inner">
	            <?$APPLICATION->IncludeComponent(
		            "bitrix:breadcrumb",
		            "main",
		            Array(
			            "PATH" => "",
			            "SITE_ID" => "s1",
			            "START_FROM" => "0"
		            )
	            );?>
                
                <h1><?= $APPLICATION->ShowTitle() ?></h1>
            </div>
        </div>
    </section>
    <section class="catalog-prod">
        <div class="container">
            <div class="catalog-prod__t">
                <div class="filter__sort">
                    <?php
                    if($_GET["sort"]){
                        $_SESSION["sort"] = $_GET["sort"];
                    }else{
	                    $_GET["sort"] = $_SESSION["sort"];
                    }
                    
                    switch ($_GET["sort"]){
                            case "price-desc": $sortName = "Сначала дороже"; break;
	                    case "price-asc": $sortName = "Сначала дешевле"; break;
	                    case "name": $sortName = "По названию"; break;
                        default: $sortName = "По умолчанию";
                    }
                    if($_GET["sort"] == "price-desc" || $_GET["sort"] == "price-asc"){
	                    $filter["SORT"] = "PROPERTY_PRICE";
                    }
                    if($_GET["sort"] == "price-desc"){
	                    $filter["SORT_ORDER"] = "DESC";
                    }
                    if($_GET["sort"] == "price-asc"){
	                    $filter["SORT_ORDER"] = "ASC";
                    }
                    if($_GET["sort"] == "name"){
	                    $filter["SORT"] = "NAME";
	                    $filter["SORT_ORDER"] = "DESC";
                    }
                    
                    ?>
                    <div class="filter__sort-title">Сортировка:</div>
                    <div class="filter__sort-drop">
                        <div class="filter__sort-drop-title"><?= $sortName ?></div>
                        <ul>
                            <li><a href="?sort=price-desc">Сначала дороже</a></li>
                            <li><a href="?sort=price-asc">Сначала дешевле</a></li>
                            <li><a href="?sort=name">По названию</a></li>
                        </ul>
                    </div>
                </div>
                <div class="catalog-prod__t-m">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/svg/ic-fltr.svg" alt="">
                </div>
            </div>
            
            <div class="catalog-prod__inner">
                <div class="catalog-prod__filter">
                    <div class="catalog-prod__filter-mob">
                        <div class="catalog-prod__filter-mob-title">Фильтры</div>
                        <div class="catalog-prod__filter-mob-close"><img src="<?=SITE_TEMPLATE_PATH?>/assets/img/svg/ic-cl.svg" alt=""></div>
                    </div>
                    <div class="filter">
	                    <?php
	                    $APPLICATION->IncludeComponent(
		                    "bitrix:catalog.section.list",
		                    "filter",
		                    array(
			                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
			                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
			                    "CACHE_TIME" => $arParams["CACHE_TIME"],
			                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			                    "TOP_DEPTH" => 3,
			                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
			                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
			                    "ADD_SECTIONS_CHAIN" => "Y",
                                "SECTION_CODE_ACTIVE" => $arResult["VARIABLES"]["SECTION_CODE"],
//                                "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
			                    "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
			                    "CACHE_FILTER" => "N",
			                    "COUNT_ELEMENTS" => "Y",
			                    "FILTER_NAME" => "sectionsFilter",
			                    "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
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
			                    "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
			                    "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
			                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			                    "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
		                    ),
		                    $component,
		                    array('HIDE_ICONS' => 'Y')
	                    );
	                    ?>
                    
                    </div>
                </div>
           
                <div class="catalog-prod__all">
	            <?php
	            $APPLICATION->IncludeComponent(
		            "bitrix:catalog.section",
		            "",
		            array(
			            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
			            "ELEMENT_SORT_FIELD" => $filter["SORT"] ? $filter["SORT"] : $arParams["ELEMENT_SORT_FIELD"],
			            "ELEMENT_SORT_ORDER" => $filter["SORT_ORDER"] ? $filter["SORT_ORDER"] : $arParams["ELEMENT_SORT_ORDER"],
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
			            "ADD_SECTIONS_CHAIN" => "Y",
			            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			            'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare']
		            ),
		            $component
	            );
	            ?>
                </div>
            
            </div>
        </div>
    </section>
    
    <section class="tx">
        <div class="container">
            <div class="tx__inner">
                <?php if($APPLICATION->GetPageProperty("SEO_TITLE")): ?>
                <h2><?= $APPLICATION->GetPageProperty("SEO_TITLE") ?></h2>
                <?php endif; ?>
	            <?php if($APPLICATION->GetPageProperty("SEO_TEXT")): ?>
                <div class="tx__tx"><?= $APPLICATION->GetPageProperty("SEO_TEXT") ?></div>
                <div class="tx__btn">
                    <span class="cl">Показать больше</span>
                    <span class="op">Скрыть</span>
                </div>
	            <?php endif; ?>
            </div>
        </div>
    </section>
<?

$GLOBALS["arrFilter"] = [
	array(
		"LOGIC" => "OR",
		"!PROPERTY_HIT" => false,
		"!PROPERTY_PROMO" => false,
		"!PROPERTY_NEW" => false,
	)
];
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"main",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "Catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"TITLE" => "Популярное"
	)
);
unset($GLOBALS["arrFilter"]);
?>

