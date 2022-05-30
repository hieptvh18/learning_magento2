<?php

namespace Ecommage\Blog\Controller\Index;
use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {

        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    public function execute()
    {

//        $post = $this->_objectManager->create('Ecommage\Blog\Model\Blog');
//         $post->addData([
//             'author_id' => 1,
//             'url_key' => 'https://facebook.com',
//             'title' => 'bla bla bla bla bla bla.............. this is post 2',
//             'content' => 'post',
//             'status' => 0,
//             'featured_image' => 'https://yt3.ggpht.com/ytc/AKedOLRyODozgkiPQuM8Ca7eZyxM8iOYR_MvXuxqQksOoQ=s900-c-k-c0x00ffffff-no-rj',
//            'status'=>1
//             ]);
//         $post->save();
//
//         die('create data done');

        return $this->_pageFactory->create();

    }
}
