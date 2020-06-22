/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/form/element/date',
    'Magento_Catalog/js/components/visible-on-option/strategy',
], function (date, strategy) {
    'use strict';
    return date.extend({
        defaults: {
            options: {
                showsDate: false,
                showsTime: false,
                beforeShowDay: function(date) {
                    var show = true;
                    if(date.getDate() < 8 || date.getDate()>=12) show=false
                    return [show];
                }

            }
        },
    });

},);


