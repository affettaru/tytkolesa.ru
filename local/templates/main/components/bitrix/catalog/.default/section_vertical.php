<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = $arParams['COMMON_ADD_TO_BASKET_ACTION'] ?? '';
}
else
{
	$basketAction = $arParams['SECTION_ADD_TO_BASKET_ACTION'] ?? '';
}
// echo "<pre>Template arResult: "; print_r($GLOBALS['arrFilter']); echo "</pre>";
$sectionListParams = array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
	"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
	"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
	"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
	"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
	"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
);
if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
{
	$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
	if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
	{
		$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
	}
}?>
<?

// unset($sectionListParams);


if ($isFilter || $isSidebar): ?>
	<div class="col-12 col-lg-auto <?=(isset($arParams['FILTER_HIDE_ON_MOBILE']) && $arParams['FILTER_HIDE_ON_MOBILE'] === 'Y' ? ' hidden-xs' : '')?>">
		<? if ($isFilter): ?>
			<div class="filter-side js--filter">
				<? 
				// echo "<pre>Template arResult: "; print_r($arParams["FILTER_NAME"]); echo "</pre>";

				// $APPLICATION->IncludeComponent(
				// 	"bitrix:catalog.smart.filter", 
				// 	".default", 
				// 	array(
				// 		"COMPONENT_TEMPLATE" => ".default",
				// 		"IBLOCK_TYPE" => "catalog",
				// 		"IBLOCK_ID" => "10",
				// 		"PREFILTER_NAME" => "smartPreFilter",
				// 		"FILTER_NAME" => "arrFilter",
				// 		"HIDE_NOT_AVAILABLE" => "N",
				// 		"TEMPLATE_THEME" => "blue",
				// 		"FILTER_VIEW_MODE" => "vertical",
				// 		"POPUP_POSITION" => "left",
				// 		"DISPLAY_ELEMENT_COUNT" => "Y",
				// 		"SEF_MODE" => "Y",
				// 		"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
				// 		"SECTION_ID" => $arCurSection['ID'],
				// 		"SECTION_CODE" => $arCurSection['CODE'],
				// 		// "SECTION_CODE_PATH" => "",
				// 		"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
				// 		"CACHE_TYPE" => "A",
				// 		"CACHE_TIME" => "36000000",
				// 		"CACHE_GROUPS" => "Y",
				// 		"SAVE_IN_SESSION" => "N",
				// 		"PAGER_PARAMS_NAME" => "arrPager",
				// 		"PRICE_CODE" => array(
				// 			0 => "BASE",
				// 		),
				// 		"CONVERT_CURRENCY" => "N",
				// 		"XML_EXPORT" => "N",
				// 		"SECTION_TITLE" => "-",
				// 		"SECTION_DESCRIPTION" => "-"
				// 	),
				// 	false
				// );
				// echo '<pre>';
				// print_r($_REQUEST);
				// echo '</pre>';
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"",
					array(
						// "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						// "IBLOCK_ID" => $arParams["IBLOCK_ID"],
						// "SECTION_ID" => $arCurSection['ID'],
						// // "PREFILTER_NAME" => "smartPreFilter",
						// "FILTER_NAME" => $arParams["FILTER_NAME"],
						// "PRICE_CODE" => $arParams["~PRICE_CODE"],
						// "CACHE_TYPE" => $arParams["CACHE_TYPE"],
						// "CACHE_TIME" => $arParams["CACHE_TIME"],
						// "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						// "SAVE_IN_SESSION" => "N",
						// "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
						// "XML_EXPORT" => "N",
						// "SEF_MODE" => "Y",
						// // "SHOW_ALL_WO_SECTION" => "Y",
						// "SECTION_TITLE" => "NAME",
						// // "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
						// "SECTION_DESCRIPTION" => "DESCRIPTION",
						// 'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
						// "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
						// 'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						// 'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						// // "SEF_MODE" => $arParams["SEF_MODE"],
						// "SEF_RULE" => "/catalog/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
						// "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
						// "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
						// "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
						
						// "CACHE_GROUPS" => "Y",
						// "CACHE_TIME" => "36000000",
						// "CACHE_TYPE" => "A",
						// "CONVERT_CURRENCY" => "N",
						// "DISPLAY_ELEMENT_COUNT" => "Y",
						// "FILTER_NAME" => "arrFilter",
						// "FILTER_VIEW_MODE" => "vertical",
						// "HIDE_NOT_AVAILABLE" => "N",
						// "IBLOCK_ID" => "10",
						// "IBLOCK_TYPE" => "catalog",
						// "PAGER_PARAMS_NAME" => "arrPager",
						// "POPUP_POSITION" => "left",
						// "PREFILTER_NAME" => "smartPreFilter",
						// "PRICE_CODE" => array(
						// 	0 => "BASE",
						// ),
						// "SAVE_IN_SESSION" => "N",
						// "SECTION_CODE" => "shiny",
						// "SECTION_CODE_PATH" => "",
						// "SECTION_DESCRIPTION" => "-",
						// "SECTION_ID" => "",
						// "SECTION_TITLE" => "-",
						// "SEF_MODE" => "Y",
						// "SEF_RULE" => "/catalog/shiny/filter/#SMART_FILTER_PATH#/apply/",
						// "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
						// "TEMPLATE_THEME" => "blue",
						// "XML_EXPORT" => "N",
						// "COMPONENT_TEMPLATE" => "shiny"
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
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_MODE" => "N",
						"INSTANT_RELOAD" => "N",
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
                        // "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],


						// "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        // "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        // "SECTION_ID" => $arCurSection['ID'],
                        // "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        // "FILTER_NAME" => $arParams["FILTER_NAME"],
                        // "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        // "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        // "CACHE_TIME" => $arParams["CACHE_TIME"],
                        // "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        // "SAVE_IN_SESSION" => "N",
                        // "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        // "XML_EXPORT" => "N",
                        // "SECTION_TITLE" => "NAME",
                        // "SECTION_DESCRIPTION" => "DESCRIPTION",
                        // 'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        // "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        // 'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        // 'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        // "SEF_MODE" => $arParams["SEF_MODE"],
                        // "SEF_RULE" => "/catalog/shiny/filter/#SMART_FILTER_PATH#/apply/",
                        // "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
                        // "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        // "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
						// "SEF_RULE" => "/catalog/shiny/filter/#SMART_FILTER_PATH#/apply/",
						// "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				// echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
				?>
			</div>
		<? endif ?>
		<? if ($isSidebar): ?>
			<div class="hidden-xs">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => $arParams["SIDEBAR_PATH"],
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<?endif?>
	</div>
<?endif?>

<!-- <div class="col-12 col-lg"> -->
	<!-- <div class="row"> -->
		<!-- <div class="col-xs-12"> -->
			<?
			
			if (ModuleManager::isModuleInstalled("sale"))
			{
				$arRecomData = array();
				$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
				$obCache = new CPHPCache();
				if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
				{
					$arRecomData = $obCache->GetVars();
				}
				elseif ($obCache->StartDataCache())
				{
					if (Loader::includeModule("catalog"))
					{
						$arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
						$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
					}
					$obCache->EndDataCache($arRecomData);
				}

				
			}
			?>
		<!-- </div> -->
		<!-- <div class="col-xs-12"> -->
			<?


			if ($arParams["USE_COMPARE"]=="Y")
			{
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.compare.list",
					"",
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"NAME" => $arParams["COMPARE_NAME"],
						"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
						"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
						"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
						"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
						'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
						'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);
			}?>
<div class="col-12 col-lg">

<?
if ($_GET["sort"]) {
	$_SESSION["sort"] = $_GET["sort"];
} else {
	$_GET["sort"] = $_SESSION["sort"];
}

switch ($_GET["sort"]) {
	case "price-desc":
		$sortName = "По цене (убывание)";
		break;
	case "price-asc":
		$sortName = "По цене (возрастание)";
		break;
}
if ($_GET["sort"] == "price-desc" || $_GET["sort"] == "price-asc" || empty($_GET["sort"])) {
	
	$filter["SORT"] = "CATALOG_PRICE_1";
	
}

if ($_GET["sort"] == "price-desc") {
	$filter["SORT_ORDER"] = "DESC";
	$sortN="По цене (убывание)";
}
if ($_GET["sort"] == "price-asc"|| empty($_GET["sort"])) {
	$filter["SORT_ORDER"] = "ASC";
	$sortN="По цене (возрастание)";
}
// echo "<pre>Template arResult: "; print_r($GLOBALS["arrFilter2"]); echo "</pre>";
// echo "<pre>Template arResult: "; print_r($GLOBALS["arrFilter"]); echo "</pre>";
 ?>

<div class="catalog__sort row align-items-center">
	<div class="col col-lg-auto">
		<div class="columns__label">Сортировка:</div>
	</div>
	<div class="col-auto">
		<div class="catalog__sort__mobile js--sort">
			<div class="catalog__sort__mobile__link js--sort-btn d-lg-none <?= $_SESSION["sort"] == "price-asc" ? "active" : "" ?>"><a href="<?= $APPLICATION->GetCurPageParam('sort=price-asc',['sort']); ?>"><span><?=$sortN?></span></a></div>
			<ul class="catalog__sort__list">
				<li><button class="js--sort-link catalog__sort__list__button <?= $_SESSION["sort"] == "price-asc" ? "active" : "" ?>"><a href="<?= $APPLICATION->GetCurPageParam('sort=price-asc',['sort']); ?>">По цене (возрастание)</a></button></li>
				<li><button class="js--sort-link catalog__sort__list__button <?= $_SESSION["sort"] == "price-desc" ? "active" : "" ?>"><a href="<?= $APPLICATION->GetCurPageParam('sort=price-desc',['sort']); ?>">По цене (убывание)</a></button></li>
			</ul>
		</div>
	</div>
</div>
			<?$intSectionID = $APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"",
				array(
					// "SHOW_ALL_WO_SECTION" => "Y",
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
					"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
					"ELEMENT_SORT_FIELD2" => $filter["SORT"] ? $filter["SORT"] : $arParams["ELEMENT_SORT_FIELD2"],
					"ELEMENT_SORT_ORDER2" =>  $filter["SORT_ORDER"] ? $filter["SORT_ORDER"] : $arParams["ELEMENT_SORT_ORDER2"],
					"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
					"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
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
					"MESSAGE_404" => $arParams["~MESSAGE_404"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"SHOW_404" => $arParams["SHOW_404"],
					"FILE_404" => $arParams["FILE_404"],
					"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
					"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
					"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
					"PRICE_CODE" => $arParams["~PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
					"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
					"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
					"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

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
					"LAZY_LOAD" => $arParams["LAZY_LOAD"],
					"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
					"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

					"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
					"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
					"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
					'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

					'LABEL_PROP' => $arParams['LABEL_PROP'],
					'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
					'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'] ?? '',
					'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
					'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
					'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
					'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
					'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
					'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
					'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
					'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
					'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

					'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
					'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
					'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
					'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
					'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
					'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
					'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
					'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
					'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
					'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
					'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
					'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
					'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
					'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
					'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
					'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
					'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
					'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

					'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
					'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
					'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

					'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
					"ADD_SECTIONS_CHAIN" => "N",
					'ADD_TO_BASKET_ACTION' => $basketAction,
					'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
					'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
					'COMPARE_NAME' => $arParams['COMPARE_NAME'],
					'USE_COMPARE_LIST' => 'Y',
					'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
					'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
					'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
				),
				$component
			);
			?>
		</div>
		<?
		$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;

		if (ModuleManager::isModuleInstalled("sale"))
		{
			if (!empty($arRecomData))
			{
				if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')
				{
					?>
					<!-- <div class="col-xs-12 " data-entity="parent-container">
						<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
							<?=GetMessage('CATALOG_PERSONAL_RECOM')?>
						</div> -->
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:catalog.section",
							"",
							array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
								"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
								"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
								"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
								"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
								"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
								"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
								"BASKET_URL" => $arParams["BASKET_URL"],
								"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
								"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
								"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
								"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
								"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"CACHE_FILTER" => $arParams["CACHE_FILTER"],
								"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
								"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
								"PAGE_ELEMENT_COUNT" => 0,
								"PRICE_CODE" => $arParams["~PRICE_CODE"],
								"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
								"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

								"SET_BROWSER_TITLE" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "N",
								"ADD_SECTIONS_CHAIN" => "N",

								"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
								"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
								"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
								"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
								"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

								"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
								"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
								"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
								"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
								"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
								"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
								"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
								"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

								"SECTION_ID" => $intSectionID,
								"SECTION_CODE" => "",
								"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
								"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
								"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'CURRENCY_ID' => $arParams['CURRENCY_ID'],
								'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
								'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

								'LABEL_PROP' => $arParams['LABEL_PROP'],
								'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
								'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'] ?? '',
								'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
								'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
								'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
								'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
								'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
								'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
								'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
								'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
								'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

								"DISPLAY_TOP_PAGER" => 'N',
								"DISPLAY_BOTTOM_PAGER" => 'N',
								"HIDE_SECTION_DESCRIPTION" => "Y",

								"RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
								"SHOW_FROM_SECTION" => 'Y',

								'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
								'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
								'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
								'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
								'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
								'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
								'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
								'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
								'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
								'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
								'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
								'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
								'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
								'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
								'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
								'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
								'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
								'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

								'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
								'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
								'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

								'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
								'ADD_TO_BASKET_ACTION' => $basketAction,
								'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
								'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
								'COMPARE_NAME' => $arParams['COMPARE_NAME'],
								'USE_COMPARE_LIST' => 'Y',
								'BACKGROUND_IMAGE' => '',
								'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
							),
							$component
						);
						?>
					<!-- </div> -->
					<?
				}
			}
		}

		
		?>
	<!-- </div> -->
</div>