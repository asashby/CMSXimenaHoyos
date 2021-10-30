<?php


namespace App\View\Components;


use Illuminate\View\Component;

class Position extends Component
{

    public $root;
    public $position;
    public $title;
    public $url;

    /**
     * Position constructor.
     * @param $root
     * @param $position
     * @param $title
     * @param $url
     */
    public function __construct($root, $position, $title, $url)
    {
        $this->root = $root;
        $this->position = $position;
        $this->title = $title;
        $this->url = $url;
    }


    public function render()
    {
        return view('components.position');
    }
}
