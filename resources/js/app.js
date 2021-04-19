require('./bootstrap');

addToCart = (bookId) => {
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

        const content =  
        `
            <a href="/" class="link title">${ book.title }</a>
            <div class="quantity">
                <span class="divider">x</span>
                <span class="value">${ book.quantity } buc</span>
            </div>
            <div class="price">${ book.finalPrice } RON</div>
            <button id="delete${ book.id }" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
        `;

        if(itemExists) {
            const item = $(`#header #cart #cartContent #itemsList #${book.id}`).detach();
            item.html(content)
            cartItems.append(item);
        } else {
            const item = document.createElement('li');
            item.classList.add('item');
            item.id = book.id;
            item.innerHTML = content;
            cartItems.append(item);
            itemsIdList.push(book.id);

            removeFromCart(item);
        }

        cartCount.detach();
        cartCount.html(`${data.booksCount}`);
        cart.append(cartCount)
    })
    .fail( (jqXHR, textStatus, errorThrown) => {
        console.log(errorThrown)
    })
}

removeFromCart = (item) => {
    $(`#header #cart #cartContent #itemsList #${item.id} #delete${item.id}`).click( function() {
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
        })
        .fail( (jqXHR, textStatus, errorThrown) => {
            console.log(errorThrown)
        })
    });
}