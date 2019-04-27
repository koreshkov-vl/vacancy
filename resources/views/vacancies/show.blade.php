@extends ('layouts.app')

@section ('content')
    <div class="row col-xl-12">
        <div class="row col-xl-9 rounded shadow p-4">
            <div class="row col-xl-12 text-secondary">vacancy added: {{ $vacancy->created_at }}</div>
            <div class="row col-xl-12"><h2>{{ $vacancy->title }}</h2></div>
            <div class="row col-xl-12">{{ $vacancy->description }}</div>
            <div class="row col-xl-12 text-info text-right ">views: {{ $vacancy->views }}</div>
        </div>
    </div>
@endsection