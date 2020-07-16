<?php


namespace Junior\Chapter10\Block;

use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\Cart;

class Total extends Template
{
    protected $cart;
    public function __construct(
        Template\Context $context,
        Cart $cart,
        array $data = []
    )
    {
        $this->cart = $cart;
        parent::__construct($context, $data);
    }

    public function getPrice()
    {
        $items = $this->cart->getQuote()->getAllItems();
        $price = 0;
        $total = 0;
        foreach($items as $item)
        {
           $price += ($item->getQty() * $item->getPrice());
           $total = $item->getQuote()->getGrandTotal();
        }
        $totalPrice = array('price' => $price,'total' => $total);
        return $totalPrice;
    }
}
