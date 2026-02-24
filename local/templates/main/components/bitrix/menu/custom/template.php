<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/templates/main/components/bitrix/menu/helpers.php';

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




<nav class="flex items-center justify-between gap-4 w-full max-w-[830px]">
	<?if (!empty($arResult)):?>
        <? $arResult = getChildren($arResult) ?>
		<?foreach($arResult as $arItem):?>
            <?if (!empty($arItem['CHILDREN'])):?>
                <div class="group/accordion relative" data-accordion data-close-click data-close-scroll>
                    <button class="flex items-center font-medium underline-offset-4 hover:underline" data-accordion-toggle>
                        <?= $arItem["TEXT"] ?>
                        <?php \lib\KitTPL::icon("{id: 'arrow-right', className: 'icon text-lg opacity-50 rotate-90 ml-2 transition-transform group-[[data-accordion=active]]/accordion:-rotate-90', data: null}");?>
                    </button>
                    <div class="absolute top-8 left-0 w-max" data-accordion-content>
                        <div class="card bg-white rounded-2xl">
                            <div class="card-content items-start gap-4 p-4">
                                <?if ($arItem["CHILDREN"]):?>
                                    <?foreach($arItem["CHILDREN"] as $arItemChild):?>
                                        <a class="text-sm underline-offset-4 hover:underline" draggable="false" href="<?=$arItemChild["LINK"]?>"><?=$arItemChild["TEXT"]?></a>
                                    <?endforeach?>
                                <?endif?>
                            </div>
                        </div>
                    </div>
                </div>
            <?endif?>
            <?if (empty($arItem['CHILDREN'])):?>
                <a class="font-medium underline-offset-4 hover:underline" draggable="false" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            <?endif?>
		<?endforeach?>
	<?endif?>
</nav>
