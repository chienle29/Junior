<?php


namespace Junior\Chapter05\Ui\Component\Listing\Grid\Column;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Backend\Model\Auth\Session;

class Hide extends Column
{
    private $authSession;

    public function __construct(
        ContextInterface $context,
        Session $authSession,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        $this->authSession = $authSession;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepare()
    {
        parent::prepare();
        $firstName = $this->authSession->getUser()->getFirstName();
        $firstCharacter = substr($firstName, 0, 1);
        $pattern = "/^[a-mA-M]$/";
        if(preg_match($pattern, $firstCharacter))
        {
            $this->_data['config']['componentDisabled'] = false;
        }else{
            $this->_data['config']['componentDisabled'] = true;
        }

    }
}
