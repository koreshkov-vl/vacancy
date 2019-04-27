@extends ('layouts.app')

@section ('content')
    <div style="display: flex; align-items: center">
        <h1 style="margin-right: auto">Last vacancies</h1>
    </div>

    <div class="row col-xl-12">

    @forelse ($vacancies as $vacancy)
        <div class="row col-xl-9 rounded shadow p-4">
            <div class="row col-xl-12 text-secondary">vacancy added: {{ $vacancy->created_at }}</div>
            <div class="row col-xl-12"><h2><a href="{{$vacancy->path}}">{{ $vacancy->title }}</a></h2></div>
            <div class="row col-xl-12">{{ $vacancy->description }}</div>
            <div class="row col-xl-12 text-info text-right ">views: {{ $vacancy->views }}</div>
        </div>
    @empty
         <div class="row col-xl-9 rounded shadow p-4">No vacancies yet...</div>
    @endforelse
    </div>

@endsection