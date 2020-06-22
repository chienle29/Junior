<?php

namespace Junior\Chapter01\Controller\Test;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $collectionFactory;
    public function __construct(
        Context $context,
        \Junior\Chapter01\Model\ResourceModel\Rules\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $items = $this->collectionFactory->create()->addFieldToFilter("status", "pending")->getItems();
        foreach ($items as $value){
            echo "<pre>";
            print_r($value->getData());
            echo "</pre>";
        }
    }
}
