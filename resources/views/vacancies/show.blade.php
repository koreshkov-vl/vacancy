@extends ('layouts.app')

@section ('content')
    <div class="row col-xl-12">
        <div class="row col-xl-9 rounded shadow p-4">
            <div class="row col-xl-12 text-secondary">vacancy added: {{ $vacancy->created_at }}</div>
            <div class="row col-xl-12"><h2>{{ $vacancy->title }}</h2></div>
            <div class="row col-xl-12">{{ $vacancy->description }}</div>
            <div class="row col-xl-12 text-info text-right ">views: {{ $vacancy->views }}</div>
            @if (Auth::check())
                <div class="row col-xl-12 text-secondary">created by user:&nbsp;<p class="text-success">{{ $vacancy->user_name }}</p>
                    &nbsp;email:&nbsp;<p class="text-success">{{ $vacancy->user_email }}</p>
                </div>
                <div class="row col-xl-12">
                    <a href="/vacancies/{{ $vacancy->id }}/edit" type="button" class="btn btn-warning">Edit</a>&nbsp;

                    <form action="/vacancies/{{ $vacancy->id }}/delete" method="post">
                        <button type="submit" class="btn btn-outline-danger" value="Delete">Delete</button>
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection