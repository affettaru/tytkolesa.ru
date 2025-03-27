<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
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

if ($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"]) {
	$arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"] = $arResult["PROPERTIES"]["PRICE"]["VALUE"];
	$arResult["PROPERTIES"]["PRICE"]["VALUE"] = ceil($arResult["PROPERTIES"]["PRICE"]["VALUE"] / 100 * (100 - $arResult["PROPERTIES"]["DISCOUNT"]["VALUE"]));
}

if(!$arResult["PROPERTIES"]["WB"]["VALUE"]) $arResult["PROPERTIES"]["WB"]["VALUE"] = $GLOBALS["CONTACTS"]["WB"];
if(!$arResult["PROPERTIES"]["OZON"]["VALUE"]) $arResult["PROPERTIES"]["OZON"]["VALUE"] = $GLOBALS["CONTACTS"]["OZON"];
if(!$arResult["PROPERTIES"]["YMARKET"]["VALUE"]) $arResult["PROPERTIES"]["YMARKET"]["VALUE"] = $GLOBALS["CONTACTS"]["YMARKET"];

$characteristics = true;
if(empty($arResult["PROPERTIES"]["MATERIAL"]["VALUE"]) &&
empty($arResult["PROPERTIES"]["FEATURES"]["VALUE"]) &&
empty($arResult["PROPERTIES"]["EQUIPMENT"]["VALUE"]) &&
empty($arResult["PROPERTIES"]["COLOR"]["VALUE"]) &&
empty($arResult["PROPERTIES"]["DECOR"]["VALUE"]) &&
empty($arResult["PROPERTIES"]["COUNTRY"]["VALUE"])){
    $characteristics = false;
}

$APPLICATION->SetPageProperty("title", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"]);
// $APPLICATION->SetPageProperty("description", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]);
$APPLICATION->SetTitle($arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"]);
// $APPLICATION->SetDescription($arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]);
?>

<section class="card">
    <div class="container">
        <div class="card__inner" itemscope itemtype="https://schema.org/Product">
            <div class="card__slider">
                <div class="card__label">
					<?php if ($arResult["PROPERTIES"]["NEW"]["VALUE"]): ?>
                        <div class="card__label-it bg1">Новинка</div>
					<?php endif; ?>
					<?php if ($arResult["PROPERTIES"]["PROMO"]["VALUE"]): ?>
                        <div class="card__label-it bg3">Акция</div>
					<?php endif; ?>
					<?php if ($arResult["PROPERTIES"]["HIT"]["VALUE"]): ?>
                        <div class="card__label-it bg2">Хит</div>
					<?php endif; ?>
                </div>
                 
                <img itemprop="image"  style="display:none" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"]?>" />
                <div class="card__slider-nav js-nav">
                    <div class="swiper-wrapper">
                        <?php if(!$arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] && !$arResult["PROPERTIES"]["VIDEO"]["VALUE"] && !$arResult["PROPERTIES"]["IMAGES"]["SMALL"]): ?>
                            <div class="swiper-slide">
                                <div class="card__slider-nav-item">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/placeholder.png" alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить" title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>" loading="lazy">
                                </div>
                            </div>
                        <?php endif; ?>
						<?php if ($arResult["PROPERTIES"]["VIDEO"]["VALUE"] && $arResult["PROPERTIES"]["VIDEO_PIC"]["VALUE"]): ?>
                            <div class="swiper-slide">
                                <div class="card__slider-nav-item vd">
                                    <img src="<?= $arResult["PROPERTIES"]["VIDEO_PIC"]["SMALL"] ?>" alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить" title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>" loading="lazy">
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ($arResult["DETAIL_PICTURE"]["SMALL"]["SRC"]): ?>
                            <div class="swiper-slide">
                                <div class="card__slider-nav-item">
                                    <img src="<?= $arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] ?>" alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить"  title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>" loading="lazy">
                                </div>
                            </div>
						<?php endif; ?>
						<?php $i=1;
                        foreach ($arResult["PROPERTIES"]["IMAGES"]["SMALL"] as $image): $i++;?>
                            <div class="swiper-slide">
                                <div class="card__slider-nav-item">
                                    <img src="<?= $image ?>"  alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить <?if($i!=1){?>рис. <?echo($i);}?>" loading="lazy" title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?> <?if($i!=1){?>рис. <?echo($i);}?>">
                                </div>
                            </div>
						<?php endforeach; ?>
                    </div>

                    <div class="swiper-button-prev js-prev"></div>
                    <div class="swiper-button-next js-next"></div>
                </div>
                <div class="card__slider-for js-for">
                    <div class="swiper-wrapper">
                   
	                    <?php if(!$arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] && !$arResult["PROPERTIES"]["VIDEO"]["VALUE"] && !$arResult["PROPERTIES"]["IMAGES"]["SMALL"]): ?>
                            <div class="swiper-slide">
                                <a href="<?= SITE_TEMPLATE_PATH ?>/placeholder.png" class="card__slider-for-item" data-fancybox="gallery">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/placeholder.png"  alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить" loading="lazy" title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>">
                                </a>
                            </div>
	                    <?php endif; ?>
						<?php if ($arResult["PROPERTIES"]["VIDEO"]["VALUE"] && $arResult["PROPERTIES"]["VIDEO_PIC"]["VALUE"]): ?>
                            <div class="swiper-slide">
                                <a href="<?= $arResult["PROPERTIES"]["VIDEO"]["VALUE"] ?>" class="card__slider-for-item vd"
                                   data-fancybox="gallery">
                                    <img src="<?= $arResult["PROPERTIES"]["VIDEO_PIC"]["BIG"] ?>"  alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить" loading="lazy" title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>">
                                </a>
                            </div>
						<?php endif; ?>
						<?php if ($arResult["DETAIL_PICTURE"]["BIG"]["SRC"]): ?>
                            <div class="swiper-slide">
                                <a href="<?= $arResult["DETAIL_PICTURE"]["BIG"]["SRC"] ?>" class="card__slider-for-item" data-fancybox="gallery">
                                    <img src="<?= $arResult["DETAIL_PICTURE"]["BIG"]["SRC"] ?>"  title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>"  alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить" loading="lazy">
                                </a>
                            </div>
						<?php endif; ?>
						<?php $i=1;
                        foreach ($arResult["PROPERTIES"]["IMAGES"]["BIG"] as $image): $i++;?>
                            <div class="swiper-slide">
                                <a href="<?= $image ?>" class="card__slider-for-item" data-fancybox="gallery">
                                    <img src="<?= $image ?>"  loading="lazy" title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?> <?if($i!=1){?>рис. <?echo($i);}?>" alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?>  купить <?if($i!=1){?>рис. <?echo($i);}?>">
                                </a>
                            </div>
						<?php endforeach; ?>
                    </div>

                    <div class="swiper-pagination js-nv"></div>

                </div>
            </div>

            <div class="card__info">
                <h1 itemprop="name"><?=$arResult["NAME"]?> <?=$arResult["PROPERTIES"]["VENDOR"]["VALUE"]?></h1>
                <div class="card__top">
                    <div class="card__price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    <meta itemprop="price" content="<?= $arResult["PROPERTIES"]["PRICE"]["VALUE"] ? $arResult["PROPERTIES"]["PRICE"]["VALUE"] . " " : "Цена не указана" ?>">
                    <meta itemprop="priceCurrency" content="RUB">
                    <link itemprop="availability" href="http://schema.org/InStock">
                        <div class="card__price-now"><?= $arResult["PROPERTIES"]["PRICE"]["VALUE"] ? $arResult["PROPERTIES"]["PRICE"]["VALUE"] . " ₽" : "Цена не указана" ?></div>
						<?php if ($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"]): ?>
                            <div class="card__price-old"><?= $arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"] ? $arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"] . " ₽" : "Цена не указана" ?></div>
						<?php endif; ?>
                    </div>

                    <div class="card__link">
                        <a href="javascript:void(0)" class="card__link-fav <?= in_array($arResult["ID"], $_SESSION['fav']) ? "active" : "" ?>" onclick="addFavorite(<?= $arResult["ID"] ?>, this)"></a>
                        <a href="#copy" class="card__link-db open-modal"></a>
                    </div>
                </div>
                    <div class="card__mrkt">
                        <div class="card__mrkt-title">Где купить товар:</div>
						<?php if ($arResult["PROPERTIES"]["WB"]["VALUE"]): ?>
                            <a href="<?= $arResult["PROPERTIES"]["WB"]["VALUE"] ?>" target="_blank"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/content/catalog-i1.png" alt=""></a>
						<?php endif ?>
						<?php if ($arResult["PROPERTIES"]["OZON"]["VALUE"]): ?>
                            <a href="<?= $arResult["PROPERTIES"]["OZON"]["VALUE"] ?>" target="_blank"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/content/catalog-i2.png" alt=""></a>
						<?php endif ?>
						<?php if ($arResult["PROPERTIES"]["YMARKET"]["VALUE"]): ?>
                            <a href="<?= $arResult["PROPERTIES"]["YMARKET"]["VALUE"] ?>" target="_blank"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/content/catalog-i3.png" alt=""></a>
						<?php endif ?>
                    </div>
                <div class="card__all tabs_wrapper">
                    <ul class="tabs">
						<?php if ($arResult["DETAIL_TEXT"]): ?>
                            <li class="active" id="tab1">Описание</li>
						<?php endif; ?>
                        <?php if($characteristics): ?>
                        <li id="tab2">Характеристики</li>
                        <?php endif; ?>
	                    <?php if (!empty($arResult["PROPERTIES"]["REVIEWS"]["VALUE"])): ?>
                        <li id="tab3">Отзывы</li>
	                    <?php endif; ?>
                    </ul>
					<?php if ($arResult["DETAIL_TEXT"]): ?>
                    <div class="tabs_container">
                        <div class="tab_content active" data-tab="tab1">
                            <div class="card__content">
                                <div class="card__m">Описание</div>
                                <div class="tx__tx" itemprop="description">
									<?= $arResult["DETAIL_TEXT"] ?>
                                </div>
                                <div class="tx__btn">
                                    <span class="cl">Показать больше</span>
                                    <span class="op">Скрыть</span>
                                </div>
                            </div>
                        </div>
						<?php endif; ?>
                        <div class="tab_content" data-tab="tab2">
                            <div class="card__content">
                                <div class="card__m">Характеристики</div>
                                <div class="card__descrip">
                                    <div class="tx__tx">
                                        <?php if (!empty($arResult["PROPERTIES"]["VENDOR"]["VALUE"])): ?>
                                            <div class="card__descrip-item"><span><?= $arResult["PROPERTIES"]["VENDOR"]["NAME"] ?>:</span>
												<?= $arResult["PROPERTIES"]["VENDOR"]["VALUE"] ?>
                                            </div>
										<?php endif; ?>

                                        <?php if (!empty($arResult["PROPERTIES"]["COUNTRY"]["VALUE"])): ?>
                                            <div class="card__descrip-item"><span><?= $arResult["PROPERTIES"]["COUNTRY"]["NAME"] ?>:</span>
												<?= $arResult["PROPERTIES"]["COUNTRY"]["VALUE"] ?>
                                            </div>
										<?php endif; ?>
                                        <?php if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])): ?>
                                            <div class="card__descrip-item"><span><?= $arResult["PROPERTIES"]["COLOR"]["NAME"] ?>:</span>
												<?php foreach ($arResult["PROPERTIES"]["COLOR"]["VALUE"] as $arItem): ?>
													<?= $arItem . "; " ?>
												<?php endforeach; ?>
                                            </div>
										<?php endif; ?>

										<?php if (!empty($arResult["PROPERTIES"]["MATERIAL"]["VALUE"])): ?>
                                            <div class="card__descrip-item"><span><?= $arResult["PROPERTIES"]["MATERIAL"]["NAME"] ?>:</span>
												<?php foreach ($arResult["PROPERTIES"]["MATERIAL"]["VALUE"] as $arItem): ?>
													<?= $arItem . "; " ?>
												<?php endforeach; ?>
                                            </div>
										<?php endif; ?>
										<?php if (!empty($arResult["PROPERTIES"]["FEATURES"]["VALUE"])): ?>
                                            <div class="card__descrip-item"><span><?= $arResult["PROPERTIES"]["FEATURES"]["NAME"] ?>:</span>
												<?php foreach ($arResult["PROPERTIES"]["FEATURES"]["VALUE"] as $arItem): ?>
													<?= $arItem . "; " ?>
												<?php endforeach; ?>
                                            </div>
										<?php endif; ?>
										<?php if (!empty($arResult["PROPERTIES"]["EQUIPMENT"]["VALUE"])): ?>
                                            <div class="card__descrip-item"><span><?= $arResult["PROPERTIES"]["EQUIPMENT"]["NAME"] ?>:</span>
												<?php foreach ($arResult["PROPERTIES"]["EQUIPMENT"]["VALUE"] as $arItem): ?>
													<?= $arItem . "; " ?>
												<?php endforeach; ?>
                                            </div>
										<?php endif; ?>
										
										<?php if (!empty($arResult["PROPERTIES"]["DECOR"]["VALUE"])): ?>
                                            <div class="card__descrip-item"><span><?= $arResult["PROPERTIES"]["DECOR"]["NAME"] ?>:</span>
												<?php foreach ($arResult["PROPERTIES"]["DECOR"]["VALUE"] as $arItem): ?>
													<?= $arItem . "; " ?>
												<?php endforeach; ?>
                                            </div>
										<?php endif; ?>
										
                                    </div>
                                    <div class="tx__btn">
                                        <span class="cl">Показать больше</span>
                                        <span class="op">Скрыть</span>
                                    </div>
                                </div>
                            </div>
                        </div>
	                    <?php if (!empty($arResult["PROPERTIES"]["REVIEWS"]["VALUE"])): ?>
                        <div class="tab_content" data-tab="tab3">
                            <div class="card__content">
                                <div class="card__m">Отзывы</div>
                                <div class="card__rev">
                                    <div class="tx__tx">
                                        <?php foreach ($arResult["PROPERTIES"]["REVIEWS"]["VALUE"] as $val): ?>
                                        <div class="card__rev-item">
                                            <div class="card__rev-top">
                                                <div class="card__rev-l">
                                                    <div class="card__rev-av">
                                                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/ic-av.svg" alt="">
                                                    </div>
                                                    <div class="card__rev-name"><?= $val["NAME"] ?></div>
                                                    <div class="card__rev-date"><?= $val["DATE_CREATE"] ?></div>
                                                </div>
                                                <div class="card__rev-rat">
                                                    <?php for ($i = 0; $i < $val["PROPERTY_RATE_VALUE"]; $i++):?>
	                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/star.svg" alt="">
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <p><?= $val["PREVIEW_TEXT"] ?></p>
                                        </div>
                                       <?php endforeach; ?>
                                    </div>
                                    <div class="tx__btn">
                                        <span class="cl">Показать больше</span>
                                        <span class="op">Скрыть</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?  
?>

</section>

