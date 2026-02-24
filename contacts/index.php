<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Продажа туалетных кабин");
?>

<?
use lib\Kit;
use Bitrix\Main\Config\Option;
?>

<section class="container">
    <?php \lib\KitTPL::title("{text: 'Контакты', className: 'mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
    <div class="card xl:flex-row xl:items-center xl:justify-between gap-4 border border-solid border-gray pt-4 pb-12 xl:pb-4 pl-4 xl:pl-12 pr-4">
        <div class="card-content order-2 xl:order-1 w-full xl:max-w-[485px] px-4 xl:px-0">
            <ul class="flex flex-col gap-8">
                <li class="flex flex-col items-start">
                    <span class="font-medium text-sm sm:text-base opacity-60 mb-1">Адрес</span>
                    <address class="font-alt font-extrabold text-xl sm:text-1.5xl">
                        Краснодарский край, г. Краснодар, ул. им. Калинина, д. 1
                    </address>
                </li>
                <li class="flex flex-col items-start">
                    <span class="font-medium text-sm sm:text-base opacity-60 mb-1">E-mail</span>
                    <a class="font-alt font-extrabold text-xl sm:text-1.5xl underline-offset-4 hover:underline" draggable="false" href="mailto: <?=Option::get("stdkit.settings", "email");?>"><?=Option::get("stdkit.settings", "email");?></a>
                </li>
                <li class="flex flex-col items-start">
                    <span class="font-medium text-sm sm:text-base opacity-60 mb-1">По всем вопросам</span>
                    <a class="font-alt font-extrabold text-xl sm:text-1.5xl underline-offset-4 hover:underline" draggable="false" href="tel: <?=Option::get("stdkit.settings", "main_phone");?>"><?=Option::get("stdkit.settings", "main_phone");?></a>
                </li>
                <li class="flex flex-col items-start">
                    <span class="font-medium text-sm sm:text-base opacity-60 mb-1">Заказать машину</span>
                    <a class="font-alt font-extrabold text-xl sm:text-1.5xl underline-offset-4 hover:underline" draggable="false" href="tel: <?=Option::get("stdkit.settings", "car_phone");?>"><?=Option::get("stdkit.settings", "car_phone");?></a>
                </li>
            </ul>
            <div class="flex items-center gap-8 xl:gap-4 mt-8">
                <a class="btn btn-primary rounded-full" data-waved="light" draggable="false" href="<?=Option::get("stdkit.settings", "telegram");?>" target="_blank">
                    <?php \lib\KitTPL::picture("{src: '/img/pictures/telegram', format: 'svg', className: 'icon text-5xl xl:text-3xl', data: null}");?>
                </a>
                <a class="btn btn-primary rounded-full" data-waved="light" draggable="false" href="<?=Option::get("stdkit.settings", "whatsapp");?>" target="_blank">
                    <?php \lib\KitTPL::picture("{src: '/img/pictures/whatsapp', format: 'svg', className: 'icon text-5xl xl:text-3xl', data: null}");?>
                </a>
                <a class="btn btn-primary rounded-full" data-waved="light" draggable="false" href="<?=Option::get("stdkit.settings", "max");?>" target="_blank">
                    <?php \lib\KitTPL::picture("{src: '/img/pictures/max', format: 'svg', className: 'icon text-5xl xl:text-3xl', data: null}");?>
                </a>
            </div>
        </div>
        <div class="order-1 xl:order-2 w-full lg:max-w-[600px]">
            <div class="pack pack-[65] bg-gray rounded-3xl">
                <?php \lib\KitTPL::loader("{className: ''}");?>
                <?php \lib\KitTPL::picture("{src: '/img/pictures/feedback-bg', format: 'jpg', className: 'image rounded-inherit', data: null}");?>
                <div class="flex items-center justify-center absolute inset-0 bg-black/20 rounded-inherit p-4">
                    <div class="shrink-0 w-16 mr-4">
                        <?php \lib\KitTPL::picture("{src: '/img/pictures/logo', format: 'png', className: 'block w-full', data: null}");?>
                    </div>
                    <span class="font-alt font-extrabold uppercase text-white text-3xl">БИО-сервис</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Карта -->
<?php \lib\KitTPL::map();?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>