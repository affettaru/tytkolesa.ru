<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$component = $this->getComponent();
if (!empty($arResult["ITEMS"])) {
    foreach ($arResult["ITEMS"] as $key => $arItem) {
        $resize = CFIle::ResizeImageGet(
            $arItem["PREVIEW_PICTURE"],
            array("width" => 500, "height" => 500),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            false
        );
        $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"] = $resize["src"];

        $arResult["ITEMS"][$key]["PRICE_RENT"] = number_format($arItem["PROPERTIES"]["PRICE_RENT"]["VALUE"], 0, '', ' ') . " ₽";
        $arResult["ITEMS"][$key]["PRICE_SALE"] = number_format($arItem["PROPERTIES"]["PRICE_SALE"]["VALUE"], 0, '', ' ') . " ₽";

    }
}

function declOfNum($num, $titles) {
    $cases = array(2, 0, 1, 1, 1, 2);

    return $num . " " . $titles[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
}

$arResult["SEARCH_COUNT"] = declOfNum($arResult["NAV_RESULT"]->NavRecordCount, array('товар', 'товара', 'товаров'))

?>