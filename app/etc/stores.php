<?php

declare(strict_types=1);

use Magento\Store\Model\StoreManager;

$serverName = $_SERVER['HTTP_HOST'] ?? null;

$runCode = null;
$runType = null;

switch ($serverName) {
    case 'app.magento244-multisite.test':
        $runType = 'website';
        $runCode = 'base';
        break;

    case 'app.magento244-website-two.test':
        $runType = 'website';
        $runCode = 'website_two';
        break;

    case 'app.magento244-store-view-three-us.test':
        $runType = 'store';
        $runCode = 'store_view_three_us';
        break;

    case 'app.magento244-store-view-three-de.test':
        $runType = 'store';
        $runCode = 'store_view_three_de';
        break;

    default:
        return;
}

if (
    (!isset($_SERVER[StoreManager::PARAM_RUN_TYPE]) || empty($_SERVER[StoreManager::PARAM_RUN_TYPE])) &&
    (!isset($_SERVER[StoreManager::PARAM_RUN_CODE]) || empty($_SERVER[StoreManager::PARAM_RUN_CODE])) &&
    !empty($runCode) && !empty($runType)
) {
    $_SERVER[StoreManager::PARAM_RUN_CODE] = $runCode;
    $_SERVER[StoreManager::PARAM_RUN_TYPE] = $runType;
}
