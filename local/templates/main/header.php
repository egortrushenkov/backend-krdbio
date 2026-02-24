<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die(); ?>

<?
use lib\Kit;
use Bitrix\Main\Config\Option;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="autor" content="//STDKIT">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/favicon.svg">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/apple-touch-icon.png">
    <meta name="apple-mobile-web-app-title" content="MyWebSite">
    <link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/img/favicon/site.webmanifest">

    <title><?$APPLICATION->ShowTitle();?></title>

    <?$APPLICATION->ShowHead();?>
    <?php
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/application.js");
    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");
    ?>
</head>
<body>
<main>
    <div id="panel">
        <?$APPLICATION->ShowPanel();?>
    </div>

    <!-- Прелоадер -->
    <div class="flex items-center justify-center fixed inset-0 z-50 bg-gradient-to-br from-green-dark to-green transition-[opacity,_visibility] duration-500" data-preloader>
        <?php \lib\KitTPL::preloader();?>
    </div>

    <!-- Шапка документа (верх) -->
    <header class="container flex items-center justify-between gap-4 sticky lg:static top-0 z-30 bg-beige border-b border-solid border-gray/50 py-4">
        <button class="btn lg:hidden rounded-md" data-sidebar-open="menu" data-waved="dark">
            <?php \lib\KitTPL::icon("{id: 'burger', className: 'icon text-2xl', data: null}");?>
        </button>
        <a class="flex items-center shrink-0 mr-auto sm:mr-0" draggable="false" href="/">
            <div class="shrink-0 w-8 sm:w-12 lg:w-16 mr-2 sm:mr-4">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/logo', format: 'png', className: 'block w-full', data: null}");?>
            </div>
            <span class="font-alt font-extrabold uppercase text-1.5xl sm:text-2xl lg:text-3xl">БИО-сервис</span>
        </a>
        <p class="hidden xl:block font-medium text-xs opacity-60">
            Продажа, аренда и обслуживание туалетных <br> кабин в Краснодаре и Краснодарском крае
        </p>
        <div class="hidden sm:flex flex-col items-start">
            <span class="font-medium text-xs opacity-60">Время работы</span>
            <span class="font-alt font-extrabold text-1.5xl">09:00 - 18:00</span>
        </div>
        <div class="hidden lg:flex gap-8">
            <div class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">По всем вопросам</span>
                <a class="font-alt font-extrabold text-1.5xl underline-offset-4 hover:underline" draggable="false" href="tel: <?=Option::get("stdkit.settings", "main_phone");?>"><?=Option::get("stdkit.settings", "main_phone");?></a>
            </div>
            <div class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">Заказать машину</span>
                <a class="font-alt font-extrabold text-1.5xl underline-offset-4 hover:underline" draggable="false" href="tel: <?=Option::get("stdkit.settings", "car_phone");?>"><?=Option::get("stdkit.settings", "car_phone");?></a>
            </div>
        </div>
        <a class="btn btn-primary btn-fill btn-light btn-sm lg:hidden shrink-0 text-sm" data-fancybox-form data-waved="light" draggable="false" href="/ajax/dialogs/dialog-feedback.html">Связаться</a>
    </header>

    <!-- Шапка документа (низ) -->
    <header class="container hidden lg:flex items-center justify-between gap-10 sticky top-0 z-30 bg-beige py-4">
        <?$APPLICATION->IncludeComponent("bitrix:menu","custom",Array(
                        "ROOT_MENU_TYPE" => "top",
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "MENU_CACHE_GET_VARS" => ""
                )
        );?>
        <a class="btn btn-primary btn-fill btn-light btn-md shrink-0" data-fancybox-form data-waved="light" draggable="false" href="/ajax/dialogs/dialog-feedback.php">Связаться с нами</a>
    </header>

    <!-- Меню -->
    <?$APPLICATION->IncludeComponent("bitrix:menu","custom-mobile",Array(
                    "ROOT_MENU_TYPE" => "top",
                    "MAX_LEVEL" => "2",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => ""
            )
    );?>

