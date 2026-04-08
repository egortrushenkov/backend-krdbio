<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

	/** @var array $arParams */


	use Bitrix\Main\Loader;
	use Bitrix\Iblock\Elements\ElementPrimalTable;
	use Bitrix\Iblock\PropertyEnumerationTable;

	Loader::includeModule('iblock');

    $ar_result = [];
    $arFilter = Array('IBLOCK_ID'=> 4, 'CODE'=>$arParams['CODE']);
    $db_list = CIBlockSection::GetList([], $arFilter, true);
    while($ar_result = $db_list->GetNext())
    {
        $SECTION_ID = $ar_result['ID'];
    }

	$filter = ['=ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => $SECTION_ID];
	if( $arParams['ID'] ){
		$filter['ID'] = $arParams['ID'];
	}

	$arResult = \Bitrix\Iblock\Elements\ElementFaqTable::getList([
	    'filter' => $filter,
	    'select' => ['ID', 'IBLOCK_ID', 'CODE', 'NAME', "TEXT"=>'PREVIEW_TEXT'],
		'order' => ['SORT' => 'DESC', 'ID' => 'DESC'],
		"cache" => ["ttl" => 3600],
	])->fetchAll();



	$this->IncludeComponentTemplate();