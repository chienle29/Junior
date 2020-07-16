<?php


namespace Junior\Chapter9\Block;

use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\View\Element\Template\Context;

class HidePrice extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    protected $scopeConfig;

    protected $httpContext;

    const OPTIONS = "hide_price/hide_price_group/hide_price_title";

    public function __construct(
        Context $context,
        SaleableInterface $saleableItem,
        PriceInterface $price,
        RendererPool $rendererPool,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Http\Context $httpContext,
        array $data = [],
        SalableResolverInterface $salableResolver = null,
        MinimalPriceCalculatorInterface $minimalPriceCalculator = null
    )
    {
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data, $salableResolver, $minimalPriceCalculator);
        $this->scopeConfig = $scopeConfig;
        $this->httpContext = $httpContext;
    }


    public function wrapResult($html)
    {
        $flag = 1;
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        $option = $this->scopeConfig->getValue(self::OPTIONS, $storeScope);
        //check customer is logged
        if($option)
        {
            if(!$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH))
            {
                $flag = 0;
            }
        }
        if($flag === 1)
        {
            return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
                'data-role="priceBox" ' .
                'data-product-id="' . $this->getSaleableItem()->getId() . '" ' .
                'data-price-box="product-id-' . $this->getSaleableItem()->getId() . '"' .
                '>' . $html . '</div>';
        }else{
            return '<div class="price-box" ' .
                'data-role="priceBox" ' .
                'data-product-id="" ' .
                'data-price-box="product-id-"' .
                ' style="width: 205px !important"><span class="custom-price-login" style="background: #288ad6;color: #fff;text-transform: uppercase;font-size: 13px;padding: 1px 10px;">'.
                'You need is login see price</span></div>';
        }
    }

}
