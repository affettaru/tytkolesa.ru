<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
global $APPLICATION;
$curDir = $APPLICATION->GetCurDir();
?>
<? if (!empty($arResult)): ?>




<ul class="header__menu">

    <?php
    $previousLevel = 0;
    foreach ($arResult as $arItem): ?>

    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?= str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? endif ?>

    <? if ($arItem["IS_PARENT"]): ?>

    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
    <!-- <li class="header__menu__item header__menu__chapter <?= $curDir == $arItem["LINK"] ? "header__menu__item__active" : "" ?>"> -->
        <li class="header__menu__item header__menu__catalog">
        <? if ($curDir == $arItem["LINK"]): ?>
            <a class="header__menu__link"><span class="header__menu__link__box"> <i class="header__menu__link__text"><?= $arItem["TEXT"] ?></i><i class="header__menu__link__icon">
            <svg>
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
            </svg>
            </i></span> 
                        </a>
        <? else: ?>
           
            <div class="header__menu__link" >
            <span class="header__menu__link__box"> <i class="header__menu__link__text"><?= $arItem["TEXT"] ?></i><i class="header__menu__link__icon">
            <svg>
                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
            </svg>
            </i></span>
            </div>
        <? endif ?>
        <div class="header__menu__popup header__menu__popup__w100">
            <div class="header__menu__popup__content">
                <ul class="header__menu__sub">
            <!-- <ul class="header__nav__submenu"> -->
                <? else: ?>
                <li >
                    <? if ($curDir == $arItem["LINK"]): ?>
                        <a ><?= $arItem["TEXT"] ?></a>
                    <? else: ?>
                        <a ><?= $arItem["TEXT"] ?></a>
                    <? endif ?>
                    <div class="header__menu__popup header__menu__popup__w100">
                        <div class="header__menu__popup__content">
                            <ul class="header__menu__sub">
                <? endif ?>

    <? else: ?>

                                <? if ($arItem["PERMISSION"] > "D"): ?>

                                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                                        <li class="header__menu__item <?if($arItem["TEXT"]=="ШИНЫ" || $arItem["TEXT"]=="Диски"){?>header__menu__catalog header__menu__popupsize100<?}?>">
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <a  class="header__menu__link"><span class="header__menu__link__box"> <i class="header__menu__link__text"><?= $arItem["TEXT"] ?></i><i class="header__menu__link__icon">
                                                <svg>
                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                                </svg>
                                                </i></span></a>
                                            <? else: ?>
                                                <a  class="header__menu__link" href="<?= $arItem["LINK"] ?>"><span class="header__menu__link__box"> 
                                                    <i class="header__menu__link__text"><?= $arItem["TEXT"] ?></i>
                                                    <i class="header__menu__link__icon">
                                                <svg>
                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                                </svg>
                                                </i></span>
                                            </a>
                                            <?if($arItem["TEXT"]=="ШИНЫ"){?>
                                                    <div class="header__menu__popup">
                                                        <div class="header__menu__popup__content">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="header__menu__colluns">
                                                                        <div class="header__menu__colluns__el">
                                                                            <div class="header__menu__title">Cезон</div>
                                                                            <ul class="header__menu__sub">
                                                                                <li><a href="/catalog/shiny/filter/u_season_list-is-u/apply/">Всесезонные шины</a></li>
                                                                                <li><a href="/catalog/shiny/filter/u_season_list-is-s/apply/">Летние шины</a></li>
                                                                                <li><a href="/catalog/shiny/filter/u_season_list-is-w/apply/">Зимние шины</a></li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="header__menu__colluns__el">
                                                                            <div class="header__menu__title">Подбор шин </div>
                                                                            <ul class="header__menu__sub">
                                                                                <li><a href="/catalog/shiny/filter/u_thorn-is-y/apply/">Шипованные шины</a></li>
                                                                                <li><a href="/catalog/shiny/filter/u_thorn-is-n/apply/">Нешипованные шины</a></li>
                                                                                <li><a href="/catalog/shiny/filter/u_runflat-is-y/apply/">RunFlat шины</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="header__menu__side">
                                                                        <div class="header__menu__title">Популярные производители</div>
                                                                        <ul class="header__menu__brends">
                                                                        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"maker2", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "9",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PROPERTY_CODE" => array(
			0 => "MAKER",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "maker2",
		"FILTER_NAME" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
                                                                           
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?}?>
                                                    <?if($arItem["TEXT"]=="Диски"){?>
                                                        <div class="header__menu__popup header__menu__popup__w100">
                                    <div class="header__menu__popup__content">
                                        <div class="row">
                                            <div class="col">
                                                <div class="header__menu__colluns">
                                                    <div class="header__menu__colluns__el">
                                                        <div class="header__menu__title">Типы дисков</div>
                                                        <ul class="header__menu__sub">
                                                            <li><a href="/catalog/diski/filter/u_type_d-is-79144e98e24dae85d71af576cab95571/apply/">Литые диски</a></li>
                                                            <li><a href="/catalog/diski/filter/u_type_d-is-1/apply/">Штампованные диски</a></li>
                                                            <li><a href="/catalog/diski/filter/u_type_d-is-2/apply/">Кованные диски</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="header__menu__side">
                                                    <div class="header__menu__title">Популярные производители</div>
                                                    <ul class="header__menu__brends">
                                                        
                                                   
                                                                        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"maker3", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "9",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PROPERTY_CODE" => array(
			0 => "MAKER",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "maker3",
		"FILTER_NAME" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
                                                                           
                                                                           </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                    <?}?>
                                            <? endif ?>
                                        </li>
                                    <? else: ?>
                                        <li>
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <a><?= $arItem["TEXT"] ?></a>
                                            <? else: ?>
                                                <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
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
