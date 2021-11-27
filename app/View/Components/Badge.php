<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
  public $name;
  public $show;
  public $type;
  public function __construct($name, $type, $show)
  {
    //    $this->name = $name;
    $this->name = $name;
    $this->type = $type;
    $this->show = $show;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.badge');
  }
}
