<?php
namespace Ecommage\Blog\Model\Config;

/**
 * Class Status
 * @package
 */
class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('publish')],
            ['value' => 2, 'label' => __('draft')],
            ['value' => 3, 'label' => __('non-publish')]
        ];
    }
}
