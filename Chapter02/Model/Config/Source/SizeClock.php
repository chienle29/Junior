<?php
namespace Junior\Chapter02\Model\Config\Source;
class SizeClock implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value' => 'small',
                'label' => __('Small')
            ],
            [
                'value' => 'big',
                'label' => __('Big')
            ],
            [
                'value' => 'normal',
                'label' => __('Normal')
            ],
        ];
    }
}
