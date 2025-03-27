<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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

<div class="filter__list">
	<?php foreach ($arResult["SECTIONS"] as $arSec): ?>
        <?$a=0;?>
        <?php foreach ($arSec["CHILDS"] as $arChild): ?>
            <?php if($arParams["SECTION_CODE_ACTIVE"] == $arChild["CODE"]) $a=1;?>
        <?php endforeach; ?>
        <div class="filter__list-item <?= !empty($arSec["CHILDS"]) ? 'drop' : "" ?> <?= $arParams["SECTION_CODE_ACTIVE"] == $arSec["CODE"] ? "active" : "" ?> <?= $arParams["SECTION_CODE_ACTIVE"] == $arSec["CODE"] || $a===1 ? "open" : $a ?>">
            <span <?= !empty($arSec["CHILDS"]) ? 'class="js-drop"' : "" ?>> <a href="<?= $arSec["SECTION_PAGE_URL"] ?>"><?= $arSec["NAME"] ?></a></span>
			<?php if (!empty($arSec["CHILDS"])): ?>
                <div class="filter__list-dr">
                   <?$a=0;?>

					<?php foreach ($arSec["CHILDS"] as $arChild): ?>
                        <?php if (!empty($arChild["CHILDS"])): ?>
                            <?php foreach ($arChild["CHILDS"] as $arChildChild): ?>
                                <?php if($arParams["SECTION_CODE_ACTIVE"] == $arChildChild["CODE"]) $a=1;?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="filter__list-dr-item <?= !empty($arChild["CHILDS"]) ? 'drop' : "" ?> <?= $arParams["SECTION_CODE_ACTIVE"] == $arChild["CODE"] ? "active" : "" ?> <?= $arParams["SECTION_CODE_ACTIVE"] == $arChild["CODE"] || $a==1 ? "open" : "" ?>">
                            <span class="js-drop">
                                <a href="<?= $arChild["SECTION_PAGE_URL"] ?>">
                                <?= $arChild["NAME"] ?>
                                    </a>
                            </span>
							
							<?php if (!empty($arChild["CHILDS"])): ?>
                                <div class="filter__list-dr">
									<?php foreach ($arChild["CHILDS"] as $arChildChild): ?>
                                        <div class="filter__list-dr-item <?= $arParams["SECTION_CODE_ACTIVE"] == $arChildChild["CODE"] ? "active" : "" ?>">
                                            <a href="<?= $arChildChild["SECTION_PAGE_URL"] ?>"><?= $arChildChild["NAME"] ?></a>
                                        </div>
									<?php endforeach; ?>
                                </div>
							<?php endif; ?>

                        </div>
					<?php endforeach; ?>
                    
                </div>
			<?php endif; ?>
        </div>
	<?php endforeach; ?>
</div>
