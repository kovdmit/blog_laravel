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
                        <h4 class="m-0 text-uppercase font-weight-bold">Обратная связь</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4 mb-3">
                        <div class="mb-4">
                            <h6 class="text-uppercase font-weight-bold">Связь с автором сайта</h6>
                            <p class="mb-4">Уважаемые посетители ресурса, если вы хотите связаться с автором сайта, вы можете написать в любой социальной сети из бокового меню каждой страницы, либо заполнить форму ниже.</p>
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fa fa-envelope-open text-primary mr-2"></i>
                                    <h6 class="font-weight-bold mb-0">Контакты</h6>
                                </div>
                                <p class="m-0">pzhabbiu@gmail.com</p>
                                <p class="m-0">https://t.me/i76700</p>
                            </div>
                        </div>
                        <h6 class="text-uppercase font-weight-bold mb-3">Контактная форма</h6>
                        <form action="{{ route('sendmail') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control p-4" placeholder="ФИО"
                                               required="required"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control p-4" placeholder="Email"
                                               required="required"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control p-4" placeholder="Тема" required="required"/>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="4" placeholder="Сообщение"
                                          required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;">
                                    Отправить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @include('layouts.sidebar')
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
