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
        "TITLE" => "Добавить поле",
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
    $result = SettingsTable::add([
        'NAME' => $post["FIELD_NAME"],
        'CODE' => $post["FIELD_CODE"],
        'MULTIPLE' => isset($post["MULTIPLE"]) ? true : false,
    ]);
    $errors = $result->getErrorMessages();
    foreach ($errors as $error){
        $errorStr .= $error . "\n";
    }

    if(empty($errorStr)) LocalRedirect("/bitrix/admin/cv_add_field.php");
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
    <tr>
        <td class="adm-detail-content-cell-l">
            <strong>
                Название
            </strong>
        </td>
        <td class="adm-detail-content-cell-r">
            <input type="text" size="50" name="FIELD_NAME" value="<?= $post["FIELD_NAME"] ?>" placeholder="Электронная почта">
        </td>
    </tr>
    <tr>
        <td class="adm-detail-content-cell-l">
            <strong>
                Символьный код
            </strong>
        </td>
        <td class="adm-detail-content-cell-r">
            <input type="text" size="50" name="FIELD_CODE" value="<?= $post["FIELD_CODE"] ?>" placeholder="MAIL">
        </td>


    </tr>
    <tr>
        <td>Множественное</td>
        <td>
            <input type="checkbox" name="MULTIPLE" value="Y">
        </td>
    </tr>
    <input type="hidden" name="lang" value="<?= LANG ?>">
    <?php
    // кнопки сохранения изменений
    $tabControl->Buttons(
        [
            "disabled" => ($POST_RIGHT < "W"),
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
