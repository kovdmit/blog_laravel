<!-- Footer Start -->
<div class="container-fluid bg-dark pt-5 px-sm-3 px-md-5 mt-5">
    <div class="row py-4">
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Контакты</h5>
            <p class="font-weight-medium"><i class="fa fa-envelope mr-2"></i>pzhabbiu@gmail.com</p>
            <h6 class="mt-4 mb-3 text-white text-uppercase font-weight-bold">Подписаться</h6>
            <div class="d-flex justify-content-start">
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="https://t.me/i76700"><i class="fab fa-telegram-plane"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="https://www.facebook.com/kovdmit"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="https://www.linkedin.com/in/kovdmit/"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href="https://www.instagram.com/kovdmit/"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square" href="https://vk.com/kovdmit"><i class="fab fa-vk"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Популярные новости</h5>
            <div class="mb-3">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">Business</a>
                    <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                </div>
                <a class="small text-body text-uppercase font-weight-medium" href="">Lorem ipsum dolor sit amet elit. Proin vitae porta diam...</a>
            </div>
            <div class="mb-3">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">Business</a>
                    <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                </div>
                <a class="small text-body text-uppercase font-weight-medium" href="">Lorem ipsum dolor sit amet elit. Proin vitae porta diam...</a>
            </div>
            <div class="">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="">Business</a>
                    <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                </div>
                <a class="small text-body text-uppercase font-weight-medium" href="">Lorem ipsum dolor sit amet elit. Proin vitae porta diam...</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Категории</h5>
            <div class="m-n1">

                @foreach($categories as $slug => $title)
                    <a href="{{ route('category.show', ['slug' => $slug]) }}" class="btn btn-sm btn-secondary m-1">{{ $title }}</a>
                @endforeach

            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Фотографии</h5>
            <div class="row">
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="img/news-110x110-1.jpg" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="img/news-110x110-2.jpg" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="img/news-110x110-3.jpg" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="img/news-110x110-4.jpg" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="img/news-110x110-5.jpg" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="img/news-110x110-1.jpg" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5" style="background: #111111;">
    <p class="m-0 text-center">&copy; <a href="#">Your Site Name</a>. All Rights Reserved.

        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
        Design by <a href="https://htmlcodex.com">HTML Codex</a></p>
</div>
<!-- Footer End -->
