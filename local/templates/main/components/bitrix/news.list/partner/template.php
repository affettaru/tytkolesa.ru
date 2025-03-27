<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>



    <div class="container">
        <div class="h1">Наши партнеры</div>
            <div class="partners">
                <div class="partners__slider swiper js--patners-slider">
                    <div class="swiper-wrapper">
                        <?php $i=0;
                        foreach ($arResult["ITEMS"] as $arItem): $i++;?>
                            <?$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>500, 'height'=>'500'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                            <div class="partners__slider__item swiper-slide">
                                <div class="brands__card">
                                    <span class="brands__card__img">
                                        <img src="<?=$file["src"]?>" alt="<?=$arItem["NAME"]?>"  title="<?= $arItem["NAME"] ?> tytkolesa.ru"/>
                                    </span>
                                    <span class="brands__card__text"><?=$arItem["NAME"]?></span>
                                </div>
                            </div>
                        <?endforeach;?> 
                    </div>
                </div>
                <div class="slider__pag js--partners-pag d-xl-none"></div>
                <div class="slider__nav d-none d-xl-block">
                    <div class="slider__nav__btn slider__nav__btn__prev js--partners-prev"><svg>
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                        </svg></div>
                    <div class="slider__nav__btn slider__nav__btn__next js--partners-next"><svg>
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-next"></use>
                        </svg></div>
                </div>
            </div>
        </div> 
       
<?endif;?>