<?php

namespace Ecommage\Blog\Controller\Adminhtml\Blog;

use Ecommage\Blog\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Ecommage\Blog\Model\BlogFactory;

class Edit extends \Magento\Backend\App\Action{
    protected  $_pageFactory;
    protected $helper;
    private $_blogFactory;

    public function __construct(
        Context $context,
        PageFactory  $pageFactory,
        Data $helper,
        BlogFactory $blogFactory
    )
    {
        $this->_blogFactory = $blogFactory;
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

        $blogId = $this->getRequest()->getParam('id');
        if(!$blogId){
            $this->messageManager->addError(__("Can't find the record you want to edit"));
            return $this->_redirect('blog/blog');
        }

        $blogModel = $this->_blogFactory->create();
        $blog = $blogModel->load($blogId);
        if(!$blog->getData()){
            $this->messageManager->addError(__("Can't find the record you want to edit"));
            return $this->_redirect('blog/blog');
        }

        $page = $this->_pageFactory->create();
        $page->getConfig()->getTitle()->prepend(__('BLOG DETAIL'));
        return $page;
    }
}
