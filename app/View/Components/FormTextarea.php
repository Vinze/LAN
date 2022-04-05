<?php
namespace App\View\Components;

use Carbon\Carbon;

class FormTextarea extends FormComponent {

    public $name;
    public $value;

    public function __construct($name = null, $value = null) {
        $this->name = $name;
        $this->value = $this->old($name, $value);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.form-textarea');
    }
}
