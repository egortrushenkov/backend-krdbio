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

<section class="container max-sm:pt-14">
    <? foreach ($arResult as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="flex flex-col xl:flex-row items-center xl:items-stretch xl:justify-between gap-4 sm:gap-6"
             id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="grow order-2 xl:order-1">
                <div class="card bg-grey border border-solid border-gray">
                    <div class="card-content py-6 sm:py-8 lg:py-10 px-4 sm:px-7 lg:px-10">
                        <?php \lib\KitTPL::subtitleSmall("{text: '".$arItem['PROPERTIES']['header']['VALUE']."', className: 'mb-4 sm:mb-6 lg:mb-8 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
                        <div class="text-sm sm:text-base anim anim-up ease-in-out duration-700" data-anim>
                            <?=$arItem["DETAIL_TEXT"]?>
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
                                <?php \lib\KitTPL::picture("{src: '".$arItem["PREVIEW_PICTURE_SRC"]."', format: 'url', className: 'block relative w-full', data: null}"); ?>
                                <div class="absolute inset-0 bg-beige opacity-40"></div>
                            </div>
                            <div class="relative bg-gray rotate-[10deg]">
                                <?php \lib\KitTPL::loader("{className: ''}"); ?>
                                <?php \lib\KitTPL::picture("{src: '".$arItem["PREVIEW_PICTURE_SRC"]."', format: 'url', className: 'block relative w-full', data: null}"); ?>
                            </div>
                            <?php \lib\KitTPL::shadow("{className: 'mt-6 sm:mt-10'}"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?endforeach;?>
</section>
