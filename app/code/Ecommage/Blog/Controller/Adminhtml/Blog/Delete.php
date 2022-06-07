<?php

namespace Ecommage\Blog\Controller\Adminhtml\Blog;

use Ecommage\Blog\Helper\Data;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Ecommage\Blog\Model\BlogFactory;
use Magento\Ui\Component\MassAction\Filter;
use Ecommage\Blog\Model\ResourceModel\Blog\CollectionFactory;
use phpDocumentor\Reflection\Types\Collection;


class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface {
    protected  $_pageFactory;
    protected $helper;
    protected $_blogFactory;
    protected $filter;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        PageFactory  $pageFactory,
        Data $helper,
        BlogFactory $blogFactory,
        Filter $filter,
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        $this->_blogFactory = $blogFactory;
        $this->helper = $helper;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogIds = $this->getRequest()->getParam('selected');

        if(count($blogIds) == 0){
            $this->messageManager->addError(__("Can't find the record you want to delete"));
            return $this->_redirect('blog/blog');
        }

        /*
         * exec delete, filter giup loc ra cac ban ghi theo id cua selector->loop & delete
         * */
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $collectionSize = $collection->getSize();

        foreach ($collection as $news) {
            $news->delete();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));

        return $this->_redirect('blog/blog');

    }
}
