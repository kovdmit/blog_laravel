@extends('admin.layouts.layout')

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
                        <li class="breadcrumb-item active">Категории</li>
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
                <h3 class="card-title">Список категорий</h3>

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

                @if($categories->isEmpty())
                    Категорий нет
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">№</th>
                            <th>Наименование</th>
                            <th>Slug</th>
                            <th style="width: 40px">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', ['category' => $category->slug]) }}"
                                       class="ico-shadow-edit">
                                        <i class="fa-solid fa-pen-to-square fa-lg pr-2 ico-shadow-edit"></i>
                                    </a>
                                    <form class="d-inline"
                                          action="{{ route('categories.destroy', ['category' => $category->slug]) }}"
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
                        <a class="btn btn-primary btn-sm" href="{{ route('categories.create') }}" role="button">Новая
                            категория</a>
                    </div>
                    <div class="col">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item"><a class="page-link" href="#">Назад</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Вперед</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
