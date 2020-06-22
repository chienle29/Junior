<?php


namespace Junior\Chapter03\Block\Adminhtml;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class Background extends AbstractFieldArray
{
    private $customRenderer;
    private $typeRenderer;


    protected function _prepareToRender()
    {
        $this->addColumn(
            'color',
            [
                'label' => __('Color'),
                'class' => 'required-entry'
            ]
        );
        $this->addColumn(
            'color_code',
            [
                'label' => __('Color Code'),
                'class' => 'required-entry',
                'renderer' => $this->getBackground()
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


    private function getBackground()
    {
        if (!$this->typeRenderer) {
            $this->typeRenderer = $this->getLayout()->createBlock(
                \Junior\Chapter03\Block\Adminhtml\Form\Field\Background::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->typeRenderer;
    }

}
