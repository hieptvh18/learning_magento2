<?php
namespace Ecommage\News\Ui\Component\Listing\Column;

use Magento\Catalog\Helper\Image;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{
    const ALT_FIELD = 'title';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Image $imageHelper
     * @param UrlInterface $urlBuilder
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Image $imageHelper,
        UrlInterface $urlBuilder,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');

            foreach($dataSource['data']['items'] as & $item) {
//               // init obj news
                $news = new \Magento\Framework\DataObject($item);
                $url = '';
                if($item[$fieldName] != '') {
                    $url = $item[$fieldName];
//                        $this->storeManager->getStore()->getBaseUrl(
//                            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
//                        ).$item[$fieldName];
                }
                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';

                // set link goo to detail page in preview img
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    'news/news/edit',
                    ['blog_id' => $news->getData('id'), 'store' => $this->context->getRequestParam('store')]
                );
                // set link preview image
                $item[$fieldName . '_orig_src'] = $item[$fieldName];
            }
        }
        return $dataSource;
    }

    /**
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}
