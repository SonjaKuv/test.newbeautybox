<?php

use \Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class GiftList extends \CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['ID'] = (isset($params['ID']) ? (int) $params['ID'] : '');

        return $params;
    }

    public function executeComponent()
    {
        $bannerID = $this->arParams['ID'];

        if (!$bannerID) return;

        $bannerCollection = \file_get_contents(Application::getDocumentRoot() . "/bitrix/json/banners.json"); 

        $bannerCollection = \json_decode($bannerCollection, true);

        $targetBanner = \array_filter($bannerCollection["banners"], function ($banner) {
            return $banner["ID"] === $this->arParams['ID'];
        });

        if (!count($targetBanner)) return;

        $this->arResult["BANNER"] = \array_values($targetBanner)[0];

        $this->includeComponentTemplate();
    }
}
