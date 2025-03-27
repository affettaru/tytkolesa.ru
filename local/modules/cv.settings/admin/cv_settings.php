<?php
/**
 * @global $APPLICATION
 * @global $USER
 * @var $USER_FIELD_MANAGER
 * @var $REQUEST_METHOD
 * @var $space_code
 * @var $save
 * @var $apply
 */

use \Cv\Settings\SettingsTable;
use Cv\Settings\FieldsManager;
use Cv\Settings\ValueTable;


require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

if (!$USER->IsAdmin() || !\Bitrix\Main\Loader::includeModule("cv.settings")) {
    return;
}


IncludeModuleLangFile(__FILE__);

$POST_RIGHT = $APPLICATION->GetGroupRight("cv.settings");

if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm("ACCESS_DENIED");

// Серверная часть
$tabControl = new CAdminTabControl("tabControl", array(
    array(
        "DIV" => "edit1",
        "TAB" => "Настройки",
        "TITLE" => "Редактирование полей",
    ),

));

$message = null;
$bVarsFromForm = false;
$module_id = "cv.settings";

// поля настроек
$fieldsManager = FieldsManager::getInstance();
$fields = $fieldsManager->getFields();
$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();
$post = $request->getPostList()->toArray();
$errorStr = "";


// Обработка изменений с формы

if (
    $REQUEST_METHOD == "POST"
    &&
    ($save != "" || $apply != "")
    &&
    $POST_RIGHT == "W"
    &&
    check_bitrix_sessid()
) {
    // обработка данных формы
    foreach ($fields as $code => $field) {
        if (!isset($post[$code]) || !is_array($field["VALUE"])) continue;


        // delete
        if(is_array($post["DELETE_FIELD"]) && in_array($field["ID"], $post["DELETE_FIELD"])){
            $fieldObj = SettingsTable::getByPrimary($field["ID"])->fetchObject();
            if (empty($fieldObj)) continue;
            $result = $fieldObj->delete();
            $errorStr .= $fieldsManager->GetErrorsString($result);
        }


        // update
        $arrToUpdate = array_intersect_key($post[$code], $field["VALUE"]);
        foreach ($arrToUpdate as $id => $value) {
            if(!empty($value)) {
                $result = ValueTable::update($id, array(
                    'TEXT' => $value
                ));
                $errorStr .= $fieldsManager->GetErrorsString($result);
            }else{
                $value = ValueTable::getByPrimary($id)->fetchObject();
                $result = $value->delete();
                $errorStr .= $fieldsManager->GetErrorsString($result);
            }
        }


        //add
        $arrToAdd = array_diff_key($post[$code], $field["VALUE"]);
        foreach ($arrToAdd as $id => $value) {
            if(empty($value)) continue;
            $result = ValueTable::add([
                'TEXT' => $value,
                'SETTING_ID' => $field["ID"],
            ]);
            $errorStr .= $fieldsManager->GetErrorsString($result);
        }
    }
        if(empty($errorStr)) LocalRedirect("/bitrix/admin/cv_settings.php");
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

// show errors
if (!empty($errorStr)) {
    CAdminMessage::ShowMessage($errorStr);
}
?>

<form action="<?= $APPLICATION->GetCurPage() ?>" method="POST" name="post_form" ENCTYPE="multipart/form-data">
    <?= bitrix_sessid_post(); ?>

    <?php $tabControl->Begin(); ?>
    <?php $tabControl->BeginNextTab(); ?>
    <?php foreach ($fields as $code => $field):
        $c = 0;
        if (is_array($field["VALUE"])):
            foreach ($field["VALUE"] as $id => $val):
                $c++;
                ?>
                <tr>
                    <td>
                        <?= $c == 1 ? $field["NAME"] : "" ?>
                    </td>
                    <td>
                        <input data-code="<?= $code ?>" data-id="<?= $id ?>" type="text" size="50"
                               name="<?= $code . "[{$id}]" ?>" value="<?= htmlspecialchars($val) ?>">
                    </td>
                    <td>
                        <?php if ($c == 1): ?>
                    <td>
                        <input id="checkbox_<?= $field["ID"] ?>" type="checkbox" name="DELETE_FIELD[]"
                               value="<?= $field["ID"] ?>">
                    </td>
                    <td>
                        Удалить поле
                    </td>
                    <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        <?php if(!empty($field["MULTIPLE"])): ?>
            <tr>
                <td></td>
                <td>
                    <input class="adm-detail-content-cell-r add-field" type="button" value="Добавить...">
                </td>
            </tr>
            <?php endif; ?>
        <?php endif; ?>
        <td style="padding-bottom: 10px">
        </td>
    <?php
    endforeach; ?>
    <input type="hidden" name="lang" value="<?= LANG ?>">
    <script>
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains("add-field")) {
                let inputToCopy = e.target.closest("tr").previousElementSibling.querySelector("input");
                let id = parseInt(inputToCopy.getAttribute("data-id"))
                let code = inputToCopy.getAttribute("data-code")


                var container = document.createElement('tr');
                var space = document.createElement('td');
                space.classList.add("adm-detail-content-cell-l")
                var newFieldGroup = document.createElement('td');
                newFieldGroup.classList.add("adm-detail-content-cell-r")
                newFieldGroup.innerHTML = `<input data-code="${code}" data-id="${id + 1}" size="50" type="text" name="${code}[${id + 1}]" value="" />`;
                container.appendChild(space);
                container.appendChild(newFieldGroup);
                inputToCopy.closest("tr").after(container)
            }
        });
    </script>


    <?php
    // кнопки сохранения изменений
    $tabControl->Buttons(
        [
            "disabled" => ($POST_RIGHT < "W"),
            "back_url" => "intervolga.academy_rubric_admin.php?LANG=" . LANG
        ]
    );
    ?>




    <?php
    $tabControl->End();
    ?>
    <?php
    $tabControl->ShowWarnings("post_form", $message);
    ?>
</form>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>
