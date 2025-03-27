<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты ");
$APPLICATION->SetTitle("Контакты");

   
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
			<div class="h1"><?= $APPLICATION->ShowTitle() ?></div>
				<?php
				$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"contacts",
					array(
						"IBLOCK_ID" => 9,
						"IBLOCK_TYPE" => "content",
						"NEWS_COUNT" => "10",
						"FIELD_CODE" => array("NAME", "PREVIEW_TEXT"),
						"PROPERTY_CODE" => array("LINK", "TEXT"),
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
					)
				);
				?>
				
			</div>
		</div>
	</section><!-- form invite-->
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
); ?>
	<!-- <script src="https://api-maps.yandex.ru/2.1/?apikey=6c385eb6-43a4-490f-9cc9-bb318a95d256&amp;lang=ru_RU"></script> -->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>