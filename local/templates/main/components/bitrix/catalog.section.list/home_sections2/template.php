<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


?>
<?php foreach($arResult["SECTIONS"] as $arChild): ?>
    <?php
    $this->AddEditAction($arChild['ID'], $arChild['EDIT_LINK'], CIBlock::GetArrayByID($arChild["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arChild['ID'],$arChild['DELETE_LINK'], CIBlock::GetArrayByID($arChild["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $id = $this->GetEditAreaId($arChild['ID']);
    ?>
    <div id="<?= $id ?>" class="categor__cell <?= $key == 0 ? : "1" ?>">
        <div class="categor__item">
            <a href="<?= $arChild["SECTION_PAGE_URL"] ?>"></a>
            <div class="categor__item-title"><?= $arChild["NAME"] ?></div>
            <div class="categor__item-img">
                <img src="<?= $arChild["PICTURE"]["SRC"] ? $arChild["PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/placeholder.png" ?>"
                    alt="<?= $arChild["NAME"] ?>">
            </div>
        </div>
                               
    </div>
<?php endforeach; ?>

                            

<?=$arResult['NAV_STRING']?>
                        

