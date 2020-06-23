<?php


namespace Junior\Chapter05\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Eav\Model\Config;

class LoadProductEdit implements ObserverInterface
{
    protected $product;
    protected $eavConfig;
    protected $auth;
    public function __construct(
        ProductFactory $productFactory,
        Config $eavConfig,
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        $this->product = $productFactory;
        $this->eavConfig = $eavConfig;
        $this->auth = $authSession;
    }

    public function execute(Observer $observer)
    {
        //add 'varchar' string to attribute custom_magenest of product
        $product = $observer->getData('collection')->getItems();
        foreach($product as $value){
            if($value->getData('custom_magenest') != ""){
                $name = str_replace("varchar", "", $value->getData('custom_magenest'));
                $value->setData('custom_magenest', $name);
            }
        }
    }
}

