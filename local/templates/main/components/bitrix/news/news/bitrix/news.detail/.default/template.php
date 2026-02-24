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
?>

<section class="container">
    <?php \lib\KitTPL::back();?>
    <?php \lib\KitTPL::title("{text: '".$arResult['NAME']."', className: 'mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}");?>
    <div class="flex flex-col xl:flex-row xl:justify-between gap-6">
        <div class="description order-2 xl:order-1 text-sm sm:text-base w-full xl:max-w-[600px]">
            <?=$arResult['DETAIL_TEXT']?>
        </div>
        <div class="order-1 xl:order-2 w-full md:max-w-[480px]">
            <div class="pack pack-md bg-gray rounded-4xl xl:sticky xl:top-20">
                <?php \lib\KitTPL::loader("{className: ''}");?>
                <?php \lib\KitTPL::picture("{src: '".$arResult['DETAIL_PICTURE']['SRC']."', format: 'url', className: 'image rounded-inherit', data: null}");?>
            </div>
        </div>
    </div>
</section>