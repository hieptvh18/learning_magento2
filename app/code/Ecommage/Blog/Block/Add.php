<?php

namespace Ecommage\Blog\Block;
use \Magento\Framework\View\Element\Template;

class Add extends Template
{
    protected $_template = 'Ecommage_Blog::add.phtml';
    protected $formKey;

    public function __construct(Template\Context $context, array $data = [],
                                \Magento\Backend\Block\Template\Context $contextTemplate
)
    {
        $this->formKey = $contextTemplate->getFormKey();
        parent::__construct($context, $data);
    }

    /*
     * get form key*/
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
}
