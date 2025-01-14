<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class ProductListComponent extends \CBitrixComponent
{
    public function executeComponent()
    {
        if (!Loader::includeModule('iblock')) {
            ShowError('Модуль инфоблоков не установлен');
            return;
        }

        $iblockId = (int)$this->arParams["IBLOCK_ID"];
        if ($iblockId <= 0) {
            ShowError('Не указан ID инфоблока');
            return;
        }

        $filterProperties = $this->arParams["FILTER_PROPERTY_CODE"];
        $sortField = $this->arParams["SORT_BY"];
        $sortOrder = $this->arParams["SORT_ORDER"];

        $products = $this->getProducts($iblockId, $filterProperties, $sortField, $sortOrder);
        $this->arResult["PRODUCTS"] = $products;

        $this->includeComponentTemplate();
    }

    private function getProducts($iblockId, $filterProperties, $sortField, $sortOrder)
    {
        $arSelect = ["ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_PRICE", "PROPERTY_QUANTITY"];
        foreach ($filterProperties as $propertyCode) {
            $arSelect[] = "PROPERTY_" . $propertyCode;
        }

        $arFilter = ["IBLOCK_ID" => $iblockId];
        foreach ($filterProperties as $propertyCode) {
            if (isset($_GET[$propertyCode])) {
                $arFilter["PROPERTY_" . $propertyCode] = $_GET[$propertyCode];
            }
        }

        $rsElements = \CIBlockElement::GetList(
            [$sortField => $sortOrder],
            $arFilter,
            false,
            false,
            $arSelect
        );

        $result = [];
        while ($arElement = $rsElements->GetNext()) {
            $result[] = [
                'ID' => $arElement['ID'],
                'NAME' => $arElement['NAME'],
                'URL' => $arElement['DETAIL_PAGE_URL'],
                'PRICE' => $arElement['PROPERTY_PRICE_VALUE'],
                'QUANTITY' => $arElement['PROPERTY_QUANTITY_VALUE']
            ];
        }

        return $result;
    }
}