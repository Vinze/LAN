<?php
namespace App\View\Components;

class FormCheckbox extends FormComponent {

    public $name;
    public $value;
    public $selected;
    public $label;

    public function __construct($name, $value, $selected = null, $label = null) {
        $selected = $this->old($name, $selected);

        if ($selected === null || $selected === '') {
            $selected = [];
        } else if ( ! is_array($selected)) {
            $selected = [$selected];
        }
        if (is_numeric($value)) {
            $value = (int) $value;
        }

        $this->name = $name;
        $this->value = $value;
        $this->selected = $selected;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.form-checkbox');
    }
}
