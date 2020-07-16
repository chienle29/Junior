<?php


namespace Junior\Chapter06\Api\Data;


interface MagenestInterface extends \Magento\Framework\Api\CustomAttributesDataInterface
{
    /**
     * @param $id
     * @return $this
     */
   // public function setId($id);

    /**
     * @inheritDoc
     */
    public function getId();
    /**
     * @param string $title
     * @return $this
     */

    public function setTitle($title);

    /**
     * @inheritDoc
     */

    public function getTitle();

    /**
     * @param string $status
     * @return $this
     */

    public function setStatus($status);

    /**
     * @inheritDoc
     */

    public function getStatus();

    /**
     * @param number $ruleType
     * @return $this
     */

    public function setRuleType($ruleType);

    /**
     * @inheritDoc
     */

    public function getRuleType();

    /**
     * @param string $conditionsSerialized
     * @return $this
     */

    public function setConditionsSerialized($conditionsSerialized);

    /**
     * @inheritDoc
     */
    public function getConditionsSerialized();

}
