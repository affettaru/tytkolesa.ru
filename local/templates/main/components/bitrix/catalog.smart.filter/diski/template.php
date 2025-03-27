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
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}
?>


<div class="col-12 col-lg-6">
	<!-- <div class="smart-filter-section"> -->

		<!-- <div class="smart-filter-title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></div> -->
		
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="/catalog/diski/" method="get" class="" style="height: 100%;">

			<div class="filter__btnslide d-lg-none js--filter-title">
				<div class="filter__btnslide__img">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/filter/bg-filter-2-title.png" alt="">
				</div>
				<div class="filter__btnslide__link">
				<span>Подобрать <i>
				<svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                            </svg></i></span>
				</div>
				<div class="filter__btnslide__title">
						Диски
				</div>
			</div>

			<div class="filter js--filter-slider">

				<div class="filter__title d-none d-lg-block">
					<div class="row align-items-center">
						<div class="col">
							<div class="h1">
									Диски
							</div>
						</div>
						<div class="col-auto">
							<div class="filter__title__des">
									Параметры
							</div>
						</div>
					</div>
				</div>
				<div class="filter__content">
					<div class="filter__img">
						<img src="<?=SITE_TEMPLATE_PATH?>/img/filter/bg-filter-2.png" alt="">
					</div>
					<div class="filter__body">
			<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;?>

			<div class="filter__line1 row">
				<?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
				{
					break;
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

						<div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-12<?endif?> mb-2 smart-filter-parameters-box bx-active">
							<div class="smart-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
								<span class="smart-filter-container-modef"></span>
								<span class="smart-filter-parameters-box-title-text"><?=$arItem["NAME"]?></span>
								<span data-role="prop_angle" class="smart-filter-angle smart-filter-angle-up">
									<span  class="smart-filter-angles"></span>
								</span>
							</div>

							<div class="smart-filter-block" data-role="bx_filter_block">
								<div class="smart-filter-parameters-box-container">
									<div class="smart-filter-input-group-number">
										<div class="d-flex justify-content-between">
											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="min-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="max-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>
										</div>

										<div class="smart-filter-slider-track-container">
											<div class="smart-filter-slider-track" id="drag_track_<?=$key?>">
												<?for($i = 0; $i <= $step_num; $i++):?>
												<div class="smart-filter-slider-ruler p<?=$i+1?>"><span><?=$prices[$i]?></span></div>
												<?endfor;?>
												<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0; right: 0;">
													<a class="smart-filter-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
													<a class="smart-filter-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
												</div>
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
				}

				//not prices
				foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
						continue;

					if (
						$arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
						&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
					)
					{
						continue;
					}
					?>
<?if($arItem["CODE"]=="U_MARKA_D" || $arItem["CODE"]=="U_ET" || $arItem["CODE"]=="U_WIDTH_D" || $arItem["CODE"]=="U_DIAMETER_D" || $arItem["CODE"]=="U_DIA"|| $arItem["CODE"]=="U_BOLTS_SPACING"){ ?>

						<div class="col-6 <?if($arItem["CODE"]!="U_BOLTS_SPACING" && $arItem["CODE"]!="U_DIA"){?>col-xl-3<?}?>">
									<div class="filter__label">
									<?=$arItem["NAME"]?>
									</div>
						
							<?
							
							$arCur = current($arItem["VALUES"]);
							switch ($arItem["DISPLAY_TYPE"])
							{
								
								//region DROPDOWN +
								default:
								?>
									<? $checkedItemExist = false; ?>
									
									<div class="smart-filter-input-group-dropdown" style="border: none;">
										<div class="" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
											<div class="custom-select-container customSelect ">
											<span class="custom-select-opener"  data-role="currentOption">
											<?ksort($arItem["VALUES"]);?>
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
								<?
								
									
							}
							?>
							<!-- </div>
						</div> -->
					
				<?
				}
			}
				?>
				</div>
			
				
			</div><!--//row-->
			</div>
			<div class="filter__footer row">
				<div class="filter__footer__item col smart-filter-button-box">
					<div class="smart-filter-block">
						<div class="smart-filter-parameters-box-container">
							<input
								class="mbtn mbtn__big mbtn__primary d-block w-100"
								type="submit"
								id="set_filter2"
								name="set_filter"
								value="Подобрать диски"
							/>
							<!-- <input
								class="btn btn-link"
								type="submit"
								id="del_filter"
								name="del_filter"
								value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
							/> -->
							<div class="smart-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
								<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.(int)($arResult["ELEMENT_COUNT"] ?? 0).'</span>'));?>
								<span class="arrow"></span>
								<br/>
								<a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="filter__footer__item">
					<a class="mbtn mbtn__big d-block w-100" href="/catalog/">Перейти&nbsp;в&nbsp;каталог</a>
				</div>
			</div>

			</div>
			</div>
		</form>

	<!-- </div> -->
</div>

<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>