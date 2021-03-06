<?php

namespace Ecommage\Blog\Controller\MyBlog;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends Action implements HttpGetActionInterface {

    private $_authSession;
    protected $_customerUrl;
    protected $pageFactory;

    public function __construct(Context $context,
                                \Magento\Customer\Model\SessionFactory $_authSession,
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
        /*
         * Check login -> access post */
        if(!$this->_authSession->create()->isLoggedIn()){
            $urlLogin = $this->_customerUrl->getLoginUrl();
            $this->messageManager->addError(__('Please login before blogging.'));
            return $this->_redirect($urlLogin);
        }

        // display my blog
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('Your blog'));

        return $page;
    }

}
