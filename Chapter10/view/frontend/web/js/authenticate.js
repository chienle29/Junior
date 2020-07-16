define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'underscore',
        'Magento_Checkout/js/model/step-navigator',
        'Magento_Customer/js/customer-data'
    ],
    function (
        $,
        ko,
        Component,
        _,
        stepNavigator,
        customerData
    ) {
        'use strict';
        var url = window.BASE_URL;

        /**
         *
         * mystep - is the name of the component's .html template,
         * <Vendor>_<Module>  - is the name of the your module directory.
         *
         */

        return Component.extend({
            defaults: {
                template: 'Junior_Chapter10/authenticate'
            },

            //add here your logic to display step,
            isVisible: ko.observable(true),
            /**
             *
             * @returns {*}
             */

            initialize: function () {
                this._super();
                // register your step

                stepNavigator.registerStep(
                    //step code will be used as step content id in the component template
                    'authenticate',
                    //step alias
                    null,
                    //Authenticate value
                    'Authenticate',
                    //observable property with logic when display step or hide step
                    this.isVisible,

                    _.bind(this.navigate, this),

                    /**
                     * sort order value
                     * 'sort order value' < 10: step displays before shipping step;
                     * 10 < 'sort order value' < 20 : step displays between shipping and payment step
                     * 'sort order value' > 20 : step displays after payment step
                     */
                    9
                );

                return this;
            },


            /**
             * The navigate() method is responsible for navigation between checkout step
             * during checkout. You can add custom logic, for example some conditions
             * for switching to your custom step
             * When the user navigates to the custom step via url anchor or back button we_must show step manually here
             */
            navigate: function () {
                this.isVisible(true);
            },
            isLogin: function () {
                return isCustomerLoggedIn;
            },

            /**
             * @returns void
             */
            navigateToNextStep: function () {
                if (isCustomerLoggedIn) {
                    stepNavigator.next();
                } else {
                    var userName, password, errUser, errPass, flag = 1;
                    userName = $('#username').val();
                    password = $('#password').val();

                    if (userName.length < 6 || userName.length > 32) {
                        flag = 0;
                        errUser = 'Username invalid';
                    }
                    if (password.length < 6 || password.length > 32) {
                        flag = 0;
                        errPass = 'Password invalid';
                    }
                    if (userName === "") {
                        flag = 0;
                        errUser = 'This is a required';
                    }
                    if (password === "") {
                        flag = 0;
                        errPass = 'This is a required';
                    }

                    if (flag === 1) {
                        $('.err-user').html('');
                        $('.err-pass').html('');
                        var formData = new FormData();
                        formData.append('username', userName);
                        formData.append('password', password);
                        $('.loading-contain').css('display', 'block');
                        $.ajax({
                            url: url + "ajax/login/index",
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = Number(data);
                                if (data === 1) {
                                    stepNavigator.next();
                                    window.location.reload();

                                } else {
                                    $('.loading-contain').css('display', 'none');
                                    require([
                                        'Magento_Ui/js/modal/alert'
                                    ], function (alert) {
                                        alert({
                                            title: 'Error Message',
                                            content: "Username Or Password invalid",
                                            actions: {
                                                always: function () {
                                                }
                                            }
                                        });

                                    });
                                }
                            }
                        });

                    } else {
                        $('.err-user').html(errUser);
                        $('.err-pass').html(errPass);
                    }
                }
            },

        });
    }
);
