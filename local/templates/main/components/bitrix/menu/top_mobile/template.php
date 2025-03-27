<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
global $APPLICATION;
$curDir = $APPLICATION->GetCurDir()
?>

<? if (!empty($arResult)): ?>



<ul class="mobilemenu__catalog">

    <?php
    $previousLevel = 0;
    foreach ($arResult as $arItem): ?>

    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?= str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? endif ?>

    <? if ($arItem["IS_PARENT"]): ?>

    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
    <!-- <li class="header__menu__item header__menu__chapter <?= $curDir == $arItem["LINK"] ? "header__menu__item__active" : "" ?>"> -->
        <li class="mobilemenu__catalog__item">
        <? if ($curDir == $arItem["LINK"]): ?>
            <a class="mobilemenu__catalog__link"><?= $arItem["TEXT"] ?>
           </span> 
                        </a>
        <? else: ?>
           
            <div class="mobilemenu__catalog__link mobilemenu__catalog__link__wsub js--mobilemenu-linkslide">
            <?= $arItem["TEXT"] ?></span>
        </div>
        <? endif ?>

        <div class="mobilemenu__popup">
            <div class="container">
            <div class="mobilemenu__popup__title js--mobilemenu-link-close"><?= $arItem["TEXT"] ?></div>
                <ul class="mobilemenu__sub">
            <!-- <ul class="header__nav__submenu"> -->
                <? else: ?>
                <li class="mobilemenu__sub__item">
                    <? if ($curDir == $arItem["LINK"]): ?>
                        <a  class="mobilemenu__sub__link"><?= $arItem["TEXT"] ?></a>
                    <? else: ?>
                        <a  class="mobilemenu__sub__link"><?= $arItem["TEXT"] ?></a>
                    <? endif ?>
                    <div class="mobilemenu__popup">
                        <div class="container">
                        <div class="mobilemenu__popup__title js--mobilemenu-link-close"><?= $arItem["TEXT"] ?></div>
                            <ul class="mobilemenu__sub">
                <? endif ?>

    <? else: ?>

                                <? if ($arItem["PERMISSION"] > "D"): ?>

                                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                                        <li class="mobilemenu__catalog__item">
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <div  class="mobilemenu__catalog__link <?if($arItem["TEXT"]=="ШИНЫ" || $arItem["TEXT"]=="Диски"){?> mobilemenu__catalog__link__wsub js--mobilemenu-linkslide<?}?>"><?= $arItem["TEXT"] ?></div>
                                            <? else: ?>
                                                <?if($arItem["TEXT"]=="ШИНЫ" || $arItem["TEXT"]=="Диски"){?> 
                                                    <div class="mobilemenu__catalog__link mobilemenu__catalog__link__wsub js--mobilemenu-linkslide"><?= $arItem["TEXT"] ?>
                                                </div>
                                                    <?}else{?>
                                                <a  class="mobilemenu__catalog__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?>
                                            </a><?}?>
                                            <?if($arItem["TEXT"]=="ШИНЫ"){?>

                  
                                                    <div class="mobilemenu__popup">
                                                        <div class="container">
                                                        <div class="mobilemenu__popup__title js--mobilemenu-link-close">Шины</div>
                                                        <ul class="mobilemenu__sub">
                                                            <li class="mobilemenu__sub__item"><div class="mobilemenu__sub__link" >Cезон</div>
                                                                <ul class="mobilemenu__sub__podmenu">
                                                                    <li><a href="/catalog/shiny/filter/u_season_list-is-u/apply/">Всесезонные шины</a></li>
                                                                    <li><a href="/catalog/shiny/filter/u_season_list-is-s/apply/">Летние шины</a></li>
                                                                    <li><a href="/catalog/shiny/filter/u_season_list-is-w/apply/">Зимние шины</a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="mobilemenu__sub__item"><div class="mobilemenu__sub__link">Подбор шин</div>
                                                                <ul class="mobilemenu__sub__podmenu">
                                                                    <li><a href="/catalog/shiny/filter/u_thorn-is-y/apply/">Шипованные шины</a></li>
                                                                    <li><a href="/catalog/shiny/filter/u_thorn-is-n/apply/">Нешипованные шины</a></li>
                                                                    <li><a href="/catalog/shiny/filter/u_runflat-is-y/apply/">RunFlat шины</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>


                                                          
                                                        </div>
                                                    </div>
                                                    <?}?>
                                                    <? if($arItem["TEXT"]=="Диски"){?>


                                                        <div class="mobilemenu__popup">
                                <div class="container">
                                    <div class="mobilemenu__popup__title js--mobilemenu-link-close">Диски</div>
                                    <ul class="mobilemenu__sub">
                                        <li class="mobilemenu__sub__item"><div class="mobilemenu__sub__link">Типы дисков</div>
                                            <ul class="mobilemenu__sub__podmenu">
                                                <li><a href="/catalog/diski/filter/u_type_d-is-79144e98e24dae85d71af576cab95571/apply/">Литые диски</a></li>
                                                <li><a href="/catalog/diski/filter/u_type_d-is-1/apply/">Штампованные диски</a></li>
                                                <li><a href="/catalog/diski/filter/u_type_d-is-2/apply/">Кованные диски</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li class="mobilemenu__sub__item"><div class="mobilemenu__sub__link">Подбор дисков</div>
                                            <ul class="mobilemenu__sub__podmenu">
                                                <li><a href="#">По размеру</a></li>
                                                <li><a href="#">По автомобилю</a></li>
                                                <li><a href="#">Маркировка колес</a></li>
                                            </ul>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>


                                                    <?}?>
                                            <? endif ?>
                                        </li>
                                    <? else: ?>

                                        <li class="mobilemenu__sub__item">
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <a class="mobilemenu__sub__link"><?= $arItem["TEXT"] ?></a>
                                            <? else: ?>
                                                <a href="<?= $arItem["LINK"] ?>" class="mobilemenu__sub__link"><?= $arItem["TEXT"] ?></a>
                                            <? endif ?>
                                        </li>
                                    <? endif ?>

                                <? endif ?>

                            <? endif ?>

                            <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                            <? endforeach ?>

                            <? if ($previousLevel > 1): // close last item tags ?>
                                <?= str_repeat("</ul></div></div></li>", ($previousLevel - 1)); ?>
                            <? endif ?>
                        </ul>
                        <? endif ?>
                       
