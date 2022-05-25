<?php

namespace Ecommage\HelloWorld\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\Stdlib\DateTime\DateTimeFactory;

class Index extends Action
{
    protected $_pageFactory;
    protected $_postFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {

        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        // login control and respone req->
        //  $page = $this->_pageFactory->create();
        //  return $page;

        /**
         * test khoi tao model with _objectManger
         * */ 
        $post = $this->_objectManager->create('Ecommage\HelloWorld\Model\Post');
        // $post->addData([
        //     'name' => 'Bai post 2',
        //     'url_key' => '',
        //     'post_content' => 'bla bla bla bla bla bla.............. this is post 2',
        //     'tags' => 'post',
        //     'status' => 0,
        //     'featured_image' => 'image2.png',
        // ]);
        // $post->save();

        // die('create data done');

        /**
         * test get data
         */

         $post = $post->load(1)->getData();
         echo "<pre>";
         var_dump($post);die;

    }
}
