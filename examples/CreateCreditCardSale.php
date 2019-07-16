<?php
require '../vendor/autoload.php';

use BraspagSplit\Merchant;
use BraspagSplit\Cielo\API30\Ecommerce\Environment;
use BraspagSplit\Cielo\API30\Ecommerce\Sale;
use BraspagSplit\Cielo\API30\Ecommerce\CieloEcommerce;
use BraspagSplit\Cielo\API30\Ecommerce\Payment;
use BraspagSplit\Cielo\API30\Ecommerce\CreditCard;

use BraspagSplit\Request\BraspagRequestException;
// ...
// Configure o ambiente
$environment = Environment::sandbox();

// Configure seu merchant
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJjbGllbnRfbmFtZSI6ImdlcmVuY2lhZ3JhbSIsImNsaWVudF9pZCI6ImU1ODYxYTAwLTVlZDItNDkyOC1iNzNiLWEzN2M4OWFhOTM3MCIsInNjb3BlcyI6WyJ7XCJTY29wZVwiOlwiU3BsaXRNYXN0ZXJcIixcIkNsYWltc1wiOltdfSIsIntcIlNjb3BlXCI6XCJDaWVsb0FwaVwiLFwiQ2xhaW1zXCI6W119Il0sInJvbGUiOlsiU3BsaXRNYXN0ZXIiLCJDaWVsb0FwaSJdLCJpc3MiOiJodHRwczovL2F1dGhzYW5kYm94LmJyYXNwYWcuY29tLmJyIiwiYXVkIjoiVVZReGNVQTJjU0oxZmtRM0lVRW5PaUkzZG05dGZtbDVlbEI1SlVVdVFXZz0iLCJleHAiOjE1NjI4MTQwNzMsIm5iZiI6MTU2MjcyNzY3M30.UW6q8A2NyPLniuPtR6se4rarW2FS8pKlV60Uu8LJqxM';
$merchant = new Merchant($accessToken);

// Crie uma instância de Sale informando o ID do pedido na loja
$sale = new Sale('1234');

// Crie uma instância de Customer informando o nome do cliente
$customer = $sale->customer('Teste Accept');

$customer_data = [
    'Name' => 'Teste Accept',
    'Email' => 'teste@teste.com.br',
    'Birthdate' => '1997-10-09',
    'Identity' => '18160361106',
    'IdentityType' => 'cpf',
    'Mobile' => '5521995760078',
    'Phone' => '552125553669',
    'DeliveryAddress' => [
        'Street' =>'Alameda Xingu',
        'Number' =>'512',
        'Complement' =>'27 andar',
        'ZipCode' =>'12345987',
        'City' =>'São Paulo',
        'State' =>'SP',
        'Country' =>'BR',
        'District' =>'Alphaville'
    ],
    'Address' => [
        'Street' =>'Alameda Xingu',
        'Number' =>'512',
        'Complement' =>'27 andar',
        'ZipCode' =>'12345987',
        'City' =>'São Paulo',
        'State' =>'SP',
        'Country' =>'BR',
        'District' =>'Alphaville'
    ]
];
$customer_data = json_encode($customer_data);
$customer_data = json_decode($customer_data);

$customer->populate($customer_data);

// Crie uma instância de Payment informando o valor do pagamento
$payment = $sale->payment(10000);

// Crie uma instância de Credit Card utilizando os dados de teste
// esses dados estão disponíveis no manual de integração
$payment->setType(Payment::PAYMENTTYPE_SPLITTEDCREDITCARD)
            ->splittedCreditCard("693", CreditCard::VISA)
            ->setExpirationDate("12/2019")
            ->setCardNumber("4481530710186111")
            ->setHolder("Ricardo A O Costa");


// ==============================================================
// FRAUD ANALYSIS
$fraudAnalysis = $payment->fraudAnalysis();
$browser = $fraudAnalysis->browser("179.221.103.151");
$browser->setBrowserFingerprint('123456654322');
$fraudAnalysis->merchantDefinedFields(1, "Guest");
$fraudAnalysis->merchantDefinedFields(2, 90);
$fraudAnalysis->merchantDefinedFields(3, 6);
$fraudAnalysis->merchantDefinedFields(4, "Web");
$fraudAnalysis->cart("Produto teste", 1, 563, 10000);
$fraudAnalysis->shipping("Teste Accept");

// ==============================================================

// Crie o pagamento na Cielo
try {
    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
    $cielo_ecommerce = new CieloEcommerce($merchant, $environment);
    $authorize_sale = $cielo_ecommerce->createSale($sale);

    // // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
    // // dados retornados pela Cielo
    $paymentId = $authorize_sale->getPayment()->getPaymentId();

    // // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
    $captured_payment = $cielo_ecommerce->captureSale($paymentId, 10000, 0);

    print_r($captured_payment->jsonSerialize());

    // // E também podemos fazer seu cancelamento, se for o caso
    // $sale = (new CieloEcommerce($merchant, $environment))->cancelSale($paymentId, 15700);
} catch (BraspagRequestException $e) {
    // Em caso de erros de integração, podemos tratar o erro aqui.
    // os códigos de erro estão todos disponíveis no manual de integração.
    $error = $e->getCieloError();
    print_r($e);
}
