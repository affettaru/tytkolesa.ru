<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "tytkolesa.ru интернет-магазин дисков и шин");
// $APPLICATION->SetTitle("tytkolesa.ru интернет-магазин дисков и шин");
$APPLICATION->SetPageProperty("description", "tytkolesa.ru интернет-магазин дисков и шин");

?><section class="welcome">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_banner", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "main_banner",
		"FILTER_NAME" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
</div>
 </section><!-- /welcome-->
 <!-- filter--> 
  <section class="block__padd">
<div class="container">
	<div class="filter__wrapper row">
		
	
		
		<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"shiny", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "vertical",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "catalog",
		"PAGER_PARAMS_NAME" => "arrPager",
		"POPUP_POSITION" => "left",
		"PREFILTER_NAME" => "smartPreFilter",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => "shiny",
		"SECTION_CODE_PATH" => "",
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => "",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "/catalog/shiny/filter/#SMART_FILTER_PATH#/apply/",
		"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
		"TEMPLATE_THEME" => "blue",
		"XML_EXPORT" => "N",
		"COMPONENT_TEMPLATE" => "shiny"
	),
	false
);?>
 
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"diski", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "vertical",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "catalog",
		"PAGER_PARAMS_NAME" => "arrPager",
		"POPUP_POSITION" => "left",
		"PREFILTER_NAME" => "smartPreFilter",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => "diski",
		"SECTION_CODE_PATH" => "",
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => "",
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "/catalog/diski/filter/#SMART_FILTER_PATH#/apply/",
		"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
		"TEMPLATE_THEME" => "blue",
		"XML_EXPORT" => "N",
		"COMPONENT_TEMPLATE" => "diski"
	),
	false
);?>

	<!-- </div> -->

</div>
 </section>
 
 
 <!-- filter--><!-- brands--> <section class="block__padd" id="tabs">
<div class="container">
	<div class="h1">
		 Популярные производители
	</div>
	<div class="tabs">
		<ul class="tabs__nav">
			<li><button class="tabs__nav__link js--tabs-link active" type="button" data-tab="tab_1">Бренды шин</button></li>
			<li><button class="tabs__nav__link js--tabs-link" type="button" data-tab="tab_2">Бренды дисков</button></li>
		</ul>
		<div class="tabs__content">
			 <!-- el-->
			<div class="tabs__content__item js--tabs-item active" id="tab_1">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"maker", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "maker",
		"FILTER_NAME" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
			</div>
			<div class="tabs__content__item js--tabs-item" id="tab_2">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"maker", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "maker",
		"FILTER_NAME" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
			</div>
			 <!-- /el-->
		</div>
	</div>
</div>
 </section><!-- brands--><!-- catalog--><section class="block__padd">
<div class="container">
	<div class="h1">
		 Новинки
	</div>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"dop", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "dop",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
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
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
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
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SECTION_CODE" => "",
		"SECTION_ID" => "16",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y"
	),
	false
);?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"dop", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "dop",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
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
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
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
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SECTION_CODE" => "",
		"SECTION_ID" => "17",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y"
	),
	false
);?>

</div>
 </section><!-- catalog--><!-- partners--> <section class="block__padd">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"partner", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "10",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "partner",
		"FILTER_NAME" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?> </section> 


<? $APPLICATION->IncludeComponent(
	"form:feedback",
	"bottom_question",
	array(
		"IBLOCK_ID" => 11,
		"IBLOCK_TYPE" => "Forms",
		"MAIL_EVENT" => array(
			0 => "CALL",
		),
		"TOKEN" => "bottom_question_form",
	),
	false
); ?>
<!-- <section class="block__padd">
<div class="container">
	<div class="invite row align-items-stretch">
		<div class="col-12 col-lg-8">
			<div class="form__wrapper">
				<div class="h2">
					 Остались вопросы? Будем рады помочь!
				</div>
				<form class="form" action="#">
					<div class="form__line row">
						<div class="col-12">
 <input class="form__input" type="text" placeholder="Имя*" name="name">
						</div>
						<div class="col-12 col-md-6">
 <input class="form__input js--inputmask" type="tel" placeholder="Телефон*" name="phone">
						</div>
						<div class="col-12 col-md-6">
 <input class="form__input form__input__error" type="mail" name="email" placeholder="E-mail*" value="asasdasd.ru">
						</div>
						<div class="col-12">
 <textarea class="form__input" name="sms" rows="3" placeholder="Сообщение"></textarea>
						</div>
						<div class="col-12 col-lg-11">
 <label class="form__check form__check__mini"><input type="checkbox" checked="checked"><span class="form__check__text">Нажимая кнопку «Отправить», я&nbsp;даю согласие на&nbsp;обработку своих персональных данных в&nbsp;соответствии с&nbsp;<a href="#" target="_blank">Политикой конфиденциальности</a></span></label>
						</div>
						<div class="col-12 col-md-6">
 <button class="mbtn mbtn__primary mbtn__big d-block w-100" type="submit">Отправить</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-12 col-lg-4 d-none d-lg-block">
			<div class="invite__img">
 <img src="/local/templates/main/img/img-invite.png" alt="">
			</div>
		</div>
	</div>
</div>
 </section> -->
 
 
 <!-- form invite--><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>