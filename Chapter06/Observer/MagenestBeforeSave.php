<?php


namespace Junior\Chapter06\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Junior\Chapter01\Model\RulesFactory;

class MagenestBeforeSave implements ObserverInterface
{
    private $magenestFactory;

    public function __construct(RulesFactory $magenestFactory)
    {
        $this->magenestFactory = $magenestFactory;
    }

    public function execute(Observer $observer)
    {
        $data = $observer->getGroup();
        $data->setTitle( $data['title'] . ' magenest');
    }
}
