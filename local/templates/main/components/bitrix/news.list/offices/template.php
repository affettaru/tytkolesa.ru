<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
}
$emptyImage = SITE_TEMPLATE_PATH . "/placeholder.png";

?>

<div class="map">
    <div class="map__select"><select class="js--select-cities" id="js--select-formap" name="#"></select></div>
    <div class="map__columns">
        <div class="map__columns__body">
            <div class="map__yandex">
                <div class="map__yandex__include" id="js--mapoffices"></div>
            </div>
            <div class="map__hidedesktop"> <a class="mbtn mbtn__outline mbtn__wicon mbtn__block" href="#"><span>Все адреса</span><i class="ic"><svg>
                            <use xlink:href="img/icons.svg#arrow-long"></use>
                        </svg></i></a></div>
        </div>
        <div class="map__columns__aside">
            <div class="map__content">
                <div class="map__des js--placemark">
                    <div class="map__des__close js--btn-mapdes-close"><svg>
                            <use xlink:href="img/icons.svg#ic-close"></use>
                        </svg></div>
                    <div class="map__des__content js--placemark--popup"></div>
                </div>
                <div class="map__content__body">
                    <div class="map__addresses">
                        <ul class="js--addresses"></ul>
                    </div>
                </div>
                <div class="map__content__footer"><a class="mbtn mbtn__outline mbtn__wicon mbtn__block" href="#"><span>Все адреса</span><i class="ic"><svg>
                                <use xlink:href="img/icons.svg#arrow-long"></use>
                            </svg></i></a></div>
            </div>
        </div>
    </div>
</div>

<? /*  php

if (!empty($arResult["ITEMS"])):  ?>
    <section class="contacts">
        <div class="container">
            <div class="contacts__inner">
            <div class="contacts__r">
           
                    <div class="contacts__info">
                        <div class="contacts__inp">
                            <input type="text" placeholder="Ваш город">
                        </div>

                        <div class="contacts__list">
                            <div class="contacts__list-in  news-page" >

                                <?php $i=0; foreach ($arResult["ITEMS"] as $arItem): $i++;?>

                                    <?php
                                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                    $id = $this->GetEditAreaId($arItem['ID']);
                                    ?>
                                    <div id="<?= $id ?>" class="contacts__list-item news-page__inner <?if($i>4){?> d-none<?}?>">
                                        <div class="contacts__list-item__cont" data-id="<?= $arItem["ID"] ?>">
                                            <div class="contacts__list-tt"><?= $arItem["PROPERTIES"]["TYPE"]["VALUE"] ?></div>
                                            <div class="contacts__list-title"><?= $arItem["NAME"] ?></div>
                                            <div class="contacts__list-drop-item">
                                                <!-- <div class="contacts__list-drop-t">Телефон:</div> -->
                                                <div class="contacts__list-bl">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.0579 7.87491C13.6709 7.87491 13.3649 7.55991 13.3649 7.18191C13.3649 6.84891 13.0319 6.15591 12.4739 5.55292C11.9249 4.96792 11.3219 4.62592 10.8179 4.62592C10.4309 4.62592 10.1249 4.31092 10.1249 3.93293C10.1249 3.55493 10.4399 3.23993 10.8179 3.23993C11.7179 3.23993 12.6629 3.72593 13.4909 4.59892C14.2649 5.41792 14.7599 6.43491 14.7599 7.17291C14.7599 7.55991 14.4449 7.87491 14.0579 7.87491Z" fill="#9F9FAB"/>
                                                    <path d="M17.3063 7.87496C16.9193 7.87496 16.6133 7.55996 16.6133 7.18196C16.6133 3.98698 14.0123 1.39499 10.8264 1.39499C10.4394 1.39499 10.1334 1.07999 10.1334 0.701996C10.1334 0.323998 10.4394 0 10.8174 0C14.7773 0 17.9993 3.22198 17.9993 7.18196C17.9993 7.55996 17.6843 7.87496 17.3063 7.87496Z" fill="#9F9FAB"/>
                                                    <path d="M8.14496 11.6549L6.47997 13.3199C6.12897 13.6709 5.57097 13.6709 5.21097 13.3289C5.11197 13.2299 5.01298 13.1399 4.91398 13.0409C3.98698 12.1049 3.14998 11.1239 2.40299 10.098C1.66499 9.07196 1.07099 8.04596 0.638997 7.02897C0.215999 6.00297 0 5.02198 0 4.08598C0 3.47398 0.107999 2.88899 0.323998 2.34899C0.539997 1.79999 0.881996 1.29599 1.35899 0.845996C1.93499 0.278999 2.56499 0 3.23098 0C3.48298 0 3.73498 0.0539998 3.95998 0.161999C4.19398 0.269999 4.40098 0.431998 4.56298 0.665997L6.65097 3.60898C6.81297 3.83398 6.92997 4.04098 7.01096 4.23898C7.09196 4.42798 7.13696 4.61698 7.13696 4.78798C7.13696 5.00398 7.07397 5.21997 6.94797 5.42697C6.83097 5.63397 6.65997 5.84997 6.44397 6.06597L5.75997 6.77697C5.66097 6.87597 5.61597 6.99297 5.61597 7.13697C5.61597 7.20897 5.62497 7.27196 5.64297 7.34396C5.66997 7.41596 5.69697 7.46996 5.71497 7.52396C5.87697 7.82096 6.15597 8.20796 6.55197 8.67596C6.95696 9.14396 7.38896 9.62095 7.85696 10.098C7.94696 10.188 8.04596 10.278 8.13596 10.368C8.49596 10.7189 8.50496 11.2949 8.14496 11.6549Z" fill="#9F9FAB"/>
                                                    <path d="M17.9726 14.697C17.9726 14.949 17.9276 15.21 17.8376 15.462C17.8106 15.534 17.7836 15.606 17.7476 15.678C17.5946 16.002 17.3966 16.308 17.1356 16.596C16.6946 17.082 16.2086 17.433 15.6596 17.658C15.6506 17.658 15.6416 17.667 15.6326 17.667C15.1016 17.883 14.5256 18 13.9046 18C12.9866 18 12.0056 17.784 10.9706 17.343C9.93562 16.902 8.90063 16.308 7.87463 15.561C7.52363 15.3 7.17264 15.039 6.83964 14.76L9.78262 11.817C10.0346 12.006 10.2596 12.15 10.4486 12.249C10.4936 12.267 10.5476 12.294 10.6106 12.321C10.6826 12.348 10.7546 12.357 10.8356 12.357C10.9886 12.357 11.1056 12.303 11.2046 12.204L11.8886 11.529C12.1136 11.304 12.3296 11.133 12.5366 11.025C12.7436 10.899 12.9506 10.836 13.1756 10.836C13.3466 10.836 13.5266 10.872 13.7246 10.953C13.9226 11.034 14.1296 11.151 14.3546 11.304L17.3336 13.419C17.5676 13.581 17.7296 13.77 17.8286 13.995C17.9186 14.22 17.9726 14.445 17.9726 14.697Z" fill="#9F9FAB"/>
                                                    </svg>
                                                    <a href="tel:<?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?>"
                                                        class="contacts__list-drop-link"><?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?></a>
                                                </div>
                                            </div>
                                            <div class="contacts__list-drop-item">
                                                    <!-- <div class="contacts__list-drop-t">Электронная почта:</div> -->
                                                <div class="contacts__list-bl">
                                                    <svg width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22.5 3.97685V14.625C22.5001 15.4859 22.1712 16.3142 21.5806 16.9405C20.99 17.5669 20.1824 17.9439 19.323 17.9944L19.125 18H3.375C2.51414 18 1.6858 17.6711 1.05946 17.0805C0.433118 16.49 0.0561291 15.6824 0.00562514 14.823L0 14.625V3.97685L10.6256 11.061L10.7561 11.1352C10.9099 11.2104 11.0788 11.2494 11.25 11.2494C11.4212 11.2494 11.5901 11.2104 11.7439 11.1352L11.8744 11.061L22.5 3.97685Z" fill="#9F9FAB"/>
                                                    <path d="M19.1254 0C20.3404 0 21.4058 0.641251 21.9998 1.60538L11.2504 8.77163L0.500977 1.60538C0.783048 1.14724 1.17059 0.763202 1.63127 0.485306C2.09196 0.20741 2.61242 0.0437133 3.14923 0.00787497L3.37536 0H19.1254Z" fill="#9F9FAB"/>
                                                    </svg>
                                                    <a href="mailto:<?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?>"
                                                       class="contacts__list-drop-link"><?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?></a>
                                                </div>
                                            </div>
                                            <div class="contacts__list-drop-item">
                                                    <!-- <div class="contacts__list-drop-t">Время работы:</div> -->
                                                <div class="contacts__list-bl">
                                                    <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 0C8.16638 0 7.32037 0.123425 6.46875 0.337801C5.868 0.490462 5.53725 1.07947 5.69475 1.65763C5.85337 2.2358 6.46538 2.58767 7.06613 2.43609C7.73888 2.26611 8.36887 2.16541 9 2.16541C9.65025 2.16541 10.2983 2.26611 10.9688 2.43609C11.5695 2.58767 12.1815 2.2358 12.3401 1.65763C12.4976 1.07947 12.132 0.490462 11.5312 0.337801C10.6807 0.123425 9.8505 0 9 0ZM9 3.24812C4.02975 3.24812 0 7.12638 0 11.9098C0 16.6932 4.02975 20.5714 9 20.5714C13.9703 20.5714 18 16.6932 18 11.9098C18 7.12638 13.9703 3.24812 9 3.24812ZM16.875 3.24812C16.254 3.24812 15.75 3.73317 15.75 4.33083C15.75 4.92848 16.254 5.41353 16.875 5.41353C17.496 5.41353 18 4.92848 18 4.33083C18 3.73317 17.496 3.24812 16.875 3.24812ZM9 7.57895C9.621 7.57895 10.125 8.064 10.125 8.66166V11.4355L12.0589 13.2967C12.4976 13.7201 12.4976 14.4303 12.0589 14.8537C11.619 15.2759 10.881 15.2759 10.4411 14.8537L8.19113 12.6882C7.98076 12.4847 7.875 12.1967 7.875 11.9098V8.66166C7.875 8.064 8.379 7.57895 9 7.57895Z" fill="#9F9FAB" stroke="white" stroke-width="0.002" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                   <?= $arItem["PROPERTIES"]["WORK_TIME"]["VALUE"] ?>
                                                </div>
                                                </div>
                                        </div>

                                        <div class="contacts__list-drop">
                                            <div class="contacts__list-drop-close"></div>
                                            <div class="contacts__list-drop-tt"><?= $arItem["PROPERTIES"]["TYPE"]["VALUE"] ?></div>
                                            <div class="contacts__list-drop-title">
                                                <?= $arItem["NAME"] ?>
                                            </div>

                                            <?php if ($arItem["PROPERTIES"]["TYPE"]["VALUE"]): ?>
                                                <div class="contacts__list-drop-item">
                                                    <div class="contacts__list-drop-t">Телефон:</div>
                                                    <a href="tel:<?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?>"
                                                       class="contacts__list-drop-link"><?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?></a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($arItem["PROPERTIES"]["MAIL"]["VALUE"]): ?>
                                                <div class="contacts__list-drop-item">
                                                    <div class="contacts__list-drop-t">Электронная почта:</div>
                                                    <a href="mailto:<?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?>"
                                                       class="contacts__list-drop-link"><?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?></a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($arItem["PROPERTIES"]["WORK_TIME"]["VALUE"]): ?>
                                                <div class="contacts__list-drop-item">
                                                    <div class="contacts__list-drop-t">Время работы:</div>
                                                    <div class="contacts__list-drop-tx"><?= $arItem["PROPERTIES"]["WORK_TIME"]["VALUE"] ?></div>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                               
                            </div>
                            <div class="pagination">
                                <div class="nv">
                                    <ul>
                                        <li class="bt">
                                            <a id="ald" style="width: max-content;cursor: pointer;"> 
                                                Показать еще
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?if($arParams["DISPLAY_BOTTOM_PAGER"] == "Y"):?>
                            <div class="pagination">
                                <?=$arResult["NAV_STRING"]?>
                            </div>
                            <?endif?>
                        </div>
                    </div>
                </div>
                <div class="contacts__l">
                    <div class="contacts__map">
                        <div id="map"></div>
                    </div>
                </div>

                
            </div>
        </div>
    </section>

<?php
endif; */?>