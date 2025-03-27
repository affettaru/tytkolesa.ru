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

//echo "<pre>"; var_dump($arResult["NAV_RESULT"]->result->num_rows); echo "</pre>";
//echo "<pre>"; var_dump($arResult["NAV_RESULT"]->NavRecordCount); echo "</pre>";
//echo "<pre>"; var_dump($arResult); echo "</pre>";
//field_count
?>


<?php
if (!empty($arResult['ITEMS'])):?>

    <div class="catalog-page__tp">
        <h2>Результаты поиска «<?= htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8'); ?>»</h2>
        <div class="catalog-page__tp-nb"><?= $arResult["SEARCH_COUNT"]  ?></div>
    </div>
    <div class="catalog-page__content">
        <div class="catalog-page__row">
            <?php $c = 1; ?>
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="catalog-page__cell">
                    <div class="catalog-page__item">
                        <div class="catalog-page__item-img">
                            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/placeholder.png" ?>"
                                 alt="<?= $arItem["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arItem["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                        </div>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
                           class="catalog-page__item-title"><?= $arItem["NAME"] ?></a>
                        <?php if ($arItem["DISPLAY_PROPERTIES"] && !empty($arItem["DISPLAY_PROPERTIES"])): ?>
                            <div class="catalog-page__item-list">
                                <?php foreach ($arItem["DISPLAY_PROPERTIES"] as $prop): ?>
                                    <div class="catalog-page__item-list-it">
                                        <span><?= $prop["NAME"] ?></span>
                                        <span><?= $prop["VALUE"] ?></span>
                                    </div>
                                <?php endforeach; ?>
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
                            <?php if ($arItem["PRICE_RENT"] && $arItem["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl2" class="btn btn-prim">Аренда в 1
                                    клик</a>
                            <?php endif; ?>
                            <?php if ($arItem["PRICE_SALE"] && $arItem["PROPERTIES"]["ALLOW_SALE"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl1" class="btn btn-prim">Получить
                                    КП</a>
                            <?php endif; ?>
                            <?php
                            if (!$arItem["PRICE_SALE"] || !$arItem["PROPERTIES"]["ALLOW_SALE"]["VALUE"] && !$arItem["PRICE_RENT"] || !$arItem["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                <a href="javascript:void(0)" onclick="location.replace('<?= $arItem["DETAIL_PAGE_URL"] ?>')" class="btn btn-bord">Подробнее</a>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            <?php $c++; ?>
            <?php endforeach; ?>
        </div>
        <?= $arResult["NAV_STRING"] ?>
    </div>
<?php else: ?>
    <div class="catalog-page__tp">
        <h2>Результаты поиска «<?= htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8'); ?>»</h2>
        <div class="catalog-page__tp-nb"><?= $arResult["SEARCH_COUNT"] ?></div>

        <div class="catalog-page__tp-tx">
            <div class="catalog-page__tp-tt">К сожалению, мы ничего не нашли по запросу «<?= htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8'); ?>»</div>
            <p>Попробуйте изменить формулировку, воспользуйтесь <a href="/catalog/">каталогом</a> , или <a data-remodal-target="cl3" href="javascript:void(0)">свяжитесь с нами</a> </p>
            <a href="/" class="btn btn-prim">На главную</a>
        </div>
    </div>
<?php
endif; ?>