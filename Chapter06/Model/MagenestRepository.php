<?php


namespace Junior\Chapter06\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Junior\Chapter06\Api\Data\MagenestInterface;

class MagenestRepository implements \Junior\Chapter06\Api\MagenestRepositoryInterface
{
    protected $magenestResource;
    protected $magenestFactory;
    protected $serializer;
    protected $instancesById = [];
    protected $instances = [];
    private $cacheLimit = 0;

    public function __construct(
        \Junior\Chapter01\Model\ResourceModel\Rules $magenestResource,
        \Junior\Chapter01\Model\RulesFactory $magenestFactory,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        $cacheLimit = 1000
    )
    {
        $this->magenestResource = $magenestResource;
        $this->serializer = $serializer;
        $this->magenestFactory = $magenestFactory;
    }

    function delete(\Junior\Chapter06\Api\Data\MagenestInterface $magenest)
    {
        $this->magenestResource->delete($magenest);
    }

    function save(\Junior\Chapter06\Api\Data\MagenestInterface $magenest)
    {
        $this->magenestResource->save($magenest);
    }

    /**
     * @inheritdoc
     */
    public function getById($id)
    {
//        $magenest = $this->magenestFactory->create();
//        $resource = $this->magenestResource->load($magenest,$id);
//        if(! $magenest->getId()){
//            throw new NoSuchEntityException(__('Unable to find amasty with ID "%1"', $id));
//        }
//        return $magenest;

        $cacheKey = $this->getCacheKey([]);
        if (!isset($this->instancesById[$id][$cacheKey])) {
            $magenest = $this->magenestFactory->create();

            $magenest->load($id);
            if (!$magenest->getId()) {
                throw new NoSuchEntityException(
                    __("The product that was requested doesn't exist. Verify the product and try again.")
                );
            }
            $this->cacheProduct($cacheKey, $magenest);
        }
        return $this->instancesById[$id][$cacheKey];
    }
    /**
     * Get key for cache
     *
     * @param array $data
     * @return string
     */
    protected function getCacheKey($data)
    {
        $serializeData = [];
        foreach ($data as $key => $value) {
            if (is_object($value)) {
                $serializeData[$key] = $value->getId();
            } else {
                $serializeData[$key] = $value;
            }
        }
        $serializeData = $this->serializer->serialize($serializeData);
        return sha1($serializeData);
    }
    /**
     * Add product to internal cache and truncate cache if it has more than cacheLimit elements.
     *
     * @param string $cacheKey
     * @param MagenestInterface $magenest
     * @return void
     */
    private function cacheProduct($cacheKey, MagenestInterface $magenest)
    {
        $this->instancesById[$magenest->getId()][$cacheKey] = $magenest;
        $this->saveProductInLocalCache($magenest, $cacheKey);

        if ($this->cacheLimit && count($this->instances) > $this->cacheLimit) {
            $offset = round($this->cacheLimit / -2);
            $this->instancesById = array_slice($this->instancesById, $offset, null, true);
            $this->instances = array_slice($this->instances, $offset, null, true);
        }
    }
    /**
     * Saves product in the local cache by sku.
     *
     * @param MagenestInterface $magenest
     * @param $cacheKey
     * @return void
     */
    private function saveProductInLocalCache(MagenestInterface $magenest, $cacheKey)
    {
        $preparedSku = $this->prepareSku($magenest->getId());
        $this->instances[$preparedSku][$cacheKey] = $magenest;
    }
    /**
     * Converts SKU to lower case and trims.
     *
     * @param $id
     * @return string
     */
    private function prepareSku($id)
    {
        return mb_strtolower(trim($id));
    }
}
