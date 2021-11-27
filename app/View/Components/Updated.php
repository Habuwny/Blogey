<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Updated extends Component
{
  public $name;
  public $title;
  public $date;
  public function __construct($title = 'Added', $name = null, $date)
  {
    //
    $this->name = $name;
    $this->title = $title;
    $this->date = $date;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.updated');
  }
}
