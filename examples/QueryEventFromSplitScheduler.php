<?php
require '../vendor/autoload.php';

use BraspagSplit\Merchant;

use BraspagSplit\Split\API\Environment;
use BraspagSplit\Split\API\BraspagSplit;
use BraspagSplit\Split\API\SchedulerQuery;
use BraspagSplit\Split\API\SchedulerQueryResponse;

use BraspagSplit\Request\BraspagRequestException;

// Configure o ambiente
$environment = Environment::sandbox();

// Configure seu merchant
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjbGllbnRfbmFtZSI6ImdlcmVuY2lhZ3JhbSIsImNsaWVudF9pZCI6ImU1ODYxYTAwLTVlZDItNDkyOC1iNzNiLWEzN2M4OWFhOTM3MCIsInNjb3BlcyI6WyJ7XCJTY29wZVwiOlwiU3BsaXRNYXN0ZXJcIixcIkNsYWltc1wiOltdfSIsIntcIlNjb3BlXCI6XCJDaWVsb0FwaVwiLFwiQ2xhaW1zXCI6W119Il0sInJvbGUiOlsiU3BsaXRNYXN0ZXIiLCJDaWVsb0FwaSJdLCJpc3MiOiJodHRwczovL2F1dGhzYW5kYm94LmJyYXNwYWcuY29tLmJyIiwiYXVkIjoiVVZReGNVQTJjU0oxZmtRM0lVRW5PaUkzZG05dGZtbDVlbEI1SlVVdVFXZz0iLCJleHAiOjE1NjI4MTQwNzMsIm5iZiI6MTU2MjcyNzY3M30.UW6q8A2NyPLniuPtR6se4rarW2FS8pKlV60Uu8LJqxM';
$merchant = new Merchant($accessToken);

$schedulerQuery = new SchedulerQuery();
$schedulerQuery->setInitialForecastedDate('2019-07-01')
                ->setFinalForecastedDate('2019-07-30');

// Faz a consulta de eventos da Agenda
try {
    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
    $event_query_response = (new BraspagSplit($merchant, $environment))->querySchedulerEvents($schedulerQuery);

    $events = $event_query_response->getSchedules();

    foreach($events as $event){
        print_r($event->jsonSerialize());
    }

} catch (BraspagRequestException $e) {
    print_r($e);
}
