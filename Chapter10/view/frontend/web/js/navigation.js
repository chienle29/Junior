define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'Magento_Customer/js/customer-data',
        'Magento_Checkout/js/model/totals',
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
    ],
    function (
        $,
        ko,
        Component,
        _,
        stepNavigator,
        customerData,
        totals,
        quote
    ) {
        'use strict';
        var url = window.BASE_URL;
        const BASE_AUTHENTICATE = url + "checkout/#authenticate";
        const BASE_SHIPPING = url + "checkout/#shipping";
        const BASE_PAYMENT = url + "checkout/#payment";
        const BASE_CART = url + "checkout/cart";
        return Component.extend({
            defaults: {
                template: 'Junior_Chapter10/navigation',
                content: ko.observable(),
                grandTotal: ko.observable(),
            },
            initialize: function () {
                this._super();
                this.content('continue');
                if (window.location.href === BASE_PAYMENT) {
                    this.content('pay now');
                    this.grandTotal(false);
                }else{
                    this.grandTotal(true);
                }
            },
            getNextStep: function () {
                if (window.location.href === BASE_SHIPPING) {
                    this.grandTotal(false);
                    this.content('pay now');
                    $('.button.action.continue.primary').trigger("click");
                } else if(window.location.href === BASE_PAYMENT){
                    $('.action.primary.checkout').trigger('click');
                }else{
                    this.grandTotal(true);
                    stepNavigator.next();
                    this.content('continue');
                }
            },
            getPrevStep: function () {
                this.content('continue');
                var currentUrl = window.location.href;
                if (currentUrl === BASE_AUTHENTICATE) {
                    window.location.href = BASE_CART;
                } else if (currentUrl === BASE_PAYMENT) {
                    this.grandTotal(true);
                    window.location.href = BASE_SHIPPING;
                } else {
                    window.location.href = BASE_AUTHENTICATE;
                }
            },
            getValue: function () {
                let price = 0;
                price = totals.getSegment('grand_total').value;
                return "total $" + price;
            },
            getPrice: function () {
                let price = 0;
                price = Object.values(this.data)[0];
                return "total $" + price;
            },

        });

    });
