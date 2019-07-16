<?php
require '../vendor/autoload.php';

use BraspagSplit\Merchant;

use BraspagSplit\Split\API\Environment;
use BraspagSplit\Split\API\BraspagSplit;
use BraspagSplit\Split\API\Chargeback;

use BraspagSplit\Request\BraspagRequestException;

// Configure o ambiente
$environment = Environment::sandbox();

// Configure seu merchant
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjbGllbnRfbmFtZSI6ImdlcmVuY2lhZ3JhbSIsImNsaWVudF9pZCI6ImU1ODYxYTAwLTVlZDItNDkyOC1iNzNiLWEzN2M4OWFhOTM3MCIsInNjb3BlcyI6WyJ7XCJTY29wZVwiOlwiU3BsaXRNYXN0ZXJcIixcIkNsYWltc1wiOltdfSIsIntcIlNjb3BlXCI6XCJDaWVsb0FwaVwiLFwiQ2xhaW1zXCI6W119Il0sInJvbGUiOlsiU3BsaXRNYXN0ZXIiLCJDaWVsb0FwaSJdLCJpc3MiOiJodHRwczovL2F1dGhzYW5kYm94LmJyYXNwYWcuY29tLmJyIiwiYXVkIjoiVVZReGNVQTJjU0oxZmtRM0lVRW5PaUkzZG05dGZtbDVlbEI1SlVVdVFXZz0iLCJleHAiOjE1NjI4MTQwNzMsIm5iZiI6MTU2MjcyNzY3M30.UW6q8A2NyPLniuPtR6se4rarW2FS8pKlV60Uu8LJqxM';
$merchant = new Merchant($accessToken);

$chargebackId = '';

$chargebackHandler = [];

$chargebackHandling1 = new Chargeback();
$chargebackHandling1->setSubordinateMerchantId("7c7e5e7b-8a5d-41bf-ad91-b346e077f769")
                    ->setChargebackAmount(4000);
$chargebackHandler[] = $chargebackHandling1;

$chargebackHandling2 = new Chargeback();
$chargebackHandling2->setSubordinateMerchantId("2b9f5bea-5504-40a0-8ae7-04c154b06b8b")
                    ->setChargebackAmount(2000);
$chargebackHandler[] = $chargebackHandling2;

// Faz a consulta de eventos da Agenda
try {
    // Configure o SDK com seu merchant e o ambiente apropriado para lidar com o chargeback
    $chargeback_response = (new BraspagSplit($merchant, $environment))->handleChargeback($chargebackId, $chargebackHandler);

    print_r($chargeback_response);

} catch (BraspagRequestException $e) {
    print_r($e);
}
