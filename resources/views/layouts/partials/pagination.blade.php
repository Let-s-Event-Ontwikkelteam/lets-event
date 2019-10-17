@section('pagination')
    <div class="text-center">
        @if(($pageNumber - 1) > 0)
            <a href="{{ route('tournament.index') }}?pageNumber={{ ($pageNumber - 1) }}" class="btn">{{ ($pageNumber - 1) }}</a>
        @endif
        <a href="{{ route('tournament.index') }}?pageNumber={{ $pageNumber }}" class="btn btn-primary">{{ $pageNumber }}</a>
        @if(($pageNumber + 1) <= $lastPageNumber)
            <a href="{{ route('tournament.index') }}?pageNumber={{ ($pageNumber + 1) }}"
               class="btn">{{ ($pageNumber + 1) }}</a>
        @endif
    </div>
@endsection