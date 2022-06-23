<?php
namespace Ecommage\OrderSendMail\Model\Mail;


class TransportBuilder extends
\Magento\Framework\Mail\Template\TransportBuilder
{
    public function getMessage()
	{
    	return $this->message;
	}
    //create attachment items for email based on parameters
    public function createAttachment($params, $transport = false)
	{
    	$type = isset($params['cat']) ? $params['cat'] : \Zend_Mime::TYPE_OCTETSTREAM;
    	if ($transport === false) {
        	if ($type == 'pdf') {
            	$this->message->createAttachment(
                	$params['body'],
                	'application/pdf',
                	\Zend_Mime::DISPOSITION_ATTACHMENT,
                	\Zend_Mime::ENCODING_BASE64,
                	$params['name']
            	);
        	} elseif ($type == 'png') {
            	$this->message->createAttachment(
                	$params['body'],
                	'image/png',
                	\Zend_Mime::DISPOSITION_ATTACHMENT,
                	\Zend_Mime::ENCODING_BASE64,
                	$params['name']
            	);
        	} else {
                $encoding =
                isset($params['encoding']) ? $params['encoding'] : \Zend_Mime::ENCODING_BASE64;
            	$this->message->createAttachment(
                	$params['body'],
                	$type,
                	\Zend_Mime::DISPOSITION_ATTACHMENT,
                	$encoding,
                	$params['name']
            	);
        	}
    	} else {
        	$this->addAttachment($params, $transport);
    	}
    	return $this;
	}

	public function addAttachment($params, $transport)
	{
    	$zendPart = $this->createZendMimePart($params);
    	$parts	= $transport->getMessage()->getBody()->addPart($zendPart);
    	$transport->getMessage()->setBody($parts);
	}

	protected function createZendMimePart($params)
	{
    	if (class_exists('Zend\Mime\Mime') && class_exists('Zend\Mime\Part')) {
        	$type          	= isset($params['type']) ? $params['type'] : \Zend\Mime\Mime::TYPE_OCTETSTREAM;
        	$part          	= new \Zend\Mime\Part(@$params['body']);
        	$part->type    	= $type;
        	$part->filename	= @$params['name'];
        	$part->disposition = \Zend\Mime\Mime::DISPOSITION_ATTACHMENT;
        	$part->encoding	= \Zend\Mime\Mime::ENCODING_BASE64;
        	return $part;
    	} else {
        		throw new \Exception("Missing Zend Framework Source");
    	}
	}

	public function reset()
	{
    		return parent::reset();
	}
}
