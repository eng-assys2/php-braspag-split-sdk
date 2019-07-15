<?php

namespace Braspag\Cielo\API30\Ecommerce;

use Braspag\Cielo\API30\Ecommerce\SplitPayment\SplitPayment;
use Braspag\Cielo\API30\Ecommerce\FraudAnalysis\FraudAnalysis;

/**
 * Class Payment
 *
 * @package Braspag\Cielo\API30\Ecommerce
 */
class Payment implements \JsonSerializable
{

    const PAYMENTTYPE_SPLITTEDCREDITCARD = 'SplittedCreditCard';

    const PAYMENTTYPE_SPLITTEDDEBITCARD = 'SplittedDebitCard';

    const PROVIDER_BRADESCO = 'Bradesco';

    const PROVIDER_BANCO_DO_BRASIL = 'BancoDoBrasil';

    const PROVIDER_SIMULADO = 'Simulado';

    /** @var integer|null 
     * Taxa do serviço a ser capturado
     * Tamanho: 15
     */
    private $serviceTaxAmount;

    /** @var integer 
     * Número de Parcelas.
     * Tamanho: 2
     */
    private $installments;

    /** @var string|null 
     * Tipo de parcelamento. Possíveis valores:
     * Loja (ByMerchant)
     * Cartão (ByIssuer)
     * Tamanho: 10
     */
    private $interest;

    /** @var boolean|null
     * Booleano que identifica que a autorização deve ser com captura automática
     * Default: false
     */
    private $capture = false;

    /** @var boolean|null 
     * Define se o comprador será direcionado ao Banco emissor para autenticação do cartão, ou seja,
     * Indica se a transação deve ser autenticada (true) ou não (false).
     * Para transações autenticadas externamente (fornecedor de autenticação de sua escolha), 
     * este campo deve ser enviado com valor “True”, e no nó ExternalAuthentication deve-se enviar os dados 
     * retornados pelo mecanismo de autenticação externa escolhido (XID, CAVV e ECI)
     * Default: false (se crédito)/ true (se débito)
     */
    private $authenticate = false;

    /** @var string|null 
     * URL para qual o Lojista deve redirecionar o Cliente para o fluxo de Débito.
     * Tamanho: 56
     * Formato: Url de Autenticação
     */
    private $authenticationUrl;

    /** @var string|null 
     * Id da transação na adquirente.
     * Tamanho: 13
     */
    private $tid;

    /** @var string|null 
     * Número da autorização, identico ao NSU.
     * Tamanho: 6
     * Formato: Texto alfanumérico
     */
    private $proofOfSale;

    /** @var string|null 
     * Código de autorização.
     * Tamanho: 6
     * Formato: Texto alfanumérico
     */
    private $authorizationCode;

    /** @var string|null 
     * Texto impresso na fatura bancaria comprador
     * Exclusivo para VISA/MASTER
     * não permite caracteres especiais
     * Tamanho: 13
     */
    private $softDescriptor = "";

    /** @var string 
     * URI para onde o usuário será redirecionado após o fim do pagamento
     * Url de retorno do lojista. URL para onde o lojista vai ser redirecionado no final do fluxo.
     * Formato: http://www.urllogista.com.br
     * Tamanho: 1024
     */
    private $returnUrl;

    /** @var string|null 
     * Define comportamento do meio de pagamento
     * NÃO OBRIGATÓRIO PARA CRÉDITO
     * Tamanho: 15
     */
    private $provider;

    /** @var string|null 
     * Campo Identificador do Pedido
     * Tamanho: 36
     * Formato: xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
     */
    private $paymentId;

    /** @var string 
     * Tipo do Meio de Pagamento
     * Tamanho: 100
     * Obs: Enviar qrcode para uma transação de QRCode.
     */
    private $type;

    /** @var integer|null 
     * Valor do Pedido
     * Deve ser enviado em centavos
     * Tamanho: 15
     */
    private $amount;

    /** @var datetime|null 
     * Data de Recebimento do Pedido
     * Tamanho: 23
     */
    private $receivedDate;

    /** @var integer|null 
     * Valor Capturado
     */
    private $capturedAmount;

    /** @var datetime|null 
     * Data da captura
     */
    private $capturedDate;

    /** @var integer|null 
     * Valor cancelado
     */
    private $voidedAmount;

    /** @var datetime|null 
     * Data do cancelamento
     */
    private $voidedDate;

    /** @var string 
     * Moeda na qual o pagamento será feito (BRL)
     * Tamanho: 3
     */
    private $currency;

    /** @var string|null 
     * Pais no qual o pagamento será feito
     * Tamanho: 3
     */
    private $country;

    /** @var string|null 
     * Código de retorno da Adquirência.
     * Tamanho: 32
     * Formato: Texto alfanumérico
     */
    private $returnCode;

    /** @var string|null 
     * Mensagem de retorno da Adquirência.
     * Tamanho: 512
     * Formato: Texto alfanumérico
     */
    private $returnMessage;

    /** @var byte|null 
     * Status da Transação
     * No caso de uma transação de geração de QRCode de pagamento, o status inicial é 12 (Pending).
     */
    private $status;

    /** @var \StdClass|null 
     * Links com ações possíveis para se realizar com o pagamento
     * 
     */
    private $links;

    /**
     * 
     */
    private $extraDataCollection;

    /** @var boolean|null 
     * Indica que a transação utilizou QRCode
     */
    private $isQrCode;

    /** @var string|null 
     * QRCode codificado na base 64. 
     * Por exemplo, a imagem poderá ser apresentada na página utilizando o código HTML como este:
     * <img src=”data:image/png;base64,{código da imagem na base 64}”>
     * Tamanho: variável
     * Formato: Texto alfanumérico
     */
    private $qrCodeBase64Image;

    /** @var string|null 
     * Código de retorno da Operação.
     * Tamanho: 32
     * Formato: Texto alfanumérico	
     */
    private $reasonCode;

    /** @var string|null 
     * Mensagem de retorno da Operação.
     * Tamanho: 512
     * Formato: Texto alfanumérico	
     */
    private $reasonMessage;

    /** @var string|null 
     * Código de retorno do Provider.
     * Tamanho: 32
     * Formato: Texto alfanumérico	
     */
    private $providerReturnCode;

    /** @var string|null 
     * Mensagem de retorno do Provider.
     * Tamanho: 512
     * Formato: Texto alfanumérico	
     */
    private $providerReturnMessage;

    /** @var CreditCard|null 
     * Cartão de crédito do comprador
     */
    private $creditCard;

    /** @var CreditCard|null 
     * * Cartão de débito do comprador
     */
    private $debitCard;

    /** @var boolean|null 
     * Marcação de uma Transação com Split de Pagamento da Braspag Ativado
     * Tamanho: 5
     */
    private $isSplitted;

    /** @var SplitPayment|null 
     * Instância de Pagamento Dividido
     */
    private $splitPayments;

    /** @var FraudAnalysis|null 
     * Nó de análise de fraude
     * 
     */
    private $fraudAnalysis;

    /**
     * Payment constructor.
     *
     * @param int $amount
     * @param int $installments
     */
    public function __construct($amount = 0, $installments = 1)
    {
        $this->setAmount($amount);
        $this->setInstallments($installments);
    }

    /**
     * @param $json
     *
     * @return Payment
     */
    public static function fromJson($json)
    {
        $payment = new Payment();
        $payment->populate(json_decode($json));

        return $payment;
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        $this->serviceTaxAmount = isset($data->ServiceTaxAmount) ? $data->ServiceTaxAmount : null;
        $this->installments = isset($data->Installments) ? $data->Installments : null;
        $this->interest = isset($data->Interest) ? $data->Interest : null;
        $this->capture = isset($data->Capture) ? !!$data->Capture : false;
        $this->authenticate = isset($data->Authenticate) ? !!$data->Authenticate : false;
        $this->authenticationUrl = isset($data->AuthenticationUrl) ? $data->AuthenticationUrl : null;
        $this->tid = isset($data->Tid) ? $data->Tid : null;
        $this->proofOfSale = isset($data->ProofOfSale) ? $data->ProofOfSale : null;
        $this->authorizationCode = isset($data->AuthorizationCode) ? $data->AuthorizationCode : null;
        $this->softDescriptor = isset($data->SoftDescriptor) ? $data->SoftDescriptor : null;
        $this->returnUrl = isset($data->ReturnUrl) ? $data->ReturnUrl : null;
        $this->provider = isset($data->Provider) ? $data->Provider : null;
        $this->paymentId = isset($data->PaymentId) ? $data->PaymentId : null;
        $this->type = isset($data->Type) ? $data->Type : null;
        $this->amount = isset($data->Amount) ? $data->Amount : null;
        $this->receivedDate = isset($data->ReceivedDate) ? $data->ReceivedDate : null;
        $this->capturedAmount = isset($data->CapturedAmount) ? $data->CapturedAmount : null;
        $this->capturedDate = isset($data->CapturedDate) ? $data->CapturedDate : null;
        $this->voidedAmount = isset($data->VoidedAmount) ? $data->VoidedAmount : null;
        $this->voidedDate = isset($data->VoidedDate) ? $data->VoidedDate : null;
        $this->currency = isset($data->Currency) ? $data->Currency : null;
        $this->country = isset($data->Country) ? $data->Country : null;
        $this->returnCode = isset($data->ReturnCode) ? $data->ReturnCode : null;
        $this->returnMessage = isset($data->ReturnMessage) ? $data->ReturnMessage : null;
        $this->status = isset($data->Status) ? $data->Status : null;

        $this->links = isset($data->Links) ? $data->Links : [];
        $this->extraDataCollection = isset($data->ExtraDataCollection) ? $data->ExtraDataCollection : [];

        $this->isQrCode = isset($data->IsQrCode) ? $data->IsQrCode : null;
        $this->qrCodeBase64Image = isset($data->QrCodeBase64Image) ? $data->QrCodeBase64Image : null;

        $this->reasonCode = isset($data->ReasonCode) ? $data->ReasonCode : null;
        $this->reasonMessage = isset($data->ReasonMessage) ? $data->ReasonMessage : null;
        $this->providerReturnCode = isset($data->ProviderReturnCode) ? $data->ProviderReturnCode : null;
        $this->providerReturnMessage = isset($data->ProviderReturnMessage) ? $data->ProviderReturnMessage : null;

        if (isset($data->CreditCard)) {
            $this->creditCard = new CreditCard();
            $this->creditCard->populate($data->CreditCard);
        }

        if (isset($data->DebitCard)) {
            $this->debitCard = new CreditCard();
            $this->debitCard->populate($data->DebitCard);
        }

        $this->isSplitted = isset($data->IsSplitted) ? !!$data->IsSplitted : false;
        if (isset($data->SplitPayments)) {
            foreach ($data->SplitPayments as $splitPayment) {
                $splittedPayment = new SplitPayment();
                $splittedPayment->populate($splitPayment);    
                $this->splitPayments[] = $splittedPayment;
            }      
        }

        if (isset($data->FraudAnalysis)) {
            $this->fraudAnalysis = new FraudAnalysis();
            $this->fraudAnalysis->populate($data->FraudAnalysis);
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @param $securityCode
     * @param $brand
     *
     * @return CreditCard
     */
    public function splittedCreditCard($securityCode, $brand)
    {
        $card = $this->newCard($securityCode, $brand);

        $this->setType(self::PAYMENTTYPE_SPLITTEDCREDITCARD);
        $this->setCreditCard($card);

        return $card;
    }

    /**
     * @param $securityCode
     * @param $brand
     *
     * @return CreditCard
     */
    private function newCard($securityCode, $brand)
    {
        $card = new CreditCard();
        $card->setSecurityCode($securityCode);
        $card->setBrand($brand);

        return $card;
    }

    /**
     * @param $securityCode
     * @param $brand
     *
     * @return CreditCard
     */
    public function splittedDebitCard($securityCode, $brand)
    {
        $card = $this->newCard($securityCode, $brand);

        $this->setType(self::PAYMENTTYPE_SPLITTEDDEBITCARD);
        $this->setDebitCard($card);

        return $card;
    }

    /**
     * @return mixed
     */
    public function getServiceTaxAmount()
    {
        return $this->serviceTaxAmount;
    }

    /**
     * @param $serviceTaxAmount
     *
     * @return $this
     */
    public function setServiceTaxAmount($serviceTaxAmount)
    {
        $this->serviceTaxAmount = $serviceTaxAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstallments()
    {
        return $this->installments;
    }

    /**
     * @param $installments
     *
     * @return $this
     */
    public function setInstallments($installments)
    {
        $this->installments = $installments;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param $interest
     *
     * @return $this
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCapture()
    {
        return $this->capture;
    }

    /**
     * @param $capture
     *
     * @return $this
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAuthenticate()
    {
        return $this->authenticate;
    }

    /**
     * @param $authenticate
     *
     * @return $this
     */
    public function setAuthenticate($authenticate)
    {
        $this->authenticate = $authenticate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard $creditCard
     *
     * @return $this
     */
    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebitCard()
    {
        return $this->debitCard;
    }

    /**
     * @param mixed $debitCard
     *
     * @return $this
     */
    public function setDebitCard($debitCard)
    {
        $this->debitCard = $debitCard;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationUrl()
    {
        return $this->authenticationUrl;
    }

    /**
     * @param $authenticationUrl
     *
     * @return $this
     */
    public function setAuthenticationUrl($authenticationUrl)
    {
        $this->authenticationUrl = $authenticationUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * @param $tid
     *
     * @return $this
     */
    public function setTid($tid)
    {
        $this->tid = $tid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProofOfSale()
    {
        return $this->proofOfSale;
    }

    /**
     * @param $proofOfSale
     *
     * @return $this
     */
    public function setProofOfSale($proofOfSale)
    {
        $this->proofOfSale = $proofOfSale;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * @param $authorizationCode
     *
     * @return $this
     */
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getSoftDescriptor()
    {
        return $this->softDescriptor;
    }

    /**
     * @param $softDescriptor
     *
     * @return $this
     */
    public function setSoftDescriptor($softDescriptor)
    {
        $this->softDescriptor = $softDescriptor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param $returnUrl
     *
     * @return $this
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param $provider
     *
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param $paymentId
     *
     * @return $this
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivedDate()
    {
        return $this->receivedDate;
    }

    /**
     * @param $receivedDate
     *
     * @return $this
     */
    public function setReceivedDate($receivedDate)
    {
        $this->receivedDate = $receivedDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCapturedAmount()
    {
        return $this->capturedAmount;
    }

    /**
     * @param $capturedAmount
     *
     * @return $this
     */
    public function setCapturedAmount($capturedAmount)
    {
        $this->capturedAmount = $capturedAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCapturedDate()
    {
        return $this->capturedDate;
    }

    /**
     * @param $capturedDate
     *
     * @return $this
     */
    public function setCapturedDate($capturedDate)
    {
        $this->capturedDate = $capturedDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoidedAmount()
    {
        return $this->voidedAmount;
    }

    /**
     * @param $voidedAmount
     *
     * @return $this
     */
    public function setVoidedAmount($voidedAmount)
    {
        $this->voidedAmount = $voidedAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoidedDate()
    {
        return $this->voidedDate;
    }

    /**
     * @param $voidedDate
     *
     * @return $this
     */
    public function setVoidedDate($voidedDate)
    {
        $this->voidedDate = $voidedDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * @param $returnCode
     *
     * @return $this
     */
    public function setReturnCode($returnCode)
    {
        $this->returnCode = $returnCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnMessage()
    {
        return $this->returnMessage;
    }

    /**
     * @param $returnMessage
     *
     * @return $this
     */
    public function setReturnMessage($returnMessage)
    {
        $this->returnMessage = $returnMessage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param $links
     *
     * @return $this
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtraDataCollection()
    {
        return $this->extraDataCollection;
    }

    /**
     * @param $extraDataCollection
     *
     * @return $this
     */
    public function setExtraDataCollection($extraDataCollection)
    {
        $this->extraDataCollection = $extraDataCollection;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSplitPayments()
    {
        return $this->splitPayments;
    }

    /**
     * @param $subordinateMerchantId
     *
     * @return SplitPayment
     */
    public function splitPayment($subordinateMerchantId)
    {
        $splitPayment = new SplitPayment($subordinateMerchantId);
        $this->splitPayments[] = $splitPayment;

        return $splitPayment;
    }

    /**
     * @param $splitPayments
     *
     * @return $this
     */
    public function setSplitPayments($splitPayments)
    {
        $this->splitPayments = $splitPayments;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsSplitted()
    {
        return $this->isSplitted;
    }

    /**
     * @param $isSplitted
     *
     * @return $this
     */
    public function setIsSplitted($isSplitted)
    {
        $this->isSplitted = $isSplitted;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFraudAnalysis()
    {
        return $this->fraudAnalysis;
    }

    /**
     * @param $fraudAnalysis
     *
     * @return $this
     */
    public function setFraudAnalysis($fraudAnalysis)
    {
        $this->fraudAnalysis = $fraudAnalysis;

        return $this;
    }

    /**
     * @param $subordinateMerchantId
     *
     * @return FraudAnalysis
     */
    public function fraudAnalysis()
    {
        $fraudAnalysis = new FraudAnalysis();
        $this->fraudAnalysis = $fraudAnalysis;

        return $fraudAnalysis;
    }

    /**
     * @return mixed
     */
    public function getIsQrCode()
    {
        return $this->isQrCode;
    }

    /**
     * @param $isQrCode
     *
     * @return $this
     */
    public function setIsQrCode($isQrCode)
    {
        $this->isQrCode = $isQrCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQrCodeBase64Image()
    {
        return $this->qrCodeBase64Image;
    }

    /**
     * @param $qrCodeBase64Image
     *
     * @return $this
     */
    public function setQrCodeBase64Image($qrCodeBase64Image)
    {
        $this->qrCodeBase64Image = $qrCodeBase64Image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @param $reasonCode
     *
     * @return $this
     */
    public function setReasonCode($reasonCode)
    {
        $this->reasonCode = $reasonCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReasonMessage()
    {
        return $this->reasonMessage;
    }

    /**
     * @param $reasonMessage
     *
     * @return $this
     */
    public function setReasonMessage($reasonMessage)
    {
        $this->reasonMessage = $reasonMessage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderReturnCode()
    {
        return $this->providerReturnCode;
    }

    /**
     * @param $providerReturnCode
     *
     * @return $this
     */
    public function setProviderReturnCode($providerReturnCode)
    {
        $this->providerReturnCode = $providerReturnCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderReturnMessage()
    {
        return $this->providerReturnMessage;
    }

    /**
     * @param $providerReturnMessage
     *
     * @return $this
     */
    public function setProviderReturnMessage($providerReturnMessage)
    {
        $this->providerReturnMessage = $providerReturnMessage;

        return $this;
    }

}
