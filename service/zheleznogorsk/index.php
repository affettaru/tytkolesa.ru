<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Шиномонтаж в Железногорске");
?>
<section>
            <div class="container">
                <div class="block__padd">
                    <div class="crumbs">
                        <ol>
                            <li><a href="#">Главная</a></li>
                            <li>Шиномонтаж в Железногорске</li>
                        </ol>
                    </div>
                    <div class="pagehead">
                        <div class="pagehead__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/welcome/bg-welcome-0.png" alt="" /></div>
                        <div class="pagehead__body">
                            <div class="pagehead__content">
                                <div class="h1">Шиномонтаж в Железногорске</div>
                                <p>Гарантия безопасности на каждый километр – выберите надежное решение!</p>
                            </div>
                            <div class="pagehead__footer">
                                <div class="row">
                                    <div class="col-12 col-md-auto"><button class="mbtn mbtn__primary mbtn__big d-block w-100" type="button" data-fancybox-html="data-fancybox-html" data-src="#js--modal-record">Записаться</button></div>
									<?if(!CModule::IncludeModule("iblock"))
										return; 
										$res = CIBlockElement::GetList(array("SORT"=>"ASC"),array('IBLOCK_ID' => 9, 'ID'=>332), false, false, array("PROPERTY_PRICE_FILE"));
										while ($row = $res->Fetch())
										{
											$url=CFile::GetPath($row["PROPERTY_PRICE_FILE_VALUE"]);
										}
											if($url){?>
                                    <div class="col-12 col-md-auto"><a class="mbtn mbtn__grey2 mbtn__big d-block w-100" href="<?=$url?>" download="zheleznogorsk-price">Скачать прайс-лист</a></div><?}?>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block__padd">
                    <div class="h1">Фотографии</div>
					<?php
                    $GLOBALS['arrFilter'] = array('ID' => 332);
				$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider", 
	array(
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "content",
		"NEWS_COUNT" => "10",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TEXT",
			3 => "MORE_FOTO",
		),
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "slider",
		"FILTER_NAME" => "arrFilter",
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
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
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
                <div class="block__padd">
                    <div class="h1">Контакты</div>

                    <?php
                    $GLOBALS['arrFilter'] = array('ID' => 332);
				$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"contacts", 
	array(
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "content",
		"NEWS_COUNT" => "10",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "contacts",
		"FILTER_NAME" => "arrFilter",
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
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
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
            </div>
        </section><!-- form invite-->
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
); ?><!-- form invite-->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>