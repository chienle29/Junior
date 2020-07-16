<?php

namespace Cate\Demo\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form;
use Magento\Ui\Component\Form\Fieldset;

class Test extends AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        $meta['field_calendar'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Customizable Calendar'),
                        'componentType' => Fieldset::NAME,
                        'sortOrder' => 20,
                        'collapsible' => true

                    ]
                ]
            ],
            'children' => [
                'field_calendar' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Calendar'),
                                'formElement' => 'date',
                                'componentType' => 'field',
                                'component' => 'Cate_Demo/js/calendar',
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $meta['custom_group_field'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Group field'),
                        'componentType' => Fieldset::NAME,
                        'sortOrder' => 6,
                        'collapsible' => true
                    ]
                ]
            ],
            'children' => [
                'field_one' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Field 1'),
                                'formElement' => 'textarea',
                                'componentType' => 'field',
                                'component' => 'Cate_Demo/js/text',
                                'visible' => true,
                            ]
                        ]
                    ]
                ],
                'field_two' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Field 2'),
                                'formElement' => 'select',
                                'componentType' => 'field',
                                'component' => 'Cate_Demo/js/select',
                                'visible' => 1,
                                'options' => [
                                    ['value' => 'test_value_1', 'label' => 'Test Value 1'],
                                    ['value' => 'test_value_2', 'label' => 'Test Value 2'],
                                    ['value' => 'test_value_3', 'label' => 'Test Value 3'],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return $meta;
    }


}
