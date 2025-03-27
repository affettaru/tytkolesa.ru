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
?>


<div class="h2"><?= $arResult["NAME"] ?></div>
    <div class="article">
        <div class="article__date"><?$dateCreate = CIBlockFormatProperties::DateFormat('d.m.Y', MakeTimeStamp($arItem["DATE_CREATE"], CSite::GetDateFormat()));
                echo $dateCreate;?></div>
        <div class="article__body">
            <div class="block__text">
                <?php if ($arResult["DETAIL_PICTURE"]["SRC"] || $arResult["PREVIEW_PICTURE"]["SRC"]): ?>
                    <picture>
                        <source media="(min-width: 828px)" srcset="<?= $arResult["DETAIL_PICTURE"]["SRC"] ? $arResult["DETAIL_PICTURE"]["SRC"] : $arResult["PREVIEW_PICTURE"]["SRC"]  ?>" /><img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ? $arResult["DETAIL_PICTURE"]["SRC"] : $arResult["PREVIEW_PICTURE"]["SRC"]  ?>" alt="" />
                    </picture>
                <?php endif; ?>
                <?= html_entity_decode($arResult["DETAIL_TEXT"]) ?>
            </div>
            <?
            if(!empty($arResult["PROPERTIES"]["SLAIDER"]["VALUE"])){?>
                <div class="gallery swiper js--gallery">
                    <div class="swiper-wrapper">
                        <?
                        foreach ($arResult["PROPERTIES"]["SLAIDER"]["VALUE"] as $key => $value) {
                            $file = CFile::ResizeImageGet($value, array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                            <div class="gallery__item swiper-slide">
                                <a class="gallery__card" href="<?=$file["src"]?>" data-fancybox="gallery-images">
                                    <picture>
                                        <source media="(min-width: 828px)" srcset="<?=$file["src"]?>" /><img src="<?=$file["src"]?>" alt="" />
                                    </picture>
                                </a>
                            </div>
                        <?}?>
                    </div>
                    <div class="sliders__navs"><span class="sliders__navs__prev js--gallery-prev"><svg>
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowleft-big"></use>
                            </svg></span><span class="sliders__navs__next js--gallery-next"><svg>
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowright-big"></use>
                            </svg></span></div>
                    <div class="sliders__pagination js--gallery-pagination"></div>
                </div>
            <?}?>
        </div>
                    <div class="article__footer">
                        <div class="article__share">
                            <div class="article__share__label">Поделиться:</div>
                            <div class="article__share__body">
                                <ul>
                                    <li><a class="bg__green" href="#" target="_blank" rel="noopener noreferrer"><svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1497_1967)">
                                                    <path d="M7.1668 8.66666C7.4531 9.04942 7.81837 9.36612 8.23783 9.59529C8.6573 9.82446 9.12114 9.96074 9.5979 9.99489C10.0747 10.029 10.5532 9.96024 11.001 9.79319C11.4489 9.62613 11.8555 9.36471 12.1935 9.02666L14.1935 7.02666C14.8007 6.39799 15.1366 5.55598 15.129 4.68199C15.1215 3.808 14.7709 2.97196 14.1529 2.35394C13.5348 1.73591 12.6988 1.38535 11.8248 1.37775C10.9508 1.37016 10.1088 1.70614 9.48013 2.31333L8.33347 3.45333M9.83347 7.33333C9.54716 6.95058 9.18189 6.63388 8.76243 6.4047C8.34297 6.17553 7.87913 6.03925 7.40237 6.00511C6.9256 5.97096 6.44708 6.03975 5.99924 6.20681C5.5514 6.37387 5.14472 6.63528 4.8068 6.97333L2.8068 8.97333C2.19961 9.602 1.86363 10.444 1.87122 11.318C1.87881 12.192 2.22938 13.028 2.8474 13.6461C3.46543 14.2641 4.30147 14.6147 5.17546 14.6222C6.04945 14.6298 6.89146 14.2939 7.52013 13.6867L8.66013 12.5467" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1497_1967">
                                                        <rect width="16" height="16" fill="currentColor" transform="translate(0.5)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="toorder">
                    <div class="toorder__content">
                        <div class="toorder__body">Закажите медицинские услуги у нас! Мы предлагаем консультации специалистов, обследования и лечение на современном оборудовании. </div>
                    </div>
                    <div class="toorder__aside"><a class="mbtn mbtn__primary mbtn__blockmobile" data-fancybox-html="modal-order" data-src="#js--modal-order" href="#">Записаться на прием</a></div>
                </div>
                



