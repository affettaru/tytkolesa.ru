<?php
    $resize = CFIle::ResizeImageGet(
        $arResult["PREVIEW_PICTURE"],
        array("width" => 1200, "height" => 1200),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
$arResult["PREVIEW_PICTURE"]["SRC"] = $resize["src"];
foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as &$val){
    $resize = CFIle::ResizeImageGet(
        $val,
        array("width" => 500, "height" => 500),
	    BX_RESIZE_IMAGE_EXACT ,
        false
    );
    $val = $resize["src"];
}
