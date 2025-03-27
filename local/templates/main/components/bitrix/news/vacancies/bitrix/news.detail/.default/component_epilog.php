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

<?php
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"work_with_us",
	array(
		"IBLOCK_ID" => 5,
		"IBLOCK_TYPE" => "Content",
		"NEWS_COUNT" => "",
		"FIELD_CODE" => array("NAME"),
		"PROPERTY_CODE" => array("TILE_BIG", "TITLE_SMALL"),
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
	)
);
?>
<?php require $_SERVER["DOCUMENT_ROOT"] . "/local/templates/main/inc/bottom_forms.php"?>
