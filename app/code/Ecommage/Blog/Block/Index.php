<?php
declare(strict_types=1);

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\App\Action\Action;
use \Ecommage\Blog\Model\ResourceModel\Blog\Collection;


class Index extends Template
{
    protected $_blogFactory;
    protected $_collection;

    public function __construct(Template\Context $context, array $data = [],
                                \Ecommage\Blog\Model\BlogFactory $blogFactory ,
    Collection $collection)
    {
        $this->_collection = $collection;
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    /*
     * get list blog != 2&3 -> render to menu fe
     * */
    public function getBlogCollection(){
        $blogs = $this->_blogFactory->create()->getCollection()
//            ->addFieldToFilter('status',['neq'=>3])
//            ->addFieldToFilter('status',['neq'=>2])
//        or
                ->addFilter('status',1)
        ;
        return $blogs;
    }

    /*
     * get post by id
     * */
    public function getBlogRand(){
        $blogs = $this->_blogFactory->create()->getCollection()
            ->setOrder('created_at','desc')
            ->addFilter('status',1)->getLastItem();
        return $blogs;
    }

    public function getDataWithJoin(){
        return $this->_collection->joinCustomerTbl();
    }

}
