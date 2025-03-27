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

$availbable = $arResult["PROPERTIES"]["AVAILABLE"]["VALUE_ENUM_ID"] == 5;
$noImage = !$arResult["DETAIL_PICTURE"]["BIG"]["SRC"] && !$arResult["DETAIL_PICTURE"]["BIG"]["SRC"];

$allowSale = $arResult["PROPERTIES"]["ALLOW_SALE"]["VALUE"] == "Y";
$allowRent = $arResult["PROPERTIES"]["ALLOW_RENT"]["VALUE"] == "Y";


$priceSale = $arResult["PROPERTIES"]["PRICE_SALE"]["VALUE"];
$priceRent = $arResult["PROPERTIES"]["PRICE_RENT"]["VALUE"];

$pathArr = explode("/", $_SERVER["REQUEST_URI"]);
$isRent = in_array("arenda", $pathArr);
?>

<section class="card-product">
    <div class="container">
        <div class="card-product__inner">
            <div class="card-product__row">
                <div class="card-product__l">
                    <div class="prices-mob">
                        <div class="prices-left">
                            <?php if ($priceRent && $allowRent): ?>
                                <div class="card-product__pr">
                                    <div class="card-product__pr-tt">Цена в сутки с НДС:</div>
                                    <!--                                <div class="card-product__pr-old">4 238 133 ₽</div>-->
                                    <div class="card-product__pr-now"><?= $priceRent ?></div>
                                </div>
                            <?php endif; ?>

                            <?php if ($priceSale && $allowSale): ?>
                                <div class="card-product__pr">
                                    <div class="card-product__pr-tt">Цена покупки:</div>
                                    <!--                                <div class="card-product__pr-old">4 238 133 ₽</div>-->
                                    <div class="card-product__pr-now"><?= $priceSale ?></div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($arResult["PRODUCER"]): ?>
                            <div class="card-product__top-r">
                                <div class="card-product__logo">
                                    <img src="<?= $arResult["PRODUCER"] ?>" alt="">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?if(!empty($arResult["PROPERTIES"]["PICTURES"]["VALUE"])){?>
                        <div class="swiper-button-prev js-card-product-slider-prev"></div>
                        <div class="swiper-button-next js-card-product-slider-next"></div>
                        <div class="swiper-pagination js-card-product-slider-pagination"></div>
                    <?}?>

                    <div class="card-product__slider_for js-card-product-slider-for">
                        <div class="swiper-wrapper">
                            <?php $c = 1; ?>
                            <?php if ($noImage): ?>
                                <div class="swiper-slide">
                                    <div class="card-product__slider-item">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/placeholder.png" alt="<?= $arResult["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arResult["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                    </div>
                                </div>
                                <?php $c++; ?>
                            <?php endif; ?>
                            <?php if ($arResult["DETAIL_PICTURE"]["BIG"]["SRC"]): ?>
                                <div class="swiper-slide">
                                    <div class="card-product__slider-item">
                                        <img src="<?= $arResult["DETAIL_PICTURE"]["BIG"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arResult["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                    </div>
                                </div>
                                <?php $c++; ?>
                            <?php endif; ?>
                            <?php foreach ($arResult["PROPERTIES"]["PICTURES"]["BIG"] as $pic): ?>
                                <div class="swiper-slide">
                                    <div class="card-product__slider-item">
                                        <img src="<?= $pic ?>" alt="<?= $arResult["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arResult["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                    </div>
                                </div>
                                <?php $c++; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <?if(!empty($arResult["PROPERTIES"]["PICTURES"]["VALUE"])){?>
                    <div class="card-product__sl">
                        <div class="card-product__slider_nav js-card-product-slider-nav">
                            <div class="swiper-wrapper">
                                <?php $c = 1; ?>
                                <?php if ($noImage): ?>
                                    <div class="swiper-slide">
                                        <div class="card-product__slider-item">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/placeholder.png" alt="<?= $arResult["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arResult["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                        </div>
                                    </div>
                                    <?php $c++; ?>
                                <?php endif; ?>
                                <?php if ($arResult["DETAIL_PICTURE"]["SMALL"]["SRC"]): ?>
                                    <div class="swiper-slide">
                                        <div class="card-product__slider-item">
                                            <img src="<?= $arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arResult["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                        </div>
                                    </div>
                                    <?php $c++; ?>
                                <?php endif; ?>
                                <?php foreach ($arResult["PROPERTIES"]["PICTURES"]["SMALL"] as $pic): ?>
                                    <div class="swiper-slide">
                                        <div class="card-product__slider-item">
                                            <img src="<?= $pic ?>" alt="<?= $arResult["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arResult["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                                        </div>
                                    </div>
                                    <?php $c++; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                    <?}?>
                </div>

                <div class="card-product__r">
                    <div class="card-product__top">
                        <div class="card-product__top-l">
                            <div class="prices-desc">
                                <?php if ($priceSale && $allowRent): ?>
                                    <div class="card-product__pr">
                                        <div class="card-product__pr-tt">Цена в сутки с НДС:</div>
                                        <!--                                <div class="card-product__pr-old">4 238 133 ₽</div>-->
                                        <div class="card-product__pr-now"><?= $priceRent ?></div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($priceSale && $allowSale): ?>
                                    <div class="card-product__pr">
                                        <div class="card-product__pr-tt">Цена покупки:</div>
                                        <!--                                <div class="card-product__pr-old">4 238 133 ₽</div>-->
                                        <div class="card-product__pr-now"><?= $priceSale ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($arResult["PRODUCER"]): ?>
                            <div class="card-product__top-r mob-hidden">
                                <div class="card-product__logo">
                                    <img src="<?= $arResult["PRODUCER"] ?>" alt="">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($availbable): ?>
                        <div class="card-product__i">
                            <div class="card-product__i-item">Товар в наличии</div>
                        </div>
                    <?php else: ?>
                        <div class="card-product__i">
                            <?= $arResult["PROPERTIES"]["AVAILABLE"]["VALUE"] ?>
                        </div>
                    <?php endif; ?>

                    <div class="card-product__btn">
                        <?php if($isRent): ?>
                            <?php if ($priceRent && $arResult["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl2" class="btn btn-prim">Аренда в 1
                                    клик</a>
                            <?php endif; ?>
                            <?php if ($priceSale && $arResult["PROPERTIES"]["ALLOW_SALE"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl1" class="btn btn-prim">Купить
                                    технику</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if ($priceSale && $arResult["PROPERTIES"]["ALLOW_SALE"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl1" class="btn btn-prim">Купить
                                    технику</a>
                            <?php endif; ?>
                            <?php if ($priceRent && $arResult["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl2" class="btn btn-prim">Аренда в 1
                                    клик</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if((!$priceRent || !$arResult["PROPERTIES"]["ALLOW_RENT"]["VALUE"]) && (!$priceRent || !$arResult["PROPERTIES"]["ALLOW_RENT"]["VALUE"])): ?>
                            <a href="javascript:void(0)" data-remodal-target="cl1" class="btn btn-prim">Получить КП</a>
                        <?php endif; ?>
                    </div>


                    <div class="card-product__tech">
                        <div class="card-product__tech-tit">Технические характеристики</div>
                        <div class="card-product__tech-in">
                            <!-- <div class="card-product__tech-row">
                                <span>Страна производитель</span>
                                <span>КНР</span>
                            </div> -->

                            <?php $i=0;foreach ($arResult["DISPLAY_PROPERTIES"] as $arProp){ ?>

                                <div class="card-product__tech-row">
                                    <span><?= $arProp["NAME"] ?></span>
                                    <?if($arProp["USER_TYPE_SETTINGS"]["TABLE_NAME"]){?>
                                        <?
                                        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                                            array("filter" => array('TABLE_NAME' => $arProp["USER_TYPE_SETTINGS"]["TABLE_NAME"])))->fetch();
                                        if (isset($hlblock['ID']))
                                        {
                                            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                                            $entity_data_class = $entity->getDataClass();
                                            $res = $entity_data_class::getList( array('filter'=>array()) );
                                            while ($item = $res->fetch())
                                            {
                                                if($item["UF_XML_ID"]==$arProp["VALUE"]){?>
                                                <span><?= $item["UF_NAME"] ?></span>
                                            <?}}}
                                         }else{?>
                                    <span><?= $arProp["VALUE"] ?></span><?}?>
                                </div>
                                <?$i++;if($i==3){break;}?>
                            <?php } ?>

                        </div>

                        <a href="#info_detail" class="card-product__tech-btn">Все характеристики</a>

                    </div>
                </div>
            </div>
            <?php if ($arResult["DETAIL_TEXT"]): ?>
                <div class="card-product__descr">
                    <div class="card-product__descr-tt">Описание</div>

                    <div class="card-product__descr-tx">
                        <?= html_entity_decode($arResult["DETAIL_TEXT"]) ?>
                    </div>
                    <div class="b">
                        <span class="cl">Читать полностью</span>
                        <span class="op">Скрыть</span>
                    </div>


                </div>
            <?php endif; ?>


            <?php if ($arResult["DISPLAY_PROPERTIES"]): ?>
                <div class="card-product__descr" id="info_detail">
                    <div class="card-product__descr-tt">Технические характеристики</div>

                    <div class="card-product__descr-im">
                        <div class="card-product__descr-al">
                            <div class="card-product__descr-row">
                                <?php foreach ($arResult["PROPERTIES"]["LEFT_TOP"] as $prop): ?>

                                    <div class="card-product__descr-cell">
                                        <div class="card-product__descr-item">
                                            <span><?= $prop["NAME"] ?></span>
                                            <?if($arProp["USER_TYPE_SETTINGS"]["TABLE_NAME"]){?>
                                        <?
                                        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                                            array("filter" => array('TABLE_NAME' => $arProp["USER_TYPE_SETTINGS"]["TABLE_NAME"])))->fetch();
                                        if (isset($hlblock['ID']))
                                        {
                                            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                                            $entity_data_class = $entity->getDataClass();
                                            $res = $entity_data_class::getList( array('filter'=>array()) );
                                            while ($item = $res->fetch())
                                            {
                                                if($item["UF_XML_ID"]==$arProp["VALUE"]){?>
                                                <span><?= $item["UF_NAME"] ?></span>
                                            <?}}}
                                         }else{?>
                                            <span><?= $prop["VALUE"] ?></span>
                                            <?}?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="card-product__descr-row">
                                <?php foreach ($arResult["PROPERTIES"]["RIGHT_TOP"] as $prop): ?>
                                    <div class="card-product__descr-cell">
                                        <div class="card-product__descr-item">
                                            <span><?= $prop["NAME"] ?></span>
                                            <?if($arProp["USER_TYPE_SETTINGS"]["TABLE_NAME"]){?>
                                        <?
                                        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                                            array("filter" => array('TABLE_NAME' => $arProp["USER_TYPE_SETTINGS"]["TABLE_NAME"])))->fetch();
                                        if (isset($hlblock['ID']))
                                        {
                                            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                                            $entity_data_class = $entity->getDataClass();
                                            $res = $entity_data_class::getList( array('filter'=>array()) );
                                            while ($item = $res->fetch())
                                            {
                                                if($item["UF_XML_ID"]==$arProp["VALUE"]){?>
                                                <span><?= $item["UF_NAME"] ?></span>
                                            <?}}}
                                         }else{?>
                                            <span><?= $prop["VALUE"] ?></span>
                                            <?}?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>


                        </div>
                        <div class="card-product__descr-al mob">
                            <div class="card-product__descr-row">
                                <?php foreach ($arResult["PROPERTIES"]["LEFT_BOT"] as $prop): ?>
                                    <div class="card-product__descr-cell">
                                        <div class="card-product__descr-item">
                                            <span><?= $prop["NAME"] ?></span>
                                            <span><?= $prop["VALUE"] ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="card-product__descr-row">
                                <?php foreach ($arResult["PROPERTIES"]["RIGHT_BOT"] as $prop): ?>
                                    <div class="card-product__descr-cell">
                                        <div class="card-product__descr-item">
                                            <span><?= $prop["NAME"] ?></span>
                                            <span><?= $prop["VALUE"] ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="b">
                                <span class="cl">Читать полностью</span>
                                <span class="op">Скрыть</span>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>


