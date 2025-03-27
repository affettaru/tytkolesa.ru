<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$component = $this->getComponent();

                    
// CModule::AddAutoloadClasses("", array(
// 	'AffettaCFile' => '/local/php_interface/classes/affetta/AffettaCFile.php',
// ));
// $webFile = AffettaCFile::ResizeImageGet(['FILE_NAME_NEW' => 'Тест фото 1'], $arResult["DETAIL_PICTURE"]["SMALL"]["SRC"], array( "width" => 700, "height" => 400 ));




if($arResult["DETAIL_PICTURE"]) {
	
	$resize =AffettaCFile::ResizeImageGet( $arResult["DETAIL_PICTURE"], 
	["width" => 1200, "height" => 1200 ],
		BX_RESIZE_IMAGE_PROPORTIONAL,
		false, false, false, false,
		['FILE_NAME_NEW' => $arResult["NAME"],
		]);
	// $resize = CFIle::ResizeImageGet(
	// 	$arResult["DETAIL_PICTURE"],
	// 	array("width" => 1200, "height" => 1200),
	// 	BX_RESIZE_IMAGE_PROPORTIONAL,
	// 	false
	// );
	$arResult["DETAIL_PICTURE"]["BIG"]["SRC"] = $resize["src"];

// $resize = CFIle::ResizeImageGet(
// 	$arResult["DETAIL_PICTURE"],
// 	array("width" => 500, "height" => 500),
// 	BX_RESIZE_IMAGE_PROPORTIONAL,
// 	false
// );
$resize =AffettaCFile::ResizeImageGet( $arResult["DETAIL_PICTURE"],
		["width" => 200, "height" => 200 ],
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT ,
		false, false,false, false, 
		['FILE_NAME_NEW' => $arResult["NAME"],
		]);
$arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] = $resize["src"];
}else{
	// $resize = CFIle::ResizeImageGet(
	// 	$arResult["PREVIEW_PICTURE"],
	// 	array("width" => 1200, "height" => 1200),
	// 	BX_RESIZE_IMAGE_PROPORTIONAL,
	// 	false
	// );
	$resize =AffettaCFile::ResizeImageGet( $arResult["PREVIEW_PICTURE"],
	["width" => 1200, "height" => 1200 ],
	BX_RESIZE_IMAGE_PROPORTIONAL,
	false, false,false, false, 
	['FILE_NAME_NEW' => $arResult["NAME"],
	]);
	$arResult["DETAIL_PICTURE"]["BIG"]["SRC"] = $resize["src"];
	// $resize = CFIle::ResizeImageGet(
	// 	$arResult["PREVIEW_PICTURE"],
	// 	array("width" => 500, "height" => 500),
	// 	BX_RESIZE_IMAGE_PROPORTIONAL,
	// 	false
	// );
	$resize =AffettaCFile::ResizeImageGet( $arResult["PREVIEW_PICTURE"],
	["width" => 200, "height" => 200 ],
	BX_RESIZE_IMAGE_PROPORTIONAL,
	false, false,false, false, 
	['FILE_NAME_NEW' => $arResult["NAME"],
	]);
	$arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] = $resize["src"];
}


// $resize = CFIle::ResizeImageGet(
// 	$arResult["PROPERTIES"]["VIDEO_PIC"]["VALUE"],
// 	array("width" => 500, "height" => 500),
// 	BX_RESIZE_IMAGE_PROPORTIONAL,
// 	false
// );
$resize =AffettaCFile::ResizeImageGet( ["PROPERTIES"]["VIDEO_PIC"]["VALUE"],
	["width" => 200, "height" => 200 ],
	BX_RESIZE_IMAGE_PROPORTIONAL,
	false, false,false, false, 
	['FILE_NAME_NEW' => $arResult["NAME"],
	]);
$arResult["PROPERTIES"]["VIDEO_PIC"]["SMALL"] = $resize["src"];

// $resize = CFIle::ResizeImageGet(
// 	$arResult["PROPERTIES"]["VIDEO_PIC"]["VALUE"],
// 	array("width" => 1200, "height" => 1200),
// 	BX_RESIZE_IMAGE_PROPORTIONAL,
// 	false
// );
$resize =AffettaCFile::ResizeImageGet( $arResult["PROPERTIES"]["VIDEO_PIC"]["VALUE"],
	["width" => 1200, "height" => 1200 ],
	BX_RESIZE_IMAGE_PROPORTIONAL,
	false, false,false, false, 
	['FILE_NAME_NEW' => $arResult["NAME"],
	]);
$arResult["PROPERTIES"]["VIDEO_PIC"]["BIG"] = $resize["src"];


foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $key => $image) {
	// $resize = CFIle::ResizeImageGet(
	// 	$image,
	// 	array("width" => 1200, "height" => 1200),
	// 	BX_RESIZE_IMAGE_PROPORTIONAL,
	// 	false
	// );
	$resize =AffettaCFile::ResizeImageGet( $image,
	["width" => 1200, "height" => 1200 ],
	BX_RESIZE_IMAGE_PROPORTIONAL,
	false, false,false, false, 
	['FILE_NAME_NEW' => $arResult["NAME"].'_'.($key+1),
	]);
	$arResult["PROPERTIES"]["IMAGES"]["BIG"][$key] = $resize["src"];
	
	// $resize = CFIle::ResizeImageGet(
	// 	$image,
	// 	array("width" => 500, "height" => 500),
	// 	BX_RESIZE_IMAGE_PROPORTIONAL,
	// 	false
	// );
	$resize =AffettaCFile::ResizeImageGet( $image,
	["width" => 200, "height" => 200 ],
	BX_RESIZE_IMAGE_PROPORTIONAL,
	false, false,false, false, 
	['FILE_NAME_NEW' => $arResult["NAME"].'_'.($key+1),
	]);
	$arResult["PROPERTIES"]["IMAGES"]["SMALL"][$key] = $resize["src"];
}


if(!empty($arResult["PROPERTIES"]["REVIEWS"]["VALUE"])){
	$arSelect = ["NAME", "PROPERTY_RATE", "PREVIEW_TEXT", "DATE_CREATE"];
	$arFilter = ["ID" => $arResult["PROPERTIES"]["REVIEWS"]["VALUE"]];
	$res = CIBlockElement::GetList(Array(), $arFilter, false, [], $arSelect);
	while($ob = $res->GetNext())
	{
		$reviews[] = $ob;
	}
	$arResult["PROPERTIES"]["REVIEWS"]["VALUE"] = $reviews;
}



