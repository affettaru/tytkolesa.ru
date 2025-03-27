<?php
/**
 * @global $APPLICATION
 * @global $USER
 */

if (!$USER->IsAdmin()) {
    return;
}

return array(
    array(
        "parent_menu" => "global_menu_content",
        "sort" => 10,
        "module_id" => "cv.settings",
        "icon" => "cv_settings_menu_icon",
        "text" => "Глобальные настройки",
        "title" => "Глобальные настройки",
        "items" => array(
            array(
                "sort" => 10,
                "text" => "Редактирование полей",
                "title" => "Редактирование полей",
                "url" => "cv_settings.php",
            ),
            array(
                "sort" => 20,
                "text" => "Добавить поле",
                "title" => "Добавить поле",
                "url" => "cv_add_field.php",
            )
        )
    ),
);
