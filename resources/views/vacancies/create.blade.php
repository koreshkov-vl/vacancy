@extends ('layouts.app')

@section ('content')
    <form method="POST" action="/vacancies">
        <h1 class="heading is-1">Create vacancy</h1>
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label class="label" for="description">Description</label>
            <textarea class="form-control" rows="10" name="description" placeholder="description here..."></textarea>
        </div>
        <button type="submit" class="btn btn-info">Create</button>
    </form>

@endsection