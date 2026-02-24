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

?>
<section class="container overflow-hidden pt-0">
    <?php \lib\KitTPL::subtitle("{text: 'Еще новости', className: 'mb-8 sm:mb-10 lg:mb-12 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
    <div data-slider="news">
        <div class="relative">
            <div class="swiper -mx-4 sm:mx-0 px-4 sm:px-0" data-slider-swiper="news">
                <div class="swiper-wrapper">
                    <? foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="swiper-slide h-auto">
                            <div class="anim anim-up ease-in-out duration-700" data-anim
                                 id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <div class="card border border-solid border-gray">
                                    <a class="pack pack-[65] bg-gray rounded-t-inherit" data-waved="light"
                                       draggable="false" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                        <?php \lib\KitTPL::loader("{className: ''}"); ?>
                                        <?php \lib\KitTPL::picture("{src: '" . $arItem['PREVIEW_PICTURE']['SRC'] . "', format: 'url', className: 'pack-image image rounded-t-inherit', data: null}"); ?>
                                    </a>
                                    <div class="card-content p-4 sm:p-6">
                                        <h4 class="font-semibold text-1.5xl sm:text-2xl mb-1 sm:mb-3">
                                            <?= $arItem['NAME'] ?>
                                        </h4>
                                        <p class="text-sm sm:text-base opacity-80 line-clamp-6 mb-4 sm:mb-6">
                                            <?= $arItem['PREVIEW_TEXT'] ?>
                                        </p>
                                        <div class="flex flex-col gap-4 sm:gap-6 mt-auto">
                                            <a class="btn btn-primary btn-fill btn-light btn-lg swiper-no-swiping"
                                               data-waved="light" draggable="false"
                                               href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <?php \lib\KitTPL::swiperButtonPrev("{value: 'news', className: 'hidden lg:flex -left-7 xl:-left-14'}");?>
            <?php \lib\KitTPL::swiperButtonNext("{value: 'news', className: 'hidden lg:flex -right-7 xl:-right-14'}");?>
        </div>
        <?php \lib\KitTPL::swiperPagination("{value: 'news', className: 'text-primary mt-7 sm:mt-10'}");?>
    </div>
</section>
