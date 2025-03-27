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
$emptyImage = SITE_TEMPLATE_PATH . "/assets/img/product-empty-cat.jpg";
if (!empty($arResult['SECTIONS'])) {
    ?>
    <section class="catalog">
        <div class="container">
            <div class="catalog__inner">
                <div class="catalog__row">
                    <?php
                    $c = 1 ?>
                    <?php
                    foreach ($arResult["SECTIONS"] as $arItem): ?>
                        <div class="catalog__cell">
                            <div class="catalog__item">
                                <a href="<?= $arItem["SECTION_PAGE_URL"] ?>"></a>
                                <div class="catalog__item-img">
                                    <img src="<?= (!empty($arItem["PICTURE"]["SRC"])) ? $arItem["PICTURE"]["SRC"] :
                                        $emptyImage
                                    ?>"
                                         alt="<?= $arItem["NAME"] ?><?= $c > 1 ? " рис - " . $c : "" ?>" title="<?=
                                    $arItem["NAME"] ?> батарейки <?= $c > 1 ? " рис - " . $c : "" ?>">
                                </div>
                                <div class="catalog__item-tx">
                                    <?= $arItem["NAME"] ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $c++ ?>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}