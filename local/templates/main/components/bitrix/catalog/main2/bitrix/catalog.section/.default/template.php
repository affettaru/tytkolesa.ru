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

$APPLICATION->SetPageProperty("SEO_TITLE", $seoTitle);
$APPLICATION->SetPageProperty("SEO_TEXT", $seoText);

?>
<?
// $arResult["PAGE_ELEMENT_COUNT"] кол-во эл-ов $arResult["NAV_RESULT"][result] 
// [NAV_RESULT] [bNavStart] => 1   [NavPageCount] => 1            [NavPageNomer] => 1            [NavPageSize] => 12    [NavRecordCount] => 1            [bFirstPrintNav] => 1            [PAGEN] => 1            [SIZEN] => 12            [SESS_SIZEN] =>             [SESS_ALL] =>             [SESS_PAGEN] =>             [add_anchor] =>             [bPostNavigation] =>             [bFromArray] => 1            [bFromLimited] => 1            [nPageWindow] => 5            [nSelectedCount] => 1
// $NavPageSize=((array)$arResult["NAV_RESULT"])["NavPageSize"]; //кол-во эл-ов на странице
// $NavPageCount=((array)$arResult["NAV_RESULT"])["NavPageCount"]; //кол-во листов для товаров из инфоблока
// $PAGE=$_REQUEST['PAGEN_1'];

// echo "<pre>Template arResult: "; print_r($NavPageCount); echo "</pre>";
// echo "<pre>Template arResult: "; print_r(count($arResult['ITEMS'])); echo "</pre>";
$i=0;?>
<div class="catalog catalog__inside">
<?if (!empty($arResult['ITEMS'])):
    // if ($NavPageCount+1>$PAGE):?>

    <?php  foreach ($arResult["ITEMS"] as $arItem): $i++;?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $id = $this->GetEditAreaId($arItem['ID']);
        if(empty($arItem['ID'])){
            $file["src"]=$arItem['PREVIEW_PICTURE'];
        }else{
        $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);}
        ?>
       
        <div class="catalog__el">
            <div class="catalog__card"><a class="catalog__card__img" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img src="<?=$file["src"]?>" alt="<?= $arItem["NAME"] ?>" /></a>
                <div class="catalog__card__body"><a class="catalog__card__title" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                    <div class="catalog__card__line row align-items-md-center">
                        <div class="col-12 col-md-auto">
                            <div class="catalog__card__price"><?=$arItem["ITEM_PRICES"][0]["PRINT_PRICE"]?></div>
                        </div>
                        <?if($arItem["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]!=$arItem["ITEM_PRICES"][0]["PRINT_PRICE"] && !empty($arItem['ID'])){ ?>
                            <div class="col-12 col-md-auto">
                                <div class="catalog__card__oldprice"><?=$arItem["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]?></div>
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
                                        </svg></div><input class="inputcount__input js--inputcount-input" type="number" value="0" min="0" step="1" max="<?=$arItem["PRODUCT"]["QUANTITY"]?>"/>
                                </div>
                            </div>
                            <div class="col-6"><button class="mbtn mbtn__grey2 mbtn__small" type="button">В корзину</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?endforeach;?>
        <?php
endif; 
?>
      

</div>
<?= $arResult["NAV_STRING"] ?>





