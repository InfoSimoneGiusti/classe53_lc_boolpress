@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1>Vedi {{$post->title}}</h1>

                <div><strong>ID</strong> {{$post->id}}</div>
                <div><strong>Title</strong> {{$post->title}}</div>
                <div><strong>Content</strong> {!! $post->content !!}</div>
                <div><strong>Slug</strong> {{$post->slug}}</div>

                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna alla lista</a>
            </div>
        </div>
    </div>
@endsection


