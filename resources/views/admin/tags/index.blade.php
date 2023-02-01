@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Теги</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Теги</li>
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
                <h3 class="card-title">Список тегов</h3>

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

                @if($tags->isEmpty())
                    Тегов нет
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
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    <a href="{{ route('tags.edit', ['tag' => $tag->slug]) }}"
                                       class="ico-shadow-edit">
                                        <i class="fa-solid fa-pen-to-square fa-lg pr-2 ico-shadow-edit"></i>
                                    </a>
                                    <form class="d-inline"
                                          action="{{ route('tags.destroy', ['tag' => $tag->slug]) }}"
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
                        <a class="btn btn-primary btn-sm" href="{{ route('tags.create') }}" role="button">Новый
                            тег</a>
                    </div>

                    @if($tags->hasPages())
                        <div class="col">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item @if($tags->onFirstPage()) disabled @endif">
                                        <a class="page-link" href="{{ $tags->previousPageUrl() }}">Назад</a>
                                    </li>
                                    @for($i = 1; $i <= $tags->lastPage(); $i++)
                                        @if($i === 1 || abs($i - $tags->currentPage()) < 3 || $i === $tags->lastPage())
                                            <li class="page-item {{ ($tags->currentPage() == $i) ? ' active' : '' }}">
                                                <a class="page-link" href="{{ $tags->url($i)}} ">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endif

                                    @endfor
                                    <li class="page-item @if(!$tags->hasMorePages()) disabled @endif">
                                        <a class="page-link" href="{{ $tags->nextPageUrl() }}">Вперед</a>
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
