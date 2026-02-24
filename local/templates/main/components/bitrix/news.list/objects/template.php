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
    <?php \lib\KitTPL::subtitle("{text: '".$arParams["SECTION_TITLE"]."', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
    <div data-slider="objects">
        <div class="swiper overflow-visible" data-slider-swiper="objects">
            <div class="swiper-wrapper lg:grid xl:grid-cols-2 lg:gap-4 xl:gap-8 lg:!transform-none">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>

                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="swiper-slide h-auto" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="card lg:flex-row lg:items-center gap-6 lg:gap-12 border border-solid border-gray pt-4 pb-8 lg:pb-4 pl-4 pr-4 lg:pr-10">
                            <div class="pack pack-md bg-gray rounded-3xl shrink-0 w-full lg:max-w-64">
                                <?php \lib\KitTPL::loader("{className: ''}"); ?>
                                <?php \lib\KitTPL::picture("{src: '" . $arItem['PREVIEW_PICTURE']['SRC'] . "', format: 'url', className: 'image rounded-inherit', data: null}"); ?>
                            </div>
                            <div class="card-content px-4 lg:px-0">
                                <h4 class="font-semibold text-2xl">
                                    <?= $arItem["NAME"] ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</section>

