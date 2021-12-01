<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Updated extends Component
{
  public $name;
  public $title;
  public $date;
  public $userId;
  public function __construct(
    $title = 'Added',
    $name = null,
    $date,
    $userId = null
  ) {
    //
    $this->name = $name;
    $this->title = $title;
    $this->date = $date;
    $this->userId = $userId;
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
