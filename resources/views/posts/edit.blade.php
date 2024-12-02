@extends('layouts.post')
@section('title')
    Thêm bài viết
@endsection
@section('content')
    <h2>Thêm bài viết</h2>
    <div class="float-end">
        <a href="{{ route('posts.index') }}" class="float-end btn btn-primary">Quay về</a>
    </div>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ $post->title }}">
        </div>
        <div class="form-group mt-3">
            <label for="content">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="10" required>{{ $post->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Thêm bài viết</button>
    </form>
@endsection
