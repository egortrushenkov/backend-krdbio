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
<section class="container <%= className %>">
    <?php \lib\KitTPL::subtitle("{text: 'Вопрос-ответ', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
    <ul class="flex flex-col gap-2 sm:gap-4">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="anim anim-up ease-in-out duration-700" data-anim id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="group/accordion bg-grey rounded-3xl border border-solid border-gray transition-colors [&[data-accordion=active]]:bg-white py-3 sm:py-6 px-6 sm:px-8" data-accordion data-close-click>
                    <button class="flex items-center justify-between gap-4 text-left w-full" data-accordion-toggle>
                        <h3 class="font-semibold text-lg sm:text-xl lg:text-1.5xl">
                            <?= $arItem["NAME"] ?>
                        </h3>
                        <?php \lib\KitTPL::icon("{id: 'arrow-right', className: 'icon text-3xl opacity-50 rotate-90 transition-transform group-[[data-accordion=active]]/accordion:-rotate-90', data: null}");?>
                    </button>
                    <div data-accordion-content>
                        <p class="text-sm sm:text-base opacity-80 pt-7">
                            <?= $arItem["PREVIEW_TEXT"] ?>
                        </p>
                    </div>
                </div>
            </li>
        <? endforeach; ?>
    </div>
</section>