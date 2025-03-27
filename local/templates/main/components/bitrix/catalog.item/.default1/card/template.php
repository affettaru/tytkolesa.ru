<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>


<?

$id = $this->GetEditAreaId($item['ID']);

// $file = CFile::ResizeImageGet($item['PREVIEW_PICTURE']["SRC"], array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

$file = CFile::ResizeImageGet($item["DETAIL_PICTURE"], array("width" => $wdth, "height" => $hght));
// echo "<pre>Template arResult: "; print_r($file); echo "</pre>";
?>


<!-- <div class="catalog__el"> -->
	<div class="catalog__card product-item"><a class="catalog__card__img" href="<?= $item["DETAIL_PAGE_URL"] ?>"><img src="<?=$file["src"]?>" alt="<?= $item["NAME"] ?>" /></a>
		<div class="catalog__card__body"><a class="catalog__card__title" href="<?= $item["DETAIL_PAGE_URL"] ?>"><?= $item["NAME"] ?></a>
			<div class="catalog__card__line row align-items-md-center">
				<div class="col-12 col-md-auto">
					<div class="catalog__card__price"><?=$item["ITEM_PRICES"][0]["PRINT_PRICE"]?></div>
				</div>
				<?if($item["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]!=$item["ITEM_PRICES"][0]["PRINT_PRICE"] && !empty($item['ID'])){ ?>
					<div class="col-12 col-md-auto">
						<div class="catalog__card__oldprice"><?=$item["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]?></div>
					</div>
				<?}?>
			</div>
			<div class="catalog__card__footer d-none d-md-block">
				<div class="row">
					<div class="col-6">
						<div class="inputcount js--inputcount">
							<div class="inputcount__btn inputcount__btn__left js--inputcount-minus"><svg>
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-minus"></use>
								</svg></div>
							<div class="inputcount__btn inputcount__btn__right js--inputcount-plus"><svg>
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-plus"></use>
								</svg></div><input class="inputcount__input js--inputcount-input" type="number" value="0" min="0" step="1" max="<?=$item["PRODUCT"]["QUANTITY"]?>"/>
						</div>
					</div>
					<div class="col-6"><button class="mbtn mbtn__grey2 mbtn__small" type="button">В корзину</button></div>
			<?
					
								?>
								<div class="product-item-info-container " data-entity="buttons-block">
														<div class="product-item-button-container" id="<?=$itemIds['BASKET_ACTIONS']?>">
									<a class="btn btn-link btn-md" id="<?=$itemIds['BUY_LINK']?>" href="javascript:void(0)" rel="nofollow">
										В корзину									</a>
								</div></div>
								<!-- <div class="product-item-info-container " data-entity="buttons-block">
								
													
													<div class="product-item-button-container" id="<?=$itemIds['BASKET_ACTIONS']?>">
									<a class="btn btn-link <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
										href="javascript:void(0)" rel="nofollow">
										<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
									</a>
								</div> -->
								<!-- <div class="product-item-button-container">
								
									<?
									if ($showSubscribe)
									{
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'PRODUCT_ID' => $item['ID'],
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
												'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
												'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
									}
									?>
									<a class="btn btn-link <?=$buttonSizeClass?>"
										id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
										<?=($actualItem['CAN_BUY'] ? 'style="display: none;"' : '')?>>
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</a>
									<div id="<?=$itemIds['BASKET_ACTIONS']?>" <?=($actualItem['CAN_BUY'] ? '' : 'style="display: none;"')?>>
										<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
											href="javascript:void(0)" rel="nofollow">
											<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
										</a>
									</div>
								</div> -->
								</div>

								<?
							?>
							
					
				</div>
			</div>
		</div>
	</div>
<!-- </div> -->





