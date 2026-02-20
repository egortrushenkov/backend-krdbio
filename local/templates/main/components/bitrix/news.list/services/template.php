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
<section class="container">
    <?php \lib\KitTPL::subtitle("{text: 'Ассенизаторские услуги', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="anim anim-up ease-in-out duration-700" data-anim
                 id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="card border border-solid border-gray">
                    <a class="pack pack-[65] bg-gray rounded-t-inherit" data-waved="light" draggable="false" href="">
                        <?php \lib\KitTPL::loader("{className: ''}"); ?>
                        <?php \lib\KitTPL::picture("{src: '".$arItem['PREVIEW_PICTURE']['SRC']."', format: 'url', className: 'pack-image image rounded-t-inherit', data: null}"); ?>
                    </a>
                    <div class="card-content p-4 sm:p-6">
                        <h4 class="font-semibold text-1.5xl sm:text-2xl mb-1 sm:mb-3">
                            <?= $arItem['NAME'] ?>
                        </h4>
                        <p class="text-sm sm:text-base opacity-80 line-clamp-6 mb-4 sm:mb-6">
                            <?= $arItem['PREVIEW_TEXT'] ?>
                        </p>
                        <div class="flex flex-col gap-4 sm:gap-6 mt-auto">
                            <? if (!empty($arItem["PROPERTIES"]["PRICE"]["VALUE"])): ?>
                                <div class="font-semibold text-1.5xl sm:text-2xl"><?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?></div>
                            <? endif; ?>
                            <a class="btn btn-primary btn-fill btn-light btn-lg swiper-no-swiping" data-waved="light"
                               draggable="false" href="<?= $arItem['CODE'] ?>">Подробнее</a>
                        </div>
                    </div>
                </div>

            </div>
        <? endforeach; ?>
    </div>
</section>

