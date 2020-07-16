<?php


namespace Junior\Chapter06\Controller\Adminhtml\Rules;

use Junior\Chapter01\Model\RulesFactory;
use Magento\Backend\App\Action;

class Test extends \Magento\Backend\App\Action
{
    public function __construct(
        Action\Context $context
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $result = \Magento\Framework\App\ObjectManager::getInstance();
        $collection = $result->create('Junior\Chapter01\Model\ResourceModel\Rules\CollectionFactory');
        $a = $collection->create()->addFieldToFilter("title", "sdsd")->getData();
        print_r($a);
    }
}
