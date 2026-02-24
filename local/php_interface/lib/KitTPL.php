<?php

namespace lib;

use lib\Kit;
use Bitrix\Main\Config\Option;


class KitTPL
{
    public static function __callStatic($method, $args)
    {
        // Проверяем, существует ли приватный метод с префиксом "_"
        $privateMethod = "_" . $method;
        if (method_exists(__CLASS__, $privateMethod)) {
            // Автоматически конвертируем первый аргумент, если он строка
            if (isset($args[0]) && is_string($args[0])) {
                $args[0] = self::parseStringToObject($args[0]);
            }
            return call_user_func_array([__CLASS__, $privateMethod], $args);
        } else {
            throw new \BadMethodCallException("Метод {$method} не найден в " . __CLASS__);
        }
    }

    public static function parseStringToObject($input)
    {
        // Приводим строку к валидному JSON
        $json = preg_replace_callback('/(\w+):\s*(\'[^\']*\'|[^\s,}]+)/', function ($matches) {
            $key = $matches[1];
            $value = trim($matches[2]);

            // Убираем одинарные кавычки, если это строка
            if ($value[0] === "'" && $value[strlen($value) - 1] === "'") {
                $value = '"' . substr($value, 1, -1) . '"';
            } elseif (!in_array($value, ['null', 'true', 'false']) && !is_numeric($value)) {
                // Если это не ключевые слова или число, то оборачиваем в кавычки
                $value = '"' . addslashes($value) . '"';
            }

            return '"' . $key . '":' . $value;
        }, $input);

        $json = str_replace("'", '"', $json);
        $data = json_decode($json, true);

        if ($data === null) {
            throw new \Exception("Ошибка парсинга JSON: " . json_last_error_msg());
        }

        return $data;
    }

    public static function _back()
    {
        ?>
        <div class="flex mb-6 sm:mb-8 lg:mb-10">
            <a class="btn btn-white btn-fill btn-lg text-black w-12 sm:w-auto px-0 sm:px-6" data-waved="dark"
               draggable="false" href="/">
                <? self::_icon(self::parseStringToObject("{id: 'arrow-back', className: 'icon text-2xl', data: null}")); ?>
                <span class="hidden sm:block ml-2">Назад</span>
            </a>
        </div>
        <?php
    }

    public static function _error($json)
    {
        ?>
        <span class="flex items-center justify-center absolute -bottom-4 left-0 right-0 bg-red text-white text-center text-xs rounded-md invisible opacity-0 transition-[opacity,_visibility] h-4"
              data-error><?= $json['text'] ?></span>
        <?php
    }

    public static function _icon($json)
    {
        ?>
        <svg class="<?= $json['className'] ?>" <?= $json['data'] ?>>
            <use href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#<?= $json['id'] ?>"></use>
        </svg>
        <?php
    }

    private static function _loader($json)
    {
        ?>
        <div class="loader <?= $json['className'] ?>" data-loader>
          <span class="loader-progress">
              <? self::_icon(self::parseStringToObject("{id: 'loader', className: 'loader-icon icon', data: null}")); ?>
          </span>
        </div>
        <?php
    }

    private static function _picture($json)
    {
        $src = $json['src'];
        $format = $json['format'] ?: 'url';
        if ($format != 'url') $src = SITE_TEMPLATE_PATH . "/" . $src;
        $className = $json['className'] ?: "";
        $data = $json['data'] ?: false;
        $alt = $json['alt'] ?? "";
        $block_webp = $json['block_webp'] ?? "";

        switch ($format) {
            case 'jpg':
                $loading = 'lazy';
                break;
            case 'png':
                $loading = 'eager';
                break;
            default:
                $loading = false;
                break;
        }

        // Генерация webp для локальных картинок в режиме url
        $webpSrc = false;
        if ($format === 'url' && $src !== '' && str_starts_with($src, '/')) {
            if (function_exists('makeWebp')) {
                $generated = makeWebp($src);
                if ($generated) {
                    $webpSrc = $generated;
                }
            }
        }
        ?>
        <picture>
            <? if ($src !== '' && ($format === 'jpg' || $format === 'png')) { ?>
                <source srcset="<?= $src ?>.webp" type="webp">
            <? } elseif ($format === 'url' && $webpSrc && !$block_webp) { ?>
                <source srcset="<?= $webpSrc ?>" type="webp">
            <? } ?>
            <img class="<?= $className ?>" <?= $data ? $data : '' ?> draggable="false" <? if ($loading){
            ?>loading="<?= $loading ?>"<?
            } ?> src="<?= $format !== 'url' ? $src . "." . $format : $src ?>"
                 alt="<?= htmlspecialchars($alt, ENT_QUOTES) ?>">
        </picture>
        <?php
    }

    private static function _preloader()
    {
        ?>
        <div class="flex flex-col items-center w-full max-w-52 animate-bounce">
            <div class="w-full mb-7">
                <? self::_picture(self::parseStringToObject("{src: '/img/pictures/preloader', format: 'png', className: 'block w-full', data: null}")); ?>
            </div>
            <span class="font-alt font-bold uppercase text-white text-center text-3xl">Секундочку...</span>
        </div>
        <?php
    }

    private static function _price($json)
    {
        ?>
        <div class="flex items-center justify-center bg-gradient-to-r from-blue-dark to-blue rounded-tr-5xl rounded-bl-5xl h-14 sm:h-16 px-10 <?= $json['className'] ?>" <?= $json['data'] ?> >
            <span class="font-semibold text-center text-xl sm:text-2xl">Цена ОТ <?= $json['price']?> ₽</span>
        </div>
        <?php
    }

    private static function _shadow($json)
    {
        ?>
        <div class="bg-black opacity-50 rounded-full blur h-0.5 <?= $json['className'] ?>"></div>
        <?php
    }

    private static function _subtitle($json)
    {
        ?>
        <h2 class="font-alt font-extrabold uppercase text-4xl/tight sm:text-5xl/tight lg:text-6xl/tight <?= $json['className'] ?>" <?= $json['data'] ?>><?= $json['text'] ?></h2>
        <?php
    }

    private static function _subtitleSmall($json)
    {
        ?>
        <h2 class="font-alt font-extrabold uppercase text-2xl/tight sm:text-3xl/tight lg:text-4xl/tight xl:text-subtitle/tight <?= $json['className'] ?>" <?= $json['data'] ?>><?= $json['text'] ?></h2>
        <?php
    }

    private static function _swiperButtonPrev($json)
    {
        ?>
        <button class="swiper-button-prev btn btn-gray btn-fill absolute text-black text-xs sm:text-base rounded-full size-8 sm:size-10 <?= $json['className'] ?>"
                data-slider-prev="<?= $json['value'] ?>" data-waved="dark">
            <? self::_icon(self::parseStringToObject("{id: 'arrow-left', className: null, data: null}")); ?>
        </button>
        <?php
    }

    private static function _swiperButtonNext($json)
    {
        ?>
        <button class="swiper-button-next btn btn-gray btn-fill absolute text-black text-xs sm:text-base rounded-full size-8 sm:size-10 <?= $json['className'] ?>"
                data-slider-next="<?= $json['value'] ?>" data-waved="dark">
            <? self::_icon(self::parseStringToObject("{id: 'arrow-right', className: null, data: null}")); ?>
        </button>
        <?php
    }

    private static function _swiperPagination($json)
    {
        ?>
        <div class="swiper-pagination <?= $json['className'] ?>" data-slider-pagination="<?= $json['value'] ?>"></div>
        <?php
    }

    private static function _cardService($json)
    {
        ?>
        <div class="card border border-solid border-gray">
            <a class="pack pack-[65] bg-gray rounded-t-inherit" data-waved="light" draggable="false" href="">

                <? self::_loader(self::parseStringToObject("{className: ''}")); ?>
                <? self::_picture(self::parseStringToObject("{src: '".$json['src']."', format: 'url', className: 'pack-image image rounded-t-inherit', data: null}")); ?>
            </a>
            <div class="card-content p-4 sm:p-6">
                <h4 class="font-semibold text-1.5xl sm:text-2xl mb-1 sm:mb-3">
                    <?=$json['title']?>
                </h4>
                <p class="text-sm sm:text-base opacity-80 line-clamp-6 mb-4 sm:mb-6">
                    <?=$json['text']?>
                </p>
                <? if (!empty($json['price']) || !empty($json['btn'])): ?>
                    <div class="flex flex-col gap-4 sm:gap-6 mt-auto">

                        <? if (!empty($json['price'])): ?>
                            <div class="font-semibold text-1.5xl sm:text-2xl">От 1800 ₽/сут</div>
                        <? endif; ?>

                        <? if (!empty($json['btn'])): ?>
                            <a class="btn btn-primary btn-fill btn-light btn-lg swiper-no-swiping" data-waved="light"
                               draggable="false" href="/services/<?=$json['linkBtn']?>">Подробнее</a>
                        <? endif; ?>

                    </div>
                <? endif; ?>
            </div>
        </div>
        <?php
    }

    private static function _die(string $variant)
    {
        $die = [
                'new'      => ['gradient' => 'from-lime-dark to-lime',           'text' => 'Новинка'],
                'chocolate' => ['gradient' => 'from-chocolate-dark to-chocolate', 'text' => 'Лидер продаж'],
                'crimson'   => ['gradient' => 'from-crimson-dark to-crimson',     'text' => 'Лучшее качество'],
                'sky'       => ['gradient' => 'from-sky-dark to-sky',             'text' => 'Акция'],
        ];

        if (!isset($die[$variant])) return;

        $gradient = $die[$variant]['gradient'];
        $text     = $die[$variant]['text'];
        ?>
        <div class="flex items-center justify-center absolute top-2 sm:top-4 left-2 sm:left-4 bg-gradient-to-r rounded-tl-3xl rounded-br-3xl w-full sm:w-auto max-w-32 sm:max-w-none h-8 px-2 sm:px-5 <?= $gradient ?>">
            <span class="font-semibold uppercase text-white text-center text-xs sm:text-sm"><?= htmlspecialchars($text) ?></span>
        </div>
        <?php
    }

    private static function _description($json)
    {
        ?>
        <section class="container overflow-hidden <?= $json['className'] ?>">
            <?php \lib\KitTPL::subtitle("{text: '" . $json['text'] . "', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
            <div class="description text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>
                <p>
                    Мы предлагаем краткосрочную и долгосрочную аренду биотуалетов, а также их обслуживание в Краснодаре
                    и Краснодарском крае. Купить биотуалет для кратковременного использования на строительных площадках
                    и мероприятиях на открытом воздухе не является выгодней, чем его аренда.
                </p>
                <br>
                <h4>
                    Аренда биотуалета включает в себя:
                </h4>
                <br>
                <ul>
                    <li>
                        доставку и установку биотуалета;
                    </li>
                    <li>
                        заправку биожидкостью;
                    </li>
                    <li>
                        для обеспечения нормальной санитарно-эпидемиологической ситуации, транспортировка отходов
                        производиться на сливную станцию, имеющую соответствующие разрешения на сбор, использование,
                        обезвреживание и размещение отходов;
                    </li>
                    <li>
                        демонтаж и вывоз биотуалета после окончания аренды.
                    </li>
                </ul>
            </div>
            <div class="my-8 sm:my-10" data-slider="gallery">
                <div class="swiper overflow-visible" data-slider-swiper="gallery">
                    <div class="swiper-wrapper">
                        <a class="swiper-slide pack pack-md bg-gray rounded-4xl" data-fancybox="gallery"
                           data-waved="light" draggable="false" href="<?= $json['image1'] ?>">
                            <?php \lib\KitTPL::loader("{className: ''}"); ?>
                            <?php \lib\KitTPL::picture("{src: '" . $json['image1'] . "', format: 'url', className: 'pack-image image rounded-inherit', data: null}"); ?>
                        </a>
                        <a class="swiper-slide pack pack-md bg-gray rounded-4xl" data-fancybox="gallery"
                           data-waved="light" draggable="false" href="<?= $json['image1'] ?>">
                            <?php \lib\KitTPL::loader("{className: ''}"); ?>
                            <?php \lib\KitTPL::picture("{src: '" . $json['image2'] . "', format: 'url', className: 'pack-image image rounded-inherit', data: null}"); ?>
                        </a>
                        <a class="swiper-slide pack pack-md bg-gray rounded-4xl" data-fancybox="gallery"
                           data-waved="light" draggable="false" href="<?= $json['image1'] ?>">
                            <?php \lib\KitTPL::loader("{className: ''}"); ?>
                            <?php \lib\KitTPL::picture("{src: '" . $json['image3'] . "', format: 'url', className: 'pack-image image rounded-inherit', data: null}"); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="description text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>
                <h4>
                    Аренда биотуалетов в Краснодаре
                </h4>
                <br>
                <p>
                    Аренда биотуалетов в Краснодаре Дни города, свадьбы, корпоративные вечеринки на пляжах Черноморского
                    побережья, дни рождения на свежем воздухе).Это было бы невозможно, не обладай компания большим
                    парком туалетных кабин, наличием спецтехники и огромного желания быть нужными и полезными. Дни
                    города, свадьбы, корпоративные вечеринки на пляжах Черноморского побережья, дни рождения на свежем
                    воздухе).Это было бы невозможно, не обладай компания большим парком туалетных кабин, наличием
                    спецтехники и огромного желания быть нужными и полезными.
                </p>
                <br>
                <p>
                    <b>Это было бы невозможно, не обладай компания большим парком туалетных кабин, наличием спецтехники
                        и огромного желания быть нужными и полезными.</b>
                </p>
            </div>
        </section>
        <?php
    }

    private static function _cardProduct($json)
    {
        ?>
        <div class="card border border-solid border-gray">
            <a class="pack pack-xl bg-gray rounded-t-inherit" data-waved="dark" draggable="false" href="">
                <?php \lib\KitTPL::_loader(self::parseStringToObject("{className: ''}")); ?>;?>
                <?php \lib\KitTPL::_picture(self::parseStringToObject("{src: '/img/pictures/test', format: 'jpg', className: 'pack-image image rounded-t-inherit', data: null}")); ?>
                <?php \lib\KitTPL::_die(self::parseStringToObject($json['variant'])); ?>
            </a>
            <div class="card-content p-2 sm:p-4 lg:p-6">
                <h3 class="font-normal text-sm sm:text-base">
                    Супер-Эконом
                </h3>
                <? if (!empty($json['buy'])) { ?>
                    <div class="font-semibold text-xl sm:text-2xl mt-1 sm:mt-2 mb-3 sm:mb-6">
                        От 24 000 ₽
                    </div>
                    <div class="flex flex-col sm:flex-row items-center justify-center sm:gap-1 bg-blue/10 text-center text-sm sm:text-base rounded-tl-4xl rounded-br-4xl h-12 sm:h-10 px-2 sm:px-4 mb-2">
                        В аренду <span class="font-medium">от 4 000 ₽/мес</span>
                    </div>
                <? } else { ?>
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 mt-4 mb-4 sm:mb-6">
                        <div class="flex flex-col">
                            <span class="text-sm sm:text-base">Посуточно</span>
                            <span class="font-semibold sm:text-xl lg:text-2xl">4 000 ₽</span>
                        </div>
                        <span class="hidden sm:block shrink-0 bg-gray w-px"></span>
                        <div class="flex flex-col">
                            <span class="text-sm sm:text-base">В месяц</span>
                            <span class="font-semibold sm:text-xl lg:text-2xl">14 000 ₽</span>
                        </div>
                    </div>
                <? } ?>
                <a class="btn btn-primary btn-fill btn-light btn-lg mt-auto" data-fancybox-form data-waved="light"
                   draggable="false"
                   href="/dialogs/dialog-feedback.html"><?= $json['buy'] ? 'Купить' : 'Арендовать' ?></a>
            </div>
        </div>
        <?php
    }

    private static function _title($json)
    {
        ?>
        <h1 class="font-alt font-extrabold uppercase text-4xl/tight sm:text-5xl/tight lg:text-6xl/tight <?= $json['className'] ?>" <?= $json['data'] ?>><?= $json['text'] ?></h1>
        <?php
    }

    private static function _feedback($json)
    {
        ?>
        <section class="container xl:container-distance relative xl:rounded-5xl max-sm:pb-72 xl:my-0">
            <div class="absolute inset-0 bg-gray rounded-inherit">
                <?php \lib\KitTPL::loader("{className: ''}"); ?>
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-desktop.webp"
                            media="(min-width: 575.98px)" type="image/webp">
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-desktop.jpg"
                            media="(min-width: 575.98px)">
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-mobile.webp"
                            type="image/webp">
                    <img class="image rounded-inherit" draggable="false" loading="lazy"
                         src="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-mobile.jpg" alt="">
                </picture>
            </div>
            <div class="card bg-white sm:rounded-5xl w-full sm:max-w-lg">
                <div class="card-content py-6 sm:py-9 lg:py-12 px-4 sm:px-6 lg:px-8">
                    <?php \lib\KitTPL::subtitleSmall("{text: '" . $json['title'] . "', className: 'mb-4 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
                    <p class="font-semibold text-xl sm:text-2xl mb-4 sm:mb-8 lg:mb-12 anim anim-up ease-in-out duration-700"
                       data-anim><?= $json['text'] ?>></p>
                    <form data-form="submit" action="/ajax/php/submit-handler.php">
                        <input type="hidden" value="Тема" name="theme">
                        <div class="flex flex-col gap-4 mb-6">
                            <label data-label>
                                <h5 class="font-medium mb-2">
                                    Ваше имя
                                </h5>
                                <div class="relative">
                                    <input class="input input-gray input-lg" data-input="name" type="text" name="name">
                                    <?php \lib\KitTPL::error("{text: 'Введите ваше имя'}"); ?>
                                </div>
                            </label>
                            <label data-label>
                                <h5 class="font-medium mb-2">
                                    Ваш телефон
                                </h5>
                                <div class="relative">
                                    <input class="input input-gray input-lg" data-input="tel" type="tel"
                                           placeholder="+7 (___) ___-__-__" name="tel">
                                    <?php \lib\KitTPL::error("{text: 'Введите ваш номер'}"); ?>
                                </div>
                            </label>
                        </div>
                        <div class="flex mb-6">
                            <button class="btn btn-primary btn-fill btn-light btn-lg" data-waved="dark" type="submit">
                                Отправить заявку
                            </button>
                        </div>
                        <div class="flex items-center">
                            <input class="switch switch-checkbox mr-2" data-toggle-submit type="checkbox">
                            <p class="text-xxs opacity-70">
                                Согласие на обработку <a class="underline underline-offset-4" data-fancybox-dialog
                                                         draggable="false" href="/ajax/dialogs//dialog-politics.php">персональных
                                    данных</a> на условиях <a class="underline underline-offset-4" draggable="false"
                                                              href="/privacy/"
                                                              target="_blank">политики конфиденциальности</a>
                            </p>
                        </div>
                        <input type="hidden" name="theme" value="<?= $json['theme'] ?>">
                    </form>
                    <div class="mt-6 sm:mt-9 lg:mt-12">
                        <h3 class="font-medium mb-4">
                            Или напишите нам, мы всегда онлайн
                        </h3>
                        <div class="grid sm:grid-cols-3 gap-2 sm:gap-4">
                            <a class="btn btn-primary btn-fade btn-md text-black pl-0.5 pr-4" data-waved="dark"
                               draggable="false" href="<?= Option::get("stdkit.settings", "telegram"); ?>"
                               target="_blank">
                                <?php \lib\KitTPL::picture("{src: '/img/pictures/telegram', format: 'svg', className: 'icon text-4xl', data: null}"); ?>
                                <span class="text-sm mx-auto">Telegram</span>
                            </a>
                            <a class="btn btn-primary btn-fade btn-md text-black pl-0.5 pr-4" data-waved="dark"
                               draggable="false" href="<?= Option::get("stdkit.settings", "whatsapp"); ?>"
                               target="_blank">
                                <?php \lib\KitTPL::picture("{src: '/img/pictures/whatsapp', format: 'svg', className: 'icon text-4xl', data: null}"); ?>
                                <span class="text-sm mx-auto">WhatsApp</span>
                            </a>
                            <a class="btn btn-primary btn-fade btn-md text-black pl-0.5 pr-4" data-waved="dark"
                               draggable="false" href="<?= Option::get("stdkit.settings", "max"); ?>" target="_blank">
                                <?php \lib\KitTPL::picture("{src: '/img/pictures/max', format: 'svg', className: 'icon text-4xl', data: null}"); ?>
                                <span class="text-sm mx-auto">MAX</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    private static function _primal($json)
    {
        ?>
        <section
                class="container container xl:container-distance sm:flex items-center relative xl:rounded-5xl min-h-[610px] sm:min-h-[700px] lg:min-h-[800px] xl:my-0">
            <div class="absolute inset-0 bg-gray rounded-inherit">
                <?php \lib\KitTPL::loader("{className: ''}"); ?>
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-desktop.webp"
                            media="(min-width: 575.98px)"
                            type="image/webp">
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-desktop.jpg"
                            media="(min-width: 575.98px)">
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-mobile.webp"
                            type="image/webp">
                    <img class="image rounded-inherit" draggable="false" loading="lazy"
                         src="<?= SITE_TEMPLATE_PATH ?>/img/pictures/<?= $json['bg'] ?>-bg-mobile.jpg" alt="">
                </picture>
            </div>
            <div class="flex flex-col items-start relative text-white w-full">
                <?php \lib\KitTPL::title("{text: '" . $json['text'] . "', className: '[&>br]:hidden sm:[&>br]:block clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>

                <? if (!empty($json['description'])): ?>
                    <p class="font-semibold sm:text-lg lg:text-xl mt-4 sm:mt-6 [&>br]:hidden sm:[&>br]:block anim anim-up ease-in-out duration-700"
                       data-anim><?= $json['description'] ?></p>
                <? endif; ?>

                <? if ($json['cost'] === 'true'): ?>
                    <?php \lib\KitTPL::price("{className: 'mt-4 sm:mt-6 anim anim-up ease-in-out duration-700', data: 'data-anim'}"); ?>
                <? endif; ?>

                <? if ($json['listing'] === 'true'): ?>
                    <ul class="flex flex-col gap-2 sm:gap-4 font-semibold sm:text-lg lg:text-xl mt-4 sm:mt-8 lg:mt-12 anim anim-up ease-in-out duration-700"
                        data-anim>
                        <li class="flex items-center">
                            <div class="relative mr-2">
                                <span class="absolute inset-2 bg-white"></span>
                                <?php \lib\KitTPL::icon("{id: 'checkbox', className: 'icon relative text-lime text-2xl', data: null}"); ?>
                            </div>
                            <?= $json['checkbox-1'] ?>
                        </li>
                        <li class="flex items-center">
                            <div class="relative mr-2">
                                <span class="absolute inset-2 bg-white"></span>
                                <?php \lib\KitTPL::icon("{id: 'checkbox', className: 'icon relative text-lime text-2xl', data: null}"); ?>
                            </div>
                            <?= $json['checkbox-2'] ?>
                        </li>
                        <li class="flex items-center">
                            <div class="relative mr-2">
                                <span class="absolute inset-2 bg-white"></span>
                                <?php \lib\KitTPL::icon("{id: 'checkbox', className: 'icon relative text-lime text-2xl', data: null}"); ?>
                            </div>
                            <?= $json['checkbox-3'] ?>
                        </li>
                    </ul>
                <? endif; ?>
                <div class="flex w-full mt-8 sm:mt-12 lg:mt-16 anim anim-up ease-in-out duration-700" data-anim>
                    <a class="btn btn-white btn-fill btn-lg text-black rounded-full w-full sm:max-w-56"
                       data-fancybox-form data-waved="dark" draggable="false" href="/ajax/dialogs/dialog-feedback.php">Заказать
                        аренду</a>
                </div>
            </div>
        </section>
        <?php
    }

    private static function _text($json)
    {
        ?>
        <section class="description container text-sm sm:text-base <?= $json['className'] ?>">
            <p>
                Мы предлагаем краткосрочную и долгосрочную аренду биотуалетов, а также их обслуживание в Краснодаре и
                Краснодарском крае. Купить биотуалет для кратковременного использования на строительных площадках и
                мероприятиях на открытом воздухе не является выгодней, чем его аренда.
            </p>
            <br>
            <h4>
                Аренда биотуалета включает в себя:
            </h4>
            <ul>
                <li>
                    доставку и установку биотуалета;
                </li>
                <li>
                    заправку биожидкостью;
                </li>
                <li>
                    для обеспечения нормальной санитарно-эпидемиологической ситуации, транспортировка отходов
                    производиться на сливную станцию, имеющую соответствующие разрешения на сбор, использование,
                    обезвреживание и размещение отходов;
                </li>
                <li>
                    демонтаж и вывоз биотуалета после окончания аренды.
                </li>
            </ul>
            <br>
            <h4>
                Аренда биотуалета включает в себя:
            </h4>
            <p>
                Дни города, свадьбы, корпоративные вечеринки на пляжах Черноморского побережья, дни рождения на свежем
                воздухе).Это было бы невозможно, не обладай компания большим парком туалетных кабин, наличием
                спецтехники и огромного желания быть нужными и полезными. Дни города, свадьбы, корпоративные вечеринки
                на пляжах Черноморского побережья, дни рождения на свежем воздухе).Это было бы невозможно, не обладай
                компания большим парком туалетных кабин, наличием спецтехники и огромного желания быть нужными и
                полезными.
            </p>
        </section>
        <?php
    }

    private static function _work()
    {
        ?>
        <section class="container pt-0">
            <?php \lib\KitTPL::subtitle("{text: 'Как мы работаем', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
            <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-2 sm:gap-4 lg:gap-6">
                <div class="anim anim-up ease-in-out duration-700" data-anim>
                    <div class="card border border-solid border-gray pt-6 sm:pt-4 pb-6 sm:pb-8 lg:pb-10 px-6 sm:px-4">
                        <div class="flex items-center justify-center bg-gradient-to-br from-green-dark to-green rounded-2xl md:rounded-3xl w-16 md:w-full h-16 md:h-32">
                            <span class="font-alt font-extrabold text-white text-center text-4xl md:text-5xl lg:text-6xl">1</span>
                        </div>
                        <div class="card-content pt-4 sm:pt-6 sm:px-2">
                            <h4 class="font-semibold text-1.5xl sm:text-2xl">
                                Подбираем технику, согласовываем время и стоимость
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="anim anim-up ease-in-out duration-700" data-anim>
                    <div class="card border border-solid border-gray pt-6 sm:pt-4 pb-6 sm:pb-8 lg:pb-10 px-6 sm:px-4">
                        <div class="flex items-center justify-center bg-gradient-to-br from-green-dark to-green rounded-2xl md:rounded-3xl w-16 md:w-full h-16 md:h-32">
                            <span class="font-alt font-extrabold text-white text-center text-4xl md:text-5xl lg:text-6xl">2</span>
                        </div>
                        <div class="card-content pt-4 sm:pt-6 sm:px-2">
                            <h4 class="font-semibold text-1.5xl sm:text-2xl">
                                Подбираем технику, согласовываем время и стоимость
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="anim anim-up ease-in-out duration-700" data-anim>
                    <div class="card border border-solid border-gray pt-6 sm:pt-4 pb-6 sm:pb-8 lg:pb-10 px-6 sm:px-4">
                        <div class="flex items-center justify-center bg-gradient-to-br from-green-dark to-green rounded-2xl md:rounded-3xl w-16 md:w-full h-16 md:h-32">
                            <span class="font-alt font-extrabold text-white text-center text-4xl md:text-5xl lg:text-6xl">3</span>
                        </div>
                        <div class="card-content pt-4 sm:pt-6 sm:px-2">
                            <h4 class="font-semibold text-1.5xl sm:text-2xl">
                                Подбираем технику, согласовываем время и стоимость
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="anim anim-up ease-in-out duration-700" data-anim>
                    <div class="card border border-solid border-gray pt-6 sm:pt-4 pb-6 sm:pb-8 lg:pb-10 px-6 sm:px-4">
                        <div class="flex items-center justify-center bg-gradient-to-br from-green-dark to-green rounded-2xl md:rounded-3xl w-16 md:w-full h-16 md:h-32">
                            <span class="font-alt font-extrabold text-white text-center text-4xl md:text-5xl lg:text-6xl">4</span>
                        </div>
                        <div class="card-content pt-4 sm:pt-6 sm:px-2">
                            <h4 class="font-semibold text-1.5xl sm:text-2xl">
                                Подбираем технику, согласовываем время и стоимость
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    private static function _bio()
    {
        ?>
        <section class="container max-sm:pt-14">
            <div class="flex flex-col xl:flex-row items-center xl:items-stretch xl:justify-between gap-4 sm:gap-6">
                <div class="grow order-2 xl:order-1">
                    <div class="card bg-grey border border-solid border-gray">
                        <div class="card-content py-6 sm:py-8 lg:py-10 px-4 sm:px-7 lg:px-10">
                            <?php \lib\KitTPL::subtitleSmall("{text: 'О БИО-сервисе', className: 'mb-4 sm:mb-6 lg:mb-8 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
                            <div class="text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>
                                <p>
                                    <b>Мы помогаем быстро и качественно создавать комфортные бытовые условия</b> на
                                    строительных объектах, все туалетные кабины не только имеют эстетичный вид, но и
                                    обладают повышенной прочностью, пластиковые туалеты мобильны и не требуют больших
                                    затрат на эксплуатацию и обслуживание, установка биотуалета производится в
                                    кратчайшие сроки и удобное время. Наша компания придерживается лояльной ценовой
                                    политики.
                                </p>
                                <br>
                                <p>
                                    Аренда биотуалетов позволяет обеспечить соблюдение санитарных норм при проведении
                                    любых мероприятий на открытом воздухе. Мы можем предложить одновременную установку и
                                    обслуживание более 150 биотуалетов – этот объем мобильных туалетных кабин может
                                    обеспечить комфортную санитарно-экологическую обстановку для мероприятия с большим
                                    количеством посетителей.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shrink-0 order-1 xl:order-2 w-full xl:max-w-lg">
                    <div class="card bg-transparent border border-solid border-gray overflow-visible">
                        <div class="card-content relative px-4">
                            <div class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-white/70 blur-3xl rounded-full size-56 sm:size-80"></div>
                            <div class="relative w-full max-w-44 sm:max-w-72 mx-auto -mt-4 mb-8">
                                <div class="absolute top-0 left-0 bg-gray rotate-6">
                                    <?php \lib\KitTPL::loader("{className: ''}"); ?>
                                    <?php \lib\KitTPL::picture("{src: '/img/pictures/document-img', format: 'jpg', className: 'block relative w-full', data: null}"); ?>
                                    <div class="absolute inset-0 bg-beige opacity-40"></div>
                                </div>
                                <div class="relative bg-gray rotate-[10deg]">
                                    <?php \lib\KitTPL::loader("{className: ''}"); ?>
                                    <?php \lib\KitTPL::picture("{src: '/img/pictures/document-img', format: 'jpg', className: 'block relative w-full', data: null}"); ?>
                                </div>
                                <?php \lib\KitTPL::shadow("{className: 'mt-6 sm:mt-10'}"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    private static function _map()
    {
        ?>
        <section
                class="container xl:container-distance relative bg-gray xl:rounded-5xl overflow-hidden h-96 lg:h-[600px] xl:mt-0">
            <?php \lib\KitTPL::loader("{className: ''}"); ?>
            <div class="absolute inset-0 rounded-inherit" data-yandex-map="45.03191007458623,38.921171499999936"
                 data-src="<?= SITE_TEMPLATE_PATH ?>/img/pictures/point.svg"></div>
        </section>
        <?php
    }
}
