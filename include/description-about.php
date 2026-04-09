<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="container overflow-hidden <?= $json['className'] ?>">
    <?php \lib\KitTPL::subtitle("{text: 'О компании', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
    <div class="description text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>
        <p>
            Основные направления нашей деятельности — аренда и продажа туалетных кабин, ассенизаторские услуги, а также регулярное обслуживание биотуалетов. Мы обеспечиваем своевременную доставку, установку и санитарную обработку оборудования, строго соблюдая все нормы и требования.</p>
        <br>
<p>
            За годы работы мы зарекомендовали себя как надежный и ответственный партнер для бизнеса и частных клиентов.
        </p>

    </div>
    <div class="my-8 sm:my-10" data-slider="gallery">
        <div class="swiper overflow-visible" data-slider-swiper="gallery">
            <div class="swiper-wrapper">
                <a class="swiper-slide pack pack-md bg-gray rounded-4xl" data-fancybox="gallery"
                   data-waved="light" draggable="false" href="/local/templates/main/img/pictures/index-desc-1.png">
                    <?php \lib\KitTPL::loader("{className: ''}"); ?>
                    <?php \lib\KitTPL::picture("{src: '/local/templates/main/img/pictures/index-desc-1.png', format: 'url', className: 'pack-image image rounded-inherit', data: null}"); ?>
                </a>
                <a class="swiper-slide pack pack-md bg-gray rounded-4xl" data-fancybox="gallery"
                   data-waved="light" draggable="false" href="/local/templates/main/img/pictures/index-desc-2.png">
                    <?php \lib\KitTPL::loader("{className: ''}"); ?>
                    <?php \lib\KitTPL::picture("{src: '/local/templates/main/img/pictures/index-desc-2.png', format: 'url', className: 'pack-image image rounded-inherit', data: null}"); ?>
                </a>
                <a class="swiper-slide pack pack-md bg-gray rounded-4xl" data-fancybox="gallery"
                   data-waved="light" draggable="false" href="/local/templates/main/img/pictures/index-desc-3.png">
                    <?php \lib\KitTPL::loader("{className: ''}"); ?>
                    <?php \lib\KitTPL::picture("{src: '/local/templates/main/img/pictures/index-desc-3.png', format: 'url', className: 'pack-image image rounded-inherit', data: null}"); ?>
                </a>
            </div>
        </div>
    </div>
    <div class="description text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>

        <p>
            «Био-Сервис» — это современный подход, собственный парк техники и команда специалистов, которая гарантирует качественное выполнение работ в кратчайшие сроки. Мы ценим доверие клиентов и стремимся к долгосрочному сотрудничеству.
        </p>
        
    </div>
</section>
