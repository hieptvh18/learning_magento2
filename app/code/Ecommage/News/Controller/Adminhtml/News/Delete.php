<?php

namespace Ecommage\News\Controller\Adminhtml\News;

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

    public function __construct(
        Context $context,
        PageFactory  $pageFactory,
        Data $helper,
        NewsFactory $newsFactory,
        Filter $filter,
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        $this->_newsFactory = $newsFactory;
        $this->helper = $helper;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $newsIds = $this->getRequest()->getParam('selected');

        if(count($newsIds) == 0){
            $this->messageManager->addError(__("Can't find the record you want to delete"));
            return $this->_redirect('news/news');
        }

        /*
         * exec delete, filter giup loc ra cac ban ghi theo id cua selector->loop & delete
         * */
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $collectionSize = $collection->getSize();

        try{
            foreach ($collection as $news) {
                $news->delete();
            }

            $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));
        }catch (\Exception $e){
            $this->messageManager->addError(__($e->getMessage()));
        }

        return $this->_redirect('news/news');
    }
}
