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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);


?>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="smartfilter">
    <?
    //not prices
    $empty = true;
    foreach ($arResult["ITEMS"] as $key => $arItem):
        if (!empty($arItem["VALUES"])):
            $empty = false;
            ?>
            <?php if ($arItem["CODE"] == "PRICE"):
            $maxPrice = $arItem["VALUES"]["MAX"]["VALUE"];
            $minPrice = $arItem["VALUES"]["MIN"]["VALUE"];
            $curMin = $arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"];
            $curMax = $arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"];


            ?>
            <div class="filter__cell">
                <div class="filter__cell-title"><?= $arItem["NAME"] ?></div>
                <div class="filter__range polzunok-container-5">
                    <div class="filter__range-item">
                        <input class="polzunok-input-5-left" type="text"
                               id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                               name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                               value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                               onchange="smartFilter.click(this)">
                    </div>
                    <div class="filter__range-item">
                        <input class="polzunok-input-5-right" type="text"
                               id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                               name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                               value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                               onchange="smartFilter.click(this)">
                    </div>
                    <div class="polzunok-5 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content ui-draggable ui-draggable-handle">
                        <div class="ui-slider-range ui-corner-all ui-widget-header"
                             style="left: 11.5%; width: 88.5%;"></div>
                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                              onclick="smartFilter.click(this)"></span>
                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                              onclick="smartFilter.click(this)"></span>
                    </div>
                </div>
                <span class="bx-filter-container-modef"></span>
            </div>

        <?php else: ?>
            <div class="filter__cell">
                <div class="filter__cell-title"><?= $arItem["NAME"] ?></div>

                <div class="filter__container">
                    <div class="filter__group-check">
                        <?php $c = 0 ?>
                        <?php foreach ($arItem["VALUES"] as $val => $ar): ?>
                            <?php $c++ ?>
                            <div class="filter__check">
                                <input
                                        type="checkbox"
                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                        name="<? echo $ar["CONTROL_NAME"] ?>"
                                        value="<? echo $ar["HTML_VALUE"] ?>"
                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                        onclick="smartFilter.click(this)"
                                >
                                <label for="<? echo $ar["CONTROL_ID"] ?>"><?= $ar["VALUE"] ?></label>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <?php if ($c > 5): ?>
                        <div class="filter__all"><span class="show">Показать больше</span><span
                                    class="hid">Скрыть</span></div>
                    <?php endif; ?>
                </div>
                <span class="bx-filter-container-modef"></span>

            </div>

        <?php endif; ?>

        <?
        endif;
    endforeach;
    ?>

    <?php if (!$empty): ?>
        <div class="col-xs-12 bx-filter-button-box">
            <div class="bx-filter-block">
                <div class="bx-filter-parameters-box-container">
                    <div class="filter__bottom">
                        <div class="btn" id="set_filter"
                             name="set_filter">Показать
                        </div>
                        <div class="btn btn-df" id="del_filter"
                             name="del_filter">Сбросить
                        </div>
                        <div class="bx-filter-container-modef">
                            <div id="modef" class="filter__total" <? if (!isset($arResult["ELEMENT_COUNT"]))
                                echo 'style="display:none"'; ?> style="display: inline-block;">
                                <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . (int)($arResult["ELEMENT_COUNT"] ?? 0) . '</span>')); ?>
                                <span class="arrow" style="display: none"></span>
                                <br/>
                                <a href="<? echo $arResult["FILTER_URL"] ?>" target=""
                                   style="display: none"><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</form>
<?php
\CJSCore::Init();
// без этого почему-то не видит пространство BX (только без авторизации)
?>
<script type="text/javascript">
    $(".polzunok-5").slider({
        min: <?= $minPrice ?>,
        max: <?= $maxPrice ?>,
        values: [<?= $curMin ?>, <?= $curMax ?>],
        range: true,
        animate: true,
        slide: function (event, ui) {
            $(".polzunok-input-5-left").val(ui.values[0]);
            $(".polzunok-input-5-right").val(ui.values[1]);
        }
    });
    $(".polzunok-input-5-left").val($(".polzunok-5").slider("values", 0));
    $(".polzunok-input-5-right").val($(".polzunok-5").slider("values", 1));
    $(document).focusout(function () {
        var input_left = $(".polzunok-input-5-left").val(),
            opt_left = $(".polzunok-5").slider("option", "min"),
            where_right = $(".polzunok-5").slider("values", 1),
            input_right = $(".polzunok-input-5-right").val(),
            opt_right = $(".polzunok-5").slider("option", "max"),
            where_left = $(".polzunok-5").slider("values", 0);

        if (input_left > where_right) {
            input_left = where_right;
        }
        if (input_left < opt_left) {
            input_left = opt_left;
        }
        if (input_left == "") {
            input_left = 0;
        }
        if (input_right < where_left) {
            input_right = where_left;
        }
        if (input_right > opt_right) {
            input_right = opt_right;
        }
        if (input_right == "") {
            input_right = 0;
        }
        $(".polzunok-input-5-left").val(input_left)
        console.log(input_left);
        $(".polzunok-input-5-right").val(input_right);
        $(".polzunok-5").slider("values", [input_left, input_right]);
    });
    $('.polzunok-5').draggable();
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
    
</script>