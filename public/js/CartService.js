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
                    var _this = this;
                    var addCart = this.cart.dom.querySelectorAll(".addToCart");
                    addCart.forEach(function (btn) {
                        var itemId = btn.dataset.iid;
                        btn.addEventListener('click', function (evnt) {
                            evnt.preventDefault();
                            btn.querySelector('.fa').classList.add('fa-spinner');
                            CartService.getRequest("/cart/" + itemId + "/1/create")
                                .then(function (res) {
                                console.log(JSON.parse(res));
                                res = JSON.parse(res);
                                if (res.success != undefined) {
                                    btn.querySelector('.fa').classList.remove('fa-spinner');
                                    _this.renderUpdatedCart(); // re-render cart contents with new item
                                }
                                else {
                                    btn.querySelector('.fa').classList.remove('fa-spinner');
                                    throw "Error: " + res.error;
                                }
                            }).catch(function (err) {
                                console.log(Error(err));
                            });
                        });
                    });
                };
                CartService.prototype.renderUpdatedCart = function () {
                    var _this = this;
                    CartService.getRequest("/cart/contents")
                        .then(function (result) {
                        var res = JSON.parse(result);
                        _this.cart.updateItemCount(Object.keys(res).length);
                        var items = _this.cart.prepareBuilt(res);
                        _this.cart.renderCart(items);
                    }).catch(function (err) {
                        console.log(Error(err));
                        throw "Couldn't fetch cart " + Error(err);
                    });
                };
                CartService.getRequest = function (url) {
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
