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
     * get list blog-> render to menu fe
     * */
    public function getBlogCollection(){
        $blogs = $this->_blogFactory->create()->getCollection();
        return $blogs;
    }

    /*
     * get post by id
     * */
    public function getBlog($id = 3){
        $blogs = $this->_blogFactory->create()->load($id)->getData();
        return $blogs;
    }

    public function getAll(){
        return $this->_collection->joinCustomerTbl();
    }

}
