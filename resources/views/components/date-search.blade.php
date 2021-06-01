<form action="{{ url('/orders') }}" method="GET">
    <x-input type="date" id="date_search" name="date_search" value="{{ request('date_search') }}" />
</form>
@if (request('date_search'))
    <span class="ml-2 cursor-pointer" id="close"><i class="fas fa-times"></i></span>
@endif


