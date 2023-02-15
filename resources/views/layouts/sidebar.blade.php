<div class="col-lg-4">
    <!-- Social Follow Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Мы в соцсетях</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">
            <a href="https://t.me/i76700" class="d-block w-100 text-white text-decoration-none mb-3"
               style="background: #0088cc;">
                <i class="fab fa-telegram-plane text-center py-4 mr-3"
                   style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">Написать</span>
            </a>
            <a href="https://vk.com/kovdmit" class="d-block w-100 text-white text-decoration-none mb-3"
               style="background: #4C75A3">
                <i class="fab fa-vk text-center py-4 mr-3"
                   style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">Подписаться</span>
            </a>
            <a href="https://twitter.com/kovdmit"
               class="d-block w-100 text-white text-decoration-none mb-3"
               style="background: #52AAF4;">
                <i class="fab fa-twitter text-center py-4 mr-3"
                   style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">Подписаться</span>
            </a>
            <a href="https://www.facebook.com/kovdmit"
               class="d-block w-100 text-white text-decoration-none mb-3"
               style="background: #39569E;">
                <i class="fab fa-facebook-f text-center py-4 mr-3"
                   style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">Подписаться</span>
            </a>
            <a href="https://www.linkedin.com/in/kovdmit/"
               class="d-block w-100 text-white text-decoration-none mb-3"
               style="background: #0185AE;">
                <i class="fab fa-linkedin-in text-center py-4 mr-3"
                   style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">Подписаться</span>
            </a>
            <a href="https://instagram.com/kovdmit/"
               class="d-block w-100 text-white text-decoration-none mb-3"
               style="background: #C8359D;">
                <i class="fab fa-instagram text-center py-4 mr-3"
                   style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">Подписаться</span>
            </a>
            <a href="https://www.youtube.com/@user-uo2yh9ij4w/"
               class="d-block w-100 text-white text-decoration-none mb-3"
               style="background: #DC472E;">
                <i class="fab fa-youtube text-center py-4 mr-3"
                   style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">Подписаться</span>
            </a>
        </div>
    </div>
    <!-- Social Follow End -->

    <!-- Ads Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Реклама</h4>
        </div>
        <div class="bg-white text-center border border-top-0 p-3">
            <a href="">
                <img class="img-fluid" src="{{ asset('assets/front/img/news-800x500-2.jpg') }}" alt="ad">
            </a>
        </div>
    </div>
    <!-- Ads End -->

    <!-- Popular News Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Популярные новости</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">

            @foreach($popular_news as $post)
                <div class="d-flex align-items-center bg-white mb-3 border" style="height: 110px;">
                    <img class="img-fluid small-news" src="{{ $post->getImage() }}" alt="">
                    <div
                        class="w-100 h-100 px-3 d-flex flex-column justify-content-center">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2"
                               href="{{ route('category.show', ['slug' => $post->category->slug]) }}">
                                {{ $post->category->title }}
                            </a>
                            <a class="text-body" href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                <small>
                                    {{ \Carbon\Carbon::parse($post->created_at)->locale('ru')->isoFormat('D MM YYYY') }}
                                </small>
                            </a>
                        </div>
                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold"
                           href="{{ route('post.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Popular News End -->

    <!-- Newsletter Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Подписка</h4>
        </div>
        <div class="bg-white text-center border border-top-0 p-3">
            <p>Получайте уведомления о свежих новостях на свою электронную почту.</p>
            <form>
                <div class="input-group mb-2" style="width: 100%;">
                    <input type="email" class="form-control form-control-lg" placeholder="Введите Email">
                    <div class="input-group-append">
                        <button class="btn btn-primary font-weight-bold px-3">Подписаться</button>
                    </div>
                </div>
            </form>
            <small>Подписку можно отменить в любое время.</small>
        </div>
    </div>
    <!-- Newsletter End -->


    <!-- Tags Start -->
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Теги</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">
            <div class="d-flex flex-wrap m-n1">

                @foreach($tags as $slug => $title)
                    <a class="btn btn-sm btn-outline-secondary m-1"
                       href="{{ route('tag.show', ['slug' => $slug]) }}">{{ $title }}</a>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Tags End -->

</div>
