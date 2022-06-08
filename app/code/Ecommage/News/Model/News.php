<?php
namespace Ecommage\News\Model;
use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;

class News extends AbstractModel implements IdentityInterface{

    const CACHE_TAG = 'ecommage_news';

	protected $_cacheTag = 'ecommage_news';

	protected $_eventPrefix = 'ecommage_news';// tien to cho cac event duoc kich hoat

	protected function _construct()
	{
		$this->_init('Ecommage\News\Model\ResourceModel\News');
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
