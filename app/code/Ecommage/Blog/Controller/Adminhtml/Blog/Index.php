<?php
namespace Ecommage\Blog\Controller\Adminhtml\Blog;
use Ecommage\Blog\Helper\Data;
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
            $this->messageManager->addError(__('Module blog is not working!'));
            return $this->_forward('admin/dashboard');
        }

        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Blog Manage')));
        return $resultPage;
    }
}
