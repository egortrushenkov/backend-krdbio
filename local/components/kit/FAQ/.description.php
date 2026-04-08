<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
	$arComponentDescription = array(
		"NAME" => GetMessage("FAQ блок"),
		"DESCRIPTION" => GetMessage("Выводим FAQ блок"),
		"PATH" => array(
			"ID" => "kit_components",
			"CHILD" => array(
				"ID" => "Kit",
				"NAME" => "Kit блок"
			)
		)
	);