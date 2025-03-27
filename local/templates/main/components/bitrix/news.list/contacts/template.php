<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <?$i=0;
    foreach ($arResult["ITEMS"] as $arItem): $i++;?>
        <div class="contacts">
            <div class="row align-items-stretch">
                <div class="col-12 col-lg-5">
                    <div class="contacts__body">
                        <div class="contacts__list">
                            <div class="contacts__list__item">
                                <div class="contacts__list__title">Адрес</div>
                                <div class="contacts__list__text"><?=$arItem["PROPERTIES"]["ADRESS"]["VALUE"]?></div>
                            </div>
                            <div class="contacts__list__item">
                                <div class="contacts__list__title">Основной телефон</div>
                                <div class="contacts__list__text"><a class="contacts__wicon" href="tel:<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?>"> <i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-phone"></use>
                                            </svg></i><span><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></span></a></div>
                            </div>
                            <div class="contacts__list__item">
                                <div class="contacts__list__title">Режим работы</div>
                                <div class="contacts__list__text">
                                    <div class="contacts__wicon"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-clock"></use>
                                            </svg></i><span><?=$arItem["PROPERTIES"]["SHEDULE"]["VALUE"]?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="contacts__map__wrapper">
                        <div class="contacts__map map" data-koord="<?=$arItem["PROPERTIES"]["KOORDINATES"]["VALUE"]?>" data-adres="<?=$arItem["PROPERTIES"]["ADRESS"]["VALUE"]?>"></div>
                    </div>
                </div>
            </div>
        </div>
        <?if(count($arResult["ITEMS"])>$i){?>
            <div class="contacts__line"></div>
        <?}?>
    <?endforeach;?>
<?endif; ?>




    

