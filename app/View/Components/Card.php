<?php

namespace App\View\Components;

use Illuminate\View\Component;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class Card extends Component
{
  public $title;
  public $items;
  public $subtitle;
  public $link;
  //  public $name;

  public function __construct($title, $items, $subtitle, $link = null)
  {
    $this->title = $title;
    //    $this->name = $name;
    $this->subtitle = $subtitle;
    $this->items = $items;
    $this->link = $link;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.card');
  }
}
