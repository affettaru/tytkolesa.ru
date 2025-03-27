<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="block__padd">
        <div class="uinfo">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="uinfo__item">
                    <div class="h2"><?= $arItem["NAME"] ?></div>
                    <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>700, 'height'=>'500'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                    <a class="uinfo__link" href="<?=$file["src"]?>" data-fancybox="usinfo">
                        <img src="<?=$file["src"]?>" alt="<?= $arItem["NAME"] ?>" />
                    </a>
                </div>
            <?endforeach;?> 
        </div>
    </div>
<?endif; ?>

