<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="container-custom">
        <div class="title">
            <div class="title__body">
                <div class="h2">Преждевременная эякуляция</div>
            </div>
            <div class="title__aside"><a class="mbtn mbtn__outline" href="/premature_ejaculation">Читать все</a></div>
        </div>
        <div class="articles">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?php
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    $id = $this->GetEditAreaId($arItem['ID']);
                ?>
                <div class="articles__item">
                    <a class="articles__card" href="<?= $arItem['DETAIL_PAGE_URL']?>">
                        <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>500, 'height'=>'500'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                        <img src="<?= $file["src"] ?>" alt="<?= $arItem["NAME"] ?>" title="<?= $arItem["NAME"] ?> tytkolesa.ru" />
                        <span><?= $arItem["NAME"] ?></span>
                    </a>
                </div>
            <?endforeach;?>
        </div>
        <div class="block__more"><a class="mbtn mbtn__outline mbtn__blockmobile" href="/premature_ejaculation">Все статьи</a></div>
    </div>
<?php
endif; ?>