<?php


namespace App\View\Components;


use Illuminate\View\Component;

class Form extends Component
{

    public $message;

    /**
     * Form constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('components.form');
    }
}
