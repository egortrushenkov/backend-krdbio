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
<section class="container lg:pt-0">
    <div class="flex flex-col xl:flex-row items-center xl:items-stretch xl:justify-between gap-4 sm:gap-6">
        <div class="grow order-2 xl:order-1">
            <div class="card bg-grey border border-solid border-gray">
                <div class="card-content py-6 sm:py-8 lg:py-10 px-4 sm:px-7 lg:px-10">
                    <?php \lib\KitTPL::subtitleSmall("{text: 'Официальные документы на осуществление деятельности', className: 'mb-4 sm:mb-6 lg:mb-8 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
                    <div class="text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>
                        <p>
                            <b>Мы помогаем быстро и качественно создавать комфортные бытовые условия</b> на строительных объектах, все туалетные кабины не только имеют эстетичный вид, но и обладают повышенной прочностью, пластиковые туалеты мобильны и не требуют больших затрат на эксплуатацию и обслуживание, установка биотуалета производится в кратчайшие сроки и удобное время. Наша компания придерживается лояльной ценовой политики.
                        </p>
                        <br>
                        <p>
                            Аренда биотуалетов позволяет обеспечить соблюдение санитарных норм при проведении любых мероприятий на открытом воздухе. Мы можем предложить одновременную установку и обслуживание более 150 биотуалетов – этот объем мобильных туалетных кабин может обеспечить комфортную санитарно-экологическую обстановку для мероприятия с большим количеством посетителей.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="shrink-0 order-1 xl:order-2 w-full xl:max-w-lg">
            <div class="card bg-transparent border border-solid border-gray overflow-visible">
                <div class="card-content relative pb-6 sm:pb-8 lg:pb-10 px-4" data-slider="documents">
                    <div class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 bg-white/70 blur-3xl rounded-full size-56 sm:size-80"></div>
                    <div class="relative w-full max-w-44 sm:max-w-72 mx-auto -mt-4 mb-8">
                        <div class="swiper rotate-[10deg]" data-slider-swiper="documents">
                            <div class="swiper-wrapper">
                                <? foreach ($arResult["ITEMS"] as $arItem): ?>

                                    <?
                                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                    ?>
                                    <a class="swiper-slide relative bg-gray" data-fancybox="documents" draggable="false" href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                        <?php \lib\KitTPL::loader("{className: ''}");?>
                                        <?php \lib\KitTPL::picture("{src: '".$arItem['PREVIEW_PICTURE']['SRC']."', format: 'url', className: 'block relative w-full', data: null}");?>
                                    </a>
                                <? endforeach; ?>
                            </div>
                        </div>
                        <?php \lib\KitTPL::shadow("{className: 'mt-6 sm:mt-10'}");?>
                    </div>
                    <?php \lib\KitTPL::swiperButtonPrev("{value: 'documents', className: 'left-4'}");?>
                    <?php \lib\KitTPL::swiperButtonNext("{value: 'documents', className: 'right-4'}");?>
                    <?php \lib\KitTPL::swiperPagination("{value: 'documents', className: 'text-primary'}");?>
                </div>
            </div>
        </div>
    </div>
</section>

