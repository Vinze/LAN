<?php
namespace App\View\Components;

class FormPassword extends FormComponent {

    public $name;
    public $value;

    public function __construct($name = null, $value = null) {
        $this->name = $name;

        if ($name && old($name)) {
            $value = old($name);
        }

        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.form-password');
    }
}
