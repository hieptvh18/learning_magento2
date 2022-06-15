define(
    [
        'ko',
        'uiComponent'
    ],
    function (ko, Component) {
        "use strict";

        return Component.extend({
            defaults: {
                template: 'Ecommage_AddCmsBlockCheckout/newsletter'
            },
            isRegisterNewsletter: true
        });
    }
);
