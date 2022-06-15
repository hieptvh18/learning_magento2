<?php

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;

class Add extends Template
{
    protected $_template = 'Ecommage_Blog::add.phtml';

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function test(){
        return 'hi';
    }
}
