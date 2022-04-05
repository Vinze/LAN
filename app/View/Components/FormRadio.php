<?php
namespace App\View\Components;

class FormRadio extends FormComponent {

    public $name;
    public $value;
    public $label;
    public $selected;

    public function __construct($name, $value, $label = null, $selected = null) {
        $selected = $this->old($name, $selected);

        if (is_numeric($value)) {
            $value = (int) $value;
            $selected = (int) $selected;
        }

        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.form-radio');
    }
}
