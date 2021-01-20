<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('book', function ($trail, $item) {
    $trail->parent('home');
    $trail->push($item->title, route('books.show', $item->id));
});


//  ACCOUNT CRUMBS
Breadcrumbs::for('account', function ($trail) {
    $trail->parent('home');
    $trail->push('Account', route('client-user.show'));
});


// ACCOUNT - ADDRESSES
Breadcrumbs::for('addresses', function ($trail) {
    $trail->parent('account');
    $trail->push('Addresses', route('client-addresses.index'));
});

Breadcrumbs::for('addresses-edit', function ($trail, $item) {
    $trail->parent('addresses');
    $trail->push('Address #' . $item->id, route('client-addresses.edit', $item->id));
});

Breadcrumbs::for('addresses-show', function ($trail, $item) {
    $trail->parent('addresses');
    $trail->push('Address ' . $item->id, route('client-addresses.show', $item->id));
});

Breadcrumbs::for('addresses-create', function ($trail) {
    $trail->parent('addresses');
    $trail->push('Create new address',  route('client-addresses.create'));
});


// ACCOUNT - ORDERS
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('account');
    $trail->push('My Orders', route('client-orders.index'));
});

Breadcrumbs::for('orders-show', function ($trail, $item) {
    $trail->parent('orders');
    $trail->push('Order: #' . $item->id, route('client-orders.show', $item->id));
});
















Breadcrumbs::for('category', function ($trail, $item) {
    $trail->parent('home');
    $trail->push($item->name, route('category-books.show', $item->id));
});

Breadcrumbs::for('author', function ($trail, $item) {
    $trail->parent('home');
    $trail->push($item->first_name . ' ' . $item->name, route('author-books.show', $item->id));
});

Breadcrumbs::for('publisher', function ($trail, $item) {
    $trail->parent('home');
    $trail->push($item->name, route('category-books.show', $item->id));
});

Breadcrumbs::for('search', function ($trail) {
    $trail->parent('home');
    $trail->push('Search', route('search'));
});







?>