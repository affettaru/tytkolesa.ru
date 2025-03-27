<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="tabs__body">
        <div class="js--more-parent">
            <div class="brands">
                <?php $i=0;
                foreach ($arResult["ITEMS"] as $arItem): $i++;?>
                    <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>500, 'height'=>'500'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                    <div class="brands__el <?if($i>6){?>brands__el__hide<?}?>" <?if($i>6){?>data-hide="data-hide"<?}?>>
                        <div class="brands__card">
                            <span class="brands__card__img">
                                <img src="<?=$file["src"]?>" alt="<?=$arItem["NAME"]?>"  title="<?= $arItem["NAME"]?> tytkolesa.ru"/>
                            </span><span class="brands__card__text"><?=$arItem["NAME"]?></span>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <?if($i>12){?>
                <div class="block__more"><a class="mbtn mbtn__grey2 mbtn__big mbtn__more js--more-btn" href="#"><span>Показать все</span><span>Скрыть</span></a></div>
            <?}?>
            <?if($i>6 && $i<12){?>
                <div class="block__more"><a class="mbtn mbtn__grey2 mbtn__big mbtn__more mbtn__more_mob js--more-btn" href="#"><span>Показать все</span><span>Скрыть</span></a></div>
            <?}?>
        </div>
    </div>
<?endif; ?>

