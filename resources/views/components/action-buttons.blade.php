<div class=' flex justify-evenly'>
    <a href="/{{ $type }}/{{ $identifier }}/edit" class="hover:text-green-500 mr-1"><i class="fas fa-edit"></i></a>
    <form action="/{{ $type }}/{{ $identifier }}" method="POST" id="delete-form" class="mr-1">
        @method('delete')
        @csrf
        <button type="button" id='delete-btn' class="hover:text-red-500"><i class="fas fa-trash-alt"></i></button>
    </form>
    <a href='/{{ $type }}/{{ $identifier }}' class="hover:text-blue-500"><i class="fas fa-eye"></i></a>
</div>

@section('page-script')
    <script src="{{ asset('js/success-message.js') }}"></script>
@stop