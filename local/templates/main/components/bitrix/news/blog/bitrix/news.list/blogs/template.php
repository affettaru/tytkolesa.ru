<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
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
$emptyImage = SITE_TEMPLATE_PATH . "/img/blog/img-blog-6.jpg";
?>
<section class="news-page">
    <div class="bloglist">
        <?php foreach($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $id = $this->GetEditAreaId($arItem['ID']);
            ?>
            <div class="bloglist__item">
            <? $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); ?>
                <div class="blog__card"><a class="blog__card__img" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $file["src"] : $emptyImage ?>" alt="<?= $arItem["NAME"] ?>" /></a>
                    <div class="blog__card__body"><a class="blog__card__title" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                        <div class="blog__card__text"><?=$arItem["PREVIEW_TEXT"]?></div>
                    </div>
                    <div class="blog__card__date">
                        <?$dateCreate = CIBlockFormatProperties::DateFormat('d.m.Y', MakeTimeStamp($arItem["DATE_CREATE"], CSite::GetDateFormat()));
                            echo $dateCreate;?>
                    </div>
                </div>
            </div>       
        <?endforeach;?>              
    </div>
    <?= $arResult["NAV_STRING"] ?>
</section>
        </div></section>

