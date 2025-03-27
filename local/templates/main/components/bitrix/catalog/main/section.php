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

$this->setFrameMode(true);
?>
<section class="title-main">
    <div class="container">
        <div class="title-main__inner">
	        <?php
	        $APPLICATION->IncludeComponent(
		        "bitrix:breadcrumb",
		        "main",
		        array(
			        "PATH" => "",
			        "SITE_ID" => "s1",
			        "START_FROM" => "1"
		        )
	        );
	        ?>

            <h1>Каталог</h1>
        </div>
    </div>
</section>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "",
    array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
        "ADD_SECTIONS_CHAIN" => ("Y"),
        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "Y",
        
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);
?>
