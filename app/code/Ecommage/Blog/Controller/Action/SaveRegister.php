<?php

namespace Ecommage\Blog\Controller\Action;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;

class SaveRegister extends Action implements HttpPostActionInterface{

    protected $_sessionCustomer;
    protected $_registerFactory;

    public function __construct(Context $context,
                                \Magento\Framework\Session\SessionManagerInterface $sessionObj,
                                \Magento\Customer\Model\Session $customer,
                                \Ecommage\Blog\Model\RegisterFactory $registerFactory

    )
    {
        $this->_registerFactory = $registerFactory;
        $this->_sessionCustomer = $customer;
        parent::__construct($context);
    }

    public function execute()
    {
        /*
         * get param + save db -> pass to Cron job*/
        $email = $this->getRequest()->getParam('email');
        if(!$email || !$this->_registerFactory->create()->getData('customer_email')){
            $this->messageManager->addWarning('You are already registered');
            return $this->_redirect('blog/registerreceivenews');
        }

        $registerModel = $this->_registerFactory->create();

        $registerModel->setData('customer_email',$email);
        $registerModel->setData('status',0);

        try{
            $registerModel->save();
            $this->messageManager->addSuccess('Register success!');
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        return $this->_redirect('blog/registerreceivenews');
    }



}
