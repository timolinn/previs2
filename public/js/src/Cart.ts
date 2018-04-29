import { CartService } from "./CartService.js";


export class Cart {

    constructor(public dom: Document) {
        this.initialize();
    }



    renderCart(cartContent: string) {
        const shoppingCart: Element = this.dom.querySelector('#dropdown-content');
        shoppingCart.innerHTML = cartContent;
    }

    private build(el): string {
                    return `<div id="drop-content">
                            <div class="pull-right drop-item-dt">
                                <p style="color:#FE4C50;" >
                                ${el.options.name} <small style="color:#989898;"  class="pull-right" >Qty: ${el.qty}</small>
                                </p>
                                <p class="pull-right"><i class="fa fa-fa-money"></i>₦ ${el.price}.00</p>
                            </div>
                            <div class="pull-left drop-item">
                                <img src="${el.options.image}"  class="pull-left rounded mx-auto d-bloc" width="75" height="75" alt="User Image">
                            </div>
                </div>
                <div class="dropdown-divider"></div>`;

    }

    initialize() {

        CartService.getContent(`/cart/contents`)
          .then(res => {
            // console.log(JSON.parse(res));

            let result = JSON.parse(res);
            this.updateItemCount(Object.keys(result).length); // Update counter in the dom

            let cartItems = ``;
            for (const key in result) {
                    if (result.hasOwnProperty(key)) {
                        const element = result[key];

                        cartItems = cartItems.concat(this.build(element));
                    }
                }
                this.renderCart(cartItems);
            });

            const cartService = new CartService(this);
        }

    updateItemCount(count: number): void {
        const counter = this.dom.querySelector('#checkout_items');
        counter.innerText = count;
    }

}
