<?php
namespace Ecommage\Blog\Controller\Adminhtml\Action;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    private $_blogFactory;
    private $_authSession;

    public function __construct(
        \Ecommage\Blog\Model\BlogFactory $blogFactory,
        Context $context,
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        $this->_authSession = $authSession;
        $this->_blogFactory = $blogFactory;
        parent::__construct($context);
    }

    /*
     * save blog from ui form add blog
     * */

    public function execute()
    {
        $formData = $this->getRequest()->getParams();

        $adminId = $this->_authSession->getUser()->getId();

        $blogModel = $this->_blogFactory->create();
        $blogModel->setData($formData);
        $blogModel->setData('author_id',(int)$adminId);

        try {
            // Save blog
            $blogModel->save();

            // Display success message
            $this->messageManager->addSuccess(__('Add new blog success.'));

        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

         return $this->_redirect('blog/blog/');
    }
}
