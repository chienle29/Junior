<?php

namespace Junior\Chapter06\Model\Message;

use Junior\Chapter01\Model\RulesFactory;
use Junior\Chapter01\Model\ResourceModel\Rules\CollectionFactory;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Array
     */
    protected $_loadedData;
    protected $collection;
    protected $customerfactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $sliderCollectionFactory
     * @param array $meta
     * @param array $data
     */

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Customer\Model\CustomerFactory $customerfactory,
        CollectionFactory $CollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->customerfactory = $customerfactory;
        $this->collection = $CollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /** Get All Loaded Data
     * @return loadedData
     */
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
