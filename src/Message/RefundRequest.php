<?php

/**
 * Mollie Refund Request.
 */
namespace Omnipay\Mollie\Message;

class RefundRequest extends AbstractRequest
{
	public function getMetadata()
    {
        return $this->getParameter('metadata');
    }

    public function setMetadata($value)
    {
        return $this->setParameter('metadata', $value);
    }

	public function getData()
    {
    	$this->validate('apiKey','amount','transactionId');

    	$data = array();
        $data['amount'] = $this->getAmount();
        $data['metadata'] = $this->getMetadata();

        return $data;
    }

    public function sendData($data)
    {
    	$httpResponse = $this->sendRequest('POST', '/payments/'.$this->getTransactionId().'/refunds', $data);
        return $this->response = new PurchaseResponse($this, $httpResponse->json());
    }

}