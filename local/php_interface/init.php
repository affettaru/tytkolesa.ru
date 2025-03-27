<?php

//пример использования события OnSaleOrderBeforeSaved
use Bitrix\Main; 
use Bitrix\Sale;
use Bitrix\Basket;
Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderBeforeSaved',
    'myFunction'
);
//авторизируемся перед оформлением заказа
function myFunction(Main\Event $event)
{
    /** @var Order $order */
    global $USER;
    if (!$USER->IsAuthorized()):
        $order = $event->getParameter("ENTITY");
        // $order->setField('COMMENTS', 'Новый комментарий');
        $propertyCollection = $order->getPropertyCollection();
        $ar = $propertyCollection->getArray();
    
        foreach($ar["properties"] as $ars){
            if($ars["CODE"]=="FIO")
                $name=$ars["VALUE"][0];
            if($ars["CODE"]=="EMAIL")
                $EMAIL=$ars["VALUE"][0];
            if($ars["CODE"]=="PHONE")
                $PHONE=$ars["VALUE"][0];
        }
        $USER = new CUser;
               
        $rsUser = CUser::GetByLogin($PHONE);
        $arUser = $rsUser->Fetch();
        // echo "<pre>Template arResult: "; print_r($arUser); echo "</pre>";
        if(!$arUser){
          
            $fields = Array(
                "LOGIN" => $PHONE, // Логин пользователя
                "PASSWORD" => $PHONE, // Пароль пользователя
                "CONFIRM_PASSWORD" => $PHONE, // Подтверждение пароля
                "EMAIL" => $EMAIL, // Адрес электронной почты пользователя
                "NAME" => $name, // Имя пользователя
                "ACTIVE" => "Y", // Флаг активности пользователя
            );
            $ID = $USER->Add($fields);}
        else{
            
            
           
            $ID = $arUser["ID"];
        }
        $USER->Authorize($ID);
       
        if ($USER->IsAuthorized()){
            $order->setFieldNoDemand('USER_ID', $ID);
          
        } 
        
    endif;

}

AddEventHandler("sale", "OnOrderNewSendEmail", "ModifySaleMails");
 
function ModifySaleMails($orderID, &$eventName, &$arFields)
{
   $arOrder = CSaleOrder::GetByID($orderID);  

   $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);  

   $phone = ""; 

   while ($arProps = $order_props->Fetch()){    
     if ($arProps["CODE"] == "PHONE"){
         $phone = htmlspecialchars($arProps["VALUE"]);}

   }

 if (!empty($arOrder["USER_DESCRIPTION"])){
     $arFields["DESCRIPTION"] = $arOrder["USER_DESCRIPTION"];}

   //-- добавляем новые поля в массив результатов
   $arFields["PHONE"] =  $phone;
}

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnEpilog', 'AddSuffixInTitle');
function AddSuffixInTitle()
{
	global $APPLICATION;
    CModule::IncludeModule("iblock");
    $arSelect = Array("ID", "NAME", "PROPERTY_U_LINK", "PROPERTY_U_H1", "PROPERTY_U_TITLE", "PROPERTY_U_DESCRIPTION", "PROPERTY_U_KEYWORDS");
    $arFilter = Array("IBLOCK_ID"=>13, "PROPERTY_U_LINK"=>$APPLICATION->GetCurDir(), "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
   
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
    }
  if($arFields){
  
      if($arFields["PROPERTY_U_H1_VALUE"]){
          $APPLICATION->SetPageProperty("H1", $arFields["PROPERTY_U_H1_VALUE"]);
      }
      if($arFields["PROPERTY_U_TITLE_VALUE"]){
          $APPLICATION->SetPageProperty("title", $arFields["PROPERTY_U_TITLE_VALUE"]);
      }
      if($arFields["PROPERTY_U_DESCRIPTION_VALUE"]){
          $APPLICATION->SetPageProperty("description", $arFields["PROPERTY_U_DESCRIPTION_VALUE"]);
      }
      if($arFields["PROPERTY_U_KEYWORDS_VALUE"]){
          $APPLICATION->SetPageProperty("keywords", $arFields["PROPERTY_U_KEYWORDS_VALUE"]);
      }
  }
}

