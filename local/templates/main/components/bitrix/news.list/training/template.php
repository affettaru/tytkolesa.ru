<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="container-custom">
        <div class="title">
            <div class="title__body">
                <div class="h2">Обучение и <br />сотрудничество</div>
                <div class="block__body">
                    <div class="block__text">
                        <p>Приглашаем врачей к сотрудничеству. Наши программы обучения помогут освоить новейшие методы лечения мужского здоровья.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="training">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?php
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    $id = $this->GetEditAreaId($arItem['ID']);
                ?>
                <div class="training__item"><div class="training__card" >
                    <i class="training__card__icon" style="background-color:<?=$arItem['PROPERTIES']['COLOUR']['VALUE']?>">
                        <img src="<?=CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);?>"  alt="<?= $arItem["NAME"] ?>" >
                    </i>
                    <span class="training__card__title"><?= $arItem["NAME"] ?></span></div>
                </div>
                
            <?endforeach;?>           
        </div>
    </div>

<?php
endif; ?>