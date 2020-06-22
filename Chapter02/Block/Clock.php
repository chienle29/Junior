<?php


namespace Junior\Chapter02\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Clock extends \Magento\Framework\View\Element\Template
{
    private $scopeConfig;
    private $date;
    CONST TITLE = 'clock_configration/default_clock/title_clock';
    CONST SIZE = 'clock_configration/default_clock/size_clock';
    CONST COLOR_BACKGROUND = 'clock_configration/default_clock/my_color_option';
    CONST COLOR_TEXT = 'clock_configration/default_clock/text_color';
    CONST TYPE = 'clock_configration/default_clock/clock_type';

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        DateTime $dateTime,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->date = $dateTime;
    }


    public function getTitle()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        $title = $this->scopeConfig->getValue(self::TITLE, $storeScope);
        return $title;
    }

    public function getSize()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        return $this->scopeConfig->getValue(self::SIZE, $storeScope);
    }

    public function getBackgroundColor()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        return $this->scopeConfig->getValue(self::COLOR_BACKGROUND, $storeScope);
    }

    public function getTextColor()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        return $this->scopeConfig->getValue(self::COLOR_TEXT, $storeScope);
    }

    public function getType()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        return $this->scopeConfig->getValue(self::TYPE, $storeScope);
    }

}
