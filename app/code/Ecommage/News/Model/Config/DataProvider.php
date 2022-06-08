<?php

namespace Ecommage\News\Model\Config;

use Ecommage\News\Model\NewsFactory;
use Ecommage\News\Model\ResourceModel\News\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
        {
        protected $_loadedData;
        protected $collection;

        public function __construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            CollectionFactory $collectionFactory,
            array $meta = [],
            array $data = []
        )
        {
            $this->collection = $collectionFactory->create();
            parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        }

        public function getData()
        {
            if (isset($this->_loadedData)) {
                return $this->_loadedData;
            }
                $items = $this->collection->getItems();
                foreach ($items as $item) {
                $this->_loadedData[$item->getId()] = $item->getData();
            }
            return $this->_loadedData;
        }
}
