<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="container-custom">
        <div class="title">
            <div class="title__body">
                <div class="h2">Статьи</div>
            </div>
            <div class="title__aside"><a class="mbtn mbtn__outline" href="/blog">Все статьи</a></div>
        </div>
        <div class="blog">
            <div class="blog__slider__wrapper">
                <div class="sliders__navs"><span class="sliders__navs__prev js--blog-prev"><svg>
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowleft-big"></use>
                        </svg></span><span class="sliders__navs__next js--blog-next"><svg>
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowright-big"></use>
                        </svg></span></div>
                <div class="blog__slider swiper js--blog-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?php
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            $id = $this->GetEditAreaId($arItem['ID']);
                        ?>
                            <div class="blog__slider__item swiper-slide">
                                <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                                <div class="blog__card">
                                    <a class="blog__card__img" href="<?= $arItem['DETAIL_PAGE_URL']?>">
                                        <?if(!$file){?>
                                            <img src="<?=SITE_TEMPLATE_PATH?>/img/blog/img-blog-6.jpg" alt="<?= $arItem["NAME"] ?>" />
                                        <?}else{?>
                                        <img src="<?= $file["src"]?>" alt="<?= $arItem["NAME"] ?>" />
                                        <?}?>
                                    </a>
                                    <div class="blog__card__body"><a class="blog__card__title" href="<?= $arItem['DETAIL_PAGE_URL']?>"><?= $arItem["NAME"] ?></a>
                                        <div class="blog__card__text"><?= $arItem['PREVIEW_TEXT']?></div>
                                    </div>
                                    <div class="blog__card__date">
                                        <?$dateCreate = CIBlockFormatProperties::DateFormat('d.m.Y', MakeTimeStamp($arItem["DATE_CREATE"], CSite::GetDateFormat()));
                                    echo $dateCreate;?></div>
                                </div>
                            </div>
                        <?endforeach;?>
                    </div>
                    <div class="sliders__pagination js--blog-pagination sliders__pagination__onlimobile"></div>
                </div>
            </div>
        </div>
        <div class="block__more"><a class="mbtn mbtn__outline mbtn__blockmobile" href="/blog">Все статьи</a></div>
    </div>



    
<?php
endif; ?>