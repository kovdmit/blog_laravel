@extends('layouts.layout')

@section('title')
    <title>{{ $post->title }} - FreshNews</title>
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
@endsection

@section('content')
    <!-- Breaking News Start -->
    <div class="container-fluid mt-5 mb-3 pt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="section-title border-right-0 mb-0" style="width: 180px;">
                            <h4 class="m-0 text-uppercase font-weight-bold">Молния</h4>
                        </div>
                        <div
                            class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
                            style="width: calc(100% - 180px); padding-right: 100px;">

                            @foreach($lightnings as $lightning)
                                <div class="text-truncate">
                                    <a class="text-secondary text-uppercase font-weight-semi-bold">
                                        {{ $lightning->content }}
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->

    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="{{ $post->getImage() }}" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                   href="">{{ $post->category->title }}</a>
                                <a class="text-body">
                                    {{ Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
                                </a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">
                                {{ $post->title }}
                            </h1>
                            {{ $post->description }}
                            {!! $post->content !!}
                        </div>
                        <div>
                            <div class="section-title mb-0">
                                <h6 class="m-0">Теги</h6>
                            </div>
                            <div class="bg-white border border-top-0 p-3">
                                <div class="d-flex flex-wrap m-n1">

                                    @foreach($post->tags as $tag)
                                        <a class="btn btn-sm btn-outline-secondary m-1"
                                           href="{{ route('tag.show', ['slug' => $tag->slug]) }}">
                                            {{ $tag->title }}
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-2" src="{{ $post->author->getImage() }}" width="25" height="25" alt="">
                                <span>{{ $post->author->name }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="ml-3"><i class="far fa-eye mr-2"></i>{{ $post->views }}</span>
                                <span class="ml-3"><i class="far fa-comment mr-2"></i>{{ count($comments) }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->

                    @if(count($comments) > 0)
                        <!-- Comment List Start -->
                        <div class="mb-3">
                            <div class="section-title mb-0">
                                <h4 class="m-0 text-uppercase font-weight-bold">Комментарии</h4>
                            </div>
                            <div class="bg-white border border-top-0 p-4">

                                @foreach($comments as $comment)
                                    <div class="media mb-4">
                                        <img src="{{ $comment->author->getImage() }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><a class="text-secondary font-weight-bold">
                                                    {{ $comment->author->name }}</a>
                                                <small>
                                                    <i>{{ \Carbon\Carbon::parse($comment->created_at)->locale('ru')->isoFormat('DD MMMM YYYY') }}</i>
                                                </small>
                                            </h6>
                                            <p>{{ $comment->comment }}</p>
                                            <button class="btn btn-sm btn-outline-secondary">Ответить</button>
                                            @if($comment->author == auth()->user() || auth()->user()->staff > 0)
                                                <form class="d-inline" action="{{ route('comment.destroy', ['id' => $comment->id, 'slug' => $post->slug]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-secondary">Удалить</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- Comment List End -->
                    @endif


                    <!-- Comment Form Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Добавить комментарий</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4">
                            <form method="POST" action="{{ route('comment.store', ['slug' => $post->slug]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="message">Комментарий</label>
                                    <textarea id="comment" name="comment" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Отправить"
                                           class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Comment Form End -->
                </div>

                @include('layouts.sidebar')

            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
