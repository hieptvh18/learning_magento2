<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecommage\Blog\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class StatusText extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    /**#@+
     * Blog Status values
     */
    const STATUS_PUBLISH= 1;

    const STATUS_DRAFT = 2;

    const STATUS_NON_PUBLISH = 3;

    public static function getOptionArray()
    {
        return [self::STATUS_PUBLISH => __('Publish'), self::STATUS_DRAFT => __('Draft'),
            self::STATUS_NON_PUBLISH => __('Non-Publish')];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return $options[$optionId] ?? null;
    }

}
