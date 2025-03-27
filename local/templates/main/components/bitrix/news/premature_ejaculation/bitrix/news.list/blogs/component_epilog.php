<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

?>
</div>
</section>
<section class="section section__pt0">
<?php 

$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"blog",
	array(
		"IBLOCK_ID" => 4,
		"IBLOCK_TYPE" => "Content",
		"NEWS_COUNT" => "20",
		"FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"),
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "DESC",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
        "FILTER_NAME" => "arrFilter"
	)
);


?>
</section>

