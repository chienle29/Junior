<?php

namespace Junior\Chapter06\Controller\Adminhtml\Rules;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private $pageFactory;
    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;

    }
    public function execute()
    {
        $result = $this->pageFactory->create();
        $result->getConfig()->getTitle()->prepend("Magenest Rules");
        return $result;
    }
}
