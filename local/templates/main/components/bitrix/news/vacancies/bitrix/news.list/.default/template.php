<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
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
$emptyImage = SITE_TEMPLATE_PATH . "/placeholder.png";
?>



<section class="vacancies">
    <div class="container">
        <div class="vacancies__inner">
            <?php foreach($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                $id = $this->GetEditAreaId($arItem['ID']);
                ?>
                <div id="<?= $id ?>" class="vacancies__item">
                    <div class="vacancies__l">
                        <div class="vacancies__date"><?= FormatDate("d-m-Y", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?></div>
                        <div class="vacancies__title"><?= $arItem["NAME"] ?></div>
                        <div class="vacancies__zp"><?= $arItem["PROPERTIES"]["SALARY"]["VALUE"] ?></div>
                    </div>
                    <div class="vacancies__r">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="btn btn-prim btn-min">Подробнее о вакансии</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?= $arResult["NAV_STRING"] ?>
    </div>
</section>
