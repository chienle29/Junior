<?php


namespace Junior\Chapter10\Controller\Login;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Setup\Exception;

class Index extends Action
{
    protected $session;
    protected $customerAccountManagement;

    public function __construct(
        Context $context,
        Session $session,
        AccountManagementInterface $accountManagement
    )
    {
        $this->session = $session;
        $this->customerAccountManagement = $accountManagement;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if ($this->session->isLoggedIn()) {
            echo (int)1;
        } else {
            if (isset($data['username']) && isset($data['password'])) {
                try {
                    $customer = $this->customerAccountManagement->authenticate($data['username'], $data['password']);
                    $login = $this->session->setCustomerDataAsLoggedIn($customer);
                    if ($customer || $login) {
                        echo (int)1;
                    } else {
                        echo (int)0;
                    }
                } catch (\Exception $e) {
                    echo 0;
                }

            }
        }

    }
}
