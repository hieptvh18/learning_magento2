<?php

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected $_template = 'Ecommage_Blog::index.phtml';
    protected $collection;

    public function __construct(Template\Context $context, array $data = [],
                                \Ecommage\Blog\Model\ResourceModel\Blog\Collection $collection
    )
    {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }

    public function getBlogList(){
        $data = $this->collection->joinCustomerTbl();
        return $data;
    }

    public function hi(){
        return 'hi';
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
