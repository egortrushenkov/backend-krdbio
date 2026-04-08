<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Страница продуктов");

use lib\Kit;
use Bitrix\Main\Config\Option;


$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "product-detail",
    [
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => 1,

        "ELEMENT_CODE" => $code,
        "SET_TITLE" => "Y",
        "ADD_ELEMENT_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",

        "CHECK_DATES" => "Y",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "Y",

        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 36000000,

        "FIELD_CODE" => [
            "NAME",
            "PREVIEW_TEXT",
            "DETAIL_TEXT",
            "PREVIEW_PICTURE",
            "DETAIL_PICTURE"
        ],

        "PROPERTY_CODE" => [
            "priceRentMoth",
            "priceSale",
            "tag",
            "tagsDetails",
            "size",
            "liter",
            "outlet",
            "paper",
            "hook",
            "priceRentDay",
        ],
    ]
);


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
