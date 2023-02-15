@extends('layouts.layout')

@section('title')
    <title>{{ $category->title }} - FreshNews</title>
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
    <!-- News With Sidebar Start -->
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Категория: {{ $category->title }}</h4>
                                <a class="text-secondary font-weight-medium text-decoration-none"
                                   href="{{ route('category.index') }}">Все категории</a>
                            </div>
                        </div>

                        @foreach($posts as $num => $post)
                            <div class="col-lg-6">
                                <div class="position-relative mb-3 border">
                                    <a href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                        <img class="img-fluid w-100" src="{{ $post->getImage() }}"
                                             style="object-fit: cover;">
                                    </a>
                                    <div class="bg-white  p-4">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                               href="{{ route('category.show', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                                            <a class="text-body" href=""><small>
                                                    {{ Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
                                                </small>
                                            </a>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold"
                                           href="{{ route('post.show', ['slug' => $post->slug]) }}">{{ truncate($post->title, 5) }}</a>
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

                    </div>
                </div>

                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
