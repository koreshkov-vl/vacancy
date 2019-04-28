@extends ('layouts.app')

@section ('content')
    <form method="POST" action="/vacancies">
        <h1 class="heading is-1">Edit vacancy</h1>
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $vacancy->title }}">
        </div>
        <div class="form-group">
            <label class="label" for="description">Description</label>
            <textarea class="form-control" rows="10" name="description" placeholder="description here...">{{ $vacancy->description }}</textarea>
        </div>
        <div class="row col-xl-12 text-secondary">vacancy added: {{ $vacancy->created_at }}</div>
        <div class="row col-xl-12 text-secondary">created by user:&nbsp;<p class="text-success">{{ $vacancy->user_name }}</p>
            &nbsp;email:&nbsp;<p class="text-success">{{ $vacancy->user_email }}</p>
        </div>
        <div class="row col-xl-12">
            <form action="/vacancies/{{ $vacancy->id }}/update" method="post">
                <button type="submit" class="btn btn-outline-info" value="post">Save changes</button>
                {!! method_field('post') !!}
                {!! csrf_field() !!}
            </form>&nbsp;
            <form action="/vacancies/{{ $vacancy->id }}/delete" method="post">
                <button type="submit" class="btn btn-outline-danger" value="Delete">Delete</button>
                {!! method_field('delete') !!}
                {!! csrf_field() !!}
            </form>
        </div>

    </form>

@endsection