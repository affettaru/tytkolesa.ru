<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
 
if (!empty($arResult["ITEMS"])): ?>
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="header__socio__item">
            <a class="header__socio__icon tg" href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank" rel="noopener noreferrer">
            <img src="<?= CFile::GetPath($arItem["PROPERTIES"]["ICON"]["VALUE"]) ?>" alt="<?= $arItem["NAME"] ?>">
        </a>
        </div>
<?php endforeach;
endif; ?>