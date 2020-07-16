<?php

namespace Junior\Chapter07\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\RequestInterface;

class AddProductToCart implements ObserverInterface
{

    protected $serializer;
    protected $dateTime;
    protected $_request;

    public function __construct(
        Json $json,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        RequestInterface $request
    )
    {
        $this->serializer = $json;
        $this->dateTime = $dateTime;
        $this->_request = $request;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if ($this->_request->getFullActionName() == 'checkout_cart_add') {
            $additionalOptions = [];
            $dateToTimestamp = date('H:i:s d-m-Y');
            $timeStamp = $this->dateTime->gmtTimestamp($dateToTimestamp);
            $additionalOptions[] = [
                'label' => 'Time Stamp',
                'value' => $timeStamp
            ];
            $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));
        }
    }


}
