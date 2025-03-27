<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
global $APPLICATION;
$curDir = $APPLICATION->GetCurDir();
?>
<?php if (!empty($arResult)): ?>
    <ul class="footer__menu">
        <?php foreach ($arResult as $arItem): ?>
            <?php
            if ($arParams["MAX_LEVEL"] == 0 && $arItem["DEPTH_LEVEL"] > 0) {
                continue;
            }
            ?>
            <li>
                <?php if ($curDir == $arItem["LINK"]): ?>
                    <?= $arItem["TEXT"] ?>
                <?php else: ?>
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                <?php endif ?>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>
