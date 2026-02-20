<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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

<?php
function getChildren($input, &$start = 0, $level = 0) {
    $children = [];
    if (!$level) {
        $lastDepthLevel = 1;
        if (is_array($input)) {
            foreach ($input as $i => $arItem) {
                if ($arItem['DEPTH_LEVEL'] > $lastDepthLevel) {
                    if ($i > 0) {
                        $input[$i - 1]['IS_PARENT'] = 1;
                    }
                }
                $lastDepthLevel = $arItem['DEPTH_LEVEL'];
            }
        }
    }
    for ($i = $start, $count = count($input); $i < $count; ++$i) {
        $item = $input[$i];
        if ($level > $item['DEPTH_LEVEL'] - 1) {
            break;
        } elseif (!empty($item['IS_PARENT'])) {
            ++$i;
            $item['CHILDREN'] = getChildren($input, $i, $level + 1);
            --$i;
        }
        $children[] = $item;
    }
    $start = $i;
    return $children;
}
?>


<nav class="flex items-center justify-between gap-4 w-full max-w-[830px]">
	<?if (!empty($arResult)):?>
        <? $arResult = getChildren($arResult) ?>
		<?foreach($arResult as $arItem):?>
            <?if (!empty($arItem[' LDREN'])):?>
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
                                        <a class="text-sm underline-offset-4 hover:underline" draggable="false" href=""><?=$arItemChild["TEXT"]?></a>
                                    <?endforeach?>
                                <?endif?>
                            </div>
                        </div>
                    </div>
                </div>
            <?endif?>
            <?if (empty($arItem['CHILDREN'])):?>
                <a class="font-medium underline-offset-4 hover:underline" draggable="false" href=""><?=$arItem["TEXT"]?></a>
            <?endif?>
		<?endforeach?>
	<?endif?>
</nav>
