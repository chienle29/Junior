define([
    'Magento_Ui/js/form/element/select',
    'Magento_Catalog/js/components/visible-on-option/strategy',
], function (select, strategy) {
    'use strict';
    return select.extend(strategy);

},);


