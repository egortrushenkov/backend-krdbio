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

<section class="container pt-0">
    <?php \lib\KitTPL::subtitle("{text: 'Как мы работаем', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-2 sm:gap-4 lg:gap-6">
        <? $i=1;foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="anim anim-up ease-in-out duration-700" data-anim id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="card border border-solid border-gray pt-6 sm:pt-4 pb-6 sm:pb-8 lg:pb-10 px-6 sm:px-4">
                    <div class="flex items-center justify-center bg-gradient-to-br from-green-dark to-green rounded-2xl md:rounded-3xl w-16 md:w-full h-16 md:h-32">
                        <span class="font-alt font-extrabold text-white text-center text-4xl md:text-5xl lg:text-6xl"><?=$i?></span>
                    </div>
                    <div class="card-content pt-4 sm:pt-6 sm:px-2">
                        <h4 class="font-semibold text-1.5xl sm:text-2xl">
                            <?= $arItem["NAME"]?>
                        </h4>
                    </div>
                </div>
            </div>
        <? $i++ ?>
        <? endforeach;?>
    </div>
</section>