<?php

namespace Ecommage\Blog\Controller\Adminhtml\Blog;

use Ecommage\Blog\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Create extends \Magento\Backend\App\Action{
    protected  $_pageFactory;
    protected $helper;

    public function __construct(
        Context $context,
         PageFactory  $pageFactory,
        Data $helper
    )
    {
        $this->helper = $helper;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if(!$this->helper->getGeneralConfig('enable')){
            //   module disable-> redirect
            $this->messageManager->addError(__('Module blog is not working!'));
            return $this->_forward('admin/dashboard');
        }
        $page = $this->_pageFactory->create();

        $page->getConfig()->getTitle()->prepend(__('ADD NEW BLOG'));
        return $page;
    }
}
