<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<section class="container xl:container-distance relative xl:rounded-5xl overflow-hidden xl:my-0">
    <div class="absolute inset-0 bg-gray rounded-inherit">
        <?php \lib\KitTPL::loader("{className: ''}");?>
        <picture>
            <source srcset="<?=SITE_TEMPLATE_PATH?>/img/pictures/rent-bg-desktop.webp" media="(min-width: 575.98px)" type="image/webp">
            <source srcset="<?=SITE_TEMPLATE_PATH?>/img/pictures/rent-bg-desktop.jpg" media="(min-width: 575.98px)">
            <source srcset="<?=SITE_TEMPLATE_PATH?>/img/pictures/rent-bg-mobile.webp" type="image/webp">
            <img class="image rounded-inherit" draggable="false" loading="lazy" src="<?=SITE_TEMPLATE_PATH?>/img/pictures/rent-bg-mobile.jpg" alt="">
        </picture>
    </div>
    <div class="flex flex-col relative">
        <div class="card bg-black/20 backdrop-blur-2xl text-white w-full lg:max-w-[720px]">
            <div class="card-content pt-4 sm:pt-8 lg:pt-12 pb-20 sm:pb-12 px-4 sm:px-8 lg:px-12">
                <?php \lib\KitTPL::subtitleSmall("{text: 'Аренда, продажа и обслуживание биотуалетов в Краснодаре', className: 'mb-4 sm:mb-6 lg:mb-8 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
                <div class="text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>
                    <p>
                        <b>Компания «БИО-СЕРВИС»</b> профилируется на продаже и услугах по аренде и обслуживанию мобильных туалетных кабин. Этот вид туалетных кабин не имеет себе аналогов по быстроте установки и эффективности.
                    </p>
                    <br>
                    <p>
                        <b>Компания «БИО-СЕРВИС» была основана в 2009 году</b>. За период работы на Краснодарском рынке, мы оказали услуги аренды мобильных туалетных кабин для большого количества мероприятий, связанных со скоплением большого количества людей — это мероприятия, проводимые по инициативе Администрации г. Краснодара и Краснодарского края, летние праздники, а также многие другие мероприятия, где требовалась организация качественного сервисного обслуживания (автогонки, выставки сельхозтехники на открытых площадках, ярмарки, дни города, свадьбы, корпоративные вечеринкина пляжах Черноморского побережья).
                    </p>
                </div>
            </div>
        </div>
        <div class="sm:hidden relative -mt-20 -mb-40">
            <?php \lib\KitTPL::picture("{src: '/img/pictures/rent-img', format: 'png', className: 'block w-full', data: null}");?>
        </div>
    </div>
</section>
