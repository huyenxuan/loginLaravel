@extends('layouts.post')
@section('title')
    Danh sách bài viết
@endsection
@section('content')
    <h2>Danh sách bài viết</h2>
    <div class="d-flex float-end my-2">
        <a href="{{ route('posts.create') }}" class="btn btn-primary float-end">
            Thêm bài viết mới
        </a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Ngày đăng</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $post)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ substr($post->content, 0, 90) . '...' }}</td>
                    <td>{{ $post->published_at }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
