<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="container pt-0">
    <div class="card text-white rounded-none sm:rounded-5xl -mx-4 sm:mx-0">
        <div class="absolute inset-0 bg-gray rounded-inherit">
            <?php \lib\KitTPL::loader("{className: ''}");?>
            <picture>
                <source srcset="<?=SITE_TEMPLATE_PATH?>/img/pictures/discount-bg-desktop.webp" media="(min-width: 575.98px)" type="image/webp">
                <source srcset="<?=SITE_TEMPLATE_PATH?>/img/pictures/discount-bg-desktop.jpg" media="(min-width: 575.98px)">
                <source srcset="<?=SITE_TEMPLATE_PATH?>/img/pictures/discount-bg-mobile.webp" type="image/webp">
                <img class="image rounded-inherit" draggable="false" loading="lazy"
                     src="<?=SITE_TEMPLATE_PATH?>/img/pictures/discount-bg-mobile.jpg" alt="">
            </picture>
        </div>
        <div class="card-content relative pt-8 sm:pt-10 lg:pt-12 pb-80 sm:pb-10 lg:pb-12 px-4 sm:px-8 lg:px-12">
            <div class="w-full md:max-w-lg">
                <?php \lib\KitTPL::subtitle("{text: 'Получите скидку', className: 'mb-3 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
                <h3 class="font-semibold uppercase text-xl sm:text-2xl mb-6 sm:mb-8 anim anim-up ease-in-out duration-700"
                    data-anim>
                    На аренду и обслуживание биотуалета
                </h3>
                <div class="bg-black/20 rounded-3xl w-full md:max-w-[480px] p-4 sm:p-6">
                    <h4 class="font-semibold text-1.5xl mb-6">
                        Оставить заявку
                    </h4>
                    <form data-form="submit" action="/ajax/php/submit-handler.php">
                        <input type="hidden" value="Тема" name="theme">
                        <div class="flex flex-col gap-4 mb-6">
                            <label data-label>
                                <h5 class="font-medium mb-2">
                                    Ваше имя
                                </h5>
                                <div class="relative">
                                    <input class="input input-white input-fade input-lg" data-input="name" type="text"
                                           name="name">
                                    <?php \lib\KitTPL::error("{text: 'Введите ваше имя'}");?>
                                </div>
                            </label>
                            <label data-label>
                                <h5 class="font-medium mb-2">
                                    Ваш телефон
                                </h5>
                                <div class="relative">
                                    <input class="input input-white input-fade input-lg" data-input="tel" type="tel"
                                           placeholder="+7 (___) ___-__-__" name="tel">
                                    <?php \lib\KitTPL::error("{text: 'Введите ваш номер'}");?>
                                </div>
                            </label>
                        </div>
                        <div class="flex mb-6">
                            <button class="btn btn-white btn-fill btn-lg text-black" data-waved="dark" type="submit">
                                Отправить заявку
                            </button>
                        </div>
                        <div class="flex items-center">
                            <input class="switch switch-checkbox mr-2" data-toggle-submit type="checkbox">
                            <p class="text-xxs opacity-70">
                                Согласие на обработку <a class="underline underline-offset-4" data-fancybox-dialog
                                                         draggable="false" href="/ajax/dialogs//dialog-politics.php">персональных
                                    данных</a> на условиях <a class="underline underline-offset-4" draggable="false"
                                                              href="" target="_blank">политики конфиденциальности</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>