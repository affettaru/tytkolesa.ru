<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die(); ?>

<div class="modal" id="js--modal-qwestion">
        <div class="modal__content">
            <div class="modal__title">Задать вопрос</div>
            <form class="form form__mini"  id="<?= $arParams["TOKEN"] ?>">
                <div class="form__columns">
                    <div class="form__item"><input class="form__input" type="text" placeholder="Ваше имя*" name="NAME" /></div>
                    <div class="form__item"><input class="form__input" type="text" placeholder="Город*" name="CITY" /></div>
                    <div class="form__item"><input class="form__input js--maskphone" type="tel"  id="PHONE_<?= $arParams["TOKEN"] ?>"  placeholder="Ваш телефон*" name="PHONE" /></div>
                    <div class="form__item"><input class="form__input" type="mail" placeholder="Ваш email*" name="EMAIL" /></div>
                    <div class="form__item"><textarea class="form__input" placeholder="Введите сообщенние" rows="4" name="TEXT"></textarea></div>
                    <div class="form__item form__item__last"><button  id="btn_<?= $arParams["TOKEN"] ?>" class="mbtn mbtn__primary mbtn__block" type="submit">Отправить</button>
                        <div class="form__text"> Нажимая на кнопку, Вы соглашаетесь с <a href="/policy/">политикой конфиденциальности</a></div>
                    </div>
                    <button id="send-btn_<?= $arParams["TOKEN"] ?>" style="display:none" class="mbtn mbtn__primary mbtn__small" data-fancybox-html="modal-send" data-src="#js--modal-send">Форма отправлена</button>
                    <input type="text" hidden="" value="<?= $APPLICATION->GetCurDir() ?>" name="PAGE">
                    <input type="text" hidden="" value="задать вопрос" name="TITLE">
                </div>
            </form>
        </div>
    </div>


    <?php
CJSCore::Init(['masked_input']);
?>

<script>
    // BX.ready(function() {
    //     var result = new BX.MaskedInput({
    //         mask: '+7 999 999 99 99', // устанавливаем маску
    //         input: BX('PHONE'),
    //         placeholder: '-' // символ замены +7 ___ ___ __ __
    //     });
    //     result.setValue('+'); // устанавливаем значение
    // });


    // reject reload
    document.querySelector("#<?= $arParams["TOKEN"] ?>").addEventListener("submit", (event) => {
        event.preventDefault()
    });

    //valid
    function valid(e, name, text, regex = /.{1}/) {
        
        if (e.name == name) {
           
            if (!regex.test(e.value)) {
               
                if (!e.parentElement.querySelector("span")) {
                    e.className="form__input__error";
                    // e.style = "border: 1px solid red"
                    e.parentElement.innerHTML += `<span style="color:#000">${text}</span>`;
                }else{
                if (e.parentElement.querySelector(".iti__a11y-text")) {
                    e.className="form__input__error";
                    // e.style = "border: 1px solid red"
                    e.parentElement.parentElement.innerHTML += `<span style="color:#000">${text}</span>`;
                }
                if (e.parentElement.parentElement.querySelector("span")) {
                    e.parentElement.parentElement.querySelector("span").remove();
                    e.style = "";
                }
                if (!e.parentElement.querySelector(".iti__a11y-text")) {
                    e.className="form__input__error";
                    // e.style = "border: 1px solid red"
                    e.parentElement.parentElement.innerHTML += `<span style="color:#000">${text}</span>`;
                }
            }
                window.FormStatus = false;
            } else {
                
                if (e.parentElement.querySelector("span")) {
                    e.parentElement.querySelector("span").remove();
                    e.style = "";
                }
            }
        }
    }

    
    document.querySelector("#btn_<?= $arParams["TOKEN"] ?>").addEventListener("click", async (event) => {
        // send ajax request with values of inputs
        window.FormStatus = true;
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='NAME']"), "NAME", "Поле обязательно к заполнению")
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='CITY']"), "CITY", "Поле обязательно к заполнению")
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='EMAIL']"), "EMAIL", "Поле обязательно к заполнению")
        valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='PHONE']"), "PHONE", "Номер введен неверно", /^(\+7|7|8|[0-9])?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/)
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
            document.querySelector(".is-close-btn").click()
            document.querySelector("#send-btn_<?= $arParams["TOKEN"] ?>").click()
            
        } else {
            window.FormStatus = true;
            valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='NAME']"), "NAME", "Поле обязательно к заполнению")
            valid(document.querySelector("#<?= $arParams["TOKEN"] ?> input[name='PHONE']"), "PHONE", "Номер введен неверно", /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/)
        }

    })
    ;


</script>

