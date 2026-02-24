<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="container lg:pt-0">
    <div class="anim anim-up ease-in-out duration-700" data-anim>
        <div class="card rounded-tr-4xl rounded-bl-4xl rounded-tl-none rounded-br-none border border-solid border-gray overflow-visible">
            <div class="card-content lg:flex-row items-center lg:items-stretch lg:justify-between gap-4 sm:gap-8 lg:gap-11 lg:pt-4 pb-6 lg:pb-4 pl-4 sm:pl-7 lg:pl-10 pr-4">
                <div class="order-1 w-full max-w-36 -mt-6 lg:-mt-8 lg:-mb-4">
                    <div class="pack pack-[145] lg:pack-xl bg-gray">
                        <?php \lib\KitTPL::loader("{className: ''}"); ?>
                        <?php \lib\KitTPL::picture("{src: '/img/pictures/certificate-img', format: 'jpg', className: 'image lg:object-top', data: null}");?>
                    </div>
                    <?php \lib\KitTPL::shadow("{className: 'lg:hidden mt-2'}");?>
                </div>
                <h3 class="font-semibold text-center lg:text-left text-lg sm:text-xl lg:text-2xl order-3 lg:order-2 lg:my-auto">
                    Био-Сервис – официальный дилер холдинга «Экосервис-плюс»
                </h3>
                <div class="flex items-center justify-center bg-gradient-to-r from-chocolate-dark to-chocolate rounded-tr-3xl rounded-bl-3xl order-2 lg:order-3 shrink-0 h-8 px-4">
                    <span class="font-semibold text-white text-center text-sm">Официальный дилер</span>
                </div>
            </div>
        </div>
    </div>
</section>