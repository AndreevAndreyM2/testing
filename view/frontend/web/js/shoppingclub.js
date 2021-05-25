define([
        'uiComponent',
        'Magento_Customer/js/customer-data'
    ], function (Component, customerData) {
        'use strict';
        return Component.extend({
            initialize: function () {
                this.shoppingclub = customerData.get('shoppingclub');
                customerData.reload(['shoppingclub']);
                this._super();
            },
        });
    }
);
