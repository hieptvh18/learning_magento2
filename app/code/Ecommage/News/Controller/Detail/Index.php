<?php
//declare(strict_types=1);

namespace Ecommage\News\Controller\Detail;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\View\Result\PageFactory;
use \Ecommage\News\Helper\Data;

class Index extends Action implements HttpGetActionInterface {

    protected $_newsFactory;
    protected  $_pageFactory;
    protected $_helper;

    public function __construct(Context $context,
                                PageFactory $pageFactory,
                                \Ecommage\News\Model\NewsFactory $newsFactory,
                                Data $helper
                                )
    {
        $this->_helper = $helper;
        $this->_newsFactory = $newsFactory;
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
           return $this->_redirect('news');
        }

        $news = $this->_newsFactory->create()->load($postId);

        if(!$news->getData()){
            return $this->_redirect('news');
        }

        // truyen news tra ve tu controller->block & render
        $page = $this->_pageFactory->create();

        // gan data cho block
        $block = $page->getLayout()->getBlock('news.detail.index');
        $block->setData('news', $news);

        return $page;
    }

}
