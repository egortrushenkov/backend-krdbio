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

$title = !empty($arParams["SECTION_TITLE"])
        ? $arParams["SECTION_TITLE"]
        : $arResult["SECTION"]["NAME"];
$buy = $arParams["SECTION_BUY"];

?>

<section class="container">
    <?php \lib\KitTPL::subtitle("{text: '" . $title . "', className: 'sm:text-center mb-8 sm:mb-11 lg:mb-14 clip-path clip-path-up ease-linear duration-1000', data: 'data-anim'}"); ?>
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="anim anim-up ease-in-out duration-700" data-anim
                 id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="card border border-solid border-gray">
                    <a class="pack pack-xl bg-gray rounded-t-inherit" data-waved="dark" draggable="false" href="/services/prodazha-biotualetov/<?=$arItem['CODE']?>/">
                        <?php \lib\KitTPL::loader("{className: ''}");?>
                        <?php \lib\KitTPL::picture("{src: '".$arItem['PREVIEW_PICTURE']['SRC']."', format: 'url', className: 'pack-image image rounded-t-inherit', data: null}");?>
                        <?php \lib\KitTPL::die("'{$arItem['PROPERTIES']['tag']["VALUE_XML_ID"]}'");?>
                    </a>
                    <div class="card-content p-2 sm:p-4 lg:p-6">
                        <h3 class="font-normal text-sm sm:text-base">
                            <?= $arItem['NAME'] ?>
                        </h3>
                        <? if ($buy) {?>
                        <div class="font-semibold text-xl sm:text-2xl mt-1 sm:mt-2 mb-3 sm:mb-6">
                            От <?= $arItem["PROPERTIES"]["priceSale"]["VALUE"] ?> ₽
                        </div>
                        <div class="flex flex-col sm:flex-row items-center justify-center sm:gap-1 bg-blue/10 text-center text-sm sm:text-base rounded-tl-4xl rounded-br-4xl h-12 sm:h-10 px-2 sm:px-4 mb-2">
                            В аренду <span class="font-medium">от <?= $arItem["PROPERTIES"]['priceRentDay']["VALUE"] ?>₽/мес</span>
                        </div>
                        <? } else { ?>
                        <div class="flex flex-col sm:flex-row sm:justify-between gap-1 mt-4 mb-4 sm:mb-6">
                            <div class="flex flex-col">
                                <span class="text-sm sm:text-base">Посуточно</span>
                                <span class="font-semibold sm:text-xl lg:text-2xl"><?= $arItem["PROPERTIES"]['priceRentDay']["VALUE"] ?> ₽</span>
                            </div>
                            <span class="hidden sm:block shrink-0 bg-gray w-px"></span>
                            <div class="flex flex-col">
                                <span class="text-sm sm:text-base">В месяц</span>
                                <span class="font-semibold sm:text-xl lg:text-2xl"><?= $arItem["PROPERTIES"]['priceRentMoth']["VALUE"] ?> ₽</span>
                            </div>
                        </div>
                        <? }; ?>
                        <a class="btn btn-primary btn-fill btn-light btn-lg mt-auto" data-fancybox-form
                           data-waved="light" draggable="false" href="/ajax/dialogs/dialog-feedback.php"><?= $buy ? 'Купить'
                            : 'Арендовать' ?></a>
                    </div>
                </div>

            </div>
        <? endforeach; ?>
    </div>
</section>

