<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

// Коды, которые идут в характеристики:
$parametrsProduct = [
    'size',
    'liter',
    'outlet',
    'paper',
    'hook',
];

?>
<section class="container">
    <?php \lib\KitTPL::back();?>
    <div class="flex flex-col lg:flex-row lg:justify-between gap-6">
        <div class="w-full sm:max-w-md">
            <div class="card border border-solid border-gray">
                <div class="card-content relative rounded-inherit">
                    <a class="pack pack-xxl bg-gray rounded-inherit h-full" data-fancybox data-waved="dark" draggable="false" href="/img/pictures/test.jpg">
                        <?php \lib\KitTPL::loader("{className: ''}");?>
                        <?php \lib\KitTPL::picture("{src: '".$arResult['DETAIL_PICTURE']['SRC']."', format: 'url', className: 'pack-image image rounded-inherit', data: null}");?>
                    </a>
                    <?php \lib\KitTPL::die("'{$arResult['PROPERTIES']['tag']["VALUE_XML_ID"]}'");?>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-8 sm:gap-10 w-full lg:max-w-[520px]">
            <?php \lib\KitTPL::subtitleSmall("{text: '".$arResult['NAME']."', className: null, data: null}");?>
            <ul class="flex flex-wrap items-center gap-2">
                    <? $i = 0;?>
                    <? foreach ($arResult['PROPERTIES']['tagsDetails']['VALUE'] as $item): ?>
                        <li class="flex items-center justify-center bg-sky-dark/15 font-semibold text-sm rounded-lg shrink-0 h-8 px-4">
                            <?php \lib\KitTPL::icon("{id: '".$arResult['PROPERTIES']['tagsDetails']['VALUE_XML_ID'][$i]."', className: 'icon text-xl opacity-50 mr-1 sm:mr-2', data: null}");?>
                            <?= $item ?>
                            <? $i++;?>
                        </li>
                    <?endforeach;?>
            </ul>
            <? foreach ($parametrsProduct as $paramItem): ?>
            <ul class="flex flex-col gap-4 text-sm sm:text-base">
                <li class="grid grid-cols-2 gap-4 xl:gap-8">
                    <span><?=$arResult['PROPERTIES'][$paramItem]['NAME']?></span>
                    <span class="font-semibold shrink-0"><?=$arResult['PROPERTIES'][$paramItem]['VALUE']?></span>
                </li>
            </ul>
            <?endforeach;?>
            <ul class="grid sm:grid-cols-2 gap-4 xl:gap-8 mt-auto">
                <li class="flex flex-col">
                    <span class="text-sm sm:text-base mb-1">Купить</span>
                    <span class="font-semibold text-2xl mb-3 sm:mb-6">От <?=$arResult['PROPERTIES']['priceSale']['VALUE']?> ₽</span>
                    <a class="btn btn-primary btn-fill btn-light btn-lg" data-fancybox-form data-waved="light" draggable="false" href="/ajax/dialogs/dialog-feedback.php">Купить</a>
                </li>
                <li class="flex flex-col">
                    <span class="text-sm sm:text-base mb-1">Взять в аренду</span>
                    <span class="font-semibold text-2xl mb-3 sm:mb-6">От <?=$arResult['PROPERTIES']['priceRentDay']['VALUE']?> ₽/мес</span>
                    <a class="btn btn-sky-dark btn-fill btn-lg" data-fancybox-form data-waved="light" draggable="false" href="/ajax/dialogs/dialog-feedback.php">Арендовать</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="description container text-sm sm:text-base pt-0">
    <?=$arResult['DETAIL_TEXT']?>
</section>