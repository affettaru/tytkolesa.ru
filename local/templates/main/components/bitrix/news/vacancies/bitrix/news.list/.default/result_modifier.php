<?php
foreach ($arResult["ITEMS"] as $key => $arItem){
    $resize = CFIle::ResizeImageGet(
        $arItem["PREVIEW_PICTURE"],
        array("width" => 605, "height" => 304),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"] = $resize["src"];
}
