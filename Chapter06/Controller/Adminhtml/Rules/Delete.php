<?php


namespace Junior\Chapter06\Controller\Adminhtml\Rules;

use Magento\Backend\App\Action;
use Junior\Chapter06\Model\MagenestRepository;
use Junior\Chapter01\Model\ResourceModel\Rules\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete extends Action
{
    private $magenestRepository;
    private $filter;
    private $collectionFactory;
    private $logger;
    private $resultRedirect;

    public function __construct(
        Action\Context $context,
        MagenestRepository $magenestRepository,
        Filter $filter,
        CollectionFactory $collectionFactory,
        LoggerInterface $logger,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->magenestRepository = $magenestRepository;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->logger = $logger;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $total = 0;
        $err = 0;
        foreach ($collection->getItems() as $magenest) {
            $this->magenestRepository->delete($magenest);
            try {
                $this->magenestRepository->delete($magenest);
                $total++;
            } catch (LocalizedException $exception) {
                $this->logger->error($exception->getLogMessage());
               $err++;
            }
        }

        if ($total) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $total)
            );
        }

        if ($err) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                    $err
                )
            );
        }
        return $this->resultRedirect->create()->setPath('magenest/rules/index');
    }
}
