@extends('admin.layouts.layout')

@section('title')
    Настройки профиля
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Профиль</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Настройки профиля</li>
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
                            <h3 class="card-title">Настройки профиля</h3>
                        </div>
                        <form action="{{ route('user.update', ['id' => auth()->user()->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="name" placeholder="Имя"
                                           value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <div class="miniature">
                                        <img src="{{ $user->getImage() }}" alt="img">
                                        @if($user->avatar)
                                            <a>
                                                <i class="fa-solid fa-trash-can fa-lg ico-shadow-del"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="avatar">Аватар</label>
                                        <input type="file"
                                               class="custom-file-input @error('avatar') is-invalid @enderror"
                                               name="avatar" id="avatar">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email"
                                           value="{{ $user->email }}" @error('email') is-invalid @endif>
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
