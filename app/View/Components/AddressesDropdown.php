<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AddressesDropdown extends Component
{

    public $name;
    public $title;
    public $id;
    public $addresses;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $id, $addresses)
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
      
        return view('components.addresses-dropdown');
    }
}
