<?php


namespace Junior\Chapter9\Block;

use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\Order\ItemRepository;
use Magento\Framework\App\RequestInterface;


class Order extends Template
{
    /**
     * @var \Magento\Sales\Model\OrderFactory $orderFactory
     */
    protected $orderFactory;
    protected $request;

    public function __construct(
        Template\Context $context,
        ItemRepository $orderItemInterface,
        RequestInterface $request,
        array $data = []
    )
    {
        $this->orderFactory = $orderItemInterface;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getOrder()
    {
        $orderId = $this->request->getParam('order_id');
        $result = $this->orderFactory->get($orderId)->getData('product_options')['info_buyRequest'];
        $data = array('name' => $result['reciveName'], 'message' => $result['giftMessage']);
        return $data;
    }

}
