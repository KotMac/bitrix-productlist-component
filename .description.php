<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => "Product List with Filters and Sorting",
    "DESCRIPTION" => "Displays a list of products with filtering and sorting options.",
    "COMPLEX" => "N",
    "PATH" => array(
        "ID" => "content",
        "CHILD" => array(
            "ID" => "productlist",
            "NAME" => "Product List"
        )
    ),
    "PARAMETERS" => array(
        "IBLOCK_ID" => array(
            "NAME" => "Инфоблок с товарами",
            "TYPE" => "string",
            "DEFAULT" => "",
            "PARENT" => "BASE",
            "MULTIPLE" => "N",
            "REFRESH" => "Y"
        ),
        "FILTER_PROPERTY_CODE" => array(
            "NAME" => "Код свойства для фильтрации",
            "TYPE" => "string",
            "DEFAULT" => "",
            "PARENT" => "DATA_SOURCE",
            "MULTIPLE" => "Y"
        ),
        "SORT_BY" => array(
            "NAME" => "Поле для сортировки",
            "TYPE" => "string",
            "DEFAULT" => "sort",
            "PARENT" => "SORT_SETTINGS",
            "MULTIPLE" => "N"
        ),
        "SORT_ORDER" => array(
            "NAME" => "Направление сортировки",
            "TYPE" => "string",
            "DEFAULT" => "asc",
            "PARENT" => "SORT_SETTINGS",
            "MULTIPLE" => "N"
        ),
    ),
);