@extends('admin.layouts.layout')

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
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Публикации</a></li>
                        <li class="breadcrumb-item active">{{ $post->title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Параметр</th>
                            <th>Значение</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>id</td>
                            <td>{{ $post->id }}</td>
                        </tr>
                        <tr>
                            <td>slug</td>
                            <td>{{ $post->slug }}</td>
                        </tr>
                        <tr>
                            <td>Наименование</td>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <td>Изображение</td>
                            <td>
                                <div class="miniature">
                                    <img src="{{ $post->getImage() }}" alt="img">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Категория</td>
                            <td>{{ $post->category->title }}</td>
                        </tr>
                        <tr>
                            <td>Описание</td>
                            <td>{{ $post->description }}</td>
                        </tr>
                        <tr>
                            <td>Основной контент</td>
                            <td>{{ $post->content }}</td>
                        </tr>
                        <tr>
                            <td>Дата создания</td>
                            <td>{{ $post->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Дата обновления</td>
                            <td>{{ $post->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Теги</td>
                            <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                        </tr>
                        <tr>
                            <td>Количество просмотров</td>
                            <td>{{ $post->views }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
