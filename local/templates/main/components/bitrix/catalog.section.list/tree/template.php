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

$strTitle = "";

$curDir = $APPLICATION->GetCurDir();
?>


<div class="filter mb">

    <?php foreach ($arResult["SECTIONS"] as $arSec): ?>

        <!--    first level    -->
        <div class="filter__item <?= $curDir == $arSec["SECTION_PAGE_URL"] ? "open" : "" ?>">
            <div class="filter__title <?= $curDir == $arSec["SECTION_PAGE_URL"] ? "active open" : "" ?>"><?= $arSec["NAME"] ?></div>
            <div class="filter__bl">
                <div class="filter__container" style="display: block;">
                    <?php foreach ($arSec["CHILDS"] as $childFirst): ?>

                        <a href="<?= $childFirst["SECTION_PAGE_URL"] ?>"
                           class="filter__bl-item <?= $curDir == $childFirst["SECTION_PAGE_URL"] ? "active" : "" ?>"><?= $childFirst["NAME"] ?></a>
                        <?php foreach ($childFirst["CHILDS"] as $childSecond): ?>
                            <div class="filter__bl-in <?= strpos($curDir, $childSecond["SECTION_PAGE_URL"]) !== false ? "op" : ""?>">
                                <?php if(empty($childSecond["CHILDS"])): ?>
                                    <a href="<?= $childSecond["SECTION_PAGE_URL"] ?>" class="filter__bl-tit <?= $curDir == $childSecond["SECTION_PAGE_URL"] ? "active" : "" ?>"><?= $childSecond["NAME"] ?></a>
                                <?php else: ?>
                                    <div class="filter__bl-tit has-childs <?= $curDir == $childSecond["SECTION_PAGE_URL"] ? "active" : "" ?>"><?= $childSecond["NAME"] ?></div>
                                <?php endif; ?>
                                <ul>
                                    <?php foreach ($childSecond["CHILDS"] as $childThird): ?>
                                        <li class="<?= $curDir == $childThird["SECTION_PAGE_URL"] ? "active" : "" ?>"><a
                                                    href="<?= $childThird["SECTION_PAGE_URL"] ?>"><?= $childThird["NAME"] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>


                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>
