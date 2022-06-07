<?php
//declare(strict_types=1);

namespace Ecommage\Blog\Controller\Detail;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\View\Result\PageFactory;
use \Ecommage\Blog\Helper\Data;

class Index extends Action implements HttpGetActionInterface {

    protected $_blogFactory;
    protected  $_pageFactory;
    protected $_helper;

    public function __construct(Context $context,
                                PageFactory $pageFactory,
                                \Ecommage\Blog\Model\BlogFactory $blogFactory,
                                Data $helper
                                )
    {
        $this->_helper = $helper;
        $this->_blogFactory = $blogFactory;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if(!$this->_helper->getGeneralConfig('enable')){
            //   module disable-> redirect
            $this->messageManager->addError(__('Module is not working!'));
            return $this->_forward('/');
        }

        $postId = $this->getRequest()->getParam('id',null);
        if(!$postId){
           return $this->_redirect('blog');
        }

        $blog = $this->_blogFactory->create()->load($postId);

        if(!$blog->getData()){
            return $this->_redirect('blog');
        }

        // truyen blog tra ve tu controller->block & render
        $page = $this->_pageFactory->create();

        // gan data cho block
        $block = $page->getLayout()->getBlock('blog.detail.index');
        $block->setData('blog', $blog);

        return $page;
    }

}
