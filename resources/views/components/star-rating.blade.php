<!-- this below code is for displaying star rating -->

@if ($rating)
    @for ($i = 1; $i <= 5; $i++)
    {{ $i <= round($rating) ? '★' : '☆' }} <!-- This will show the star rating based on the rating value. -->
    @endfor
@else

@endif