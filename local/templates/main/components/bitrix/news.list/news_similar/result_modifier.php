<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) ;
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $resize = CFIle::ResizeImageGet(
        $arItem["PREVIEW_PICTURE"],
        array("width" => 400, "height" => 400),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
	$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"] = $resize["src"];
}