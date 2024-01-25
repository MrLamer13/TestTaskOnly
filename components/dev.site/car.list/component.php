<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (($_GET["date_from"] != "") && ($_GET["date_to"] != "")) {
    $arResult["WORK_POSITION"] = $this->getUserWorkPosition();

    $arResult["CARS_LIST"] = $this->getCarsList();

    $arResult["JOB_COMFORT_LIST"] = $this->getJobComfortList();

    $arResult["CARS_LIST_WITH_JOB_COMFORT"] = $this->getCarsListWithComfortForJob();

    $arResult["RESERVATION_CARS"] = $this->getReservationCarsInPeriod($_GET["date_from"], $_GET["date_to"]);

    $arResult["NO_RESERVATION_CARS_LIST_WITH_JOB_COMFORT"] = $this->getNoReservationCarsListWithComfortForJob();
}

$this->IncludeComponentTemplate();