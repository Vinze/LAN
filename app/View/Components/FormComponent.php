<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Arr;

abstract class FormComponent extends Component {

    public function old($name, $value = null) {
        $key = str_dot($name);
        $old = session()->getOldInput();

        if (count($old) > 0 && $key) {
            $value = Arr::get($old, $key);
        }

        return $value;
    }

}
