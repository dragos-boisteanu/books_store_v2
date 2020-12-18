<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MethodsSelect extends Component
{


    public $name;
    public $title;
    public $id;
    public $methods; 
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $id, $methods)
    {
        $this->name = $name;
        $this->title =  $title;
        $this->id = $id;
        $this->methods = $methods;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.methods-select');
    }
}
