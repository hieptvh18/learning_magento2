<?php

namespace Ecommage\Blog\Cron;
use Psr\Log\LoggerInterface;

class SignupToReceiveNews {

    protected $_helper;
    protected $_customerSession;
    protected $logger;
    protected $_registerFatory;

    public function __construct(
        \Ecommage\Blog\Helper\Data $helper,
        \Magento\Customer\Model\Session $customerSession,
        LoggerInterface $logger,
        \Ecommage\Blog\Model\RegisterFactory $_registerFactory
    )
    {
        $this->_registerFactory = $_registerFactory;
        $this->logger = $logger;
        $this->_customerSession = $customerSession;
        $this->_helper = $helper;
    }

    public function execute(){
        /*
         * load email register from db-> loop && send mail;
         * */
        $collection = $this->_registerFactory->create()->getCollection();
        foreach ($collection as $item){
            try{
                $this->_helper->sendEmail($item->getData('customer_email'));

                $this->logger->info('Send mail success! + '. $item->getData('customer_email'));
            }catch(\Exception $e){
                $this->logger->error($e->getMessage());
            }
        }

    }
}
