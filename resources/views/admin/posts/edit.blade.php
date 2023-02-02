@extends('admin.layouts.layout')

@section('title')
    Редактирование публикации
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
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Публикации</a></li>
                        <li class="breadcrumb-item active">Редактировать публикацию</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование публикации</h3>
                        </div>
                        <form action="{{ route('posts.update', ['post' => $post->slug]) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Наименование</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" id="title" placeholder="Имя публикации"
                                           value="{{ $post->title }}">
                                </div>
                                <div class="form-group">
                                    <div class="miniature">
                                        <img src="{{ $post->getImage() }}" alt="img {{ $post->getImage() }}">
                                        @if($post->thumbnail)
                                            <a href="{{ route('img-post-del', ['slug' => $post->slug]) }}">
                                                <i class="fa-solid fa-trash-can fa-lg ico-shadow-del"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="thumbnail">Изображение (необязательно)</label>
                                        <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Краткое описание</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="2">{{ $post->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Основной контент</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5">{{ $post->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Выбор категории</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" aria-label="Default select example"
                                            id="category_id">
                                        <option disabled selected>Категория</option>
                                        @foreach($categories as $id => $title)
                                            <option value="{{ $id }}" @if($id === $post->category_id) selected @endif>
                                                {{ $title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Теги</label>
                                    <select class="select2 @error('tags') is-invalid @enderror" name="tags[]" id="tags" multiple="multiple" data-placeholder="Выбор тегов" style="width: 100%;">
                                        @foreach($tags as $id => $title)
                                            <option @if(in_array($id, $post->tags->pluck('id')->all())) selected @endif value="{{ $id }}">
                                                {{ $title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.select2').select2()
        });
    </script>
@endsection
