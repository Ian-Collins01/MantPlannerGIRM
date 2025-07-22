<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    public $successMessage;
    public $errors;

    /**
     * Create a new component instance.
     *
     * @param  string|null  $successMessage
     * @param  array  $errors
     * @return void
     */
    public function __construct($successMessage = null, $errors = [])
    {
        $this->successMessage = $successMessage;
        $this->errors = $errors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.toast');
    }
}
