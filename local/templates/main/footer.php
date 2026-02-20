<? if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true )die(); ?>

<?
	use lib\Kit;
	use Bitrix\Main\Config\Option;
    $socials = [
            '/img/pictures/telegram',
            '/img/pictures/whatsapp',
            '/img/pictures/max',
    ];

    $nav = [
        [
                'title' => 'Навигация',
                'listing' => ['Главная', 'Продажа биотуалетов', 'Наши услуги', 'О компании', 'Новости', 'Контакты']
        ],
        [
                'title' => 'Продажа биотуалетов',
                'listing' => ['Биотуалет супер-эконом', 'Биотуалет Эконом', 'Биотуалет Стандарт', 'Биотуалет Евро']
        ],
        [
                'title' => 'Наши услуги',
                'listing' => ['Аренда биотуалетов', 'Обслуживание биотуалетов', 'Откачка выгребных ям и септиков', 'Ассенизаторские услуги']
        ],
    ];
?>

<footer class="container flex flex-col sm:flex-row sm:flex-wrap xl:flex-nowrap sm:justify-between gap-4 sm:gap-6 lg:gap-8 bg-gradient-to-r sm:bg-gradient-to-br from-green-dark to-green text-white sm:py-12 mt-auto">
    <div class="flex flex-col items-start border-b sm:border-none border-solid border-white/10 w-full sm:max-w-52 pb-4 sm:pb-0">
        <a class="flex items-center mb-4" draggable="false" href="">
            <div class="shrink-0 w-10 mr-3">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/logo', format: 'png', className: 'block w-full', data: null}");?>
            </div>
            <span class="font-alt font-extrabold uppercase text-3xl">БИО-сервис</span>
        </a>
        <p class="font-medium text-xs opacity-60 mb-6 sm:mb-4">
            Продажа, аренда и обслуживание туалетных кабин в Краснодаре и Краснодарском крае
        </p>
        <div class="flex items-center gap-4 mb-6 sm:mb-8 lg:mb-10">
            <?php foreach ($socials as $item): ?>
                <a class="btn btn-primary rounded-full" data-waved="light" draggable="false" href="" target="_blank">
                    <?php \lib\KitTPL::picture("{src: '{$item}', format: 'svg', className: 'icon text-5xl sm:text-3xl', data: null}"); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <a class="font-medium text-sm opacity-60 underline underline-offset-4 decoration-dotted transition-opacity hover:opacity-100 mb-6 sm:mb-8 lg:mb-10" draggable="false" href="">Политика конфиденциальности</a>
        <div class="font-medium text-sm opacity-60">
            © <span id="year"></span>
        </div>
    </div>
    <?php foreach ($nav as $item): ?>
    <div class="group/accordion border-b sm:border-none border-solid border-white/10 pb-4 sm:pb-0" data-accordion data-close-click>
        <button class="flex items-center justify-between sm:pointer-events-none w-full" data-accordion-toggle>
            <h4 class="font-alt font-extrabold uppercase text-xl"><?= $item['title'] ?></h4>
            <?php \lib\KitTPL::icon("{id: 'arrow-right', className: 'icon sm:hidden text-2xl rotate-90 ml-2 transition-transform group-[[data-accordion=active]]/accordion:-rotate-90', data: null}");?>
        </button>
        <div class="sm:!h-auto" data-accordion-content>
            <nav class="flex flex-col items-start gap-4 pt-4 sm:pt-6 lg:pt-8">
                <? for ($i = 0; $i < $item['listing']['length']; $i++):?>
                    <a class="text-sm underline-offset-4 hover:underline" draggable="false" href=""><?= $item['listing'][$i] ?></a>
                <?endfor;?>
            </nav>
        </div>
    </div>
    <?endforeach;?>
    <div class="flex flex-col items-start w-full sm:max-w-52">
        <h4 class="font-alt font-extrabold uppercase text-xl mb-4 sm:mb-6 lg:mb-8">
            Контакты
        </h4>
        <address class="font-medium text-xs mb-4">
            Краснодарский край, г.Краснодар, ул. им. Калинина, д. 1
        </address>
        <a class="font-semibold text-sm underline-offset-4 hover:underline mb-4" draggable="false" href="mailto: a2101914@yandex.ru">a2101914@yandex.ru</a>
        <ul class="flex flex-col gap-4">
            <li class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">Время работы</span>
                <span class="font-extrabold">09:00 - 18:00</span>
            </li>
            <li class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">По всем вопросам</span>
                <a class="font-extrabold underline-offset-4 hover:underline" draggable="false" href="tel: <?=Option::get("stdkit.settings", "main_phone");?>"><?=Option::get("stdkit.settings", "main_phone");?></a>
            </li>
            <li class="flex flex-col items-start">
                <span class="font-medium text-xs opacity-60">Заказать машину</span>
                <a class="font-extrabold underline-offset-4 hover:underline" draggable="false" href="tel: <?=Option::get("stdkit.settings", "car_phone");?>"><?=Option::get("stdkit.settings", "car_phone");?></a>
            </li>
        </ul>
    </div>
</footer>


<!-- Куки -->
<?php if ($_COOKIE['cookie_cookie_active'] != 1): ?>
<section class="container fixed bottom-4 lg:bottom-10 left-0 right-0 z-20 py-0" data-cookie data-expires="7" id="cookie">
    <div class="card bg-white rounded-2xl sm:rounded-3xl shadow-md w-full xl:max-w-5xl xl:mx-auto">
        <div class="card-content items-start p-4 sm:p-6">
            <p class="text-sm sm:text-base opacity-80 mb-4">
                Этот веб-сайт использует файлы cookie, чтобы обеспечить удобную работу пользователей с ним и функциональные возможности сайта. Продолжая использовать этот сайт, Вы соглашаетесь с использованием файлов cookie
            </p>
            <button class="btn btn-primary btn-fill btn-light btn-md sm:btn-lg text-sm sm:text-base" data-cookie-button data-waved="light">Согласен</button>
        </div>
    </div>
</section>
<?php endif;?>

</main>

</body>

</html>