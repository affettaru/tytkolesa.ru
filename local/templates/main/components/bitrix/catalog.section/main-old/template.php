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

$pathArr = explode("/", $_SERVER["REQUEST_URI"]);
$isRent = in_array("arenda", $pathArr);
?>
<?
if (!empty($arResult['ITEMS'])):?>
    <section class="catalog-p">
        <div class="container">
            <div class="catalog-p__inner">
                <h2>Похожие товары</h2>

                <div class="catalog-p__row">
                    <?php $c = 1; ?>
                    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                        <div class="catalog-p__cell">
                            <div class="catalog-page__item">
                                <div class="catalog-page__item-img">
                                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/placeholder.png" ?>"
                                         alt="<?= $arItem["NAME"] ?><?= $c ? "- рис " . $c : "" ?>"
                                         title="<?= $arItem["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                </div>
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
                                   class="catalog-page__item-title"><?= $arItem["NAME"] ?></a>
                                <?php if ($arItem["DISPLAY_PROPERTIES"] && !empty($arItem["DISPLAY_PROPERTIES"])): ?>
                                    <div class="catalog-page__item-list">
                                        <?php $i=0; foreach ($arItem["DISPLAY_PROPERTIES"] as $prop): ?>
                                            <div class="catalog-page__item-list-it">
                                                
                                                <span><?= $prop["NAME"] ?></span>
                                                <?if($prop["USER_TYPE_SETTINGS"]["TABLE_NAME"]){?>
                                                    <?
                                                    $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                                                        array("filter" => array('TABLE_NAME' => $prop["USER_TYPE_SETTINGS"]["TABLE_NAME"])))->fetch();
                                                    if (isset($hlblock['ID']))
                                                    {
                                                        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                                                        $entity_data_class = $entity->getDataClass();
                                                        $res = $entity_data_class::getList( array('filter'=>array()) );
                                                        while ($item = $res->fetch())
                                                        {
                                                            if($item["UF_XML_ID"]==$prop["VALUE"]){?>
                                                            <span><?= $item["UF_NAME"] ?></span>
                                                        <?}}}
                                                    }else{?>
                                                <span><?= $prop["VALUE"] ?></span><?}?>
                                            </div>
                                        <?php $i++;if($i==3){break;}endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="catalog-page__item-al">
                                    <?php if ($arItem["PRICE_RENT"] && $arItem["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                        <div class="catalog-page__item-al-in">
                                            <span>Цена в сутки с НДС</span>
                                            <span><?= $arItem["PRICE_RENT"] ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($arItem["PRICE_SALE"] && $arItem["PROPERTIES"]["ALLOW_SALE"]["VALUE"]): ?>
                                        <div class="catalog-page__item-al-in">
                                            <span>Цена покупки</span>
                                            <span><?= $arItem["PRICE_SALE"] ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="catalog-page__item-btn">
                                    <?php if ($arItem["PRICE_RENT"] && $arItem["PROPERTIES"]["ALLOW_RENT"]["VALUE"] && $isRent): ?>
                                        <a href="javascript:void(0)" data-remodal-target="cl2" class="btn btn-prim">Аренда
                                            в 1
                                            клик</a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" data-remodal-target="cl1" class="btn btn-prim">Получить
                                            КП</a>
                                    <?php endif; ?>
                                    <a href="javascript:void(0)"
                                       onclick="location.replace('<?= $arItem["DETAIL_PAGE_URL"] ?>')"
                                       class="btn btn-bord">Подробнее</a>
                                </div>
                            </div>
                        </div>
                        <?php $c++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php
endif; ?>