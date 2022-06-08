<?php
namespace Ecommage\OrderGrid\Model\ResourceModel\Order\Grid;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as OriginalCollection;

class Collection extends OriginalCollection
{
    protected function _renderFiltersBefore()
    {
        $joinTable = $this->getTable('sales_order');// get table auto gan prefix cho table neu db co use prefix
        $this->getSelect()->joinLeft($joinTable, 'main_table.entity_id = sales_order.entity_id', ['tax_amount', 'discount_amount', 'coupon_code']);
        parent::_renderFiltersBefore();
    }
}
