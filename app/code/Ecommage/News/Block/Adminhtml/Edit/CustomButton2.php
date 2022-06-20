<?php
namespace Ecommage\News\Block\Adminhtml\Edit;

class CustomButton2 extends \Ecommage\News\Block\Adminhtml\Edit\GenericButton
{
    public function getButtonData()
    {

        $data = [];
        if($this->getPageId()){
            $data = [
                'label' => __('Custom Button Delete'),
                'class' => 'action-secondary',
                'on_click' => 'alert("delete page")',
                'sort_order' => 10
            ];
        }

        return $data;
    }
}
