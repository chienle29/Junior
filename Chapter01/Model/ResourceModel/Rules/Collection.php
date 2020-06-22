<?php


namespace Junior\Chapter01\Model\ResourceModel\Rules;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = "id";
    public function _construct()
    {
        $this->_init('Junior\Chapter01\Model\Rules', 'Junior\Chapter01\Model\ResourceModel\Rules');
    }
}
