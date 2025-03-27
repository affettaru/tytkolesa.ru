<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<?php
if (!empty($arResult["ITEMS"])): ?>
    <div class="container-custom">
        <div class="h2">Часто задаваемые вопросы</div>
        <div class="faq">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="faq__item">
                    <div class="faq__card">
                        <div class="faq__card__title js--faq-title">
                            <div class="faq__card__title__text"><?= $arItem["NAME"] ?></div>
                            <div class="faq__card__title__icon"><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#arrow-down"></use>
                                </svg></div>
                        </div>
                        <div class="faq__card__content">
                            <div class="block__text">
                                <p><?= $arItem["PREVIEW_TEXT"]?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?endforeach;?>       
            
        </div>
    </div>

<?php
endif; ?>