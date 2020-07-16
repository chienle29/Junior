<?php


namespace Cate\Demo\Ui\DataProvider\Product\Form\Modifier;



use Magento\Ui\Component\Listing\Columns\Column;

class HideColumn extends Column
{

    public function afterPrepareDataSource(\Magento\Catalog\Ui\Component\Listing\Columns\ProductActions $subject, array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['custom_magenest'] = [
                    'hidden' => true
                ];
            }
        }
        return $dataSource;
    }
}
