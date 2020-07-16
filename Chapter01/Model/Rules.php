<?php


namespace Junior\Chapter01\Model;
use Junior\Chapter06\Api\Data\MagenestInterface;

class Rules extends \Magento\Framework\Model\AbstractModel  implements MagenestInterface
{
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource
        $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb
        $resourceCollection = null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    public function _construct()
    {
        $this->_init('Junior\Chapter01\Model\ResourceModel\Rules');
    }
    public function getId()
    {
        return $this->_getData('id');
    }
//
//    public function setId($id)
//    {
//        $this->setData('id', $id);
//        return $this;
//    }

    public function setTitle($title)
    {
        $this->setData('title', $title);
        return $this;
    }
    public function getTitle()
    {
        return $this->getData('title');
    }

    public function setStatus($status)
    {
        $this->setData('status', $status);
        return $this;
    }
    public function getStatus()
    {
        return $this->getData('status');
    }

    public function setRuleType($ruleType)
    {
        $this->setData('rule_type', $ruleType);
        return $this;
    }

    public function getRuleType()
    {
        return $this->getData('rule_type');
    }

    public function setConditionsSerialized($conditionsSerialized)
    {
        $this->setData('conditions_serialized', $conditionsSerialized);
        return $this;
    }

    public function getConditionsSerialized()
    {
        return $this->getData('conditions_serialized');
    }

    public function getCustomAttributes()
    {
        // TODO: Implement setCustomAttribute() method.
    }
    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        // TODO: Implement setCustomAttribute() method.
    }
    public function setCustomAttributes(array $attributes)
    {
        // TODO: Implement setCustomAttributes() method.
    }
    public function getCustomAttribute($attributeCode)
    {
        // TODO: Implement getCustomAttribute() method.
    }
}
