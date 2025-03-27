<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$component = $this->getComponent();
if ($arResult["DETAIL_PICTURE"]) {
    $resize = CFIle::ResizeImageGet(
        $arResult["DETAIL_PICTURE"],
        array("width" => 1200, "height" => 1200),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["BIG"]["SRC"] = $resize["src"];

    $resize = CFIle::ResizeImageGet(
        $arResult["DETAIL_PICTURE"],
        array("width" => 100, "height" => 100),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] = $resize["src"];
} else {
    $resize = CFIle::ResizeImageGet(
        $arResult["PREVIEW_PICTURE"],
        array("width" => 700, "height" => 700),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["BIG"]["SRC"] = $resize["src"];
    $resize = CFIle::ResizeImageGet(
        $arResult["PREVIEW_PICTURE"],
        array("width" => 500, "height" => 500),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] = $resize["src"];
}


foreach ($arResult["PROPERTIES"]["PICTURES"]["VALUE"] as $key => $image) {
    $resize = CFIle::ResizeImageGet(
        $image,
        array("width" => 700, "height" => 700),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["PROPERTIES"]["PICTURES"]["BIG"][$key] = $resize["src"];

    $resize = CFIle::ResizeImageGet(
        $image,
        array("width" => 100, "height" => 100),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["PROPERTIES"]["PICTURES"]["SMALL"][$key] = $resize["src"];
}

if($arResult["PROPERTIES"]["PRICE_SALE"]["VALUE"]){
$arResult["PROPERTIES"]["PRICE_SALE"]["VALUE"] = number_format($arResult["PROPERTIES"]["PRICE_SALE"]["VALUE"], 0, '', ' ') . " ₽";}
if($$arResult["PROPERTIES"]["PRICE_RENT"]["VALUE"]){
$arResult["PROPERTIES"]["PRICE_RENT"]["VALUE"] = number_format($arResult["PROPERTIES"]["PRICE_RENT"]["VALUE"], 0, '', ' ') . " ₽";}


$BRAND_ID = $arResult["PROPERTIES"]["PRODUCER"]["VALUE"];
// Подключаем модуль инфоблоков
if (CModule::IncludeModule('highloadblock')) {
    $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(2)->fetch();
    $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
    $strEntityDataClass = $obEntity->getDataClass();
    $resData = $strEntityDataClass::getList(array(
        'select' => array('ID', 'UF_NAME', "UF_FILE"),
        'filter' => array('UF_XML_ID' => $BRAND_ID),
        'order' => array('ID' => 'ASC'),
        'limit' => 100,
    ));
    if ($arItem = $resData->Fetch()) {
        if ($arItem["UF_FILE"]) $arResult["PRODUCER"] = CFIle::GetPath($arItem["UF_FILE"]);
    }
}

$c = 0;
$key = 0;
foreach ($arResult["DISPLAY_PROPERTIES"] as $prop) {
    if ($key < 3) $arResult["PROPERTIES"]["LEFT_TOP"][] = $prop;
    else if ($key < 6) $arResult["PROPERTIES"]["RIGHT_TOP"][] = $prop;
    else{
        if($c % 2 == 0) $arResult["PROPERTIES"]["LEFT_BOT"][] = $prop;
        else $arResult["PROPERTIES"]["RIGHT_BOT"][] = $prop;
        $c += 1;
    }
    $key++;
}

