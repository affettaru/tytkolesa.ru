<?
/**
 * @global $APPLICATION
 * @global $USER
 * @var $USER_FIELD_MANAGER
 * @var $REQUEST_METHOD
 * @var $space_code
 * @var $save
 * @var $apply
 */

 $_SERVER["DOCUMENT_ROOT"] = '/var/www/u2939381/data/www/tytkolesa.ru';
//  $email = "alyona@zolar.ru";
 
 $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
 
 define("NO_KEEP_STATISTIC", true);
 define("NOT_CHECK_PERMISSIONS", true);
 define("NO_AGENT_STATISTIC", true);
 define("NO_AGENT_CHECK", true);
 
 require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
 
 set_time_limit(0);


// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetTitle("О компании");
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;  
Loader::includeModule("iblock");
?>

<?php
if(CModule::IncludeModule("catalog"))
{ 
    $IBLOCK_ID=10;
    function translit($s) {
        $s = (string) $s; // преобразуем в строковое значение
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = preg_replace('/[^ a-zа-я\d.]/ui', '', $s );
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array(','=>'','.'=>'',' '=>'-','а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        return $s; // возвращаем результат
    } 
    $client = new SoapClient("http://api-b2b.4tochki.ru/WCF/ClientService.svc?wsdl");
    $page=0;
    $pageSize=2000;
    do{
        // break;

        $params =  array(
            'login' => $GLOBALS["SETTINGS"]["LOGIN_4TOCHKI"],
            'password' => $GLOBALS["SETTINGS"]["PASSWORD_4TOCHKI"],
            'filter' => array(
                'quality' => 0,
                'retread' => false,
                'wrh_list' => array(46),
                'type_list' => array(0 => 'car', 1 => 'cartruck', 2 => 'moto', 3 => 'vned', 4 => 'quadbike'),
                // 'season_list' => array(0 => 'w'),
                // 'width_min' => 185,
                // 'width_max' => 185,
                // 'height_min' => 60,
                // 'height_max' => 60,
                // 'diameter_min' => 15,
                // 'diameter_max' => 15,
            ),
            'page' => $page,
            "pageSize" =>   $pageSize,
        );
        $page++;
        $answer = $client->GetFindTyre($params); 
        $elements = ((array)((array)((array) $answer)["GetFindTyreResult"])["price_rest_list"])["TyrePriceRest"];

        $hlblock = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_proizvoditeli')))->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass(); 

        $hlblock4 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_width')))->fetch();
        $entity4 = HL\HighloadBlockTable::compileEntity($hlblock4);
        $entity_data_class4 = $entity4->getDataClass(); 

        $hlblock2 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_diameter')))->fetch();
        $entity2 = HL\HighloadBlockTable::compileEntity($hlblock2);
        $entity_data_class2 = $entity2->getDataClass(); 

        $hlblock3 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_height')))->fetch();
        $entity3 = HL\HighloadBlockTable::compileEntity($hlblock3);
        $entity_data_class3 = $entity3->getDataClass(); 



        
        if(((array)((array)((array) $answer)["GetFindTyreResult"])["currencyRate"])["charCode"]=="RUB"){
        foreach ($elements as $element): 

            $wh_price_rest=((array)((array)$element)["whpr"])["wh_price_rest"];
                   
            $code=((array)$element)["code"]; 
            $name=((array)$element)["name"];
            $img=((array)$element)["img_big_pish"];   //после добавления лого клиента заменить на img_big_my
            $model=((array)$element)["model"];
            $marka=((array)$element)["marka"];

            $t=0;
            $q=0;
            $p=0;
            // echo "<pre>Template arResult: "; print_r($name); echo "</pre>";
            $res = CCatalogProduct::GetList(array(), array("IBLOCK_ID"=>$IBLOCK_ID,"ELEMENT_NAME"=>$name), false, false,array());
            // echo "<pre>Template arResult: "; print_r($res); echo "</pre>";
            while($ar_res = $res->Fetch())
            {                 
                $t++;
                $ID=$ar_res["ID"];
                $arPrice = CPrice::GetByID($ID);
            
                if($ar_res["QUANTITY"]!=((array)$wh_price_rest)["rest"]){
                    $q++;
                }
                if($arPrice["PRICE"]!=((array)$wh_price_rest)["price_rozn"]){
                    $p++;
                }
             
            }
          
            if($q==0){
                $arFields = array('QUANTITY' => ((array)$wh_price_rest)["rest"]);// зарезервированное количество
                CCatalogProduct::Update($ID, $arFields);
            }
            if($p==0){
                $arFields = Array("PRICE" => ((array)$wh_price_rest)["price_rozn"]);
                CPrice::Update($ID, $arFields);
            }
            if($t==0){
                $PROP = array();
                $PROP["U_MODEL"]=$model;
                $PROP["U_CODE"]=$code;

                //списки
                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_SEASON_LIST"));
                while($enum_fields = $property_enums->GetNext())
                {
                    if($enum_fields["XML_ID"]==((array)$element)["season"])
                        $prop_U_SEASON_LIST_ID=$enum_fields["ID"];
                }

                $property_enums2 = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_THORN"));
                while($enum_fields = $property_enums2->GetNext())
                {
                    if($enum_fields["XML_ID"]=="Y"){
                        $prop_U_THORN_Y_ID=$enum_fields["ID"];}else{
                            $prop_U_THORN_N_ID=$enum_fields["ID"];
                        }
                }

                $property_enums3 = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_TYPE"));
                while($enum_fields = $property_enums3->GetNext())
                {
                    if($enum_fields["XML_ID"]==((array)$element)["type"])
                        $prop_U_TYPE_ID=$enum_fields["ID"];
                }

                
                $PROP["U_SEASON_LIST"]=$prop_U_SEASON_LIST_ID;
                if(!empty(((array)$element)["thorn"])){
                    $PROP["U_THORN"]=$prop_U_THORN_Y_ID;}
                    else{
                        $PROP["U_THORN"]=$prop_U_THORN_N_ID;
                }
                $PROP["U_TYPE"]=$prop_U_TYPE_ID;

                //справочники
                $rsData = $entity_data_class::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$marka)  
                ));

                while($arData = $rsData->Fetch()){
                    $HB_data_xml_id=$arData["UF_XML_ID"]; 
                }
                if(!$HB_data_xml_id){
                    $data = array("UF_NAME"=>$marka,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($marka,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class::add($data);

                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_MARKA"]['VALUE'] = $HB_data_xml_id;


                $params2 =  array(
                    'login' => $GLOBALS["SETTINGS"]["LOGIN_4TOCHKI"],
                    'password' => $GLOBALS["SETTINGS"]["PASSWORD_4TOCHKI"],
                    'code_list' => array( 0 => $code),
                );
                
                $answer2 = $client->GetGoodsInfo($params2);     
                
                $diameter=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["diameter"];
                $width=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["width"];
                $height=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["height"];
                $puncture=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["puncture"];
                $strengthening=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["strengthening"];
        
                $rsData2 = $entity_data_class2::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$diameter)  
                ));
        
                while($arData = $rsData2->Fetch()){
                    $HB_data_xml_id2=$arData["UF_XML_ID"]; 
                }
                if(!$HB_data_xml_id2){
                    $data = array("UF_NAME"=>$diameter,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($diameter,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class2::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class2::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id2=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_DIAMETER"]['VALUE'] = $HB_data_xml_id2;

        
                $rsData4 = $entity_data_class4::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$width)  
                    ));
        
                    while($arData = $rsData4->Fetch()){
                        $HB_data_xml_id4=$arData["UF_XML_ID"]; 
                    }
                if(!$HB_data_xml_id4){
                    $data = array("UF_NAME"=>$width,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($width,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class4::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class4::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id4=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_WIDTH"]['VALUE'] = $HB_data_xml_id4;

        
                $rsData3 = $entity_data_class3::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$height)  
                    ));
        
                    while($arData = $rsData3->Fetch()){
                        $HB_data_xml_id3=$arData["UF_XML_ID"]; 
                    }
                if(!$HB_data_xml_id3){
                    $data = array("UF_NAME"=>$height,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($height,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class3::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class3::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id3=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_HEIGHT"]['VALUE'] = $HB_data_xml_id3;


                $property_enums4 = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_RUNFLAT"));
                while($enum_fields = $property_enums4->GetNext())
                {
                    if($enum_fields["XML_ID"]=="Y"){
                        $prop_U_RUNFLAT_Y_ID=$enum_fields["ID"];}else{
                            $prop_U_RUNFLAT_N_ID=$enum_fields["ID"];
                        }
                }
                if(!empty(((array)$element)["thorn"])){
                    $PROP["U_RUNFLAT"]=$prop_U_RUNFLAT_Y_ID;}
                    else{
                        $PROP["U_RUNFLAT"]=$prop_U_RUNFLAT_N_ID;
                }
                $property_enums5 = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_REINFORCED"));
                while($enum_fields = $property_enums5->GetNext())
                {
                    if($enum_fields["XML_ID"]=="Y"){
                        $prop_U_REINFORCED_Y_ID=$enum_fields["ID"];}else{
                            $prop_U_REINFORCED_N_ID=$enum_fields["ID"];
                        }
                }
        
                if(!empty($puncture)){
                    $PROP["U_RUNFLAT"]=$prop_U_RUNFLAT_Y_ID;}
                    else{
                        $PROP["U_RUNFLAT"]=$prop_U_RUNFLAT_N_ID;
                }
                if(!empty($strengthening)){
                    $PROP["U_REINFORCED"]=$prop_U_REINFORCED_Y_ID;}
                    else{
                        $PROP["U_REINFORCED"]=$prop_U_REINFORCED_N_ID;
                }


                $subwidth=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["subwidth"];
                $subheight=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["subheight"];
                $constr=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["constr"];
                $diameter_out=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["diameter_out"];
                $load_index=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["load_index"];
                $speed_index=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["speed_index"];

                $PROP["U_SUBWIDTH"]=$subwidth;
                $PROP["U_SUBHEIGHT"]=$subheight;
                $PROP["U_CONSTR"]=$constr;
                $PROP["U_DIAMETER_OUT"]=$diameter_out;
                $PROP["U_LOAD_INDEX"]=$load_index;
                $PROP["U_SPEED_INDEX"]=$speed_index;

                $thorn_type=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["thorn_type"];
                $usa=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["usa"];
                $protection=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["protection"];
                $side=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["side"];
                $tech=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["tech"];
                $omolog=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["omolog"];

                $PROP["U_THORN_TYPE"]=$thorn_type;
                $PROP["U_USA"]=$usa;
                $PROP["U_PROTECTION"]=$protection;
                $PROP["U_SIDE"]=$side;
                $PROP["U_TECH"]=$tech;
                $PROP["U_OMOLOG"]=$omolog;

                $softness=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["softness"];
                $axle=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["axle"];
                $sloy=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["sloy"];
                $marker_color=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["marker_color"];
                $strengthening=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["strengthening"];
                $wear_index=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["wear_index"];

                $PROP["U_SOFTNESS"]=$softness;
                $PROP["U_AXLE"]=$axle;
                $PROP["U_SLOY"]=$sloy;
                $PROP["U_MARKER_COLOR"]=$marker_color;
                if($strengthening==1){
                    $PROP["U_STRENGTHENING"]="Да";}else{
                        $PROP["U_STRENGTHENING"]="Нет";
                    }
                $PROP["U_WEAR_INDEX"]=$wear_index;

                $tonnage=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["tonnage"];
                $noise=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["noise"];
                $passability=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["passability"];
                $comfort=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["comfort"];
                $aquaplaning=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["aquaplaning"];
                $moto_use=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["moto_use"];

                $PROP["U_TONNAGE"]=$tonnage;
                $PROP["U_NOISE"]=$noise;
                $PROP["U_PASSABILITY"]=$passability;
                $PROP["U_COMFORT"]=$comfort;
                $PROP["U_AQUAPLANING"]=$aquaplaning;
                $PROP["U_MOTO_USE"]=$moto_use;
                
                $protector_type=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["protector_type"];
                $sub_diameter=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["sub_diameter"];
                $sub_diameter_out=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["sub_diameter_out"];
                $camera=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["camera"];
                $grip=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["grip"];
                $weight=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["weight"];

                $PROP["U_PROTECTOR_TYPE"]=$protector_type;
                $PROP["U_SUB_DIAMETR"]=$sub_diameter;
                $PROP["U_SUB_DIAMETR_OUT"]=$sub_diameter_out;
                $PROP["U_CAMERA"]=$camera;
                $PROP["U_GRIP"]=$grip;
                $PROP["U_WEIGHT"]=$weight;

                $volume=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["volume"];
                $tread_width=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["tread_width"];
                $initial_tread_depth=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["tyreList"])["TyreContainer"])["initial_tread_depth"];

                $PROP["U_VOLUME"]=$volume;
                $PROP["U_TREAD_WIDTH"]=$tread_width;
                $PROP["U_INITIAL_TREAD_DEPTH"]=$initial_tread_depth;

                $property_enums6 = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_LOCAL"));
                while($enum_fields = $property_enums6->GetNext())
                {
                    if($enum_fields["XML_ID"]!="Y"){
                        $prop_U_LOCAL_N_ID=$enum_fields["ID"];}
                }
                $PROP["U_LOCAL"]=$prop_U_LOCAL_N_ID;
                

                $codeNew=translit(((array)$element)["name"]);
                $el = new CIBlockElement;
                $arLoadProductArray = Array(  
                    'MODIFIED_BY' => 1,  
                    'IBLOCK_SECTION_ID' => 16, 
                    'IBLOCK_ID' => $IBLOCK_ID,
                    'PROPERTY_VALUES' => $PROP,  
                    'NAME' => $name,  
                    'CODE' => $codeNew, 
                    'ACTIVE' => 'Y', 
                    'PREVIEW_TEXT' => '',  
                    'DETAIL_TEXT' => '',  
                    'PREVIEW_PICTURE'=> CFile::MakeFileArray($img),
                    'DETAIL_PICTURE' => CFile::MakeFileArray($img) 
                );
                if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    echo("---Добавили товар ");
                    $fields = array(
                        'ID' => $PRODUCT_ID,
                        'QUANTITY' =>((array)$wh_price_rest)["rest"],
                        'TYPE' => \Bitrix\Catalog\ProductTable::TYPE_PRODUCT, //тип - основной товар нового типа
                        // 'MEASURE' => 5, //id единицы измерения
                    );
                    \Bitrix\Catalog\Model\Product::add($fields, false);
                    $arFieldsPrice = array(
                        "PRODUCT_ID" => $PRODUCT_ID,
                        "CATALOG_GROUP_ID" => 1,
                        "PRICE" => ((array)$wh_price_rest)["price_rozn"],
                        "CURRENCY" => 'RUB',
                    );
                    $result = \Bitrix\Catalog\Model\Price::add($arFieldsPrice, true);
                }  
            


            }
            unset($HB_data_xml_id);
            unset($HB_data_xml_id1);
            unset($HB_data_xml_id2);
            unset($HB_data_xml_id3);
            unset($HB_data_xml_id4);
            unset($HB_data_xml_id5);
            unset($HB_data_xml_id6);
            // unset($avto);
            // unset($logo);
            // unset($marka_logo);
            // unset($code);
            // unset($name);
            // unset($img);
            // unset($model);
            // unset($marka);
            // unset($color);

        endforeach;
        $pageN=((array)((array) $answer)["GetFindTyreResult"])["totalPages"];
        echo "<pre>Template arResult: "; print_r($pageN); echo "</pre>";
        echo "<pre>Template arResult: "; print_r($page); echo "</pre>";
        }
    }while($page<$pageN);  



    $client = new SoapClient("http://api-b2b.4tochki.ru/WCF/ClientService.svc?wsdl");
    $page=0;
    $pageSize=2000;
    do{
        $params =  array(
            'login' => $GLOBALS["SETTINGS"]["LOGIN_4TOCHKI"],
            'password' => $GLOBALS["SETTINGS"]["PASSWORD_4TOCHKI"],
            'filter' => array(
                'wrh_list' => array(46),
                'rim_vid_name_list' => array(0=>'car')
            ),
            'page' => $page,
            "pageSize" =>   $pageSize,
        );
        $page++;

        $answer = $client->GetFindDisk($params); 
        echo "<pre>Template arResult: "; print_r("start"); echo "</pre>";
        $elements = ((array)((array)((array) $answer)["GetFindDiskResult"])["price_rest_list"])["DiskPriceRest"];

        $hlblock = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_proizvoditelid')))->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass(); 

        $hlblock1 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_widthd')))->fetch();
        $entity1 = HL\HighloadBlockTable::compileEntity($hlblock1);
        $entity_data_class1 = $entity1->getDataClass(); 

        $hlblock2 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_diameterd')))->fetch();
        $entity2 = HL\HighloadBlockTable::compileEntity($hlblock2);
        $entity_data_class2 = $entity2->getDataClass(); 

        // Диаметр окружности отверстия
        $hlblock3 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_boltsspacing')))->fetch();
        $entity3 = HL\HighloadBlockTable::compileEntity($hlblock3);
        $entity_data_class3 = $entity3->getDataClass(); 

        // Диаметр окружности отверстия2
        $hlblock4 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_boltsspacing2')))->fetch();
        $entity4 = HL\HighloadBlockTable::compileEntity($hlblock4);
        $entity_data_class4 = $entity4->getDataClass(); 

        // Вылет
        $hlblock5 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_et')))->fetch();
        $entity5 = HL\HighloadBlockTable::compileEntity($hlblock5);
        $entity_data_class5 = $entity5->getDataClass(); 

        // Ступичное отверстие
        $hlblock6 = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_dia')))->fetch();
        $entity6 = HL\HighloadBlockTable::compileEntity($hlblock6);
        $entity_data_class6 = $entity6->getDataClass(); 

        echo "<pre>Template arResult: "; print_r("-->"); echo "</pre>";
        
        if(((array)((array)((array) $answer)["GetFindDiskResult"])["currencyRate"])["charCode"]=="RUB"){
        foreach ($elements as $element): 
            // echo "<pre>Template arResult: "; print_r($element); echo "</pre>";
            $wh_price_rest=((array)((array)$element)["whpr"])["wh_price_rest"];
                   
            $code=((array)$element)["code"]; 
            $name=((array)$element)["name"];
            $img=((array)$element)["img_big_pish"];   //после добавления лого клиента заменить на img_big_my
            $model=((array)$element)["model"];
            $marka=((array)$element)["marka"];
            $color=((array)$element)["color"];
            echo "<pre>Template arResult: "; print_r($element); echo "</pre>";
            echo "<pre>Template arResult: "; print_r($marka); echo "</pre>";
          
            $t=0;
            $q=0;
            $p=0;
            // echo "<pre>Template arResult: "; print_r($name); echo "</pre>";
            $res = CCatalogProduct::GetList(array(), array("IBLOCK_ID"=>$IBLOCK_ID,"ELEMENT_NAME"=>$name), false, false,array());
            // echo "<pre>Template arResult: "; print_r($res); echo "</pre>";
            while($ar_res = $res->Fetch())
            {
                $t++;
                $ID=$ar_res["ID"];
                $arPrice = CPrice::GetByID($ID);
            
                if($ar_res["QUANTITY"]!=((array)$wh_price_rest)["rest"]){
                    $q++;
                }
                if($arPrice["PRICE"]!=((array)$wh_price_rest)["price_rozn"]){
                    $p++;
                }
             
            }
          
            if($q==0){
                $arFields = array('QUANTITY' => ((array)$wh_price_rest)["rest"]);// зарезервированное количество
                CCatalogProduct::Update($ID, $arFields);
            }
            if($p==0){
                $arFields = Array("PRICE" => ((array)$wh_price_rest)["price_rozn"]);
                CPrice::Update($ID, $arFields);
            }
            if($t==0){
                $PROP = array();
                $PROP["U_MODEL"]=$model;
                $PROP["U_CODE"]=$code;
                $PROP["U_COLOR"]=$color;
                //списки
                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_TYPE_D"));
                while($enum_fields = $property_enums->GetNext())
                {
                    if(((array)$element)["type"]=="0"){
                        $prop_U_TYPE_D_ID=38;
                    }else{
                    if($enum_fields["XML_ID"]==((array)$element)["type"])
                        $prop_U_TYPE_D_ID=$enum_fields["ID"];
                    }
                }

                
                $PROP["U_TYPE_D"]=$prop_U_TYPE_D_ID;

               


          
                //справочники
                $rsData = $entity_data_class::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$marka)  
                ));

                while($arData = $rsData->Fetch()){
                    $HB_data_xml_id=$arData["UF_XML_ID"]; 
                }
                if(!$HB_data_xml_id){
                    $data = array("UF_NAME"=>$marka,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($marka,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class::add($data);

                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_MARKA_D"]['VALUE'] = $HB_data_xml_id;


                $params2 =  array(
                    'login' => $GLOBALS["SETTINGS"]["LOGIN_4TOCHKI"],
                    'password' => $GLOBALS["SETTINGS"]["PASSWORD_4TOCHKI"],
                    'code_list' => array( 0 => $code),
                );
                
                $answer2 = $client->GetGoodsInfo($params2);     
                // echo "<pre>Template arResult: "; print_r($answer2); echo "</pre>";
                $diameter=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["diameter"];
                $width=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["width"];
                $bolts_spacing=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["bolts_spacing"];
                $bolts_spacing2=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["bolts_spacing2"];
                $et=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["et"];
                $dia=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["dia"];
             
       
                $rsData2 = $entity_data_class2::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$diameter)  
                ));
        
                while($arData = $rsData2->Fetch()){
                    $HB_data_xml_id2=$arData["UF_XML_ID"]; 
                }
                if(!$HB_data_xml_id2){
                    $data = array("UF_NAME"=>$diameter,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($diameter,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class2::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class2::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id2=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_DIAMETER_D"]['VALUE'] = $HB_data_xml_id2;

                $bolts_count2=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["bolts_count"];
                echo "<pre>Template arResult bolts_count2: "; print_r($bolts_count2); echo "</pre>";
                $property_enums_bolts_count2 = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_BOLTS_COUNT2"));
                while($enum_fields = $property_enums_bolts_count2->GetNext())
                {
                    echo "<pre>Template arResult bolts_count2: "; print_r($enum_fields); echo "</pre>";
                    
                    if($enum_fields["VALUE"]==$bolts_count2)
                        $prop_U_BOLTS_COUNT2_ID=$enum_fields["ID"];
                }

                if(!empty($prop_U_BOLTS_COUNT2_ID)){
                    $PROP["U_BOLTS_COUNT2"]=$prop_U_BOLTS_COUNT2_ID;}else{
                        $ibpenum = new CIBlockPropertyEnum;
                                $prop_U_BOLTS_COUNT2_ID = $ibpenum->Add(Array('PROPERTY_ID'=>109, 'VALUE'=>$bolts_count2));
                                $PROP["U_BOLTS_COUNT2"]=$prop_U_BOLTS_COUNT2_ID;
                    }

                    unset($prop_U_BOLTS_COUNT2_ID);
                  
                    unset($bolts_count2);
        
                $rsData1 = $entity_data_class1::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$width)  
                    ));
        
                    while($arData = $rsData1->Fetch()){
                        $HB_data_xml_id1=$arData["UF_XML_ID"]; 
                    }
                if(!$HB_data_xml_id1){
                    $data = array("UF_NAME"=>$width,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($width,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class1::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class1::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id1=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_WIDTH_D"]['VALUE'] = $HB_data_xml_id1;

        

                $rsData3 = $entity_data_class3::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$bolts_spacing)  
                    ));
        
                    while($arData = $rsData3->Fetch()){
                        $HB_data_xml_id3=$arData["UF_XML_ID"]; 
                    }
                if(!$HB_data_xml_id3){
                    $data = array("UF_NAME"=>$bolts_spacing,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($bolts_spacing,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class3::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class3::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id3=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_BOLTS_SPACING"]['VALUE'] = $HB_data_xml_id3;


                $rsData4 = $entity_data_class4::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$bolt_spacing2)  
                    ));
        
                    while($arData = $rsData4->Fetch()){
                        $HB_data_xml_id4=$arData["UF_XML_ID"]; 
                    }
                if(!$HB_data_xml_id4){
                    $data = array("UF_NAME"=>$bolt_spacing2,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($bolt_spacing2,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class4::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class4::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id4=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_BOLTS_SPACING2"]['VALUE'] = $HB_data_xml_id4;


                $rsData5 = $entity_data_class5::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$et)  
                    ));
        
                    while($arData = $rsData5->Fetch()){
                        $HB_data_xml_id5=$arData["UF_XML_ID"]; 
                    }
                if(!$HB_data_xml_id5){
                    $data = array("UF_NAME"=>$et,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($et,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class5::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class5::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id5=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_ET"]['VALUE'] = $HB_data_xml_id5;


                $rsData6 = $entity_data_class6::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_NAME"=>$dia)  
                    ));
        
                    while($arData = $rsData5->Fetch()){
                        $HB_data_xml_id5=$arData["UF_XML_ID"]; 
                    }
                if(!$HB_data_xml_id6){
                    $data = array("UF_NAME"=>$dia,'DEF' => 'N','SORT' =>100,'UF_XML_ID' => Cutil::translit($dia,"ru",array("replace_space"=>"-","replace_other"=>"-")));
                    $result = $entity_data_class6::add($data);
                    if($result->isSuccess()){
                        $HB_data_id=$result->getId();
                        $HB_data = $entity_data_class6::getByID($HB_data_id);
                        $HB_data1=$HB_data->fetch();
                        $HB_data_xml_id6=$HB_data1["UF_XML_ID"];
                    }
                }
                $PROP["U_DIA"]['VALUE'] = $HB_data_xml_id6;




                $bolts_count=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["bolts_count"];
                $inset_type=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["inset_type"];
                $use_ck=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["use_ck"];
                $producer=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["producer"];
                $mount=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["mount"];
                $mount_note=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["mount_note"];

                $PROP["U_BOLTS_COUNT"]=$bolts_count;
                $PROP["U_INSET_TYPE"]=$inset_type;
                $PROP["U_USE_CK"]=$use_ck;
                $PROP["U_PRODUCER"]=$producer;
                $PROP["U_MOUNT"]=$mount;
                $PROP["U_MOUNT_NOTE"]=$mount_note;

                $avto=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["avto"];
                $logo=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["logo"];
                $marka_logo=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["marka_logo"];
                

                $PROP["U_AVTO"]=$avto;
                $PROP["U_LOGO"]=$logo;
                $PROP["U_MARKA_LOGO"]=$marka_logo;

               
                $weight=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["weight"];

              
                $PROP["U_WEIGHT"]=$weight;

                $volume=((array)((array)((array) ((array) $answer2)["GetGoodsInfoResult"])["rimList"])["RimContainer"])["volume"];
               
                $PROP["U_VOLUME"]=$volume;



                $PROP["U_WIDTH_D2"]=$width;
                $PROP["U_ET2"]=$et;
                $PROP["U_DIA2"]=$dia;
               

                $property_enums6 = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"U_LOCAL"));
                while($enum_fields = $property_enums6->GetNext())
                {
                    if($enum_fields["XML_ID"]!="Y"){
                        $prop_U_LOCAL_N_ID=$enum_fields["ID"];}
                }
                $PROP["U_LOCAL"]=$prop_U_LOCAL_N_ID;
                

                $codeNew=translit(((array)$element)["name"]);
                $el = new CIBlockElement;
                $arLoadProductArray = Array(  
                    'MODIFIED_BY' => 1,  
                    'IBLOCK_SECTION_ID' => 17, 
                    'IBLOCK_ID' => $IBLOCK_ID,
                    'PROPERTY_VALUES' => $PROP,  
                    'NAME' => $name,  
                    'CODE' => $codeNew, 
                    'ACTIVE' => 'Y', 
                    'PREVIEW_TEXT' => '',  
                    'DETAIL_TEXT' => '',  
                    'PREVIEW_PICTURE'=> CFile::MakeFileArray($img),
                    'DETAIL_PICTURE' => CFile::MakeFileArray($img) 
                );
                if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    echo("---Добавили товар ");
                    $fields = array(
                        'ID' => $PRODUCT_ID,
                        'QUANTITY' =>((array)$wh_price_rest)["rest"],
                        'TYPE' => \Bitrix\Catalog\ProductTable::TYPE_PRODUCT, //тип - основной товар нового типа
                        // 'MEASURE' => 5, //id единицы измерения
                    );
                    \Bitrix\Catalog\Model\Product::add($fields, false);
                    $arFieldsPrice = array(
                        "PRODUCT_ID" => $PRODUCT_ID,
                        "CATALOG_GROUP_ID" => 1,
                        "PRICE" => ((array)$wh_price_rest)["price_rozn"],
                        "CURRENCY" => 'RUB',
                    );
                    $result = \Bitrix\Catalog\Model\Price::add($arFieldsPrice, true);
                }  
            
            }

            unset($HB_data_xml_id);
            unset($HB_data_xml_id1);
            unset($HB_data_xml_id2);
            unset($HB_data_xml_id3);
            unset($HB_data_xml_id4);
            unset($HB_data_xml_id5);
            unset($HB_data_xml_id6);
            unset($avto);
            unset($logo);
            unset($marka_logo);
            unset($code);
            unset($name);
            unset($img);
            unset($model);
            unset($marka);
            unset($color);
            // unset($bolts_count2);
            
          
          
        endforeach;
        $pageN=((array)((array) $answer)["GetFindDiskResult"])["totalPages"];
        echo "<pre>Template arResult: "; print_r($pageN); echo "</pre>";
        echo "<pre>Template arResult: "; print_r($page); echo "</pre>";
        }
        
    }while($page<$pageN);  



       
        
 } ?>
