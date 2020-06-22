<?php
declare(strict_types=1);

namespace Junior\Chapter02\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;


class CustomerColumn extends Select
{
    private $collectionFactory;
    public function __construct(Context $context, CollectionFactory $collectionFactory, array $data = [])
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param $value
     * @return $this
     */
    public function setInputId($value)
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    private function getSourceOptions(): array
    {
        $result = $this->collectionFactory->create()->getData();
        $arr = array();
        $total = 0;
        foreach ($result as $value)
        {
            $total++;
            $arr[$total]['label'] = $value['customer_group_code'];
            $arr[$total]['value'] = $value['customer_group_id'];
        }
        return $arr;
    }
}
