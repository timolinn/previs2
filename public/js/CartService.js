System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var CartService;
    return {
        setters: [],
        execute: function () {
            CartService = /** @class */ (function () {
                function CartService(cart) {
                    this.cart = cart;
                    this.setCartEvents();
                }
                CartService.prototype.setCartEvents = function () {
                    var addCart = this.cart.dom.querySelectorAll(".addToCart");
                    console.log(addCart);
                    addCart.forEach(function (btn) {
                        btn.addEventListener('click', function (evnt) {
                            evnt.preventDefault();
                            var itemId = btn.dataset.iid;
                        });
                    });
                };
                CartService.getContent = function (url) {
                    return new Promise(function (resolve, reject) {
                        // Do the usual XHR stuff
                        var req = new XMLHttpRequest();
                        req.open('GET', url);
                        req.onload = function () {
                            // This is called even on 404 etc
                            // so check the status
                            if (req.status == 200) {
                                // Resolve the promise with the response text
                                resolve(req.response);
                            }
                            else {
                                // Otherwise reject with the status text
                                // which will hopefully be a meaningful error
                                reject(Error(req.statusText));
                            }
                        };
                        // Handle network errors
                        req.onerror = function () {
                            reject(Error("Network Error"));
                        };
                        // Make the request
                        req.send();
                    });
                };
                return CartService;
            }());
            exports_1("CartService", CartService);
        }
    };
});
