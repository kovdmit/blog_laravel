@extends('layouts.layout')

@section('title')
    <title>FreshNews</title>
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
@endsection

@php
    function truncate(string $str, int $len): string
    {
        $str_array = explode(' ', $str);
        if(count($str_array) > $len) {
            $str_short_array = array_slice($str_array, 0, $len);
            return implode(' ', $str_short_array).'...';
        }
        return $str;
    }
@endphp

@section('content')
    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 px-0">
                <div class="owl-carousel main-carousel position-relative">

                    @foreach($carusel as $post)
                        <div class="position-relative overflow-hidden" style="height: 500px;">
                            <img class="img-fluid h-100" src="{{ $post->getImage() }}" style="object-fit: cover;"
                                 alt="post_img">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                       href="{{ route('category.show', ['slug' => $post->category->slug]) }}">
                                       {{ $post->category->title }}
                                    </a>
                                    <a class="text-white">
                                        {{ Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
                                    </a>
                                </div>
                                <a class="h2 m-0 text-white text-uppercase font-weight-bold"
                                   href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                    {{ truncate($post->title, 9) }}
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-lg-5 px-0">
                <div class="row mx-0">

                    @foreach($main as $post)
                        <div class="col-md-6 px-0">
                            <div class="position-relative overflow-hidden" style="height: 250px;">
                                <img class="img-fluid w-100 h-100" src="{{ $post->getImage() }}"
                                     style="object-fit: cover;">
                                <div class="overlay">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                           href="{{ route('category.show', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                                        <a class="text-white">
                                            <small>
                                                {{ Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
                                            </small>
                                        </a>
                                    </div>
                                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold"
                                       href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                        {{ truncate($post->title, 5) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->

    <!-- Breaking News Start -->
    <div class="container-fluid bg-dark py-3 mb-3">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">
                            Молния
                        </div>
                        <div
                            class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 170px); padding-right: 90px;">

                            @foreach($lightnings as $lightning)
                                <div class="text-truncate">
                                    <a class="text-white text-uppercase font-weight-semi-bold" href="">
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

    <!-- Featured News Slider Start -->
    <div class="container-fluid pt-5 mb-3">
        <div class="container">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">Рекомендуемые новости</h4>
            </div>
            <div class="owl-carousel news-carousel carousel-item-4 position-relative">

                @foreach($pop_news as $post)
                    <div class="position-relative overflow-hidden" style="height: 300px;">
                        <img class="img-fluid h-100" src="{{ $post->getImage() }}" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                   href="{{ route('category.show', ['slug' => $post->category->slug]) }}">
                                    {{ $post->category->title }}
                                </a>
                                <a class="text-white">
                                    <small>
                                        {{ Carbon\Carbon::parse($post->created_at)->format('d m Y') }}
                                    </small>
                                </a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold"
                               href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                {{ truncate($post->title, 5) }}
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Featured News Slider End -->

    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">

                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Последние новости</h4>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                   href="{{ route('category.index') }}">
                                    Посмотреть все
                                </a>
                            </div>
                        </div>

                        @foreach($posts1_4 as $num => $post)
                            <div class="col-lg-6">
                                <div class="position-relative mb-3 border">
                                    <div>
                                        <a href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                            <img class="img-fluid w-100" src="{{ $post->getImage() }}"
                                                 style="object-fit: cover;"></a>
                                    </div>
                                    <div class="bg-white  p-4">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                               href="{{ route('category.show', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                                            <a class="text-body"><small>
                                                    {{ Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
                                                </small>
                                            </a>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                           href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                            {{ truncate($post->title, 5) }}
                                        </a>
                                        <p class="m-0">
                                            {{ truncate($post->description, 15) }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25"
                                                 alt="">
                                            <small>John Doe</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <small class="ml-3"><i class="far fa-eye mr-2"></i>{{ $post->views }}
                                            </small>
                                            <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($num === 1)
                                <div class="col-lg-12 mb-3 d-none">
                                    <a href=""><img class="img-fluid w-100" src="" alt=""></a>
                                </div>
                            @endif
                        @endforeach

                        @foreach($posts5_8 as $post)
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center bg-white mb-3 border" style="height: 110px;">
                                    <img class="img-fluid small-news" src="{{ $post->getImage() }}" alt="">
                                    <div
                                        class="w-100 h-100 px-3 d-flex flex-column justify-content-center">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                                               href="{{ route('category.show', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                                            <a class="text-body">
                                                <small>
                                                    {{ Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
                                                </small>
                                            </a>
                                        </div>
                                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold"
                                           href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                            {{ truncate($post->title, 5) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-12 mb-3 d-none">
                            <a href="">
                                <img class="img-fluid w-100" src="" alt="">
                            </a>
                        </div>

                        @foreach($post9 as $post)
                            <div class="col-lg-12">
                                <div class="row news-lg mx-0 mb-3 border">
                                    <div class="col-md-6 h-100 px-0">
                                        <a href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                            <img class="img-fluid h-100" src="{{ $post->getImage() }}"
                                                 style="object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="col-md-6 d-flex flex-column bg-white h-100 px-0">
                                        <div class="mt-auto p-4">
                                            <div class="mb-2">
                                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                   href="{{ route('category.show', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                                                <a class="text-body">
                                                    <small>
                                                        {{ Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
                                                    </small>
                                                </a>
                                            </div>
                                            <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                               href="{{ route('post.show', ['slug' => $post->slug]) }}">{{ truncate($post->title, 5) }}</a>
                                            <p class="m-0">{{ truncate($post->description, 15) }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between bg-white border-top mt-auto p-4">
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle mr-2" src="img/user.jpg" width="25"
                                                     height="25" alt="">
                                                <small>John Doe</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="ml-3"><i class="far fa-eye mr-2"></i>{{ $post->views }}
                                                </small>
                                                <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($posts10_13 as $post)
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center bg-white mb-3 border" style="height: 110px;">
                                    <img class="img-fluid small-news" src="{{ $post->getImage() }}" alt="">
                                    <div
                                        class="w-100 h-100 px-3 d-flex flex-column justify-content-center">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                                               href="{{ route('category.show', ['slug' => $post->category->slug]) }}">
                                                {{ $post->category->title }}
                                            </a>
                                            <a class="text-body">
                                                <small>
                                                    {{ Carbon\Carbon::parse($post->created_at)->format('d F Y') }}
                                                </small>
                                            </a>
                                        </div>
                                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold"
                                           href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                            {{ truncate($post->title, 5) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
