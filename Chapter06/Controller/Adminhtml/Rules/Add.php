<?php


namespace Junior\Chapter06\Controller\Adminhtml\Rules;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Junior\Chapter01\Model\RulesFactory;

class Add extends Action
{
    private $pageFactory;
    private $magenestFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        RulesFactory $magenestFactory
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->magenestFactory = $magenestFactory;

    }
    public function execute()
    {
        $result = $this->pageFactory->create();
        $id = null;
        $id = $this->_request->getParam('id') ? $this->_request->getParam('id') : null;
        if($id)
        {
           $collection = $this->magenestFactory->create()->getCollection();
           $title = $collection->addFieldToFilter('id', $id)->getData();
            $result->getConfig()->getTitle()->prepend(__($title[0]['title']));
        }else{
            $result->getConfig()->getTitle()->prepend(__("Add New Row"));
        }
        return $result;
    }
}
