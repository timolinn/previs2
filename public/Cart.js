
// fetch(`/cart/contents`, {
//     method: 'GET',
//     credentials: 'same-origin',
//     mode:  'same-origin'
// }).then(res => res.json())
// .catch(err => {
//     if (err.error != undefined)
//         alert(err.error);
//     console.error(err);
// }).then(response => {
//     if (response.success != undefined) {
//         alert(response.success);
//         const cartBadge = document.querySelector("#cartCount");
//         // cartBadge.innerText = parseInt(cartBadge.innerText) + 1;
//     }
//     // console.log((response));
//     return response;
// });