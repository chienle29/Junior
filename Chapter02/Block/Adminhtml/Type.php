<?php


namespace Junior\Chapter02\Block\Adminhtml;

use Junior\Chapter02\Block\Adminhtml\Form\Field\CustomerColumn;
use Junior\Chapter02\Block\Adminhtml\Form\Field\DescribeColumn;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class Type extends AbstractFieldArray
{
    private $customRenderer;
    private $typeRenderer;


    protected function _prepareToRender()
    {
        $this->addColumn(
            'customer_group',
            [
                'label' => __('Customer Group'),
                'class' => 'required-entry',
                'renderer' => $this->getCustomTaxRenderer()
            ]
        );
        $this->addColumn(
            'clock_type',
            [
                'label' => __('Clock Type'),
                'class' => 'required-entry',
                'renderer' => $this->getTaxRenderer()
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Type');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];

        $tax = $row->getTax();
        if ($tax !== null) {
            $options['option_' . $this->getTaxRenderer()->calcOptionHash($tax)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    private function getCustomTaxRenderer()
    {
        if (!$this->customRenderer) {
            $this->customRenderer = $this->getLayout()->createBlock(
                CustomerColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->customRenderer;
    }

    private function getTaxRenderer()
    {
        if (!$this->typeRenderer) {
            $this->typeRenderer = $this->getLayout()->createBlock(
                DescribeColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->typeRenderer;
    }
}
