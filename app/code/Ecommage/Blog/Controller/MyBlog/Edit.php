<?php

namespace Ecommage\Blog\Controller\MyBlog;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends Action implements HttpGetActionInterface {

    private $_authSession;
    protected $_customerUrl;
    protected $pageFactory;
    protected $blogFactory;

    public function __construct(Context $context,
                                \Magento\Customer\Model\Session $_authSession,
                                \Magento\Customer\Model\Url $customerUrl,
                                \Magento\Framework\View\Result\PageFactory $_pageFactory,
                                \Ecommage\Blog\Model\BlogFactory $blogFactory
    )
    {
        $this->blogFactory = $blogFactory;
        $this->pageFactory=  $_pageFactory;
        $this->_customerUrl = $customerUrl;
        $this->_authSession = $_authSession;
        parent::__construct($context);
    }

    public function execute()
    {
        /*
         * Check login -> access post */
        if(!$this->_authSession->isLoggedIn()){
            $urlLogin = $this->_customerUrl->getLoginUrl();
            $this->messageManager->addError(__('Please login before edit blog.'));
            return $this->_redirect($urlLogin);
        }

        $paramId = $this->getRequest()->getParam('id');
        if(!$paramId || !$this->blogFactory->create()->load($paramId)){
            $this->messageManager->addError(__('No matching id or blog found.'));
            return $this->_redirect('/blog');
        }

        $blogData = $this->blogFactory->create()->load($paramId);

        // display my blog & rerender data to form....
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('Edit blog'));

        return $page;
    }

}
