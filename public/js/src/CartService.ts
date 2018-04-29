import { Cart } from "Cart.js";

export class CartService {

    constructor(private cart: Cart) {
        this.setCartEvents();
    }

    setCartEvents() {
        const addCart = this.cart.dom.querySelectorAll(".addToCart");
        console.log(addCart);
        addCart.forEach(btn => {
            btn.addEventListener('click', function(evnt: any) {
                evnt.preventDefault();
                const itemId = btn.dataset.iid;

            });
        });
    }

    public static getContent(url: string): Promise<any> {

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