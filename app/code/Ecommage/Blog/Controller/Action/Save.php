<?php

namespace Ecommage\Blog\Controller\Action;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Save extends Action implements HttpPostActionInterface
{

    protected $_authSession;
    protected $_blogFactory;

    public function __construct(Context $context,
                                \Magento\Customer\Model\Session $_authSession,
                                \Ecommage\Blog\Model\BlogFactory $blogFactory
)
    {
        $this->_blogFactory = $blogFactory;
        $this->_authSession = $_authSession;
        parent::__construct($context);
    }

    public function execute()
    {
        echo "<pre>";
        print_r($this->getRequest()->getParams());
        die;

        $formData = $this->getRequest()->getParams();

        $authorId = $this->_authSession->getUser()->getId();

        $blogModel = $this->_blogFactory->create();
        $blogModel->setData($formData);
        $blogModel->setData('author_id',(int)$authorId);

        try {
            // Save blog
            $blogModel->save();

            $this->messageManager->addSuccess(__('Blog have been saved.'));

        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        return $this->_redirect('blog/');
    }
}
