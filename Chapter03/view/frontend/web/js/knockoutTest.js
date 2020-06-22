define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
    return Component.extend({
            defaults: {
                template: 'Junior_Chapter03/knockoutTest',
            },

            person: {
                'name':ko.observable('le van chien'),
                'age': 25
            },

           converToFullName: function () {
                let firstName, lastName, fullName, flag = 1, err;
                firstName = $('#firstname').val();
                lastName = $('#lastname').val();

                let pattern = /[0-9]/;
                if(pattern.test(firstName) || pattern.test(lastName))
                {
                    flag = 0;
                    err = 'First Name and Last Name can not contain numbers';
                }
                if(firstName === "" || lastName === "")
                {
                    flag = 0;
                    err = 'First Name and Last Name may not be blank';
                }

                if(flag === 1)
                {
                    firstName = firstName.trim();
                    let a = firstName.charAt(0);
                    a = a.toUpperCase();
                    let b = firstName.slice(1);
                    b = b.toLowerCase();
                    firstName = a + b;

                    let array = firstName.split(" ");
                    let k = "";
                    for(var y =0; y < array.length; y++)
                    {
                        if(array[y] !== "")
                        {
                            let a = array[y].charAt(0);
                            a = a.toUpperCase();
                            let b = array[y].slice(1);
                            b = b.toLowerCase();
                            let t = a + b;
                            k = k + t + " ";
                        }
                    }
                    firstName = k.trim();

                    let arr = lastName.split(" ");
                    let f = "";
                    for(var i =0; i < arr.length; i++)
                    {
                        if(arr[i] !== "")
                        {
                            let c = arr[i].charAt(0);
                            c = c.toUpperCase();
                            let d = arr[i].slice(1);
                            d = d.toLowerCase();
                            let e = c + d;
                            f = f + e + " ";
                        }
                    }
                    lastName = f.trim();

                    $('#fullname').val(firstName + " " + lastName);
                }else{
                    require([
                        'Magento_Ui/js/modal/alert'
                    ], function(alert) {
                        alert({
                            title: 'Notice Message',
                            content: err,
                            actions: {
                                always: function(){}
                            }
                        });

                    });
                }
            },

            fullNameToFirstName: function (){
                let fullName, err, flag = 1;

                fullName = $('#fullname').val();
                fullName = fullName.trim();
                if(fullName === "")
                {
                    flag = 0;
                    err = 'Full Name may not be empty';
                }
                let pattern = /[0-9]/;
                if(pattern.test(fullName))
                {
                    flag = 0;
                    err = 'Full Name can not contain numbers';
                }
                if(flag === 1)
                {
                    let arr = fullName.split(" ");
                    let f = "";
                    for(var i = 0; i < arr.length; i++)
                    {
                        if(arr[i] !== "")
                        {
                            let a = arr[i].charAt(0);
                            a = a.toUpperCase();
                            let b = arr[i].slice(1);
                            b = b.toLowerCase();
                            if(i === 0)
                            {
                                $('#firstname').val(a + b);
                            }else{
                                f = f + (a + b) + " ";
                            }
                        }
                    }
                    f = f.trim();
                    $('#lastname').val(f);
                }else{
                    require([
                        'Magento_Ui/js/modal/alert'
                    ], function(alert) {
                        alert({
                            title: 'Notice Message',
                            content: err,
                            actions: {
                                always: function(){}
                            }
                        });

                    });

                }
            }
        });
    });
