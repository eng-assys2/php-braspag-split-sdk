<?php
require '../vendor/autoload.php';

use Braspag\Merchant;

use Braspag\Split\API\Environment;
use Braspag\Split\API\BraspagSplit;
use Braspag\Split\API\SchedulerAdjustment;

use Braspag\Request\BraspagRequestException;

// Configure o ambiente
$environment = Environment::sandbox();

// Configure seu merchant
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjbGllbnRfbmFtZSI6ImdlcmVuY2lhZ3JhbSIsImNsaWVudF9pZCI6ImU1ODYxYTAwLTVlZDItNDkyOC1iNzNiLWEzN2M4OWFhOTM3MCIsInNjb3BlcyI6WyJ7XCJTY29wZVwiOlwiU3BsaXRNYXN0ZXJcIixcIkNsYWltc1wiOltdfSIsIntcIlNjb3BlXCI6XCJDaWVsb0FwaVwiLFwiQ2xhaW1zXCI6W119Il0sInJvbGUiOlsiU3BsaXRNYXN0ZXIiLCJDaWVsb0FwaSJdLCJpc3MiOiJodHRwczovL2F1dGhzYW5kYm94LmJyYXNwYWcuY29tLmJyIiwiYXVkIjoiVVZReGNVQTJjU0oxZmtRM0lVRW5PaUkzZG05dGZtbDVlbEI1SlVVdVFXZz0iLCJleHAiOjE1NjI4MTQwNzMsIm5iZiI6MTU2MjcyNzY3M30.UW6q8A2NyPLniuPtR6se4rarW2FS8pKlV60Uu8LJqxM';
$merchant = new Merchant($accessToken);

$SchedulerAdjustment = new SchedulerAdjustment();
$SchedulerAdjustment->setMerchantIdToDebit('EA4DB25A-F981-4849-87FF-026897E006C6')
                    ->setMerchantIdToCredit('44F68284-27CF-43CB-9D14-1B1EE3F36838')
                    ->setForecastedDate('2019-08-01')
                    ->setAmount(1000)
                    ->setDescription('Multa por não cumprimento do prazo de entrega no pedido XYZ')
                    ->setTransactionId('717A0BD0-3D92-43DB-9D1E-9B82DFAFA392'); // Ao associar o ajuste a uma transação, os envolvidos devem ser participantes da transação.

// Faz a consulta de eventos da Agenda
try {
    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
    $transaction_query_response = (new BraspagSplit($merchant, $environment))->querySchedulerTransactions($schedulerQuery);

    $transactions = $transaction_query_response->getTransactions();

    foreach($transactions as $transaction){
        print_r($transaction->jsonSerialize());
    }

} catch (BraspagRequestException $e) {
    print_r($e);
}
