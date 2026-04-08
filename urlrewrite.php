<?php
$arUrlRewrite = array(
    0 =>
        array(
            'CONDITION' => '#^/prodazha-biotualetov/([^/]+)/?$#',
            'RULE' => '10',
            'ID' => 'ELEMENT_CODE=$1',
            'PATH' => '/prodazha-biotualetov/details.php',
            'SORT' => 100,
        ),
    1 =>
        array(
            'CONDITION' => '#^/rest/#',
            'RULE' => '',
            'ID' => NULL,
            'PATH' => '/bitrix/services/rest/index.php',
            'SORT' => 100,
        ),
    2 =>
        array(
            'CONDITION' => '#^/news/(.*)#',
            'RULE' => '',
            'ID' => NULL,
            'PATH' => '/news/index.php',
            'SORT' => 100,
        ),
);
