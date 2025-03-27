<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="container-custom">
        <div class="title">
            <div class="title__body">
                <div class="h2">Лицензии и сертификаты</div>
                <div class="block__body">
                    <div class="block__text">
                        <p>Лицензия на осуществление медицинской деятельности <span class="text__nowrap">№ Л041-00110-77/00363409</span> Срок действия: бессрочная</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="certificates">

            <div class="certificates__slider__wrapper">
                <div class="sliders__navs"><span class="sliders__navs__prev js--certificates-prev"><svg>
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowleft-big"></use>
                        </svg></span><span class="sliders__navs__next js--certificates-next"><svg>
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowright-big"></use>
                        </svg></span></div>
                <div class="certificates__slider swiper js--certificates-slider">
                    <div class="swiper-wrapper"><!-- el-->
                        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                            <?php
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                $id = $this->GetEditAreaId($arItem['ID']);
                            ?>
                            <div class="certificates__slider__item swiper-slide">
                                <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                                <a class="certificates__slider__card" href="<?=$file["src"]?>" data-fancybox="gallery-certificates">
                                    <span><img src="<?=$file["src"]?>" alt="" /></span>
                                </a>
                            </div>
                        <?endforeach;?>
                    </div>
                    <div class="sliders__pagination js--certificates-pagination sliders__pagination__onlimobile"></div>
                </div>
            </div>
        </div>
    </div>
<?php
endif; ?>