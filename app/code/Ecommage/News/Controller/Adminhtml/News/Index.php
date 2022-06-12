<?php
namespace Ecommage\News\Controller\Adminhtml\News;
use Ecommage\News\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = "Ecommage_News::news";

    protected $_pageFactory;
    protected $helper;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        PageFactory        $pageFactory,
        Data     $helper,
        \Ecommage\News\Model\ResourceModel\News\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->_pageFactory = $pageFactory;
        $this->helper = $helper;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->collectionFactory->create()->joinAdminUserTbl();

        if(!$this->helper->getGeneralConfig('enable')){
            $this->messageManager->addError(__('Module news is not working!'));
            return $this->_forward('admin/dashboard');
        }

        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('News Manage')));
        return $resultPage;
    }

    //    acl
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ecommage_News::news');
    }

}
