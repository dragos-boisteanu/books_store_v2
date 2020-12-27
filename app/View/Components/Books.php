<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Books extends Component
{

    public $books;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($books)
    {
        $this->books = $books;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.books');
    }
}
