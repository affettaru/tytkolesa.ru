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


<section class="categor">
    <div class="container">
        <div class="categor__inner">
            <h2>Категории товаров</h2>

            <div class="tabs_wrapper">
                <ul class="tabs">
                    <?php foreach ($arResult["SECTIONS"] as $key => $arItem): ?>
                        <li class="<?= $key == 0 ? "active" : "" ?>" id="tab<?= $key ?>"><?= $arItem["NAME"] ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class="tabs_container">
                    <?php foreach ($arResult["SECTIONS"] as $key => $arItem): ?>

                    <div  class="tab_content <?= $key == 0 ? "active" : "" ?>" data-tab="tab<?= $key ?>">
                        <div class="categor__row">
                            <?php foreach($arItem["CHILDS"] as $arChild): ?>
                                <?php
                                $this->AddEditAction($arChild['ID'], $arChild['EDIT_LINK'], CIBlock::GetArrayByID($arChild["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arChild['ID'],$arChild['DELETE_LINK'], CIBlock::GetArrayByID($arChild["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                $id = $this->GetEditAreaId($arChild['ID']);
                                ?>
                            <div id="<?= $id ?>" class="categor__cell <?= $key == 0 ? : "w33" ?>">
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
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>


        </div>
    </div>
</section>