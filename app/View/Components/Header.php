<?php


namespace App\View\Components;


use Illuminate\View\Component;

class Header extends Component
{
    public $btn;
    public $title;
    public $url;
    public $className;
    public $icon;

    /**
     * Header constructor.
     * @param $btn
     * @param $title
     * @param $url
     * @param $className
     * @param $icon
     */
    public function __construct($btn, $title, $url, $className, $icon)
    {
        $this->btn = $btn;
        $this->title = $title;
        $this->url = $url;
        $this->className = $className;
        $this->icon = $icon;
    }


    public function render()
    {
        return view('components.header');
    }
}
