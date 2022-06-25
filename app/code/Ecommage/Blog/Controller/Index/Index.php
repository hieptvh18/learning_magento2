<?php

namespace Ecommage\Blog\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Ecommage\Blog\Helper\Data;
use Psr\Log\LoggerInterface;

class Index extends Action implements HttpGetActionInterface {

    private $_authSession;
    protected $_customerUrl;
    protected $pageFactory;

    public function __construct(Context $context,
                                \Magento\Customer\Model\Session $_authSession,
                                \Magento\Customer\Model\Url $customerUrl,
                                \Magento\Framework\View\Result\PageFactory $_pageFactory
    )
    {
        $this->pageFactory=  $_pageFactory;
        $this->_customerUrl = $customerUrl;
        $this->_authSession = $_authSession;
        parent::__construct($context);
    }

    public function execute()
    {
//        $this->_helper->sendEmail('hipbu18@gmail.com');
//        die;

        /*
         * Check login -> access post */
        if(!$this->_authSession->isLoggedIn()){
            $urlLogin = $this->_customerUrl->getLoginUrl();
            $this->messageManager->addError(__('Please login before blogging.'));
            return $this->_redirect($urlLogin);
        }

        // display form blogging
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('Add blog'));

        return $page;
    }

}
