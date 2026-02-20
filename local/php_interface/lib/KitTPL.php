<?php

namespace lib;

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
               draggable="false" href="">
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
            <use href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#<?= $json['id'] ?>"></use>
        </svg>
        <?php
    }

    private static function _loader($json)
    {
        ?>
        <div class="loader <?= $json['className']?>" data-loader>
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
                <source srcset="<?= $src ?>.webp" type="image/webp">
            <? } elseif ($format === 'url' && $webpSrc && !$block_webp) { ?>
                <source srcset="<?= $webpSrc ?>" type="image/webp">
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
        <div class="flex items-center justify-center bg-gradient-to-r from-blue-dark to-blue rounded-tr-5xl rounded-bl-5xl h-14 sm:h-16 px-10 <?=$json['className']?>" <?=$json['data']?> >
            <span class="font-semibold text-center text-xl sm:text-2xl">Цена ОТ 10 000 ₽</span>
        </div>
        <?php
    }

    private static function _shadow($json) {
        ?>
            <div class="bg-black opacity-50 rounded-full blur h-0.5 <?=$json['className']?>"></div>
        <?php
    }
    private static function _subtitle($json) {
        ?>
            <h2 class="font-alt font-extrabold uppercase text-4xl/tight sm:text-5xl/tight lg:text-6xl/tight <?=$json['className']?>" <?=$json['data']?>><?=$json['text']?></h2>
        <?php
    }

    private static function _subtitleSmall($json) {
        ?>
        <h2 class="font-alt font-extrabold uppercase text-2xl/tight sm:text-3xl/tight lg:text-4xl/tight xl:text-subtitle/tight <?=$json['className']?>" <?=$json['data']?>><?=$json['text']?></h2>
        <?php
    }

    private static function _swiperButtonPrev($json)
    {
        ?>
        <button class="swiper-button-prev btn btn-gray btn-fill absolute text-black text-xs sm:text-base rounded-full size-8 sm:size-10 <?=$json['className']?>" data-slider-prev="<?=$json['value']?>" data-waved="dark">
            <? self::_icon(self::parseStringToObject("{id: 'arrow-left', className: null, data: null}")); ?>
        </button>
        <?php
    }

    private static function _swiperButtonNext($json) {
        ?>
            <button class="swiper-button-next btn btn-gray btn-fill absolute text-black text-xs sm:text-base rounded-full size-8 sm:size-10 <?=$json['className']?>" data-slider-next="<?=$json['value']?>" data-waved="dark">
                <? self::_icon(self::parseStringToObject("{id: 'arrow-right', className: null, data: null}")); ?>
            </button>
        <?php
    }

    private static function _swiperPagination($json)
    {
        ?>
            <div class="swiper-pagination <?=$json['className']?>" data-slider-pagination="<?=$json['value']?>"></div>
        <?php
    }

    private static function _cardService($json) {
        ?>
        <div class="card border border-solid border-gray">
            <a class="pack pack-[65] bg-gray rounded-t-inherit" data-waved="light" draggable="false" href="">

                <? self::_loader(self::parseStringToObject("{className: ''}")); ?>
                <? self::_picture(self::parseStringToObject("{src: '/img/pictures/test', format: 'jpg', className: 'pack-image image rounded-t-inherit', data: null}")); ?>
            </a>
            <div class="card-content p-4 sm:p-6">
                <h4 class="font-semibold text-1.5xl sm:text-2xl mb-1 sm:mb-3">
                    Аренда туалетных кабин
                </h4>
                <p class="text-sm sm:text-base opacity-80 line-clamp-6 mb-4 sm:mb-6">
                    Доставка, установка МТК, заправка биожидкостью, утилизация отходов.
                </p>
                <? if (!empty($json['price']) || !empty($json['btn'])):?>
                    <div class="flex flex-col gap-4 sm:gap-6 mt-auto">

                        <? if (!empty($json['price'])):?>
                            <div class="font-semibold text-1.5xl sm:text-2xl">От 1800 ₽/сут</div>
                        <?endif;?>

                        <? if (!empty($json['btn'])):?>
                            <a class="btn btn-primary btn-fill btn-light btn-lg swiper-no-swiping" data-waved="light" draggable="false" href="">Подробнее</a>
                        <?endif;?>

                    </div>
                <?endif;?>
            </div>
        </div>
        <?php
    }

    private static function _die($json) {
        $die = [
                'lime' => [
                        'gradient' => 'from-lime-dark to-lime',
                        'text' => 'Новинка'
                ],
                'chocolate' => [
                        'gradient' => 'from-chocolate-dark to-chocolate',
                        'text' => 'Лидер продаж'
                ],
                'crimson' => [
                        'gradient' => 'from-crimson-dark to-crimson',
                        'text' => 'Лучшее качество'
                ],
                'sky' => [
                        'gradient' => 'from-sky-dark to-sky',
                        'text' => 'Акция'
                ]

        ];
        ?>
        <div class="flex items-center justify-center absolute top-2 sm:top-4 left-2 sm:left-4 bg-gradient-to-r rounded-tl-3xl rounded-br-3xl w-full sm:w-auto max-w-32 sm:max-w-none h-8 px-2 sm:px-5 <?= $die['variant']['gradient'] ?>">
            <span class="font-semibold uppercase text-white text-center text-xs sm:text-sm"><?php \lib\KitTPL::die($json['variant']['text']);?></span>
        </div>
        <?php
    }
    private static function _cardProduct($json) {
        ?>
            <div class="card border border-solid border-gray">
                <a class="pack pack-xl bg-gray rounded-t-inherit" data-waved="dark" draggable="false" href="">
                    <?php \lib\KitTPL::_loader(self::parseStringToObject("{className: ''}")); ?>;?>
                    <?php \lib\KitTPL::_picture(self::parseStringToObject("{src: '/img/pictures/test', format: 'jpg', className: 'pack-image image rounded-t-inherit', data: null}"));?>
                    <?php \lib\KitTPL::_die(self::parseStringToObject($json['variant']));?>
                </a>
                <div class="card-content p-2 sm:p-4 lg:p-6">
                    <h3 class="font-normal text-sm sm:text-base">
                        Супер-Эконом
                    </h3>
                    <?if (!empty($json['buy'])) {?>
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
                    <a class="btn btn-primary btn-fill btn-light btn-lg mt-auto" data-fancybox-form data-waved="light" draggable="false" href="/dialogs/dialog-feedback.html"><?= $json['buy'] ? 'Купить' : 'Арендовать' ?></a>
                </div>
            </div>
        <?php
    }

    private static function _title($json)
    {
        ?>
            <h1 class="font-alt font-extrabold uppercase text-4xl/tight sm:text-5xl/tight lg:text-6xl/tight <?=$json['className']?>" <?=$json['data']?>><?=$json['text']?></h1>
        <?php
    }

}
