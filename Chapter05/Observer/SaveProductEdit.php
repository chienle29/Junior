<?php


namespace Junior\Chapter05\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductRepository;

class SaveProductEdit implements ObserverInterface
{
    protected $product;
    protected $flag = 1;
    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    public function execute(Observer $observer)
    {
        $data = $observer->getProduct()->getData('custom_magenest');
        $data = $data.'varchar';
        $product = $observer->getEvent()->getProduct();
        $product->setData('custom_magenest',$data);
        if($this->flag == 1){
            $this->flag = 0;
            $this->product->save($product);
        }

    }
}
