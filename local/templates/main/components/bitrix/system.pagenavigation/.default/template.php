<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="pagination">
  
                          
<?




if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>



<?if($arResult["bDescPageNumbering"] === true):?>



	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
			
			<div class="pagination__item"><a class="pagination__btn" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"> <svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></a></div>
			
		<?else:?>
			
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<div class="pagination__item"><a  class="pagination__btn" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"> <button ><svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></a></div>
				
			<?else:?>
				<div class="pagination__item"><a class="pagination__btn" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"> <svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></a></div>
				
			<?endif?>
		<?endif?>
	<?else:?>
		<div class="pagination__item"><button class="pagination__btn" disabled="disabled"><svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></button></div>
	<?endif?>


	<div class="pagination__item">
    <ul>
                                     
										
		<?if($arResult["nStartPage"]>5){?>
			
			<li><a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
			<li><span>...</span></li>
			<?}?>	                          
	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<li>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<a class="pagination__link pagination__link__active" href="#"><?=$NavRecordGroupPrint?></a>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
		<?else:?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
		<?endif?>

		<?$arResult["nStartPage"]--;?>
	
		</li>
	<?endwhile?>
	<?if($arResult["nStartPage"]<$arResult["nEndPage"]-5){?>
			<li><span>...</span></li>
			<li><a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nEndPage"]?>"><?=$arResult["nEndPage"]?></a></li>
				
				<?}?>
	</ul>
	</div>


	<?if ($arResult["NavPageNomer"] > 1):?>
		<div class="pagination__item"><a class="pagination__btn" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-next"></use>
                                        </svg></a></div>
		
	
	<?endif?>

<?else:?>

	<!-- <?=$arResult["NavFirstRecordShow"]?> <?=GetMessage("nav_to")?> <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?><br /></font> -->

	<!-- <font class="text"> -->

	<?if ($arResult["NavPageNomer"] > 1):?>

		<?if($arResult["bSavePage"]):?>
			
			<div class="pagination__item"><a class="pagination__btn" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"> <svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></a></div>
			
		<?else:?>

			<?if ($arResult["NavPageNomer"] > 2):?>
				<div class="pagination__item"><a class="pagination__btn" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></a></div>
			<?else:?>
				<div class="pagination__item"><a class="pagination__btn" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"> <svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></a></div>
			<?endif?>
			
		<?endif?>

	<?else:?>
		<div class="pagination__item"><button class="pagination__btn" disabled="disabled"><svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-prev"></use>
                                        </svg></button></div>
	<?endif?>

	<div class="pagination__item">
	<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
    <ul>
                                     
										
			<?if($arResult["nStartPage"]>5){?>
			<li><a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
			
			<li><span>...</span></li>
			<?}?>	
			<?$ik=0;?>                       
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]): $ik++;?>
		
		<li <?if($ik>3){?>class="pagination__hidemobile"<?}?>>
		
		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<b class="pagination__link pagination__link__active"><?=$arResult["nStartPage"]?></b>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
		<?else:?>
			<a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
		<?endif?>
		<?$arResult["nStartPage"]++?>
		</li>
		
	<?endwhile?>
	
	<?if($arResult["nStartPage"]<$arResult["NavPageCount"]-5){?>
		
			<li><span>...</span></li>
			<li><a class="pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a></li>
				
				<?}?>
	</ul>
	</div>
	

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<div class="pagination__item"><a class="pagination__btn" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"> <svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-next"></use>
                                        </svg>
                          </a></div>
	
	<?endif?>

<?endif?>


<?if ($arResult["bShowAll"]):?>
<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>
	<?endif?>
</noindex>
<?endif?>
</div>
<!-- </font> -->