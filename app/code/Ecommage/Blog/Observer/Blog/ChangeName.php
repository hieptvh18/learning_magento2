<?php
namespace Ecommage\Blog\Observer\Blog;

use Magento\Framework\Event\Observer;

class ChangeName implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(Observer $observer)
    {
        $data = $observer->getData('postData');
        $data->setData('title', 'Ecommage '. $data->getTitle());
//        $observer->setData('postData', $data);
    }
}
