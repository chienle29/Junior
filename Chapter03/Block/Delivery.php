<?php


namespace Junior\Chapter03\Block;


use Magento\Framework\View\Element\Template;

class Delivery extends \Magento\Framework\View\Element\Template
{
public function __construct(Template\Context $context, array $data = [])
{
    parent::__construct($context, $data);
}
}
