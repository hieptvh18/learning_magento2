<?php

namespace Ecommage\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Create extends \Magento\Backend\App\Action{
    protected  $_pageFactory;

    public function __construct(
        Context $context,
         PageFactory  $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $page = $this->_pageFactory->create();

        $page->getConfig()->getTitle()->prepend(__('ADD NEW BLOG'));
        return $page;
    }
}
