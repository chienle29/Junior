<?php


namespace Junior\Chapter9\Block\Adminhtml\Orderedit\Tab;

use Magento\Sales\Model\Order\ItemRepository;
use Magento\Framework\App\RequestInterface;

class View extends \Magento\Backend\Block\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $_template = 'info.phtml';

    protected $coreRegistry;

    /**
     * @var \Magento\Sales\Model\OrderFactory $orderFactory
     */
    protected $orderFactory;
    protected $request;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        ItemRepository $orderItemInterface,
        RequestInterface $request,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->orderFactory = $orderItemInterface;
        $this->request = $request;
        parent::__construct($context, $data);
    }
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }
    public function getOrderId()
    {
        return $this->getOrder()->getEntityId();
    }
    public function getOrderIncrementId()
    {
        return $this->getOrder()->getIncrementId();
    }
    public function getTabLabel()
    {
        return __('Message Information');
    }
    public function getTabTitle()
    {
        return __('Message Information');
    }
    public function canShowTab()
    {
        return true;
    }
    public function isHidden()
    {
        return false;
    }
    public function getMessage()
    {
        $orderId = $this->request->getParam('order_id');
        $result = $this->orderFactory->get($orderId)->getData('product_options')['info_buyRequest'];
        $data = array('name' => $result['reciveName'], 'message' => $result['giftMessage']);
        return $data;
    }
}
