<?php
namespace Ecommage\Blog\Model;
use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;

class Register extends AbstractModel implements IdentityInterface{

    const CACHE_TAG = 'ecommage_register';

    protected $_cacheTag = 'ecommage_register';

    protected $_eventPrefix = 'ecommage_register';// tien to cho cac event duoc kich hoat

    protected function _construct()
    {
        $this->_init('Ecommage\Blog\Model\ResourceModel\Register');
    }

    public function getIdentities()
    {
        // return 1 id
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
