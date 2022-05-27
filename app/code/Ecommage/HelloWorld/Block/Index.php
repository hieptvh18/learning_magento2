<?php
namespace Ecommage\HelloWorld\Block;
class Index extends \Magento\Framework\View\Element\Template
{

    public function getTitle(){
        return "Module hello World cua fullstackoverfllow";
    }

    // get my info
    public function getMyInfo(){
        $info = [
            'name'=>"Tran Van Hoang Hiep",
            'age'=>20,
            'school'=>'FPT POLY TECHNIC',
            'major'=>'Web backend'
        ];

        return $info;
    }
}
