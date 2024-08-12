
<footer>
    <div class="container">
        <div class="row">

            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s" style="text-align: center">
                <h2>About</h2>
                <p>
                    {!! $config->address_center_insurance !!}
                </p>
            </div>

            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="1s" style="text-align: center">
                <h2>Follow me</h2>
                <ul class="social-icon">
                    <li><a href="{{ $config->facebook }}" class="fa fa-facebook wow fadeIn" data-wow-delay="1s"></a></li>
                    <li><a href="{{ $config->twitter }}" class="fa fa-twitter wow fadeInUp" data-wow-delay="1.3s"></a></li>
                    <li><a href="{{ $config->youtube }}" class="fa fa-youtube wow fadeInUp" data-wow-delay="1.9s"></a></li>
                    <li><a href="{{ $config->instagram }}" class="fa fa-google-plus wow fadeIn" data-wow-delay="2s"></a></li>
                </ul>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12">
                <p class="copyright-text">Copyright &copy; 2024 {{ $config->short_name_company  }}</p>
            </div>

        </div>
    </div>
</footer>
