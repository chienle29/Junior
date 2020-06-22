<?php
namespace Junior\Chapter03\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Serialize\Serializer\Json;

class CheckCart implements ObserverInterface
{
    protected $_request;
    protected $serializer;
    public function __construct(RequestInterface $request, Json $serializer = null)
    {
        $this->_request = $request;
        $this->serializer = $serializer ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Serialize\Serializer\Json::class);
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        // Check and set information according to your need
        $date = $this->_request->getParam('example-date');
        if(!empty($date)){
            $product = $observer->getProduct();
            if ($this->_request->getFullActionName() == 'checkout_cart_add') {
                //checking when product is adding to cart
                $product = $observer->getProduct();
                $additionalOptions = [];
                $additionalOptions[] = array(
                    'label' => "Delivery Date:", //Custom option label
                    'value' => $date, //Custom option value
                );
                $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));
            }
        }
    }

}
