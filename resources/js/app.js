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
        }

        const cartCountValue = cartCount.html();
        const newCartContValue = parseInt(cartCountValue) + 1

        cartCount.detach();
        cartCount.html(`${newCartContValue}`);
        cart.append(cartCount)
    })
    .fail( (jqXHR, textStatus, errorThrown) => {
        console.log(errorThrown)
    })
}