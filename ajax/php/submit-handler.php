<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$theme        = $_REQUEST['theme'] ?? '';
$name         = $_REQUEST['name'] ?? '';
$tel          = $_REQUEST['tel'] ?? '';
$sitename     = $_REQUEST['referer'] ?? $_SERVER['HTTP_REFERER'] ?? '';

$message = '';
if ($theme)        $message .= 'Тема: '              . $theme        . "\n";
if ($name)         $message .= 'Имя: '               . $name         . "\n";
if ($tel)          $message .= 'Телефон: '            . $tel          . "\n";
if ($sitename)     $message .= 'Страница обращения: ' . $sitename     . "\n";

// Обработка файлов — сохраняем и добавляем ссылки в сообщение
if (!empty($_FILES['files']['name'][0])) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/feedback/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $fileLinks = [];
    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        if ($_FILES['files']['error'][$key] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($_FILES['files']['name'][$key]);
            move_uploaded_file($tmpName, $uploadDir . $fileName);
            $fileLinks[] = 'https://' . $_SERVER['HTTP_HOST'] . '/upload/feedback/' . $fileName;
        }
    }

    if ($fileLinks) {
        $message .= 'Файлы: ' . "\n" . implode("\n", $fileLinks) . "\n";
    }
}

// Всегда через CEvent
$arEventFields = [
    "THEME"     => $theme,
    "MESSAGE"   => $message,
    "SITE_NAME" => $sitename,
];

$resultMail = CEvent::SendImmediate("FEEDBACK_FORM", "s1", $arEventFields, 7);
$resultTg = t_me($message);
if ($resultMail) {
    echo json_encode([
        "status"  => true,
        "message" => "Спасибо, ваш запрос отправлен.",
    ]);
} else {
    echo json_encode([
        "status"  => false,
        "message" => "Произошла ошибка при отправке запроса.",
    ]);
}