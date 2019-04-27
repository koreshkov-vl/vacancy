@extends ('layouts.app')

@section ('content')
    <h1>{{ $vacancy->title }}</h1>
    <div>{{ $vacancy->description }}</div>
    <a href="/vacancies">Go back</a>
@endsection