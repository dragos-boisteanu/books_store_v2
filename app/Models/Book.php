<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model implements Viewable
{
    use HasFactory, SoftDeletes, InteractsWithViews;
    
    protected $fillable = [
        'title',
        'image_link',
        'isbn',
        'pages',
        'description',
        'stock_id',
        'price',
        'discount',
        'created_by',
        'updated_by',
        'published_at',
        'publisher_id',
        'category_id',
        'cover_id',
        'language_id'
    ];

    protected $appends = ['finalPrice', 'cartQuantity'];

    protected $with = ['authors', 'tags', 'category', 
                        'publisher', 'language', 'stock'];
  
    public function getFinalPriceAttribute()
    {
        $value = $this->price - ( $this->price * $this->discount / 100);
        $value = number_format($value, 2, '.', '');
        return $value;
    }

    public function getCartQuantity($cartId) 
    {
        return  $this->cart()->pivot->where('cart_id', $cartId)->quantity;
    }
    
    public function addedBy() 
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updatedBy() 
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
    
    public function cover() 
    {
        return $this->belongsTo('App\Models\Cover');
    }

    public function stock() 
    {
        return $this->hasOne('App\Models\Stock');
    }

    public function carts() 
    {
        return $this->belongsToMany('App\Models\Cart')->withPivot('quantity', 'cart_id');
    }

    public function category() 
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function publisher() 
    {
        return $this->belongsTo('App\Models\Publisher');
    }

    public function language() 
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function authors() 
    {
        return $this->belongsToMany('App\Models\Author');
    }

    public function orders() 
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function tags() 
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function increaseQuantity($cartId)
    {
        $updatedBooks = DB::update('update book_cart set quantity = quantity + 1 where book_id = :book_id and cart_id = :cart_id', ['book_id'=> $this->id, 'cart_id'=> $cartId]);

        return $updatedBooks;
    }

    public function updateQuantity($cartId, $quantity) {
        $updatedBooks = DB::update('update book_cart set quantity = :quantity where book_id = :book_id and cart_id = :cart_id', ['book_id'=>$this->id, 'cart_id'=>$cartId, 'quantity'=>$quantity]);

        return $updatedBooks;

    }

    public function deleteFromCart($cartId)
    {
        $result = DB::delete('delete from book_cart where book_id = :book_id and cart_id = :cart_id', 
        ['book_id' => $this->id, 'cart_id' => $cartId]);

        return $result;

    }

    public static function getBooksFromCart($cartId) 
    {
        $books = DB::select('SELECT books.id, books.title, book_cart.quantity, 
        books.discount as discount,
        FORMAT(books.price - (books.price * books.discount / 100), 2) * book_cart.quantity AS finalPrice,
        price as price
        FROM book_cart
        JOIN books ON book_cart.book_id = books.id
        JOIN carts on carts.id = book_cart.cart_id
        WHERE carts.id = :cart_id
        ORDER BY book_cart.created_at asc', ['cart_id' => $cartId]);

        return $books;
    }
    
    public static function getBookFromCart($cartId, $bookId)
    {
        $book = DB::select('SELECT books.id, books.title, book_cart.quantity, 
        books.discount as discount,
        FORMAT(books.price - (books.price * books.discount / 100), 2) * book_cart.quantity AS price
        FROM book_cart
        JOIN books ON book_cart.book_id = books.id
        JOIN carts on carts.id = book_cart.cart_id
        WHERE carts.id = :cart_id AND books.id = :book_id
        LIMIT 1', ['cart_id' => $cartId, 'book_id'=>$bookId]);

        return $book;
    }

    public static function getBooks($limit = 20, $offset = 0) 
    {
        $books = DB::select('SELECT books.id, books.title, stocks.quantity, 
        books.discount as discount,
        TRUNCATE(books.price - (books.price * books.discount / 100), 2) AS price
        FROM books
        JOIN stocks on stocks.book_id = books.id
        ORDER BY books.created_at desc
        LIMIT :limit OFFSET :offset', ['limit' => $limit, 'offset'=>$offset]
      );

        return $books;
    }

    public static function getBooksForOrder($cartId)
    {
        $books = DB::select('SELECT books.id, books.title, 
        books.discount as discount,
        book_cart.quantity as quantity,
        FORMAT(books.price - (books.price * books.discount / 100), 2) * book_cart.quantity AS finalPrice,
        FORMAT(books.price - (books.price * books.discount / 100), 2) as unitPrice
        FROM book_cart
        JOIN books ON book_cart.book_id = books.id
        JOIN carts on carts.id = book_cart.cart_id
        WHERE carts.id = :cart_id
        ORDER BY book_cart.created_at desc', ['cart_id' => $cartId]);

        return $books;
    }
}
