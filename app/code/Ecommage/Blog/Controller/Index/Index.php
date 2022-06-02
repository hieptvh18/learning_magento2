<?php

namespace Ecommage\Blog\Controller\Index;
use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Ecommage\Blog\Helper\Data;

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

//        $post = $this->_objectManager->create('Ecommage\Blog\Model\Blog');
//         $post->addData([
//             'author_id' => 2,
//             'url_key' => 'https://facebook.com',
//             'title' => 'this is title post 2',
//             'content' => 'post 2 content',
//             'status' => 1,
//             'featured_image' => 'https://yt3.ggpht.com/ytc/AKedOLRyODozgkiPQuM8Ca7eZyxM8iOYR_MvXuxqQksOoQ=s900-c-k-c0x00ffffff-no-rj'
//             ]);
//         $post->save();
//
//         die('create data done');

         $page = $this->_pageFactory->create();
         $page->getConfig()->getTitle()->set('Blog page');

        return $page;
    }
}
