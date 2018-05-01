import { Cart } from "Cart.js";

export class CartService {

    constructor(private cart: Cart) {
        this.setCartEvents();
    }

    setCartEvents() {
        var _this = this;
        const addCart = this.cart.dom.querySelectorAll(".addToCart");

        addCart.forEach(btn => {
            const itemId = btn.dataset.iid;
            btn.addEventListener('click', function(evnt: any) { // Add event listeners to cart buttons
                evnt.preventDefault();
                btn.querySelector('.fa').classList.add('fa-spinner');
                CartService.getRequest(`/cart/${itemId}/1/create`)
                    .then((res) => {
                        console.log(JSON.parse(res));
                        res = JSON.parse(res);
                        if (res.success != undefined) {
                            btn.querySelector('.fa').classList.remove('fa-spinner');
                            _this.renderUpdatedCart(); // re-render cart contents with new item
                        } else {
                            btn.querySelector('.fa').classList.remove('fa-spinner');
                            throw "Error: " + res.error;
                        }
                        btn.querySelector('.fa').classList.remove('fa-spinner');
                    }).catch((err) => {
                        console.log(Error(err));
                    });
            });
        });
    }

    renderUpdatedCart() {
        CartService.getRequest(`/cart/contents`)
                .then((result) => {
                    const res = JSON.parse(result);
                    this.cart.updateItemCount(Object.keys(res).length);
                    let items = this.cart.prepareBuilt(res);
                    this.cart.renderCart(items);
                }).catch((err) => {
                    console.log(Error(err));
                    throw "Couldn't fetch cart " + Error(err);
                });
    }

    public static getRequest(url: string): Promise<any> {

        return new Promise((resolve, reject) => {
            // Do the usual XHR stuff
                var req = new XMLHttpRequest();
                req.open('GET', url);

                req.onload = function() {
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
                req.onerror = function() {
                reject(Error("Network Error"));
                };

                // Make the request
                req.send();
            });
    }
}