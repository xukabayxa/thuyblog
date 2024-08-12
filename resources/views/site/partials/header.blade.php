<div class="navbar navbar-default navbar-fixed-top sticky-navigation" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="{{ route('front.home_page') }}" class="navbar-brand">{{ $config->short_name_company  }}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right main-navigation">
                <li><a href="{{ route('front.home_page') }}#home" class="smoothScroll">Trang chủ</a></li>
                <li><a href="{{ route('front.home_page') }}#overview" class="smoothScroll">Về tôi</a></li>
                <li><a href="{{ route('front.blog') }}" class="smoothScroll">Blog</a></li>
            </ul>
        </div>

    </div>
</div>
