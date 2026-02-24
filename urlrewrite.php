<?php
$arUrlRewrite=array (
  2 => 
  array (
    'CONDITION' => '#^/services/prodazha-biotualetov/([^/]+)/?$#',
    'RULE' => '10',
    'ID' => 'ELEMENT_CODE=$1',
    'PATH' => '/services/prodazha-biotualetov/details.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
