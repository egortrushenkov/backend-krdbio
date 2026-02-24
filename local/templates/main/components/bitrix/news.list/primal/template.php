<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

// Коды, которые идут в преимущества:
$parametrsProduct = [
        'advantage1',
        'advantage2',
        'advantage3',
];

?>
<section class="relative" data-slider="primal">
    <div class="swiper" data-slider-swiper="primal">

        <div class="swiper-wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>

            <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="group/slide swiper-slide h-auto" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="container xl:container-distance relative xl:rounded-5xl h-full min-h-[610px] sm:min-h-[700px] lg:min-h-[800px] xl:my-0">
                    <div class="absolute inset-0 bg-gray rounded-inherit">
                        <?php \lib\KitTPL::loader("{className: ''}");?>
                        <picture>
                            <source srcset="<?php makeWebp(['PREVIEW_PICTURE']['SRC']);?>" media="(min-width: 575.98px)" type="image/webp">
                            <source srcset="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" media="(min-width: 575.98px)">
                            <source srcset="<?php makeWebp($arItem['DETAIL_PICTURE']['SRC'])?>" type="image/webp">
                            <img class="image rounded-inherit" draggable="false" loading="lazy" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="">
                        </picture>
                    </div>
                    <div class="flex flex-col items-start relative text-white translate-y-10 opacity-0 transition ease-linear duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100">
                        <?php \lib\KitTPL::title("{text: '".$arItem['NAME']."', className: '[&>br]:hidden sm:[&>br]:block', data: null}");?>
                        <?php \lib\KitTPL::price("{price: '".$arItem['PROPERTIES']['priceSliderMain']['VALUE']."', className: 'mt-4 sm:mt-6', data: null}");?>
                        <ul class="flex flex-col gap-2 sm:gap-4 font-semibold sm:text-lg lg:text-xl mt-4 sm:mt-8 lg:mt-12">
                            <? foreach ($parametrsProduct as $arParam): ?>
                                <li class="flex items-center">
                                    <div class="relative mr-2">
                                        <span class="absolute inset-2 bg-white"></span>
                                        <?php \lib\KitTPL::icon("{id: 'checkbox', className: 'icon relative text-lime text-2xl', data: null}");?>
                                    </div>
                                    <?=$arItem['PROPERTIES'][$arParam]['VALUE']?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <a class="btn btn-white btn-fill btn-lg text-black rounded-full swiper-no-swiping w-full sm:max-w-56 mt-8 sm:mt-12 lg:mt-16" data-waved="dark" draggable="false" href="">Подробнее</a>
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
    <div class="container flex items-end absolute inset-0 z-10 pointer-events-none">
        <?php \lib\KitTPL::swiperPagination("{value: 'primal', className: 'text-white pointer-events-auto sm:!w-auto'}");?>
    </div>
</section>

