<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CarList extends CBitrixComponent
{
    public function getUserWorkPosition(): string
    {
        $arUserFields = CUser::GetByID($GLOBALS["USER"])->Fetch();
        return $arUserFields["WORK_POSITION"];
    }

    public function getCarsList(): array
    {
        $carsIBlockElements = CIBlockElement::GetList(
            [],
            ["IBLOCK_CODE" => "cars"],
            false,
            false,
            ["ID", "NAME", "PROPERTY_DRIVER", "PROPERTY_COMFORT"]
        );

        $result = [];

        while (($carsIBlockElement = $carsIBlockElements->GetNext()) !== false) {
            $result[$carsIBlockElement["ID"]][] = $carsIBlockElement["NAME"];
            $result[$carsIBlockElement["ID"]][] = $carsIBlockElement["PROPERTY_DRIVER_VALUE"];
            $result[$carsIBlockElement["ID"]][] = $carsIBlockElement["PROPERTY_COMFORT_VALUE"];
        }

        return $result;
    }

    public function getJobComfortList(): array
    {
        $jobIBlockElements = CIBlockElement::GetList(
            [],
            ["IBLOCK_CODE" => "job"],
            false,
            false,
            ["ID", "NAME", "PROPERTY_COMFORT"]
        );

        $result = [];

        while (($jobIBlockElement = $jobIBlockElements->GetNext()) !== false) {
            $result[$jobIBlockElement["NAME"]][] = $jobIBlockElement["PROPERTY_COMFORT_VALUE"];
        }

        return $result;
    }

    public function getCarsListWithComfortForJob(): array
    {
        $jobComfort = $this->arResult["JOB_COMFORT_LIST"][$this->arResult["WORK_POSITION"]];

        $result = [];

        foreach ($this->arResult["CARS_LIST"] as $key => $car) {
            if (in_array($car[2], $jobComfort)) {
                $result[$key] = $car;
            }
        }

        return $result;
    }

    public function getReservationCarsInPeriod(string $dateFrom, string $dateTo): array
    {
        $reservationCarsIBlockElements = CIBlockElement::GetList(
            [],
            [
                "IBLOCK_CODE" => "reservation",
                '<=DATE_ACTIVE_FROM' => $dateTo,
                '>=DATE_ACTIVE_TO' => $dateFrom,
            ],
            false,
            false,
            ["ID", "NAME",  "PROPERTY_CAR"]
        );

        $result = [];

        while (($reservationCarsIBlockElement = $reservationCarsIBlockElements->GetNext()) !== false) {
            $result[] = $reservationCarsIBlockElement["PROPERTY_CAR_VALUE"];
        }

        return $result;
    }

    public function getNoReservationCarsListWithComfortForJob(): array
    {
        $result = [];

        foreach ($this->arResult["CARS_LIST_WITH_JOB_COMFORT"] as $key => $value) {
            if (!in_array($key, $this->arResult["RESERVATION_CARS"])) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}