<?php


namespace Junior\Chapter03\Block\Adminhtml\Form\Field;


use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;
use Magento\Backend\Block\Template\Context;


class Background extends \Magento\Config\Block\System\Config\Form\Field
{
    private $collectionFactory;
    public function __construct(Context $context, CollectionFactory $collectionFactory, array $data = [])
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }


    public function _toHtml()
    {
        $html = '<input type="text" name="' . $this->getInputName() . '" id="' . $this->getInputId() . '" ';
        $html .= 'value="<%- ' . $this->getColumnName() .' %>" ';
        $html .= 'class="custom-color" ' . $this->getExtraParams() . '/> ';

        $html .= '<script type="text/javascript">
            require(["jquery","jquery/colorpicker/js/colorpicker"], function ($) {
                $(document).ready(function () {
                 var $el = $("#' . $this->getInputId() . '");
                    $el.css("backgroundColor", "#ffffff");

                 // Attach the color picker
                    $el.ColorPicker({
                     color: "#ffffff",
                        onChange: function (hsb, hex, rgb) {
                            $el.css("backgroundColor", "#" + hex).val("#" + hex);
                     }
                 });
             });
         });
         </script>';
        return $html;
    }
}
