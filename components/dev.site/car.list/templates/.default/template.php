<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
    <form action="#">
        <label for="date_from">От:</label>
        <input type="datetime" name="date_from" id="date_from">
        <label for="date_to">До:</label>
        <input type="datetime" name="date_to" id="date_to">
        <button type="submit">Запросить</button>
    </form><?php
echo "<pre>";
print_r($arResult["NO_RESERVATION_CARS_LIST_WITH_JOB_COMFORT"]);
echo "</pre>";