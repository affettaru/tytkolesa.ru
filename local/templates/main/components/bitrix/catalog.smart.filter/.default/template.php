<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;  
Loader::includeModule("iblock");

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}

?>
 <?
//  \CJSCore::Init();
 ?>

<!-- <div class="bx-filter <?=$templateData["TEMPLATE_CLASS"]?> <?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL") echo ""?>">
	<div class="bx-filter-section container-fluid">
		<div class="row"><div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-12<?endif?> bx-filter-title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></div></div> -->
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		<div class="filter-side__link js--filter-btn-open d-lg-none"><i><svg>
			<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-filter"></use>
			</svg></i><span>Фильтры</span>
		</div>
		<div class="filter-side__body">
            <div class="filter-side__content">
				<div class="h5 d-none d-lg-block">Подбор параметров</div>
				<div class="filter-side__title js--filter-btn-close">
					<div><span>Подбор параметров</span><i><svg>
								<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#close"></use>
							</svg></i></div>
				</div>
				<div class="filter__line3 row">
				<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
				<?endforeach;?>
				<!-- <div class="row"> -->
					<?/*foreach($arResult["ITEMS"] as $key=>$arItem)//prices
					{
						$key = $arItem["ENCODED_ID"];
						if(isset($arItem["PRICE"])):
							if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
								continue;

							$precision = 0;
							$step_num = 4;
							$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
							$prices = array();
							if (Bitrix\Main\Loader::includeModule("currency"))
							{
								for ($i = 0; $i < $step_num; $i++)
								{
									$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
								}
								$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
							}
							else
							{
								$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
								for ($i = 0; $i < $step_num; $i++)
								{
									$prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
								}
								$prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
							}
							?>
							<div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-lg-12<?endif?> bx-filter-parameters-box bx-active">
								<span class="bx-filter-container-modef"></span>
								<div class="bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)"><span><?=$arItem["NAME"]?> <i data-role="prop_angle" class="fa fa-angle-<?if (isset($arItem["DISPLAY_EXPANDED"]) && $arItem["DISPLAY_EXPANDED"] == "Y"):?>up<?else:?>down<?endif?>"></i></span></div>
								<div class="bx-filter-block" data-role="bx_filter_block">
									<div class="row bx-filter-parameters-box-container">
										<div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
											<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
											<div class="bx-filter-input-container">
												<input
													class="min-price"
													type="text"
													name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
													size="5"
													onkeyup="smartFilter.keyup(this)"
												/>
											</div>
										</div>
										<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
											<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
											<div class="bx-filter-input-container">
												<input
													class="max-price"
													type="text"
													name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
													size="5"
													onkeyup="smartFilter.keyup(this)"
												/>
											</div>
										</div>

										<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
											<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
												<?for($i = 0; $i <= $step_num; $i++):?>
												<div class="bx-ui-slider-part p<?=$i+1?>"><span><?=$prices[$i]?></span></div>
												<?endfor;?>

												<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
												<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
												<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
												<div class="bx-ui-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
													<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
													<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?
							$arJsParams = array(
								"leftSlider" => 'left_slider_'.$key,
								"rightSlider" => 'right_slider_'.$key,
								"tracker" => "drag_tracker_".$key,
								"trackerWrap" => "drag_track_".$key,
								"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
								"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
								"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
								"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
								"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
								"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
								"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
								"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
								"precision" => $precision,
								"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
								"colorAvailableActive" => 'colorAvailableActive_'.$key,
								"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
							);
							?>
							<script>
								BX.ready(function(){
									window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
								});
							</script>
						<?endif;
					}*/

					//not prices
					foreach($arResult["ITEMS"] as $key=>$arItem)
					{
						if(
							empty($arItem["VALUES"])
							|| isset($arItem["PRICE"])
						)
							continue;

						if (
							$arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
							&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
						)
							continue;
						?>

						<div class="col-12 bx-filter-parameters-box ">
							<span class="bx-filter-container-modef"></span>
							
								<!-- <select class="js--select" name="#">
                                                        <option value="0">Все</option>
                                                        <option value="1">Пункт 1</option>
                                                        <option value="2">Пункт 2</option>
                                                        <option value="3">Пункт 3</option>
                                                    </select>
									<?if ($arItem["FILTER_HINT"] <> ""):?>
										<i id="item_title_hint_<?echo $arItem["ID"]?>" class="fa fa-question-circle"></i>
										<script>
											new top.BX.CHint({
												parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
												show_timeout: 10,
												hide_timeout: 200,
												dx: 2,
												preventHide: true,
												min_width: 250,
												hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
											});
										</script>
									<?endif?> -->
									
							
							<!-- <div class="custom-select-container customSelect bx-filter-block" data-role="bx_filter_block"> -->
								<!-- <div class="row bx-filter-parameters-box-container"> -->
								<?
								$arCur = current($arItem["VALUES"]);
								switch ($arItem["DISPLAY_TYPE"])
								{
									case SectionPropertyTable::NUMBERS_WITH_SLIDER://NUMBERS_WITH_SLIDER
										?>
										
										<!-- <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left"> -->
											<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
											<?ksort($arItem["VALUES"]);?>
											<div class="bx-filter-input-container">
												<input
													class="min-price"
													type="text"
													name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
													size="5"
													onkeyup="smartFilter.keyup(this)"
												/>
											</div>
										<!-- </div> -->
										<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
											<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
											<div class="bx-filter-input-container">
												<input
													class="max-price"
													type="text"
													name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
													size="5"
													onkeyup="smartFilter.keyup(this)"
												/>
											</div>
										</div>

										<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
											<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
												<?
												$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
												$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
												$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
												$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
												$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
												$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
												$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
												?>
												<div class="bx-ui-slider-part p1"><span><?=$value1?></span></div>
												<div class="bx-ui-slider-part p2"><span><?=$value2?></span></div>
												<div class="bx-ui-slider-part p3"><span><?=$value3?></span></div>
												<div class="bx-ui-slider-part p4"><span><?=$value4?></span></div>
												<div class="bx-ui-slider-part p5"><span><?=$value5?></span></div>

												<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
												<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
												<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
												<div class="bx-ui-slider-range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
													<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
													<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
												</div>
											</div>
										</div>
										<?
										$arJsParams = array(
											"leftSlider" => 'left_slider_'.$key,
											"rightSlider" => 'right_slider_'.$key,
											"tracker" => "drag_tracker_".$key,
											"trackerWrap" => "drag_track_".$key,
											"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
											"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
											"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
											"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
											"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
											"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
											"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
											"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
											"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
											"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
											"colorAvailableActive" => 'colorAvailableActive_'.$key,
											"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
										);
										?>
										<script>
											BX.ready(function(){
												window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
											});
										</script>
										<?
										break;
									case SectionPropertyTable::NUMBERS://NUMBERS
										?>

										<div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
											<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
											<div class="bx-filter-input-container">
												<input
													class="min-price"
													type="text"
													name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
													size="5"
													onkeyup="smartFilter.keyup(this)"
													/>
											</div>
										</div>
										<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
											<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
											<div class="bx-filter-input-container">
												<input
													class="max-price"
													type="text"
													name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
													size="5"
													onkeyup="smartFilter.keyup(this)"
													/>
											</div>
										</div>
										<?
										break;
									case SectionPropertyTable::CHECKBOXES_WITH_PICTURES://CHECKBOXES_WITH_PICTURES
										?>
										<div class="col-xs-12">
											<div class="bx-filter-param-btn-inline">
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="checkbox"
													name="<?=$ar["CONTROL_NAME"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<?=$ar["HTML_VALUE"]?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												/>
												<?
												$class = "";
												if ($ar["CHECKED"])
													$class.= " bx-active";
												if ($ar["DISABLED"])
													$class.= " disabled";
												?>
												<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
													<span class="bx-filter-param-btn bx-color-sl">
														<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
														<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
														<?endif?>
													</span>
												</label>
											<?endforeach?>
											</div>
										</div>
										<?
										break;
									case SectionPropertyTable::CHECKBOXES_WITH_PICTURES_AND_LABELS://CHECKBOXES_WITH_PICTURES_AND_LABELS
										?>
										<div class="col-xs-12">
											<div class="bx-filter-param-btn-block">
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="checkbox"
													name="<?=$ar["CONTROL_NAME"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<?=$ar["HTML_VALUE"]?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												/>
												<?
												$class = "";
												if ($ar["CHECKED"])
													$class.= " bx-active";
												if ($ar["DISABLED"])
													$class.= " disabled";
												?>
												<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
													<span class="bx-filter-param-btn bx-color-sl">
														<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
															<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
														<?endif?>
													</span>
													<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
													if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
														?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
													endif;?></span>
												</label>
											<?endforeach?>
											</div>
										</div>
										<?
										break;
									case SectionPropertyTable::DROPDOWN://DROPDOWN
										$checkedItemExist = false;
										?>
										
										<div class="bx-filter-select-container">
												<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
										<div class="filter__label2 bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
											<?=$arItem["NAME"]?>
										</div>
										<div class="smart-filter-input-group-dropdown" style="border: none;">
										<div class="" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
											<div class="custom-select-container customSelect ">
											<span class="custom-select-opener"  data-role="currentOption">
											
												<?foreach ($arItem["VALUES"] as $val => $ar)
												{
													if ($ar["CHECKED"])
													{
														?><span><?echo $ar["VALUE"];?></span><?
														$checkedItemExist = true;
													}
												}
												if (!$checkedItemExist)
												{
													?><span ><?echo GetMessage("CT_BCSF_FILTER_ALL");?></span><?
												}
												?>
											</div>
											<!-- <select class="js--select" name="#">
                                                    <option value="0">Все</option>
                                                    <option value="1">Пункт 1</option>
                                                    <option value="2">Пункт 2</option>
                                                    <option value="3">Пункт 3</option>
                                                </select> -->
											<!-- <select class="js--select"></select> -->
											<input
												style="display: none"
												type="radio"
												name="<?=$arCur["CONTROL_NAME_ALT"]?>"
												id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
												value=""
											/>
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="radio"
													name="<?=$ar["CONTROL_NAME_ALT"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<? echo $ar["HTML_VALUE_ALT"] ?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												/>
											<?endforeach?>
											<!-- <div class="smart-filter-dropdown-popup" data-role="dropdownContent" style="display: none"> -->
											<!-- <select class="js--select" name="#"> 
                                                    <option value="0">Все</option>
                                                    <option value="1">Пункт 1</option>
                                                    <option value="2">Пункт 2</option>
                                                    <option value="3">Пункт 3</option>
											</select> -->
													<div class="smart-filter-dropdown-popup " data-role="dropdownContent" style="display: none; max-height: 10.7em;overflow-y: auto;
													    /* margin-top: 4px; */
    background-color: #5C6471;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    padding-right: 5px;
	max-height: 188px;
    transition: max-height 0.3s ease, overflow-y 0.1s 0.3s;    min-width: 120px;
    z-index: 5;">
													<!-- <ul>
														<li class="custom-select-opener" > -->
															<div class="custom-select-option">
															<label for="<?="all_".$arCur["CONTROL_ID"]?>"
																	class="smart-filter-param-label"
																	style="padding:0"
																	data-role="label_<?="all_".$arCur["CONTROL_ID"]?>"
																	onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																<!-- <span class="smart-filter-checkbox-btn-image all"></span> -->
																<span ><?=GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
															</label>
														</div>
														<!-- </li> -->
													<?
													foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
														<!-- <li> -->
															<div class="custom-select-option">
															<label class="custom-select-opener" for="<?=$ar["CONTROL_ID"]?>"
																	data-role="label_<?=$ar["CONTROL_ID"]?>"
																	style="padding:0"
																	class="smart-filter-param-label<?=$class?>"
																	onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="custom-select-opener" ></span>
																<?endif?>
																<span ><?=$ar["VALUE"]?></span>
															</label>
															</div>
														<!-- </li> -->
													<?endforeach?>
													<!-- </ul> -->
												</div>

											<!-- </select> -->
											</div>
										</div>
										</div>
										</div>




										




										<?
										break;
									case SectionPropertyTable::DROPDOWN_WITH_PICTURES_AND_LABELS://DROPDOWN_WITH_PICTURES_AND_LABELS
										?>
										<div class="col-xs-12">
											<div class="bx-filter-select-container">
												<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
													<div class="bx-filter-select-text fix" data-role="currentOption">
														<?
														$checkedItemExist = false;
														foreach ($arItem["VALUES"] as $val => $ar):
															if ($ar["CHECKED"])
															{
															?>
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
																<span class="bx-filter-param-text">
																	<?=$ar["VALUE"]?>
																</span>
															<?
																$checkedItemExist = true;
															}
														endforeach;
														if (!$checkedItemExist)
														{
															?><span class="bx-filter-btn-color-icon all"></span> <?
															echo GetMessage("CT_BCSF_FILTER_ALL");
														}
														?>
													</div>
													<div class="bx-filter-select-arrow"></div>
													<input
														style="display: none"
														type="radio"
														name="<?=$arCur["CONTROL_NAME_ALT"]?>"
														id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
														value=""
													/>
													<?foreach ($arItem["VALUES"] as $val => $ar):?>
														<input
															style="display: none"
															type="radio"
															name="<?=$ar["CONTROL_NAME_ALT"]?>"
															id="<?=$ar["CONTROL_ID"]?>"
															value="<?=$ar["HTML_VALUE_ALT"]?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														/>
													<?endforeach?>
													<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none">
														<ul>
															<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
																<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																	<span class="bx-filter-btn-color-icon all"></span>
																	<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
																</label>
															</li>
														<?
														foreach ($arItem["VALUES"] as $val => $ar):
															$class = "";
															if ($ar["CHECKED"])
																$class.= " selected";
															if ($ar["DISABLED"])
																$class.= " disabled";
														?>
															<li>
																<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																	<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																		<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																	<?endif?>
																	<span class="bx-filter-param-text">
																		<?=$ar["VALUE"]?>
																	</span>
																</label>
															</li>
														<?endforeach?>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<?
										break;
									case SectionPropertyTable::RADIO_BUTTONS://RADIO_BUTTONS
										?>
										<div class="col-xs-12">
											<div class="radio">
												<label class="bx-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox">
														<input
															type="radio"
															value=""
															name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
															id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
															onclick="smartFilter.click(this)"
														/>
														<span class="bx-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
													</span>
												</label>
											</div>
											<?foreach($arItem["VALUES"] as $val => $ar):?>
												<div class="radio">
													<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
														<span class="bx-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
															<input
																type="radio"
																value="<? echo $ar["HTML_VALUE_ALT"] ?>"
																name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
																id="<? echo $ar["CONTROL_ID"] ?>"
																<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
																onclick="smartFilter.click(this)"
															/>
															<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
															if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
																?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
															endif;?></span>
														</span>
													</label>
												</div>
											<?endforeach;?>
										</div>
										<?
										break;
									case SectionPropertyTable::CALENDAR://CALENDAR
										?>
										<div class="col-xs-12">
											<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
												<?$APPLICATION->IncludeComponent(
													'bitrix:main.calendar',
													'',
													array(
														'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
														'SHOW_INPUT' => 'Y',
														'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
														'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
														'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
														'SHOW_TIME' => 'N',
														'HIDE_TIMEBAR' => 'Y',
													),
													null,
													array('HIDE_ICONS' => 'Y')
												);?>
											</div></div>
											<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
												<?$APPLICATION->IncludeComponent(
													'bitrix:main.calendar',
													'',
													array(
														'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
														'SHOW_INPUT' => 'Y',
														'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
														'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
														'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
														'SHOW_TIME' => 'N',
														'HIDE_TIMEBAR' => 'Y',
													),
													null,
													array('HIDE_ICONS' => 'Y')
												);?>
											</div></div>
										</div>
										<?
										break;
									default://CHECKBOXES
										?>
										<?if($arItem["CODE"]=="U_RUNFLAT" || $arItem["CODE"]=="U_REINFORCED"){
											foreach($arItem["VALUES"] as $val => $ar):
											if($ar["VALUE"]=="Да"){?>
											<div class="filter__item">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="form__check bx-filter-param-label ">
													<input
																		type="checkbox"
																		value="<? echo $ar["HTML_VALUE"] ?>"
																		name="<? echo $ar["CONTROL_NAME"] ?>"
																		id="<? echo $ar["CONTROL_ID"] ?>"
																		<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
																		onclick="smartFilter.click(this)"
																	/>
													<span class="form__check__text"> 
														<span class="wicon"> 
															<span class="wicon__ic">
																<?if($arItem["CODE"]=="U_RUNFLAT"){?>
																	<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path fill-rule="evenodd" clip-rule="evenodd" d="M10.1345 0.325321C9.12345 0.0246161 8.06302 -0.0689735 7.0156 0.0501693C5.96819 0.169312 4.95503 0.498879 4.03572 1.01916C3.1164 1.53944 2.30956 2.24004 1.6627 3.07976C1.01585 3.91948 0.542024 4.88134 0.269204 5.90864C-0.00361578 6.93594 -0.0699105 8.00777 0.0741455 9.06133C0.218202 10.1149 0.569717 11.1289 1.10803 12.0432C1.64634 12.9576 2.36055 13.7539 3.20859 14.3856C4.05662 15.0172 5.02138 15.4713 6.04598 15.7209C6.71494 15.9078 7.406 16.0017 8.10012 16C10.0177 15.9998 11.8697 15.296 13.3109 14.0197C14.7521 12.7434 15.6841 10.9817 15.9331 9.06328C16.1821 7.14483 15.7311 5.20055 14.6642 3.59284C13.5974 1.98513 11.9873 0.823745 10.1345 0.325321ZM15.2107 9.95126C14.7713 11.6168 13.7729 13.0772 12.3859 14.0832C10.9988 15.0891 9.30894 15.5785 7.60428 15.4679C5.89961 15.3573 4.28572 14.6536 3.03776 13.4767C1.7898 12.2997 0.984977 10.7225 0.760588 9.01389C0.536199 7.30526 0.906146 5.5709 1.80725 4.10665C2.70835 2.64241 4.08486 1.53888 5.70215 0.984129C7.31944 0.429374 9.07741 0.457689 10.6763 1.06441C12.2751 1.67113 13.6159 2.81864 14.47 4.31125C15.448 6.01794 15.7144 8.04648 15.2107 9.95126ZM11.2308 11.9542C11.2308 11.9442 11.2307 11.9442 11.2406 11.9442C11.2444 11.9353 11.2515 11.9281 11.2604 11.9243C11.9311 11.3666 12.4468 10.6428 12.7567 9.82353C13.0666 9.00424 13.1601 8.11761 13.0282 7.25083C12.8417 6.0235 12.212 4.90919 11.2604 4.12198C11.2515 4.11815 11.2444 4.11099 11.2406 4.10203H11.2308C10.5506 3.54887 9.73853 3.18503 8.87565 3.04692C8.01277 2.9088 7.12905 3.00119 6.31252 3.31477H6.29287C5.80596 3.50225 5.35227 3.76815 4.94965 4.10203H4.93988C4.93608 4.11099 4.92899 4.11815 4.92011 4.12198C4.25004 4.6802 3.73495 5.40407 3.4251 6.22321C3.11526 7.04234 3.02122 7.92869 3.15229 8.79543V8.8054C3.28213 9.68365 3.64025 10.5115 4.19027 11.2046C4.74029 11.8978 5.46255 12.4317 6.28347 12.7517C7.10439 13.0717 7.99469 13.1664 8.86372 13.0263C9.73275 12.8863 10.5495 12.5163 11.2308 11.9542ZM9.12725 9.25377C9.12346 9.26273 9.11636 9.26989 9.10748 9.27372L8.88035 9.40314L8.42598 9.67221C8.39122 9.69368 8.36164 9.72288 8.33942 9.75736C8.31721 9.79184 8.30292 9.83093 8.29759 9.87171C8.12635 9.88997 7.95337 9.88324 7.78402 9.85176C7.74384 9.72625 7.65954 9.61987 7.54701 9.55276L7.05322 9.26374C6.93704 9.19512 6.79941 9.17368 6.66816 9.2039C6.59799 9.12937 6.53813 9.04556 6.49034 8.95477C6.44164 8.86465 6.39875 8.77143 6.36195 8.67573C6.40885 8.62873 6.44612 8.57283 6.47154 8.51127C6.49696 8.44971 6.51006 8.38383 6.51012 8.31713V7.7391C6.51199 7.67213 6.49973 7.60558 6.47419 7.54374C6.44865 7.4819 6.4104 7.42631 6.36195 7.3805C6.42237 7.2167 6.5055 7.06217 6.60885 6.92191C6.64611 6.94011 6.68721 6.94895 6.72856 6.94721C6.76992 6.94547 6.81024 6.9332 6.84586 6.91194L7.04333 6.80246V6.79249C7.05321 6.79249 7.06311 6.78251 7.07299 6.78251L7.29023 6.64311L7.75449 6.38401C7.78938 6.36033 7.81879 6.32935 7.84093 6.29327C7.86306 6.25719 7.87742 6.21663 7.88288 6.17455C8.05426 6.16146 8.22657 6.16816 8.39645 6.1945C8.43351 6.3242 8.51829 6.43477 8.63346 6.50347L9.12725 6.79249C9.24612 6.85335 9.38206 6.871 9.51231 6.84236C9.57156 6.92208 9.63087 7.01176 9.69013 7.09148C9.73789 7.18069 9.77755 7.2741 9.80863 7.37052C9.71874 7.47182 9.66943 7.60313 9.67035 7.7391V8.31713C9.67131 8.44977 9.72052 8.57729 9.80863 8.67573C9.74953 8.83819 9.66987 8.99247 9.57162 9.13432C9.53504 9.11378 9.49349 9.10385 9.45167 9.10561C9.40984 9.10737 9.36937 9.12075 9.33461 9.14429L9.1469 9.25377H9.12725ZM5.4731 11.6452L6.78667 9.72209L7.28046 10.0111L6.29287 12.1238L5.4731 11.6452ZM3.64608 7.53985L5.98666 7.7391V8.31713L3.64608 8.50641C3.60657 8.18544 3.60657 7.86081 3.64608 7.53985ZM10.7271 4.38107L9.38404 6.32417L8.90001 6.04512L9.89748 3.89281C10.1891 4.02791 10.467 4.19144 10.7271 4.38107ZM12.5344 8.50641L10.1938 8.31713V7.7391L12.5344 7.53985C12.5739 7.86081 12.5739 8.18544 12.5344 8.50641ZM11.132 11.3265L9.90737 9.55276C10.0759 9.34184 10.2124 9.1068 10.3123 8.85527L12.4455 9.03457C12.2522 9.91686 11.7934 10.7174 11.132 11.3265ZM11.9715 5.76608C12.1917 6.15545 12.3547 6.57503 12.4554 7.01168L10.3123 7.20096C10.2665 7.07362 10.2103 6.95043 10.1444 6.83238C10.0767 6.71487 9.99732 6.6046 9.90737 6.50347L11.1419 4.71972C11.4663 5.02685 11.7458 5.37923 11.9715 5.76608ZM8.08035 3.51402C8.52913 3.50962 8.97574 3.57684 9.40369 3.71327L8.48529 5.67631C8.22436 5.62824 7.95722 5.62486 7.69517 5.66633L6.77678 3.71327C7.19812 3.57759 7.63809 3.51037 8.08035 3.51402ZM5.84839 4.112C5.98665 4.03229 6.13485 3.96256 6.28299 3.89281L7.28046 6.04512L7.02368 6.1945L6.78667 6.32417L5.44344 4.38107C5.57379 4.2845 5.70897 4.19468 5.84839 4.112ZM5.03862 4.71972L6.2731 6.50347C6.1012 6.70836 5.96432 6.94068 5.86816 7.19098L3.73493 7.01168C3.9335 6.13374 4.38751 5.33561 5.03862 4.71972ZM4.20895 10.2802C3.98874 9.8908 3.82574 9.47122 3.72504 9.03457L5.86816 8.85527C5.914 8.98261 5.97019 9.1058 6.03609 9.22384C6.10857 9.3381 6.1877 9.44799 6.2731 9.55276L5.03862 11.3365C4.71392 11.0258 4.43452 10.6701 4.20895 10.2802ZM6.77678 12.333L7.69517 10.3799C7.82895 10.4035 7.96434 10.4167 8.10012 10.4196C8.22932 10.4162 8.3581 10.403 8.48529 10.3799L9.40369 12.343C8.54659 12.6038 7.63191 12.6003 6.77678 12.333ZM9.89748 12.1534L8.90001 10.0111L9.15679 9.86173L9.38404 9.72209L10.7271 11.6752C10.4691 11.8652 10.1908 12.0256 9.89748 12.1534ZM8.36679 7.00171C8.1914 6.95346 8.0066 6.95204 7.83044 6.99733C7.65427 7.04261 7.49272 7.13303 7.3616 7.26007C7.23047 7.38712 7.13426 7.5463 7.08227 7.72207C7.03028 7.89783 7.02425 8.08434 7.06491 8.26312C7.10558 8.4419 7.19147 8.60685 7.31422 8.74215C7.43697 8.87745 7.59243 8.97842 7.76534 9.03506C7.93824 9.0917 8.12274 9.10222 8.30085 9.06547C8.47895 9.02871 8.64452 8.94594 8.7815 8.82535C8.92522 8.69928 9.03236 8.53609 9.09133 8.35338C9.15029 8.17067 9.15888 7.97528 9.11628 7.78799C9.07368 7.60071 8.98151 7.42872 8.84949 7.29024C8.71747 7.15176 8.55061 7.05193 8.36679 7.00171ZM8.6038 8.16751C8.56805 8.2953 8.48636 8.40517 8.37475 8.47551C8.26313 8.54585 8.12955 8.57165 8.00006 8.54801C7.87056 8.52436 7.75442 8.45289 7.67432 8.34754C7.59421 8.2422 7.55589 8.11057 7.56678 7.97824C7.57766 7.84553 7.63745 7.72172 7.73435 7.63132C7.83126 7.54092 7.95826 7.49052 8.09023 7.48997C8.13689 7.49171 8.18324 7.49841 8.22851 7.50992C8.36064 7.55092 8.4731 7.63961 8.54449 7.75904C8.61333 7.88325 8.63449 8.02861 8.6038 8.16751Z" fill="currentColor" />
																	</svg>
																<?};
																if($arItem["CODE"]=="U_REINFORCED"){?>
																	<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<g clip-path="url(#clip0_7175_58443)">
																			<g clip-path="url(#clip1_7175_58443)">
																				<path fill-rule="evenodd" clip-rule="evenodd" d="M10.1345 0.325321C9.12345 0.024616 8.06302 -0.0689735 7.0156 0.0501693C5.96819 0.169312 4.95503 0.498879 4.03572 1.01916C3.1164 1.53944 2.30956 2.24004 1.6627 3.07976C1.01585 3.91948 0.542024 4.88134 0.269204 5.90864C-0.0036158 6.93594 -0.0699106 8.00777 0.0741455 9.06133C0.218202 10.1149 0.569717 11.1289 1.10803 12.0432C1.64634 12.9576 2.36055 13.7539 3.20859 14.3856C4.05662 15.0172 5.02138 15.4713 6.04598 15.7209C6.71494 15.9078 7.406 16.0017 8.10012 16C10.0177 15.9998 11.8697 15.296 13.3109 14.0197C14.7521 12.7434 15.6841 10.9817 15.9331 9.06328C16.1821 7.14483 15.7311 5.20055 14.6642 3.59284C13.5974 1.98513 11.9873 0.823745 10.1345 0.325321ZM15.2107 9.95126C14.7713 11.6168 13.7729 13.0772 12.3859 14.0832C10.9988 15.0891 9.30895 15.5785 7.60428 15.4679C5.89961 15.3573 4.28572 14.6536 3.03776 13.4767C1.7898 12.2997 0.984977 10.7225 0.760588 9.01389C0.536199 7.30526 0.906146 5.5709 1.80725 4.10665C2.70835 2.64241 4.08486 1.53888 5.70215 0.984129C7.31944 0.429374 9.07741 0.457689 10.6763 1.06441C12.2751 1.67113 13.6159 2.81864 14.47 4.31125C15.448 6.01794 15.7144 8.04648 15.2107 9.95126Z" fill="currentColor" />
																			</g>
																			<path d="M8.10844 12C7.22024 12 6.47044 11.8311 5.85902 11.4933C5.24761 11.152 4.78492 10.6809 4.47095 10.08C4.15698 9.47911 4 8.78578 4 8C4 7.21422 4.15698 6.52089 4.47095 5.92C4.78492 5.31911 5.24761 4.84978 5.85902 4.512C6.47044 4.17067 7.22024 4 8.10844 4C9.14536 4 9.99225 4.22933 10.6491 4.688C11.306 5.14311 11.7563 5.75467 12 6.52267L11.0705 6.73067C10.8805 6.12267 10.5396 5.64089 10.048 5.28533C9.55642 4.92978 8.90989 4.752 8.10844 4.752C7.41028 4.752 6.82985 4.88889 6.36716 5.16267C5.90447 5.43644 5.55538 5.81867 5.31991 6.30933C5.08856 6.79644 4.96876 7.36 4.9605 8C4.95636 8.64 5.06997 9.20356 5.30132 9.69067C5.53679 10.1778 5.88794 10.56 6.35476 10.8373C6.82572 11.1111 7.41028 11.248 8.10844 11.248C8.90989 11.248 9.55642 11.0702 10.048 10.7147C10.5396 10.3556 10.8805 9.87378 11.0705 9.26933L12 9.47733C11.7563 10.2453 11.306 10.8587 10.6491 11.3173C9.99225 11.7724 9.14536 12 8.10844 12Z" fill="currentColor" />
																		</g>
																		<defs>
																			<clipPath id="clip0_7175_58443">
																				<rect width="16" height="16" fill="white" />
																			</clipPath>
																			<clipPath id="clip1_7175_58443">
																				<rect width="16" height="16" fill="white" />
																			</clipPath>
																		</defs>
																	</svg>
																<?}?>
															</span>
															<span>
															<?=$arItem["NAME"]?>
															</span>
														</span>
													</span>
												</label>
											</div>
											<?}endforeach;
										}else{?>
										<div class="filter__label3 bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
											<?=$arItem["NAME"]?>
										</div>
										
										<!-- <div class="col-xs-12"> -->
										
											<?foreach($arItem["VALUES"] as $val => $ar):?>
											
												<div class="filter__item">
													<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="form__check bx-filter-param-label ">
														<!-- <span class="bx-filter-input-checkbox"> -->
															<input
																type="checkbox"
																value="<? echo $ar["HTML_VALUE"] ?>"
																name="<? echo $ar["CONTROL_NAME"] ?>"
																id="<? echo $ar["CONTROL_ID"] ?>"
																<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
																onclick="smartFilter.click(this)"
															/>
															<span class="form__check__text">
																<span class="wicon">
																
															<?
															$hlblock = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_seasons')))->fetch();
															$entity = HL\HighloadBlockTable::compileEntity($hlblock);
															$entity_data_class = $entity->getDataClass(); 
															$rsData = $entity_data_class::getList(array(
																"select" => array("*"),
																"order" => array("ID" => "ASC"),
																"filter" => array("UF_NAME"=>$ar["VALUE"])  
																));
																
																while($el = $rsData->fetch()){
																	?><span class="wicon__ic"><?
																	echo($el["UF_DESCRIPTION"]);
																	?></span><?
																}?>
																<?
															$hlblock = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_thorn')))->fetch();
															$entity = HL\HighloadBlockTable::compileEntity($hlblock);
															$entity_data_class = $entity->getDataClass(); 
															$rsData = $entity_data_class::getList(array(
																"select" => array("*"),
																"order" => array("ID" => "ASC"),
																"filter" => array("UF_NAME"=>$ar["VALUE"])  
																));
																
																while($el = $rsData->fetch()){
																	?><span class="wicon__ic"><?
																	echo($el["UF_DESCRIPTION"]);
																	?></span><?
																}?>
																
																<span class="" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?></span>
															
															</span>
														<!-- </span> -->
													</label>
												</div>
												
											<?endforeach;?>
											<?}?>
										<!-- </div> -->
								<?
								}
								?>
								</div>
								<!-- <div style="clear: both"></div> -->
							<!-- </div> -->
						<!-- </div> -->
					<?
					}
					?>
				</div>
			</div>
			<!--</div>//row-->
			<div class="filter-side__footer">
				<div class="filter-side__footer__body">
					<div class="row">
						<!-- <div class="col-xs-12 bx-filter-button-box">
							<div class="bx-filter-block">
								<div class="bx-filter-parameters-box-container"> -->
									<div class="col-12 col-lg">
									<input
										class="mbtn mbtn__primary mbtn__small d-block w-100 btn btn-themes"
										type="submit"
										id="set_filter"
										name="set_filter"
										value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
									/>
									</div>
									<div class="col-12 col-lg-auto">
									<input
										class="mbtn mbtn__small d-block w-100 btn btn-link"
										type="submit"
										id="del_filter"
										name="del_filter"
										value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
									/>
									</div>
									 <div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
										<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num" >'.(int)($arResult["ELEMENT_COUNT"] ?? 0).'</span>'));?>
										<span class="arrow"></span>
										<br/>
										<a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
									 </div>
								<!--</div>
							</div> -->
						</div>
					</div>
				</div>
				</div>
			<!-- </div> -->
			<div class="clb"></div>
		</form>
	<!-- </div> -->
<!-- </div> -->

<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
	
	document.addEventListener("DOMContentLoaded", function () {
		$(".custom-select-option").on( "click", function() {
			$("#"+$(this).data('value')).prop('checked', true);
		});
	})
</script>