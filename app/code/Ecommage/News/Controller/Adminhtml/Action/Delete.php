<?php

namespace Ecommage\News\Controller\Adminhtml\Action;

use Ecommage\News\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Ecommage\News\Model\NewsFactory;
use Magento\Ui\Component\MassAction\Filter;
use Ecommage\News\Model\ResourceModel\News\CollectionFactory;
use phpDocumentor\Reflection\Types\Collection;


class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface {
    protected  $_pageFactory;
    protected $helper;
    protected $_newsFactory;
    protected $filter;
    protected $collectionFactory;
    protected $_blogFactory;

    public function __construct(
        Context $context,
        PageFactory  $pageFactory,
        Data $helper,
        NewsFactory $newsFactory,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Ecommage\News\Model\NewsFactory $_blogFactory
    )
    {
        $this->_blogFactory = $_blogFactory;
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        $this->_newsFactory = $newsFactory;
        $this->helper = $helper;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /*
         * exec delete, filter giup loc ra cac ban ghi theo id cua selector->loop & delete
         * */
        $blogId = $this->getRequest()->getParam('blog_id');

        $blogCollection = $this->collectionFactory->create()->addFieldToFilter('id',$blogId);
        dd($blogCollection);

        $blog = $this->_blogFactory->create()->load($blogId);
        if(!$blog && $blogId){
            $this->messageManager->addError(__('aaa'));
            return $this->_redirect('news/news');
        }
        $blog->delete();

        $this->messageManager->addSuccess(__('bbb'));

        return $this->_redirect('news/news');
    }
}
