<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>
<section>
            <div class="container">
                <div class="block__padd">
                    <div class="crumbs">
                        <ol>
                            <li><a href="#">Главная</a></li>
                            <li>Полезная информация</li>
                        </ol>
                    </div>
                    <div class="pagehead">
                        <div class="pagehead__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/welcome/bg-welcome-1.png" alt="" /></div>
                        <div class="pagehead__body">
                            <div class="pagehead__content">
                                <div class="h1">Полезная информация</div>
                                <p>Подберем диски для любой машины</p>
                            </div>
                            <div class="pagehead__footer">
                                <div class="row">
                                    <div class="col-12 col-md-auto"><button class="mbtn mbtn__primary mbtn__big d-block w-100" type="button" data-fancybox-html="data-fancybox-html" data-src="#js--modal-order">Оставить заявку</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list", 
                    "info", 
                    array(
                        "IBLOCK_ID" => "12",
                        "IBLOCK_TYPE" => "content",
                        "NEWS_COUNT" => "20",
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