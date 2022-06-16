<?php

namespace Ecommage\News\Controller\Index;
use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Ecommage\News\Helper\Data;

class Index extends Action
{
    protected $_pageFactory;
    protected $_helper;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $helper
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_helper = $helper;
        return parent::__construct($context);
    }
    public function execute()
    {
        if(!$this->_helper->getGeneralConfig('enable')){
            //   module disable-> redirect
            $this->messageManager->addError(__('Module is not working!'));
            return $this->_forward('/');
        }

         $page = $this->_pageFactory->create();
         $page->getConfig()->getTitle()->set('News page');

        return $page;
    }

}
