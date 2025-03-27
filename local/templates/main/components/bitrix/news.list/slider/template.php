<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
$i=0;
if (!empty($arResult["ITEMS"])): $i++;?>
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="gallery">
            <div class="swiper js--gallery-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($arItem['PROPERTIES']['MORE_FOTO']['VALUE'] as $FOTO): ?>
                        <? 
                            $file = CFile::ResizeImageGet($FOTO, array('width'=>700, 'height'=>'500'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                        <div class="gallery__item swiper-slide"><a class="gallery__link" href="<?=$file['src']?>" data-fancybox="gallery"><img src="<?=$file['src']?>" alt="<?= $arItem["NAME"] ?> рис. <?=$i?>"  title="<?= $arItem["NAME"] ?> в tytkolesa.ru рис. <?=$i?>"/></a></div>  
                    <?endforeach;?>
                </div>
            </div>
            <div class="slider__pag js--gallery-pag"></div>
            <div class="slider__nav d-none d-lg-block">
                <div class="slider__nav__btn slider__nav__btn__prev js--gallery-prev"><svg>
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                    </svg></div>
                <div class="slider__nav__btn slider__nav__btn__next js--gallery-next"><svg>
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-next"></use>
                    </svg></div>
            </div>
        </div>
    <?endforeach;?>
 
<?endif; ?>

