<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
// $component = $this->getComponent();

// if (!empty($arResult["ITEMS"])) {
//     foreach ($arResult["ITEMS"] as $key => $arItem) {
//         $resize = CFIle::ResizeImageGet(
//             $arItem["PREVIEW_PICTURE"],
//             array("width" => 500, "height" => 500),
//             BX_RESIZE_IMAGE_PROPORTIONAL,
//             false
//         );
//         $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"] = $resize["src"];
// if($arItem["PROPERTIES"]["PRICE_RENT"]["VALUE"]){
//         $arResult["ITEMS"][$key]["PRICE_RENT"] = number_format($arItem["PROPERTIES"]["PRICE_RENT"]["VALUE"], 0, '', ' ') . " ₽";}
//         if($arItem["PROPERTIES"]["PRICE_SALE"]["VALUE"]){
//         $arResult["ITEMS"][$key]["PRICE_SALE"] = number_format($arItem["PROPERTIES"]["PRICE_SALE"]["VALUE"], 0, '', ' ') . " ₽";}

//     }
// }