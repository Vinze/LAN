<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component {

    public $title;
    public $minimal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $minimal = false) {
        $this->title = $title;
        $this->minimal = $minimal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.layout');
    }
}
