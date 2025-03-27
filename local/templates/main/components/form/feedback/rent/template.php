<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die(); ?>
<div class="remodal" data-remodal-id="cl2">
    <button data-remodal-action="close" class="remodal-close"></button>

    <div class="remodal__in">
        <div class="remodal__top">
            <div class="remodal__title">Аренда в 1 клик</div>
        </div>

        <div class="remodal__form">
            <div class="frm__form">
                <form id="<?= $arParams["TOKEN"] ?>">
                    <div class="frm__in">
                        <div class="frm__cell">
                            <input type="text" placeholder="Ваше ФИО*" name="NAME">
                        </div>
                        <div class="frm__cell">
                            <input type="text" placeholder="Ваш телефон*" id="PHONE_<?= $arParams["TOKEN"] ?>" name="PHONE">
                        </div>
                        <div class="frm__cell">
                            <input type="text" placeholder="Ваш e-mail" name="MAIL">
                        </div>
                        <div class="frm__cell">
                            <input type="text" placeholder="Ваша компания" name="COMPANY">
                        </div>
                        <div class="frm__cell">
                            <input type="text" placeholder="Город*" name="CITY" value="<?= $_SESSION["CITY"] ?>">
                        </div>
                    </div>

                    <div class="frm__soc">
                        <div class="frm__soc-tt">Предпочтительный способ связи:</div>

                        <div class="frm__check">
                            <input type="checkbox" id="checkSoc12" name="SOC[]" value="Telegram">
                            <label for="checkSoc12">Telegram</label>
                        </div>
                        <div class="frm__check">
                            <input type="checkbox" id="checkSoc22" checked name="SOC[]" value="WhatsApp">
                            <label for="checkSoc22">WhatsApp</label>
                        </div>
                        <div class="frm__check">
                            <input type="checkbox" id="checkSoc23" name="SOC[]" value="Перезвоните мне">
                            <label for="checkSoc23">Перезвоните мне</label>
                        </div>
                    </div>

                    <div class="frm__btn">
                        <button type="submit" class="btn btn-prim">Оставить</button>
                    </div>

                    <div class="frm__ch">
                        <div class="frm__check">
                            <input type="checkbox" id="check12" checked>
                            <label for="check12">Согласен с <a href="/policy/">политикой конфиденциальности</a> </label>
                        </div>
                    </div>
                    <input type="text" hidden="" value="<?= $_SESSION["CITY"] ?>"  name="CITY_HIDDEN">
                    <input type="text" hidden="" value="<?= $APPLICATION->GetCurDir() ?>" name="PAGE">
                </form>

            </div>
        </div>
    </div>
</div>




<?php CJSCore::Init(['masked_input']);?>
<script>
    BX.ready(function() {
        var result = new BX.MaskedInput({
            mask: '+7 999 999 99 99', // устанавливаем маску
            input: BX('PHONE_<?= $arParams["TOKEN"] ?>'),
            placeholder: '_'
        });
        result.setValue('+'); // устанавливаем значение
    });

    // reject reload
    document.querySelector("#<?= $arParams["TOKEN"] ?>").addEventListener("submit", (event) => {
        event.preventDefault()
    });

    //valid
    function valid(e, name, text, regex = /.{1}/) {
        if (e.name == name) {
            if (!regex.test(e.value)) {
                if (!e.parentElement.querySelector("span")) {
                    e.style = "border: 1px solid red"
                }
                window.FormStatus = false;
            } else {
                    e.style = "";
            }
        }
    }

    //submit
    document.querySelector("#<?= $arParams["TOKEN"] ?>").addEventListener("submit", async (event) => {

        // send ajax request with values of inputs
        window.FormStatus = true;
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='NAME']"), "NAME", "Поле обязательно к заполнению")
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='CITY']"), "CITY", "Поле обязательно к заполнению")
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='PHONE']"), "PHONE", "Номер введен неверно", /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/)
        let curDir = document.location.protocol + '//' + document.location.host + document.location.pathname;
        let data = new FormData(document.querySelector("#<?= $arParams["TOKEN"] ?>"))
        data.append("TOKEN", "<?= $arParams["TOKEN"] ?>")
        data.append("PAGE", curDir)
        if (window.FormStatus) {
            let result = await fetch(curDir, {
                method: 'POST',
                body: data,
            }).then(response => {
                return response.text()
            }).then(data => {
                return data;
            })
            console.log(result)
            event.target.reset();
            document.querySelector("#send-btn").click()

        } else {
            window.FormStatus = true;
            valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='NAME']"), "NAME", "Поле обязательно к заполнению")
            valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='PHONE']"), "PHONE", "Номер введен неверно", /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/)
            valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='CITY']"), "CITY", "Поле обязательно к заполнению")
        }

    })
    ;
</script>


