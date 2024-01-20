<?php

if (\Bitrix\Main\Loader::includeModule("dev.site")) {
    $eventManager = \Bitrix\Main\EventManager::getInstance();
    $eventManager->addEventHandlerCompatible(
        "iblock",
        "OnAfterIBlockElementUpdate",
        [
            "\Dev\Site\Handlers\Iblock",
            "addLog"
        ]
    );
    $eventManager->addEventHandlerCompatible(
        "iblock",
        "OnAfterIBlockElementAdd",
        [
            "\Dev\Site\Handlers\Iblock",
            "addLog"
        ]
    );

    CAgent::AddAgent(
        "\Dev\Site\Agents\Iblock::clearOldLogs();",
        "dev.site",
        "N",
        3600
    );
}


