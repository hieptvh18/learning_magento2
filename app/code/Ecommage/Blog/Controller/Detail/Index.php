<?php
//declare(strict_types=1);

namespace Ecommage\Blog\Controller\Detail;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface {

    protected $_blogFactory;
    protected  $_pageFactory;

    public function __construct(Context $context,
                                PageFactory $pageFactory,
                                \Ecommage\Blog\Model\BlogFactory $blogFactory
                                )
    {
        $this->_blogFactory = $blogFactory;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $postId = $this->getRequest()->getParam('id',null);
        if(!$postId){
           return $this->_redirect('blog');
        }

        $blog = $this->_blogFactory->create()->load($postId);

        // truyen blog tra ve tu controller->block & render
        $page = $this->_pageFactory->create();

        // gan data cho block
        $block = $page->getLayout()->getBlock('blog_detail_index');
        $block->setData('blog', $blog);

        return $page;
    }

    //    get detail blog

}
