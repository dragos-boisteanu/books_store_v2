<?php


Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('book', function ($trail, $item) {
    $trail->parent('home');
    $trail->push($item->title, route('books.show', $item->id));
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


//  ACCOUNT 
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


// DASHBOARD
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// DASHBOARD BOOKS 
Breadcrumbs::for('dashboard-books.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Books index', route('admin-books.index'));
});

Breadcrumbs::for('dashboard-book', function ($trail, $item) {
    $trail->parent('dashboard-books.index');
    $trail->push('Show book: ' . $item->title, route('admin-books.show', $item->id));
});

Breadcrumbs::for('dashboard-book.edit', function ($trail, $item) {
    $trail->parent('dashboard-books.index');
    $trail->push('Edit book: '.$item->title, route('admin-books.edit', $item->id));
});

Breadcrumbs::for('dashboard-book.create', function ($trail) {
    $trail->parent('dashboard-books.index');
    $trail->push('Add new book', route('admin-books.create'));
});

//  DASHBOARD ORDERS
Breadcrumbs::for('dashboard-orders.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Orders index', route('admin-orders.index'));
});

Breadcrumbs::for('dashboard-order', function ($trail, $item) {
    $trail->parent('dashboard-orders.index');
    $trail->push('Show order: #'.$item->id, route('admin-orders.show', $item->id));
});

Breadcrumbs::for('dashboard-order.edit', function ($trail, $item) {
    $trail->parent('dashboard-orders.index');
    $trail->push('Edit order: #'.$item->id, route('admin-orders.edit', $item->id));
});


//  DASHBOARD USERS
Breadcrumbs::for('dashboard-users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users index', route('admin-users.index'));
});

Breadcrumbs::for('dashboard-users.show', function ($trail, $item) {
    $trail->parent('dashboard-users.index');
    $trail->push('Show user: #'.$item->id, route('admin-users.show', $item->id));
});


// DASHBOARD AUTHORS 
Breadcrumbs::for('dashboard-authors.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Authors index', route('admin-books.index'));
});

Breadcrumbs::for('dashboard-authors.show', function ($trail, $item) {
    $trail->parent('dashboard-authors.index');
    $trail->push('Show author: ' . $item->id, route('admin-authors.show', $item->id));
});

Breadcrumbs::for('dashboard-authors.edit', function ($trail, $item) {
    $trail->parent('dashboard-authors.index');
    $trail->push('Edit author: #'.$item->id, route('admin-authors.edit', $item->id));
});

Breadcrumbs::for('dashboard-authors.create', function ($trail) {
    $trail->parent('dashboard-authors.index');
    $trail->push('Add new author', route('admin-authors.create'));
});

// DASHBOARD AUTHORS 
Breadcrumbs::for('dashboard-tags.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tags index', route('admin-tags.index'));
});

Breadcrumbs::for('dashboard-tags.show', function ($trail, $item) {
    $trail->parent('dashboard-tags.index');
    $trail->push('Show tags: ' . $item->id, route('admin-tags.show', $item->id));
});

Breadcrumbs::for('dashboard-tags.edit', function ($trail, $item) {
    $trail->parent('dashboard-tags.index');
    $trail->push('Edit tag: #'.$item->id, route('admin-tags.edit', $item->id));
});

Breadcrumbs::for('dashboard-tags.create', function ($trail) {
    $trail->parent('dashboard-tags.index');
    $trail->push('Add new tag', route('admin-tags.create'));
});


// 404

Breadcrumbs::for('errors.404', function ($trail) {
    $trail->parent('home');
    $trail->push('Page Not Found');
});

?>