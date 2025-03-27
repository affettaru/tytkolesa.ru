<?php
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/modules/cv.settings/admin/cv_settings.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/modules/cv.settings/admin/cv_settings.php");
} else {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/cv.settings/admin/cv_settings.php");
}
