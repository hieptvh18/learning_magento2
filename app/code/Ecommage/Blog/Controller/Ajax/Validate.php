<?php

namespace Ecommage\Blog\Controller\Ajax;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Validate extends Action implements HttpPostActionInterface{

    protected $_blogFactory;

    public function __construct(Context $context,
    \Ecommage\Blog\Model\BlogFactory $_blogFactory)
    {
        $this->_blogFactory = $_blogFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        //lấy dữ liệu từ ajax gửi sang->check unique title
        $title = $this->getRequest()->getParam('title');
        $blogExist = $this->_blogFactory->create()->getCollection()
            ->addFieldToFilter('title',array('eq'=>$title));

        if($blogExist->getSize()){
            $status = 'exist';
            $data = $blogExist->getData();
        }else{
            $status = 'not exist';
            $data = [];
        }

        $response = $this->resultFactory
            ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
            ->setData([
                'status'  => $status,
                'message' => "submit success!",
                'data' => $data
            ]);

        return $response;

    }
}
