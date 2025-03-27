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
$this->setFrameMode(true);

// foreach ($arResult["ITEMS"] as $key => $arItem) {
// 	if ($arItem["PROPERTIES"]["DISCOUNT"]["VALUE"]) {
// 		$arResult["ITEMS"][$key]["PROPERTIES"]["OLD_PRICE"]["VALUE"] = $arItem["PROPERTIES"]["PRICE"]["VALUE"];
// 		$arResult["ITEMS"][$key]["PROPERTIES"]["PRICE"]["VALUE"] = ceil($arItem["PROPERTIES"]["PRICE"]["VALUE"] / 100 * (100 - $arItem["PROPERTIES"]["DISCOUNT"]["VALUE"]));
// 	}
// }

// if($arResult["MAIN_SECTION"]["CHILD"]["CHILD"]["UF_TITLE"]){
// 	$seoTitle = $arResult["MAIN_SECTION"]["CHILD"]["CHILD"]["UF_TITLE"];
// }elseif ($arResult["MAIN_SECTION"]["CHILD"]["UF_TITLE"]){
// 	$seoTitle = $arResult["MAIN_SECTION"]["CHILD"]["UF_TITLE"];
// }else{
// 	$seoTitle = $arResult["MAIN_SECTION"]["UF_TITLE"];
// }

// if($arResult["MAIN_SECTION"]["CHILD"]["CHILD"]["UF_TEXT"]){
// 	$seoText = $arResult["MAIN_SECTION"]["CHILD"]["CHILD"]["UF_TEXT"];
// }elseif ($arResult["MAIN_SECTION"]["CHILD"]["UF_TEXT"]){
// 	$seoText = $arResult["MAIN_SECTION"]["CHILD"]["UF_TEXT"];
// }else{
// 	$seoText = $arResult["MAIN_SECTION"]["UF_TEXT"];
// }


// // $APPLICATION->SetPageProperty("SEO_TITLE", $seoTitle);
// $APPLICATION->SetPageProperty("SEO_TEXT", $seoText);
// CModule::AddAutoloadClasses("", array(
//     'AffettaCFile' => '/local/php_interface/classes/affetta/AffettaCFile.php',
// ));
?>

<div itemscope itemtype = "https://schema.org/OfferCatalog">
<span style="display:none" itemprop="name">Каталог</span>
<span style="display:none" itemprop="description"><?=$seoText?></span> 
<?

if (!empty($arResult['ITEMS'])):?>
    <div class="catalog-prod__row" itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer">
       
    <!-- <img src="http://www.example.com/image.jpg" itemprop="image"> -->
		<?php foreach ($arResult["ITEMS"] as $arItem): ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

            <div class="catalog-prod__cell" id="<?= $this->GetEditAreaId($arItem["ID"]) ?>">
                <div class="catalog__item <?= in_array($arItem["ID"], $_SESSION['fav']) ? "catalog__item_fav" : "" ?>">
                    <div class="catalog__item-img">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"></a>


                        
                        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/placeholder.png" ?>" alt="<?=$arItem["NAME"]?> арт. <?=$arItem["PROPERTIES"]["VENDOR"]["VALUE"]?> купить" title="<?=$arItem["NAME"]?> арт. <?=$arItem["PROPERTIES"]["VENDOR"]["VALUE"]?>">
                    </div>
                    <div class="catalog__item-bottom">
                        <div class="catalog__item-fav" onclick="addFavorite(<?= $arItem["ID"] ?>, this)">
                            <img itemprop="image" src="/local/templates/main/assets/img/svg/ic-fav2.svg" alt="">
                        </div>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="catalog__item-title" itemprop="url"><span  itemprop="name"><?= $arItem["NAME"] ?></span></a>
                        <span style="display:none" itemprop="description"><?=$arItem["DETAIL_TEXT"]?></span>
                        <div class="catalog__item-price">
                        <meta itemprop="price" content="<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"] ?>">
                        <!--В поле priceCurrency указывается валюта.-->
                        <meta itemprop="priceCurrency" content="RUB">
                        <!--В поле availability указывается информация о доступности товара для заказа.-->
                        <link itemprop="availability" href="http://schema.org/InStock">
                            <div class="catalog__item-price-now"><?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ? $arItem["PROPERTIES"]["PRICE"]["VALUE"] . " ₽" : "Цена не указана" ?></div>
							<?php if ($arItem["PROPERTIES"]["DISCOUNT"]["VALUE"]): ?>
                                <div class="catalog__item-price-old"><?= $arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"] ? $arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"] . " ₽" : "Цена не указана" ?></div>
							<?php endif; ?>
                        </div>
                            <div class="catalog__item-pl">
                                
                            </div>
                    </div>
                </div>
            </div>
		<?php endforeach; ?>
    </div>
	<?php if ($arResult["NAV_STRING"]): ?>
		<?= $arResult["NAV_STRING"] ?>
	<?php endif; ?>
    </div>
<?php
else: ?>
 
<?php
endif; ?>