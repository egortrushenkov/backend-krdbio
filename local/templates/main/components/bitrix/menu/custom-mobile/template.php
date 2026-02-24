<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/templates/main/components/bitrix/menu/helpers.php';

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use Bitrix\Main\Config\Option;
?>


<div class="group/menu fixed inset-0 z-40 bg-black/50 transition-[opacity,_visibility] duration-100 [&[data-sidebar=close]]:invisible [&[data-sidebar=close]]:opacity-0"
     data-sidebar="close" data-sidebar-resize="lg" id="menu">
    <div class="flex flex-col gap-8 bg-white overflow-auto w-full max-w-[375px] h-full pt-4 pb-10 px-4 transition-[opacity,_visibility,_transform] duration-300 group-[[data-sidebar=close]]/menu:invisible group-[[data-sidebar=close]]/menu:opacity-0 group-[[data-sidebar=close]]/menu:-translate-x-full">
        <div class="flex items-center justify-between gap-4">
            <button class="btn rounded-full" data-sidebar-close="menu" data-waved="dark">
                <?php \lib\KitTPL::icon("{id: 'close', className: 'icon text-2xl', data: null}"); ?>
            </button>
            <a class="flex items-center shrink-0 mr-auto" draggable="false" href="">
                <div class="shrink-0 w-8 mr-2">
                    <?php \lib\KitTPL::picture("{src: '/img/pictures/logo', format: 'png', className: 'block w-full', data: null}"); ?>
                </div>
                <span class="font-alt font-extrabold uppercase text-1.5xl">БИО-сервис</span>
            </a>
            <a class="btn btn-primary btn-fill btn-light btn-sm shrink-0 text-sm" data-fancybox-form data-waved="light"
               draggable="false" href="/ajax/dialogs/dialog-feedback.php">Связаться</a>
        </div>
        <nav class="flex flex-col items-start gap-8">
            <? if (!empty($arResult)): ?>
                <? $arResult = getChildren($arResult) ?>
                <? foreach ($arResult as $arItem): ?>
                    <? if (!empty($arItem['CHILDREN'])): ?>
                        <div class="group/accordion w-full" data-accordion data-close-click>
                            <button class="flex items-center justify-between font-semibold underline-offset-4 hover:underline w-full"
                                    data-accordion-toggle>
                                <?= $arItem["TEXT"] ?>
                                <?php \lib\KitTPL::icon("{id: 'arrow-right', className: 'icon text-lg opacity-50 rotate-90 ml-2 transition-transform group-[[data-accordion=active]]/accordion:-rotate-90', data: null}"); ?>
                            </button>
                            <div data-accordion-content>
                                <div class="flex flex-col items-start gap-6 pt-6">
                                    <? if ($arItem["CHILDREN"]): ?>
                                        <? foreach ($arItem["CHILDREN"] as $arItemChild): ?>
                                            <a class="text-sm underline-offset-4 hover:underline" draggable="false"
                                               href="<?= $arItemChild["LINK"] ?>"><?= $arItemChild["TEXT"] ?></a>
                                        <? endforeach ?>
                                    <? endif ?>
                                </div>
                            </div>
                        </div>
                    <? endif ?>
                    <? if (empty($arItem['CHILDREN'])): ?>
                        <a class="font-semibold underline-offset-4 hover:underline" draggable="false"
                           href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    <? endif ?>
                <? endforeach ?>
            <? endif ?>
        </nav>
        <ul class="flex flex-col gap-8">
            <li class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">Время работы</span>
                <span class="font-alt font-extrabold text-1.5xl">09:00 - 18:00</span>
            </li>
            <li class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">По всем вопросам</span>
                <a class="font-alt font-extrabold text-1.5xl underline-offset-4 hover:underline" draggable="false"
                   href="tel: <?= Option::get("stdkit.settings", "main_phone"); ?>"><?= Option::get("stdkit.settings", "main_phone"); ?></a>
            </li>
            <li class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">Заказать машину</span>
                <a class="font-alt font-extrabold text-1.5xl underline-offset-4 hover:underline" draggable="false"
                   href="tel: <?= Option::get("stdkit.settings", "car_phone"); ?>"><?= Option::get("stdkit.settings", "car_phone"); ?></a>
            </li>
        </ul>
        <div class="flex items-center gap-8 mt-auto">
            <a class="btn btn-primary rounded-full" data-waved="light" draggable="false"
               href="<?= Option::get("stdkit.settings", "telegram"); ?>" target="_blank">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/telegram', format: 'svg', className: 'icon text-6xl', data: null}"); ?>
            </a>
            <a class="btn btn-primary rounded-full" data-waved="light" draggable="false"
               href="<?= Option::get("stdkit.settings", "whatsapp"); ?>" target="_blank">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/whatsapp', format: 'svg', className: 'icon text-6xl', data: null}"); ?>
            </a>
            <a class="btn btn-primary rounded-full" data-waved="light" draggable="false"
               href="<?= Option::get("stdkit.settings", "max"); ?>" target="_blank">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/max', format: 'svg', className: 'icon text-6xl', data: null}"); ?>
            </a>
        </div>
    </div>
</div>

