@extends('layouts.layout')

@section('title')
    <title>Обратная связь - FreshNews</title>
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
@endsection

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">Письмо успешно отправлено.</h4>
                    </div>
                </div>
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
