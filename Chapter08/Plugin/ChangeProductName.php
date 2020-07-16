<?php


namespace Junior\Chapter08\Plugin;

class ChangeProductName
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        if ($subject->getData('special_price'))
        {
            $currenDate = date("Y-m-d H:i:s");
            if (strtotime($currenDate) < strtotime($subject->getData("special_to_date")) && strtotime($currenDate) > strtotime($subject->getData("special_from_date")))
            {
                $result = "Special: " . $result;
            }
        }
        $subject->cleanCache();
        return $result;
    }
}
