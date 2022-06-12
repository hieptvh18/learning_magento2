<?php
namespace Ecommage\News\Block\Adminhtml\Edit;

class CustomButton extends \Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic
{
    public function getButtonData()
    {
        return [
            'label' => __('Custom Button'),
            'class' => 'action-secondary',
            'on_click' => 'alert("Hello admin")',
            'sort_order' => 10
        ];
    }
}
