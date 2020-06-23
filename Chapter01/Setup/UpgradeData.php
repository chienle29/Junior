<?php

namespace Junior\Chapter01\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Serialize\Serializer\Serialize;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;

class UpgradeData implements UpgradeDataInterface
{
    protected $rulesFactory;
    protected $json;
    protected $serialize;
    protected $categorySetupFactory;
    protected $customer;

    public function __construct(
        \Junior\Chapter01\Model\RulesFactory $rulesFactory,
        Json $json,
        Serialize $serialize,
        \Magento\Catalog\Setup\CategorySetupFactory $categorySetupFactory,
        CollectionFactory $customerFactory
    )
    {
        $this->rulesFactory = $rulesFactory;
        $this->json = $json;
        $this->serialize = $serialize;
        $this->categorySetupFactory = $categorySetupFactory;
        $this->customer = $customerFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        //get current version
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productMetadata = $objectManager->get('Magento\Framework\App\ProductMetadataInterface');
        $version = $productMetadata->getVersion();
        $currentVersion = (float)$version;
        //get data column conditions_serialized
        $data = $this->rulesFactory->create()->getCollection()->addFieldToSelect(array('id', 'conditions_serialized'));
        //compare
        foreach ($data->getData() as $value) {
            $isSerialized = $this->isSerialized($value['conditions_serialized']);
            $arr = $isSerialized ? $this->serialize->unserialize($value['conditions_serialized']) : $this->json->unserialize($value['conditions_serialized']);
            $table = $this->rulesFactory->create()->load($value['id']);

            if ($currentVersion < 2.2) {
                $table->setConditionsSerialized($this->json->serialize($arr));
            } else {
                $table->setConditionsSerialized($this->serialize->serialize($arr));
            }
            $table->save();
        }
    }
    //Is the serialized
    private function isSerialized($value)
    {
        return (boolean)preg_match('/^((s|i|d|b|a|O|C):|N;)/', $value);
    }
}
