<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>
<section>
	<div class="container">
		<div class="block__padd">
			<? $APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"main",
				array(
					"PATH" => "",
					"SITE_ID" => "s1",
					"START_FROM" => "0"
				)
			); ?>
			<div class="pagehead">
				<div class="pagehead__img">
				<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc1.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
					</div>
				<div class="pagehead__body">
					<div class="pagehead__content">
						<?$APPLICATION->SetTitle("О компании");?>
						<div class="h1"><?= $APPLICATION->ShowTitle() ?></div>
						<!-- <div class="h1">О компании</div> -->
						<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc2.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
						
					</div>
					<div class="pagehead__footer">
						<div class="row">
							<div class="col-12 col-md-auto"><button class="mbtn mbtn__primary mbtn__big d-block w-100" type="button" data-fancybox-html="data-fancybox-html" data-src="#js--modal-order">Оставить заявку</button></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="block__padd">
			<div class="advantages">
			<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc3.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
				
			</div>
		</div>
		<div class="block__padd">
			<div class="about">
				<div class="about__item">
					<div class="row">
						<div class="col-12 col-lg-6 col-xl-5 order-1">
							<div class="about__content">
								<div class="block__text">
									<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc4.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
									
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-6 col-xl-5 offset-xl-2 order-2">
							<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc5.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
						
						</div>
					</div>
				</div>
				<div class="about__item">
					<div class="row">
						<div class="col-12 col-lg-6 col-xl-5 order-2 order-lg-1">
						<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc6.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
						
						</div>
						<div class="col-12 col-lg-6 col-xl-5 order-1 offset-xl-2 order-lg-1">
							<div class="about__content">
								<div class="block__text">
								<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc7.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
							</div>
							</div>
						</div>
					</div>
				</div>
				<div class="about__item">
					<div class="row">
						<div class="col-12 col-lg-6 col-xl-5 order-1">
							<div class="about__content">
								<div class="block__text">
								<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc8.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
									
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-6 col-xl-5 offset-xl-2 order-2">
						<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/about/inc9.php", array(), array("MODE" => "html",	"NAME" => "Редактирование включаемой области",));?>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- partners-->
<section class="block__padd">
<?php
    $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"partner", 
	array(
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "content",
		"NEWS_COUNT" => "10",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TEXT",
			3 => "",
		),
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "DESC",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "partner",
		"FILTER_NAME" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);
    ?>
	<!--  -->
</section><!-- partners--><!-- form invite-->
<? $APPLICATION->IncludeComponent(
	"form:feedback",
	"bottom_question",
	array(
		"IBLOCK_ID" => 11,
		"IBLOCK_TYPE" => "Forms",
		"MAIL_EVENT" => array(
			0 => "CALL",
		),
		"TOKEN" => "bottom_question_form",
	),
	false
); ?><!-- form invite-->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>