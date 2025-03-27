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

<section class="vacancies-item">
    <div class="container">
        <div class="vacancies-item__inner">
            <div class="vacancies-item__date"><?= FormatDate("d-m-Y", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?></div>
            <h1><?= $arResult["NAME"] ?></h1>
            <div class="vacancies-item__zp"><?= $arResult["PROPERTIES"]["SALARY_DETAIL"]["VALUE"] ?></div>

            <div class="vacancies-item__content">
                <?= html_entity_decode($arResult["DETAIL_TEXT"]) ?>
                <h3>Обязанности:</h3>
                <ul>
                    <?php foreach ($arResult["PROPERTIES"]["RESP"]["VALUE"] as $val): ?>
                        <li>
                            <?= $val ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <h3>Требования:</h3>
                <ul>
                    <?php foreach ($arResult["PROPERTIES"]["REQ"]["VALUE"] as $val): ?>
                        <li>
                            <?= $val ?>
                        </li>
                    <?php endforeach; ?>

                </ul>

                <h3>Условия:</h3>
                <ul>
                    <?php foreach ($arResult["PROPERTIES"]["COND"]["VALUE"] as $val): ?>
                        <li>
                            <?= $val ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <h3>Хотите работать в нашей команде?</h3>
                <?php
                $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/inc/vacancies/inc1.php", array(), array(
                    "MODE" => "html",
                    "NAME" => "Редактирование включаемой области",
                ));
                ?>


                <h3>Ознакомиться с нашими вакансиями вы можете здесь:</h3>
                <a href="<?= $arParams["IBLOCK_URL"] ?>" class="file"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/file2.svg" alt=""> Все
                    вакансии</a>

            </div>
        </div>
    </div>
</section>




