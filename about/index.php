<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Продажа туалетных кабин");
?>

<?
use lib\Kit;
use Bitrix\Main\Config\Option;
?>

<?//$APPLICATION->IncludeComponent("kit:primal", "", ["CODE"=> $APPLICATION->GetCurPage(false)]);?>

<!-- Hero (Primal) -->
<?php \lib\KitTPL::primal("{bg: 'about', text: 'Компания «БИО-СЕРВИС» <br> была основана в 2009 г.', description: 'и оказывает полный спектр услуг в сфере санитарного обслуживания <br>на территории Краснодара и Краснодарского края.', cost: 'false', listing: 'false'}");?>

<!-- Ассенизаторские услуги в Краснодаре -->
<?
$APPLICATION->IncludeFile("/include/description-about.php", Array(), Array(
        "MODE" => "php",
        "NAME" => "Редактирование Форма бронирования",
));
?>

<!-- Нужна консультация по аренде или покупке? -->
<?php \lib\KitTPL::feedback("{theme: 'Страница контактов', bg: 'consultation', title: 'Нужна консультация по аренде или покупке?', text: 'Свяжитесь с нами удобным для вас способом'}");?>

<!-- Вопрос-ответ -->
<?$APPLICATION->IncludeComponent("kit:FAQ", "", ["CODE"=> $APPLICATION->GetCurPage(false)]);?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>