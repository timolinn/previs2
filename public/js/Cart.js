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
                };
                Cart.prototype.build = function (el) {
                    return "<div id=\"drop-content\">\n                            <div class=\"pull-right drop-item-dt\">\n                                <p style=\"color:#FE4C50;\" >\n                                " + el.options.name + " <small style=\"color:#989898;\"  class=\"pull-right\" >Qty: " + el.qty + "</small>\n                                </p>\n                                <p class=\"pull-right\"><i class=\"fa fa-fa-money\"></i>\u20A6 " + el.price + ".00</p>\n                            </div>\n                            <div class=\"pull-left drop-item\">\n                                <img src=\"" + el.options.image + "\"  class=\"pull-left rounded mx-auto d-bloc\" width=\"75\" height=\"75\" alt=\"User Image\">\n                            </div>\n                </div>\n                <div class=\"dropdown-divider\"></div>";
                };
                Cart.prototype.initialize = function () {
                    var _this = this;
                    CartService_js_1.CartService.getContent("/cart/contents")
                        .then(function (res) {
                        // console.log(JSON.parse(res));
                        var result = JSON.parse(res);
                        _this.updateItemCount(Object.keys(result).length); // Update counter in the dom
                        var cartItems = "";
                        for (var key in result) {
                            if (result.hasOwnProperty(key)) {
                                var element = result[key];
                                cartItems = cartItems.concat(_this.build(element));
                            }
                        }
                        _this.renderCart(cartItems);
                    });
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
