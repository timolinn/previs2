import { CartService } from "./CartService.js";


export class Cart {

    public total: number;

    constructor(public dom: Document) {
        this.initialize();
    }

    renderCart(cartContent: string) {
        const shoppingCart: Element = this.dom.querySelector('#dropdown-content');
        shoppingCart.innerHTML = cartContent;
        this.totalAmount().then((resp: any) => {
            shoppingCart.querySelector('#totalAmount').innerHTML = `₦${resp}`;
        });
    }

    private build(el): string {
                    return `<div id="drop-content">
                            <div class="pull-right drop-item-dt">
                                <p style="color:#FE4C50;" >
                                ${el.options.name} <strong style="color:#989898;" class="pull-right"><a class="close-x" href="#"><i class="fa fa-times"></i></a> </strong>
                                </p>
                                <p class="pull-right" style="font-weight: normal;"><i class="fa fa-fa-money"></i>${el.qty} X ₦${el.price}.00</p>
                            </div>
                            <div class="pull-left drop-item">
                                <img src="/${el.options.image}"  class="pull-left rounded mx-auto d-bloc" width="75" height="75" alt="User Image">
                            </div>
                </div>
                <div class="dropdown-divider"></div>`;

    }

    prepareBuilt(result: any): string {
        // let total = 'Well';

        let cartItems = ``;
            for (const key in result) {
                    if (result.hasOwnProperty(key)) {
                        const element = result[key];

                        cartItems = cartItems.concat(this.build(element));
                    }
                }

                if (Object.keys(result).length < 1) {
                    cartItems = cartItems.concat(
                        `<div style="backgroud:#FE4C50;" class="drop-item-empty text-center">
                            <a href="#" class="btn mt-0" style="color:white;">Your Cart is Empty.</a>
                        </div>`
                    );
                } else {
                    cartItems = cartItems.concat(
                        `<div class="drop-item-link" style="font-size:18px;padding-top:5%;padding-bottom:5%;">
                            <strong class="pull-left">Total:</strong><strong id="totalAmount" class="pull-right">₦${this.total}</strong>
                        </div>
                        <div class="drop-item-link text-center">
                            <a href="/cart/checkout" class="btn mt-0" style="color:white;">Checkout</a>
                            <a href="/cart" class="btn btn-template-outlined mt-0"> View Cart</a>
                        </div>
                        `
                    );
                }

        return cartItems;
    }

    totalAmount() {
        return new Promise((resolve, reject) => {
            CartService.getRequest(`/cart/total-amount`)
            .then((res) => {
                res = JSON.parse(res);
                if (res.success != undefined) {
                    console.log(res.content);
                    resolve(res.content);
                }
                reject(Error(res));
            }).catch(err => {reject(Error(err));});
        });

    }

    initialize() {

        CartService.getRequest(`/cart/contents`)
          .then(res => {
            // console.log(JSON.parse(res));

                let result = JSON.parse(res);
                this.updateItemCount(Object.keys(result).length); // Update counter in the dom

                let cartItems = this.prepareBuilt(result);
                this.renderCart(cartItems);
            })
            .catch(err => {throw err});

            const cartService = new CartService(this);
        }

    updateItemCount(count: number): void {
        const counter = this.dom.querySelector('#checkout_items');
        counter.innerText = count;
    }

}
