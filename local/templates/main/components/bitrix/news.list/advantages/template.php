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
    <?php \lib\KitTPL::subtitle("{text:'".$arParams["SECTION_TITLE"]."', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
    <div class="grid xl:grid-cols-2 gap-2 sm:gap-5 lg:gap-8 text-white">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>

            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="anim anim-up ease-in-out duration-700" data-anim id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="card flex-row items-center bg-gradient-to-r from-blue to-blue-dark py-4 pl-4 pr-4 sm:pr-6 lg:pr-8">
                    <div class="pack pack-xl bg-black/20 rounded-3xl shrink-0 w-full max-w-28 sm:max-w-32 mr-4 sm:mr-7 lg:mr-10">
                        <?php \lib\KitTPL::picture("{src: '".$arItem['PREVIEW_PICTURE']['SRC']."', format: 'url', className: 'image rounded-inherit', data: null}");?>
                    </div>
                    <div class="card-content">
                        <h3 class="font-semibold text-xl sm:text-2xl mb-1 sm:mb-2">
                            <?= $arItem["NAME"] ?>
                        </h3>
                        <p class="text-xs sm:text-base">
                            <?= $arItem['PREVIEW_TEXT'] ?>
                        </p>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</section>

