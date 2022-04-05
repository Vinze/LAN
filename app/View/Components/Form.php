<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $method;
    public $action;
    public $files;

    public function __construct($method = 'POST', $action = null, $files = false) {
        $this->method = strtoupper($method);
        $this->action = $action ? url($action) : url()->current();
        $this->files = $files;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.form');
    }
}
