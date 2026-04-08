<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */


use Bitrix\Main\Loader;

Loader::includeModule('iblock');

$ar_result = [];
$arFilter = Array('IBLOCK_ID'=> 10, 'CODE'=>$arParams['CODE']);
$db_list = CIBlockSection::GetList([], $arFilter, true);
while($ar_result = $db_list->GetNext())
{
    $SECTION_ID = $ar_result['ID'];
}

if (!empty($SECTION_ID)) {
    $filter = ['=ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => $SECTION_ID, 'IBLOCK_ID' => 10];
    if ($arParams['ID']) {
        $filter['ID'] = $arParams['ID'];
    }
} else {
    $filter = ['=ACTIVE' => 'Y', 'ID' => 62, 'IBLOCK_ID' => 10];
}

$arResult = [];
$db_elements = CIBlockElement::GetList(
    ['SORT' => 'DESC', 'ID' => 'DESC'],
    $filter,
    false,
    false,
    ['ID', 'IBLOCK_ID', 'CODE', 'NAME', 'PREVIEW_TEXT', 'DETAIL_TEXT', 'PREVIEW_PICTURE']
);
while ($ob = $db_elements->GetNextElement()) {
    $arItem = $ob->GetFields();
    $arItem['PROPERTIES'] = $ob->GetProperties();
    if ($arItem['PREVIEW_PICTURE']) {
        $arItem['PREVIEW_PICTURE_SRC'] = \CFile::GetPath($arItem['PREVIEW_PICTURE']);
    } else {
        $arItem['PREVIEW_PICTURE_SRC'] = '';
    }
    $arResult[] = $arItem;
}


$this->IncludeComponentTemplate();
