<!-- FOOTER
    ================================================== -->
<hr class="nomargin nopadding"/>
<section id="footer" class="page-section">
    <footer id="footer-section" class="page-section pt-30 pb-30 center-xs">
        <div class="container">
            <div class="row multi-columns-row">
                <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
                    <div class="box-layout text-left">
                        <h4 class="font-face1 heading6 fw700 mb-20 text-left">Liên hệ</h4>
                        <div class="info info-horizontal wow slideInLeft">
                            <div class="icon icon-info">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="description">
                                    <span
                                        class="light-text">P12A16 - N03B - New Horizon City 87 Lĩnh Nam, Hoàng Mai, HN</span>
                            </div>
                        </div>
                        <div class="info info-horizontal wow slideInLeft">
                            <div class="icon icon-info">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="description">
                                <span class="light-text">096 987 20 72</span>
                            </div>
                        </div>
                        <div class="info info-horizontal wow slideInLeft">
                            <div class="icon icon-info">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </div>
                            <div class="description">
                                <span class="light-text">Thứ hai - Chủ nhật: 8h - 21h30</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-20">
                    <div class="box-layout text-left">
                        <h4 class="font-face1 heading6 fw700 mb-20  text-left">Khóa học</h4>
                        <div class="info info-horizontal wow slideInLeft">
                            <div class="icon icon-info">
                                <i class="fa fa-book" aria-hidden="true"></i>
                            </div>
                            <div class="description">
                                <a class="light-text"
                                   href="{{ (request()->route()->getName() !== 'website.home'
                                            ? route('website.home') : '') .'#courses_for_kid' }}">
                                    Khóa học cho trẻ em
                                </a>
                            </div>
                        </div>
                        <div class="info info-horizontal wow slideInLeft">
                            <div class="icon icon-info">
                                <i class="fa fa-book" aria-hidden="true"></i>
                            </div>
                            <div class="description">
                                <a class="light-text" href="{{ (request()->route()->getName() !== 'website.home'
                                            ? route('website.home') : '') .'#courses_for_adult' }}">
                                    Khóa học cho người lớn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-20"></div>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-20"></div>
            </div>
        </div>
        <!-- ACROLL TO TOP-->
        <div class="top-button"><h5>Đi lên</h5>
            <div class="line"></div>
        </div>
    </footer>
</section>
