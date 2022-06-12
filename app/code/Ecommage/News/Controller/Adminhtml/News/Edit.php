<?php

namespace Ecommage\News\Controller\Adminhtml\News;

use Ecommage\News\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Ecommage\News\Model\NewsFactory;

class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface {
    protected  $_pageFactory;
    protected $helper;
    private $_newsFactory;

    public function __construct(
        Context $context,
        PageFactory  $pageFactory,
        Data $helper,
        NewsFactory $newsFactory
    )
    {
        $this->_newsFactory = $newsFactory;
        $this->helper = $helper;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if(!$this->helper->getGeneralConfig('enable')){
            //   module disable-> redirect
            $this->messageManager->addError(__('Module news is not working!'));
            return $this->_forward('admin/dashboard');
        }

        $newsId = $this->getRequest()->getParam('blog_id');
        if(!$newsId){
            $this->messageManager->addError(__("Can't find the record you want to edit"));
            return $this->_redirect('news/news');
        }

        $newsModel = $this->_newsFactory->create();
        $news = $newsModel->load($newsId);
        if(!$news->getData()){
            $this->messageManager->addError(__("Can't find the record you want to edit"));
            return $this->_redirect('news/news');
        }

        $page = $this->_pageFactory->create();
        $page->getConfig()->getTitle()->prepend(__('NEWS DETAIL'));
        return $page;
    }
}
