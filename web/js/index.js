async function addProductInCart(userId, productId) {
    //нет проверки на кол-во товаров оставшееся
    await $.post('/cart/create',
        {'user_id': userId, 'product_id': productId}).then(() => alert('Товар добален в корзину!'));
};


async function plusProduct(cartId) {
    await $.post('/cart/plus', {'id': cartId}).then(r => alert(r));


};

async function minusProduct(cartId) {
    await $.post('/cart/minus', {'id': cartId}).then(r => alert(r));
};