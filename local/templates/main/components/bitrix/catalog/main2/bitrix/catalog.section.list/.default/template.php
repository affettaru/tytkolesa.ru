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
echo("!!!!");
$emptyImage = SITE_TEMPLATE_PATH . "/assets/img/product-empty-cat.jpg";
if (!empty($arResult['SECTIONS'])):?>
    <section class="catalog-category">
        <div class="container">
            <div class="catalog-category__inner">
                <div class="catalog-category__row">
                    <?php $c = 1; ?>
                    <?php foreach ($arResult["SECTIONS"] as $arSection): ?>
                    <?php
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arSection['ID'],$arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        $id = $this->GetEditAreaId($arSection['ID']);
                        ?>
                        <div id="<?= $id ?>" class="catalog-category__cell">
                            <div class="catalog-category__item">
                                <div class="catalog-category__l">
                                    <div class="catalog-category__title"><?= $arSection["NAME"] ?></div>
                                    <div class="catalog-category__tx"><?= $arSection["DESCRIPTION"] ?></div>
                                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>" class="btn btn-prim btn-min">Подобрать
                                        оборудование</a>
                                </div>
                                <div class="catalog-category__r">
                                    <img src="<?= $arSection["PICTURE"]["SRC"] ?>" alt="<?= $APPLICATION->GetProperty("title") ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $APPLICATION->GetProperty("title") ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                </div>
                            </div>
                            <button onclick="location.replace('<?= $arSection["SECTION_PAGE_URL"] ?>')"></button>
                        </div>
                        <?php $c++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
