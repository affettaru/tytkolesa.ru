<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="welcome__slider swiper js--welcome-slider">
        <div class="swiper-wrapper">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="welcome__slider__item swiper-slide">
                    <div class="welcome__card">
                        <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>700, 'height'=>'500'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                        <div class="welcome__card__imgcover"><img src="<?=$file["src"]?>" alt="<?= $arItem["NAME"] ?>" title="<?= $arItem["NAME"] ?> tytkolesa.ru"></div>
                        <div class="welcome__card__body">
                            <div class="h1"><?=$arItem["NAME"]?></div>
                            <div class="welcome__card__content"><?= $arItem["PREVIEW_TEXT"]?></div>
                            <div class="welcome__card__footer"><button class="mbtn mbtn__primary mbtn__big" type="button" data-fancybox-html="data-fancybox-html" data-src="#js--modal-order">Оставить заявку</button></div>
                        </div>
                    </div>
                </div>
            <?endforeach;?>
        </div>
    </div>
    <div class="slider__pag js--welcome-pag"></div>
<?endif; ?>

