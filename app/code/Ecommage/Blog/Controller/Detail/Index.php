<?php

namespace Ecommage\Blog\Controller\Detail;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends Action implements HttpGetActionInterface {

    protected $_customerUrl;
    protected $pageFactory;
    protected $blogFactory;

    public function __construct(Context $context,
                                \Magento\Customer\Model\Url $customerUrl,
                                \Magento\Framework\View\Result\PageFactory $_pageFactory,
                                \Ecommage\Blog\Model\BlogFactory $blogFactory
    )
    {
        $this->blogFactory = $blogFactory;
        $this->pageFactory=  $_pageFactory;
        $this->_customerUrl = $customerUrl;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');

        if($blogId){
            $blog = $this->blogFactory->create()->load($blogId);

            if(!$blog){
                return $this->_redirect('/blog');
            }

            // truyen data res from controller->block & render
            // get blog relate
            $relateBlog = $this->blogFactory->create()->getCollection()
                ->addFieldToFilter('author_id',['eq'=>$blog->getData('author_id')])
            ->addFieldToFilter('id',['neq'=>$blog->getData('id')]);

            $page = $this->pageFactory->create();
            $page->getConfig()->getTitle()->set(__('detail blog'));

            $block = $page->getLayout()->getBlock('blog.detail.content');
            $block->setData('blog',$blog);
            $block->setData('relateBlog',$relateBlog);
            return $page;

        }

        return $this->_redirect('/blog');
    }


}
