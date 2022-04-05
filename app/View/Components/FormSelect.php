<?php
namespace App\View\Components;

class FormSelect extends FormComponent {

    public $name;
    public $options;
    public $selected;
    public $placeholder;

    public function __construct($name, $options = [], $selected = null, $placeholder = null) {
        $selected = $this->old($name, $selected);

        if ($selected === null || $selected === '') {
            $selected = [];
        } else if ( ! is_array($selected)) {
            $selected = [(string) $selected];
        }

        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.form-select');
    }
}
