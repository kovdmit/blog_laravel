@extends('admin.layouts.layout')

@section('title')
    Публикации
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Публикации</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Публикации</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список публикаций</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                @if($posts->isEmpty())
                    Публикаций нет
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">№</th>
                            <th>Наименование</th>
                            <th>Статус</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Дата создания</th>
                            <th style="width: 120px">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td><a href="{{ route('posts.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></td>
                                <td class="text-center">@if($post->main)
                                        <i class="fa-brands fa-hotjar fa-lg main-news"></i>
                                    @endif
                                    @if($post->carusel)
                                        <i class="fa-brands fa-hotjar fa-lg carusel-news"></i>
                                    @endif</td>
                                    <td>{{ $post->category->title }}</td>
                                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <a href="{{ route('posts.show', ['post' => $post->slug]) }}"
                                       class="ico-shadow-show">
                                        <i class="fa-solid fa-eye fa-lg pr-2 ico-shadow-show"></i>
                                    </a>
                                    <a href="{{ route('posts.edit', ['post' => $post->slug]) }}"
                                       class="ico-shadow-edit">
                                        <i class="fa-solid fa-pen-to-square fa-lg pr-2 ico-shadow-edit"></i>
                                    </a>
                                    <form class="d-inline"
                                          action="{{ route('posts.destroy', ['post' => $post->slug]) }}"
                                          method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn-del">
                                            <i class="fa-solid fa-trash fa-lg ico-shadow-del"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{ route('posts.create') }}" role="button">Новая
                            публикация</a>
                    </div>

                    @if($posts->hasPages())
                        <div class="col">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item @if($posts->onFirstPage()) disabled @endif">
                                        <a class="page-link" href="{{ $posts->previousPageUrl() }}">Назад</a>
                                    </li>
                                    @for($i = 1; $i <= $posts->lastPage(); $i++)
                                        @if($i === 1 || abs($i - $posts->currentPage()) < 3 || $i === $posts->lastPage())
                                            <li class="page-item {{ ($posts->currentPage() == $i) ? ' active' : '' }}">
                                                <a class="page-link" href="{{ $posts->url($i)}} ">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endif

                                    @endfor
                                    <li class="page-item @if(!$posts->hasMorePages()) disabled @endif">
                                        <a class="page-link" href="{{ $posts->nextPageUrl() }}">Вперед</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
