<?php
declare(strict_types=1);

namespace Ecommage\News\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;
use \Ecommage\News\Model\ResourceModel\News\Collection;


class Index extends Template
{
    protected $_newsFactory;
    protected $_collection;

    public function __construct(Template\Context $context, array $data = [],
                                \Ecommage\News\Model\NewsFactory $newsFactory ,
    Collection $collection)
    {
        $this->_collection = $collection;
        $this->_newsFactory = $newsFactory;
        parent::__construct($context, $data);
    }

    /*
     * get list news != 2&3 -> render to menu fe
     * */
    public function getNewsCollection(){
        $news = $this->_newsFactory->create()->getCollection()
//            ->addFieldToFilter('status',['neq'=>3])
//            ->addFieldToFilter('status',['neq'=>2])
//        or
                ->addFilter('status',1)
        ;
        return $news;
    }

    /*
     * get post by id
     * */
    public function getNewsRand(){
        $news = $this->_newsFactory->create()->getCollection()
            ->setOrder('created_at','desc')
            ->addFilter('status',1)->getLastItem();
        return $news;
    }

    public function getDataWithJoin(){
        return $this->_collection->joinCustomerTbl();
    }

}
