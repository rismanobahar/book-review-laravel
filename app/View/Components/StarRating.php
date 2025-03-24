<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StarRating extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public readonly ?float $rating) //this is the constructor to get the rating value. readonly means the value cannot be changed. the ? means that this is optional and can be null
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.star-rating');
    }
}
