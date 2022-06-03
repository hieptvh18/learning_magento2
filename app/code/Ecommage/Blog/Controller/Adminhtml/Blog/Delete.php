<?php

namespace Ecommage\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action{
    protected  $_blogFactory;
    public function __construct(Context $context,
                                \Ecommage\Blog\Model\BlogFactory $blogFactory
    )
    {
        $this->_blogFactory = $blogFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');

        if($blogId){
            $model = $this->_blogFactory->create();
            $blog = $model->load($blogId);

           if(count($blog->getData()) == 0){
               $this->messageManager->addError(__('Delele fail! BLog is not found!'));
           }else{
               //  remove
               $model->delete();
               $this->messageManager->addSuccess(__('Delele success!'));
           }

            return $this->_redirect('*/*/');
        }

        $this->messageManager->addError(__('Delele fail! BLog is not found!'));
        return $this->_redirect('*/*/');
    }
}
