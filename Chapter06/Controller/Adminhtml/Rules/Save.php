<?php


namespace Junior\Chapter06\Controller\Adminhtml\Rules;

use Magento\Backend\App\Action;
use Junior\Chapter06\Model\MagenestRepository;
use Junior\Chapter01\Model\RulesFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Event\Manager;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    private $resultRedirect;
    private $magenestRepository;
    private $json;
    private $magenestFactory;

    public function __construct(
        Action\Context $context,
        MagenestRepository $magenestRepository,
        Json $json,
        RulesFactory $magenestFactory,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->json = $json;
        $this->magenestRepository = $magenestRepository;
        $this->magenestFactory = $magenestFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['id']) ? $data['id'] : null;

        $group = [
            'title' => $data['title'],
            'status' => $data['status'],
            'rule_type' => $data['rule_type'],
            'conditions_serialized' => $data['conditions_serialized'],
        ];

        if ($id) {
            $post = $this->magenestRepository->getById($id);
            $post->addData($group);
            $this->getMessageManager()->addSuccessMessage('You edit the magenest rule.');
        } else {
            $post = $this->magenestFactory->create();
            $post->addData($group);
            $this->getMessageManager()->addSuccessMessage('You saved the magenest rule.');
        }
        $this->_eventManager->dispatch('magenest_rules_before_save', ['group' => $post]);

        $this->magenestRepository->save($post);
        return $this->resultRedirect->create()->setPath('magenest/rules/index');
    }
}
