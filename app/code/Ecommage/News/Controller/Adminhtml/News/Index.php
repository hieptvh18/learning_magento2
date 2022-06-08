<?php
namespace Ecommage\News\Controller\Adminhtml\News;
use Ecommage\News\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $_pageFactory;
    protected $helper;

    public function __construct(
        Context $context,
        PageFactory        $pageFactory,
        Data                                  $helper
    ) {
        $this->_pageFactory = $pageFactory;
        $this->helper = $helper;
        return parent::__construct($context);
    }

    public function execute()
    {
        if(!$this->helper->getGeneralConfig('enable')){
            $this->messageManager->addError(__('Module news is not working!'));
            return $this->_forward('admin/dashboard');
        }

        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('News Manage')));
        return $resultPage;
    }
}
