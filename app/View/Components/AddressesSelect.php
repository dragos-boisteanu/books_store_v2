<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AddressesSelect extends Component
{

    public $name;
    public $title;
    public $id;
    public $addresses;
    public $default;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $id = null, $addresses)
    {
        $this->name = $name;
        $this->title =  $title;
        $this->id = $id;
        $this->addresses = $addresses;
        
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.addresses-select');
    }
}
