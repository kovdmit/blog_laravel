@extends('admin.layouts.layout')

@section('title')
    Молнии
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Молния</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Молнии</li>
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
                <h3 class="card-title">Список молний</h3>

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

                @if($lightnings->isEmpty())
                    Молний нет
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">№</th>
                            <th>Текст молнии</th>
                            <th style="width: 40px">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lightnings as $lightning)
                            <tr>
                                <td>{{ $lightning->id }}</td>
                                <td>{{ $lightning->content }}</td>
                                <td>
                                    <a href="{{ route('lightning.edit', ['lightning' => $lightning->id]) }}"
                                       class="ico-shadow-edit">
                                        <i class="fa-solid fa-pen-to-square fa-lg pr-2 ico-shadow-edit"></i>
                                    </a>
                                    <form class="d-inline"
                                          action="{{ route('lightning.destroy', ['lightning' => $lightning->id]) }}"
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
                        <a class="btn btn-primary btn-sm" href="{{ route('lightning.create') }}" role="button">Новая молния</a>
                    </div>

                    @if($lightnings->hasPages())
                        <div class="col">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item @if($lightnings->onFirstPage()) disabled @endif">
                                        <a class="page-link" href="{{ $lightnings->previousPageUrl() }}">Назад</a>
                                    </li>
                                    @for($i = 1; $i <= $lightnings->lastPage(); $i++)
                                        @if($i === 1 || abs($i - $lightnings->currentPage()) < 3 || $i === $lightnings->lastPage())
                                            <li class="page-item {{ ($lightnings->currentPage() == $i) ? ' active' : '' }}">
                                                <a class="page-link" href="{{ $lightnings->url($i)}} ">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endif

                                    @endfor
                                    <li class="page-item @if(!$lightnings->hasMorePages()) disabled @endif">
                                        <a class="page-link" href="{{ $lightnings->nextPageUrl() }}">Вперед</a>
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
