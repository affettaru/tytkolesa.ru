<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


?>


<section class="categor">
    <div class="container">
        <div class="categor__inner">
            <h2>Категории товаров</h2>

            <div class="tabs_wrapper">
                <ul class="tabs">
                    <?php foreach ($arResult["SECTIONS"] as $key => $arItem): ?>
                        <li class="<?= $key == 0 ? "active" : "" ?>" id="tab<?= $key ?>"><?= $arItem["NAME"] ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class="tabs_container">


                    <?php foreach ($arResult["SECTIONS"] as $key => $arItem): ?>

                        



                    <div  class="tab_content <?= $key == 0 ? "active" : "" ?>" data-tab="tab<?= $key ?>">
                        <div class="categor__row">
                            
                            <?php if($key == 0){
                                $c=4;
                                $key3="1";
                            }else{
                                $c=6; $key3="w33";}
                                // $itm=implode(",", $arItem["CHILDS"]);
                                $this->AddEditAction($arChild['ID'], $arChild['EDIT_LINK'], CIBlock::GetArrayByID($arChild["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arChild['ID'],$arChild['DELETE_LINK'], CIBlock::GetArrayByID($arChild["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                $id = $this->GetEditAreaId($arChild['ID']);
                                $json = json_encode($arItem["CHILDS"], JSON_UNESCAPED_UNICODE);
                                // $itm=json_decode( $json);
                                $itm="";
                                $i=0;foreach($arItem["CHILDS"] as $key2=>$arChild): 
                                $itm=$itm."{src=>".$arChild["PICTURE"]["SRC"].",name=>".$arChild["NAME"].",url=>".$arChild["SECTION_PAGE_URL"].",id=>".$id.",key=>".$key3."},";
                                if($i<$c){?>
                                <?php
                                
                                ?>
                                <div id="<?= $id ?>" class="categor__cell <?= $key == 0 ? : "w33" ?>">
                                    <div class="categor__item">
                                        <a href="<?= $arChild["SECTION_PAGE_URL"] ?>"></a>

                                        <div class="categor__item-title"><?= $arChild["NAME"] ?></div>
                                        <div class="categor__item-img">
                                            <img src="<?= $arChild["PICTURE"]["SRC"] ? $arChild["PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/placeholder.png" ?>"
                                                alt="<?= $arChild["NAME"] ?>">
                                        </div>
                                    </div>
                                </div>
                           <?}$i++;?>

                            <?php endforeach; 
                            

                           

                           ?>
                           
                            

                        </div>
                        <div class="showmore-bottom <?=$key3?>">
	<a data-page="1" data-с="<?= $c;?>" data-сdata="<?= $itm;?>" data-max="<?php echo $i+1; ?>" class="showmore-button btn btn-prim btn-min" href="#">Показать еще</a>
</div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>


        </div>
    </div>
</section>
