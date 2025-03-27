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


    //     $client = new SoapClient("http://api-b2b.4tochki.ru/WCF/ClientService.svc?wsdl");
    //     $params =  array(
    //         'login' => $GLOBALS["SETTINGS"]["LOGIN_4TOCHKI"],
    //         'password' => $GLOBALS["SETTINGS"]["PASSWORD_4TOCHKI"],
    //         'filter' => array(
    //             'quality' => 0,
    //             'retread' => false,
    //             'wrh_list' => array(46),
    //             'type_list' => array(0=>'car'),
    //             // 'season_list' => array(0 => 'w'),
    //             // 'width_min' => 185,
    //             // 'width_max' => 185,
    //             // 'height_min' => 60,
    //             // 'height_max' => 60,
    //             // 'diameter_min' => 15,
    //             // 'diameter_max' => 15,
    //         ),
    //         'page' => 0,
    //         "pageSize" =>   2000,
    //     );
    //     $answer = $client->GetFindTyre($params); 
    //     $elements = ((array)((array)((array) $answer)["GetFindTyreResult"])["price_rest_list"])["TyrePriceRest"];
       
    //     if(((array)((array)((array) $answer)["GetFindTyreResult"])["currencyRate"])["charCode"]=="RUB"){
    //     foreach ($elements as $element): 
    //         $code=((array)$element)["code"];

    //         $params2 =  array(
    //             'login' => $GLOBALS["SETTINGS"]["LOGIN_4TOCHKI"],
    //             'password' => $GLOBALS["SETTINGS"]["PASSWORD_4TOCHKI"],
    //             'code_list' => array( 0 => $code),
    //       );
            
    //       $answer2 = $client->GetGoodsInfo($params2);   


    //         echo "<pre>Template arResult: "; print_r(((array)((array) $answer)["GetFindTyreResult"])["totalPages"]); echo "</pre>";


    //         $wh_price_rest=((array)((array)$element)["whpr"])["wh_price_rest"];
    //         $el=array(
    //             "LID" => "s1",
    //             "ID" => "",
    //             "SORT" => 500,
    //             "CODE"=>((array)$element)["code"],
    //             "NAME"=>((array)$element)["name"],
    //             "ACTIVE"=>"Y",
    //             "DETAIL_PAGE_URL" => "",
    //             "PREVIEW_PICTURE" =>((array)$element)["img_big_pish"],
    //             "IPROPERTY_VALUES"=> Array(),
    //             "PRODUCT"=>Array(
    //                 "TYPE"=>1,
    //                 "AVAILABLE" => "Y", 
    //                 "BUNDLE" => "N",
    //                 "QUANTITY" => ((array)$wh_price_rest)["rest"],
    //                 "QUANTITY_TRACE" => "Y",
    //                 "CAN_BUY_ZERO" => "N",
    //                 "MEASURE" => "5",
    //                 "SUBSCRIBE" => "Y",
    //                 "VAT_ID" => 0,
    //                 "VAT_RATE" => 0,
    //                 'VAT_INCLUDED' => 'N',
    //                 'WEIGHT' => 0,
    //                 'WIDTH' => 0,
    //                 'LENGTH' => 0,
    //                 'HEIGHT' => 0,
    //                 'PAYMENT_TYPE' => 'S',
    //                 'RECUR_SCHEME_TYPE' => "D",
    //                 'RECUR_SCHEME_LENGTH' => 0,
    //                 'TRIAL_PRICE_ID' => 0,
    //                 "USE_OFFERS" => ''),
    //             "CATALOG_TYPE" => 1,
    //             "CATALOG_QUANTITY" => ((array)$wh_price_rest)["rest"],
    //             "PROPERTIES" => Array
    //             (),
    //             "ITEM_PRICES" => array(0 => array("PRINT_PRICE" => CurrencyFormat(((array)$wh_price_rest)["price_rozn"], 'RUB'),
    //                                 "UNROUND_BASE_PRICE"=>((array)$wh_price_rest)["price_rozn"],
    //                                 "BASE_PRICE" => ((array)$wh_price_rest)["price_rozn"])),
    //                                 "PRICE" =>((array)$wh_price_rest)["price_rozn"],
    //                                 "ID" => "",
    //                                 "PRICE_TYPE_ID" => 1,
    //                                 "CURRENCY" => "RUB",
    //                                 "DISCOUNT" => 0,
    //                                 "PERCENT" => 0,
    //                                 "QUANTITY_FROM" => "",
    //                                 "QUANTITY_TO" => "",
    //                                 "QUANTITY_HASH" => "ZERO-INF",
    //                                 "MEASURE_RATIO_ID" => "",
    //                                 "PRINT_BASE_PRICE" => CurrencyFormat(((array)$wh_price_rest)["price_rozn"], 'RUB'),
    //                                 "RATIO_BASE_PRICE" => ((array)$wh_price_rest)["price_rozn"],
    //                                 "PRINT_RATIO_BASE_PRICE" => CurrencyFormat(((array)$wh_price_rest)["price_rozn"], 'RUB'),
    //                                 "RATIO_PRICE" => ((array)$wh_price_rest)["price_rozn"],
    //                                 "PRINT_RATIO_PRICE" => CurrencyFormat(((array)$wh_price_rest)["price_rozn"], 'RUB'),
    //                                 "PRINT_DISCOUNT" => "0 ₽",
    //                                 "RATIO_DISCOUNT" => 0,
    //                                 "PRINT_RATIO_DISCOUNT" => "0 ₽",
    //                                 "MIN_QUANTITY" => 1
    //                             );

    //         $arResult['ITEMS'][]=$el;
    //    break;
    //     endforeach;
    //     }
       
?>
