@extends('layouts.layout')

@section('title')
    <title>Категории новостей - FreshNews</title>
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
                                <h4 class="m-0 text-uppercase font-weight-bold">Все категории</h4>
                            </div>
                        </div>

                        @foreach($posts as $i => $post)
                            @if($i === 0 || $i % 4 === 0)
                                <div class="col-lg-12 mb-3">
                                    <a href="{{ route('category.show', ['slug' => $post->category_slug]) }}">
                                        <h5 class="m-0 text-uppercase font-weight-bold text-right pr-3 pt-3">{{ $post->category_title }}</h5>
                                    </a>
                                </div>
                            @endif

                            <div class="col-lg-6">
                                <div class="d-flex align-items-center bg-white mb-3 border"
                                     style="height: 110px;">
                                    <img class="img-fluid small-news" src="
                                        @if(!$post->thumbnail)
                                            assets/admin/img/no-image.png
                                        @else
                                            /uploads/{{ $post->thumbnail }}
                                        @endif
                                    " alt="">
                                    <div
                                        class="w-100 h-100 px-3 d-flex flex-column justify-content-center">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                                               href="{{ route('category.show', ['slug' => $post->category_slug]) }}">
                                                {{ $post->category_title }}
                                            </a>
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

                    </div>
                </div>

                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
