@extends('admin.layouts.layout')

@section('title')
    Редактирование категории
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Категории</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Категории</a></li>
                        <li class="breadcrumb-item active">Редактировать категорию</li>
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
                            <h3 class="card-title">Редактирование категории</h3>
                        </div>
                        <form action="{{ route('categories.update', ['category' => $category->slug]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Наименование</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" id="title" placeholder="Новое имя категории"
                                           value="{{ $category->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Новый slug (необязательно)</label>
                                    <input type="text" class="form-control" name="slug" id="slug" value="{{ $category->slug }}"
                                           placeholder="Если не указано, значение генерируется автоматически">
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
