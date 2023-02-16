@extends('admin.layouts.layout')

@section('title')
    Пользователи
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Управление пользователями</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                        <li class="breadcrumb-item active">Пользователи</li>
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
                <h3 class="card-title">Список пользователей</h3>

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

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">id</th>
                        <th>Имя</th>
                        <th>Аватар</th>
                        <th>Email</th>
                        <th style="width: 40px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td class="text-center"><img style="max-width: 110px;" src="{{ $user->getImage() }}" alt="avatar"></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                   class="ico-shadow-edit">
                                    <i class="fa-solid fa-pen-to-square fa-lg pr-2 ico-shadow-edit"></i>
                                </a>
                                <form class="d-inline"
                                      action="{{ route('users.destroy', ['user' => $user->id]) }}"
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


            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">

                    @if($users->hasPages())
                        <div class="col">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item @if($users->onFirstPage()) disabled @endif">
                                        <a class="page-link" href="{{ $users->previousPageUrl() }}">Назад</a>
                                    </li>
                                    @for($i = 1; $i <= $users->lastPage(); $i++)
                                        @if($i === 1 || abs($i - $users->currentPage()) < 3 || $i === $users->lastPage())
                                            <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                                <a class="page-link" href="{{ $users->url($i)}} ">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endif

                                    @endfor
                                    <li class="page-item @if(!$users->hasMorePages()) disabled @endif">
                                        <a class="page-link" href="{{ $users->nextPageUrl() }}">Вперед</a>
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
