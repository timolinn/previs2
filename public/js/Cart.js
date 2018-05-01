System.register(["./CartService.js"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var CartService_js_1, Cart;
    return {
        setters: [
            function (CartService_js_1_1) {
                CartService_js_1 = CartService_js_1_1;
            }
        ],
        execute: function () {
            Cart = /** @class */ (function () {
                function Cart(dom) {
                    this.dom = dom;
                    this.initialize();
                }
                Cart.prototype.renderCart = function (cartContent) {
                    var shoppingCart = this.dom.querySelector('#dropdown-content');
                    shoppingCart.innerHTML = cartContent;
                    this.totalAmount().then(function (resp) {
                        shoppingCart.querySelector('#totalAmount').innerHTML = "\u20A6" + resp;
                    });
                };
                Cart.prototype.build = function (el) {
                    return "<div id=\"drop-content\">\n                            <div class=\"pull-right drop-item-dt\">\n                                <p style=\"color:#FE4C50;\" >\n                                " + el.options.name + " <strong style=\"color:#989898;\" class=\"pull-right\"><a class=\"close-x\" href=\"#\"><i class=\"fa fa-times\"></i></a> </strong>\n                                </p>\n                                <p class=\"pull-right\" style=\"font-weight: normal;\"><i class=\"fa fa-fa-money\"></i>" + el.qty + " X \u20A6" + el.price + ".00</p>\n                            </div>\n                            <div class=\"pull-left drop-item\">\n                                <img src=\"/" + el.options.image + "\"  class=\"pull-left rounded mx-auto d-bloc\" width=\"75\" height=\"75\" alt=\"User Image\">\n                            </div>\n                </div>\n                <div class=\"dropdown-divider\"></div>";
                };
                Cart.prototype.prepareBuilt = function (result) {
                    // let total = 'Well';
                    var cartItems = "";
                    for (var key in result) {
                        if (result.hasOwnProperty(key)) {
                            var element = result[key];
                            cartItems = cartItems.concat(this.build(element));
                        }
                    }
                    if (Object.keys(result).length < 1) {
                        cartItems = cartItems.concat("<div style=\"backgroud:#FE4C50;\" class=\"drop-item-empty text-center\">\n                            <a href=\"#\" class=\"btn mt-0\" style=\"color:white;\">Your Cart is Empty.</a>\n                        </div>");
                    }
                    else {
                        cartItems = cartItems.concat("<div class=\"drop-item-link\" style=\"font-size:18px;padding-top:5%;padding-bottom:5%;\">\n                            <strong class=\"pull-left\">Total:</strong><strong id=\"totalAmount\" class=\"pull-right\">\u20A6" + this.total + "</strong>\n                        </div>\n                        <div class=\"drop-item-link text-center\">\n                            <a href=\"/cart/checkout\" class=\"btn mt-0\" style=\"color:white;\">Checkout</a>\n                            <a href=\"/cart\" class=\"btn btn-template-outlined mt-0\"> View Cart</a>\n                        </div>\n                        ");
                    }
                    return cartItems;
                };
                Cart.prototype.totalAmount = function () {
                    return new Promise(function (resolve, reject) {
                        CartService_js_1.CartService.getRequest("/cart/total-amount")
                            .then(function (res) {
                            res = JSON.parse(res);
                            if (res.success != undefined) {
                                console.log(res.content);
                                resolve(res.content);
                            }
                            reject(Error(res));
                        }).catch(function (err) { reject(Error(err)); });
                    });
                };
                Cart.prototype.initialize = function () {
                    var _this = this;
                    CartService_js_1.CartService.getRequest("/cart/contents")
                        .then(function (res) {
                        // console.log(JSON.parse(res));
                        var result = JSON.parse(res);
                        _this.updateItemCount(Object.keys(result).length); // Update counter in the dom
                        var cartItems = _this.prepareBuilt(result);
                        _this.renderCart(cartItems);
                    })
                        .catch(function (err) { throw err; });
                    var cartService = new CartService_js_1.CartService(this);
                };
                Cart.prototype.updateItemCount = function (count) {
                    var counter = this.dom.querySelector('#checkout_items');
                    counter.innerText = count;
                };
                return Cart;
            }());
            exports_1("Cart", Cart);
        }
    };
});
