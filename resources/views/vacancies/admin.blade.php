@extends ('layouts.app')

@section ('content')
    <div style="display: flex; align-items: center">
        <h1 style="margin-right: auto">All vacancies</h1>
    </div>
    <div class="row col-xl-12">
        {{ $vacancies->links() }}
    </div>
    <div class="row col-xl-12">
    @forelse ($vacancies as $vacancy)
        <div class="row col-xl-9 rounded shadow p-4">
            <div class="row col-xl-12 text-secondary">vacancy added: {{ $vacancy->created_at }}</div>
            <div class="row col-xl-12"><h2><a href="/vacancies/{{ $vacancy->id }}">{{ $vacancy->title }}</a></h2></div>
            <div class="row col-xl-12">{{ $vacancy->description }}</div>
            <div class="row col-xl-12 text-info">views: {{ $vacancy->views }}</div>
            <div class="row col-xl-12 text-secondary">created by user:&nbsp;<p class="text-success">{{ $vacancy->user_name }}</p>
                &nbsp;email:&nbsp;<p class="text-success">{{ $vacancy->user_email }}</p>
            </div>
            <div class="row col-xl-12">
                <form action="/vacancies/{{ $vacancy->id }}/delete" method="post">
                    <button type="submit" class="btn btn-outline-danger" value="Delete">Delete</button>
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    @empty
        <div class="row col-xl-9 rounded shadow p-4">No vacancies yet...</div>
    @endforelse
    </div>
    <div class="row col-xl-12 p-4">
        {{ $vacancies->links() }}
    </div>
@endsection