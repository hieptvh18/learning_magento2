<?php
namespace Ecommage\News\Controller\Adminhtml\Action;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    private $_newsFactory;
    private $_authSession;

    public function __construct(
        \Ecommage\News\Model\NewsFactory $newsFactory,
        Context $context,
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        $this->_authSession = $authSession;
        $this->_newsFactory = $newsFactory;
        parent::__construct($context);
    }

    /*
     * save news from ui form add news
     * */
    public function execute()
    {
        $formData = $this->getRequest()->getParams();

        $adminId = $this->_authSession->getUser()->getId();

        $newsModel = $this->_newsFactory->create();
        $newsModel->setData($formData);
        $newsModel->setData('author_id',(int)$adminId);

        try {
            // Save news
            $newsModel->save();

            // Display success message
            $this->messageManager->addSuccess(__('News have been saved.'));

        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

         return $this->_redirect('news/news/');
    }
}
