<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="container-custom">
        <div class="title">
            <div class="title__body">
                <div class="h2">Методы лечения</div>
            </div>
        </div>

        <div class="methods">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?php
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    $id = $this->GetEditAreaId($arItem['ID']);
                ?>
                <div class="methods__item">
                    <a class="methods__card" style="background-color:<?=$arItem['PROPERTIES']['COLOUR']['VALUE']?>" href="<?= $arItem['DETAIL_PAGE_URL']?>">
                        <i class="methods__card__icon">
                        <img src="<?=CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);?>"  alt="<?= $arItem["NAME"] ?>" width="103px" height="67px">
                        
                        </i>
                        <span class="methods__card__title"><span><?= $arItem["NAME"] ?></span></span>
                    </a>
                </div>
            <?endforeach;?>
        </div>
    </div>



    
<?php
endif; ?>