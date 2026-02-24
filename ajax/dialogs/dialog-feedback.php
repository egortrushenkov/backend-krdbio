<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<dialog class="w-full max-w-lg bg-white text-black rounded-4xl sm:rounded-5xl py-10 sm:py-12 px-4 sm:px-6 lg:px-8">
    <?php \lib\KitTPL::subtitleSmall("{text: 'Нужна консультация по аренде или покупке?', className: 'mb-4', data: null}");?>
    <p class="font-semibold text-xl sm:text-2xl mb-4 sm:mb-8 lg:mb-12">
        Свяжитесь с нами удобным для вас способом
    </p>
    <form data-form="submit">
        <input type="hidden" value="Тема" name="theme">
        <div class="flex flex-col gap-4 mb-6">
            <label data-label>
                <h5 class="font-medium mb-2">
                    Ваше имя
                </h5>
                <div class="relative">
                    <input class="input input-gray input-lg" data-input="name" type="text" name="name">
                    <?php \lib\KitTPL::error("{text: 'Введите ваше имя'}");?>
                </div>
            </label>
            <label data-label>
                <h5 class="font-medium mb-2">
                    Ваш телефон
                </h5>
                <div class="relative">
                    <input class="input input-gray input-lg" data-input="tel" type="tel"
                           placeholder="+7 (___) ___-__-__" name="tel">
                    <?php \lib\KitTPL::error("{text: 'Введите ваш номер'}");?>
                </div>
            </label>
        </div>
        <div class="flex mb-6">
            <button class="btn btn-primary btn-fill btn-light btn-lg" data-waved="dark" type="submit">Отправить заявку
            </button>
        </div>
        <div class="flex items-center">
            <input class="switch switch-checkbox mr-2" data-toggle-submit type="checkbox">
            <p class="text-xxs opacity-70">
                Согласие на обработку <a class="underline underline-offset-4" data-fancybox-dialog draggable="false"
                                         href="/ajax/dialogs//dialog-politics.php">персональных данных</a> на условиях <a
                        class="underline underline-offset-4" draggable="false" href="" target="_blank">политики
                    конфиденциальности</a>
            </p>
        </div>
    </form>
    <div class="mt-6 sm:mt-9 lg:mt-12">
        <h3 class="font-medium mb-4">
            Или напишите нам, мы всегда онлайн
        </h3>
        <div class="grid sm:grid-cols-3 gap-2 sm:gap-4">
            <a class="btn btn-primary btn-fade btn-md text-black pl-0.5 pr-4" data-waved="dark"
               draggable="false" href="" target="_blank">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/telegram', format: 'svg', className: 'icon text-4xl', data: null}"); ?>
                <span class="text-sm mx-auto">Telegram</span>
            </a>
            <a class="btn btn-primary btn-fade btn-md text-black pl-0.5 pr-4" data-waved="dark"
               draggable="false" href="" target="_blank">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/whatsapp', format: 'svg', className: 'icon text-4xl', data: null}"); ?>
                <span class="text-sm mx-auto">WhatsApp</span>
            </a>
            <a class="btn btn-primary btn-fade btn-md text-black pl-0.5 pr-4" data-waved="dark"
               draggable="false" href="" target="_blank">
                <?php \lib\KitTPL::picture("{src: '/img/pictures/max', format: 'svg', className: 'icon text-4xl', data: null}"); ?>
                <span class="text-sm mx-auto">MAX</span>
            </a>
        </div>
    </div>
</dialog>