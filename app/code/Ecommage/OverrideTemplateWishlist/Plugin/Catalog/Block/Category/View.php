<?php
namespace Ecommage\OverrideTemplateWishlist\Plugin\Catalog\Block\Category;

class View
{
    public function beforeToHtml(\Magento\Catalog\Block\Category\View $subject)
    {
        if ($subject->getTemplate() === 'Magento_Catalog::category/products.phtml') {
            $subject->setTemplate('Ecommage_OverrideTemplateWishlist::catalog/category/products.phtml');
        }
    }
}
