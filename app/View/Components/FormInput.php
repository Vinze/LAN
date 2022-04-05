<?php
namespace App\View\Components;

use Carbon\Carbon;

class FormInput extends FormComponent {

    public $type;
    public $name;
    public $value;

    public function __construct($type = 'text', $name = null, $value = null) {
        $this->type = $type;
        $this->name = $name;

        $value = $this->old($name, $value);

        if ($value && $value instanceof Carbon) {
            if ($type == 'date') {
                $value = $value->format('Y-m-d');
            }
            if ($type == 'time') {
                $value = $value->format('H:i');
            }
        }

        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.form-input');
    }
}
