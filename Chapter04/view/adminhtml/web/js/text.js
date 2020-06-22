define([
    'Magento_Ui/js/form/element/textarea',
    'Magento_Catalog/js/components/visible-on-option/strategy',
], function (text, strategy) {
    'use strict';
    return text.extend({
        visible: true,
    });

},);
