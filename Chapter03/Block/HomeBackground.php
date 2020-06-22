<?php


namespace Junior\Chapter03\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json;

class HomeBackground extends \Magento\Framework\View\Element\Template
{
    private $scopeConfig;
    private $json;
    CONST COLOR = 'color_option_section/color_option_group/color_field';

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        Json $json,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->json = $json;
    }


    public function getTitle()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        $title = $this->scopeConfig->getValue(self::COLOR, $storeScope);
        $data = $this->json->unserialize($title);
        return $data;
    }


}
