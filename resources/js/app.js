require('./bootstrap');

addToCart = _debouce((bookId) => {
    $.post(`/api/carts`, {
        bookId: bookId
    })
    .done(data => {
        const book = data.book;
        let itemExists = false;
        itemsIdList.forEach(id => {
            if(parseInt(id) === book.id) {
                itemExists = true;
            }
        });

        if(itemExists) {
           $(`#item${book.id}Quantity`).text(`${book.quantity}`);
           $(`item${book.id}Price`).text(`${book.finalPrice} RON`);
        } else {
            const content =  
            `
                <a href="/" class="link title">${ book.title }</a>
                <div class="quantity">
                    <span class="divider">x</span>
                    <span id="item${book.id}Quantity" class="value">${ book.quantity } buc</span>
                </div>
                <div id="item${book.id}Price" class="price">${ book.finalPrice } RON</div>
                <button id="delete${ book.id }" class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            `;

            const item = document.createElement('li');

            item.classList.add('item');
            item.id = book.id;

            item.innerHTML = content;
            cartItems.append(item);
            itemsIdList.push(book.id);

            $(`#delete${item.id}`).click( function() {
                removeFromCart(item);
            });
        }

        cartCount.text(`${data.booksCount}`);
    })
    .fail( (jqXHR, textStatus, errorThrown) => {
        console.log(errorThrown)
    })
}, 500, {
    'leading': true,
    'trailing': false
});

removeFromCart = _debouce((item) => {
    $.ajax({
        method: "DELETE",
        url: `/api/carts/${item.id}`,
        data: { id: item.id }
    })
    .done(data => {
        item.remove();
        cartCount.detach();
        cartCount.html(`${data.booksCount}`);
        cart.append(cartCount);
        
        const itemIndex = _findIndex(itemsIdList, id => {
            return id === item.id
        });

        itemsIdList.splice(itemIndex, 1);
        closeCart();

    })
    .fail( (jqXHR, textStatus, errorThrown) => {
        console.log(errorThrown)
    })
}, 500, {
    'leading': true,
    'trailing': false
})


closeCart = () => {
    cartBtn.show();
    cartContent.hide();
    cartCount.show();
}
