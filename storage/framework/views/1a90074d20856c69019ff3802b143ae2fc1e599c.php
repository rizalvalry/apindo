<header id="header">

    <div class="navbar-upper">
        <div class="container">
            <div class="navbar-upper__wrapper">
                <div class="navbar-upper__logo">
                    <a href="<?php echo e(route('home')); ?>" class="navbar-upper__image-container">
                        <img src="<?php echo e(asset('assets/admin/images/apindo-logo.png')); ?>"
                            class="navbar-upper__image" alt="<?php echo e(config('basic.site_title')); ?>">
                    </a>
                    <span class="navbar-upper__company-name">Asosiasi<br>Pengusaha<br>Indonesia<br></span>
                    <span class="navbar-upper__quote">YOUR BUSINESS PARTNER IN INDONESIA</span>
                </div>
                <div class="navbar-upper__upper-right">
                    <form action="https://apindo.or.id/search-result" class="input-group navbar-upper__form">
                        <input name="searchresult" value="" type="text" class="form-control navbar-upper__form-input"
                            placeholder="Cari event, kegiatan, dan info lainnya"
                            aria-label="Cari event, kegiatan, dan info lainnya" aria-describedby="button-search">
                        <button class="navbar-upper__form-button" type="submit" id="button-search">
                            <img src="<?php echo e(asset('assets/admin/images/search-icon.svg')); ?>" alt="search icon">
                        </button>
                    </form>
                    <div class="dropdown d-inline-flex">

                        <div class="d-flex align-items-center">
                            <a class="dropdown-toggle navbar-upper__button-language" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo e(asset('assets/admin/images/id.png')); ?>" class="navbar-upper__language-icon"
                                    alt="language icon">
                                <span>ID</span>
                            </a>
                            <ul class="dropdown-menu navbar-upper__dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item navbar-upper__dropdown-link" href="en.html">
                                        <img src="images/en.png" class="navbar-upper__language-icon"
                                            alt="language icon">
                                        <span>EN</span>
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <nav class="navbar navbar-expand-lg bsnav" id="navbar">
        <div class="container-fluid">
            <button type="button" class="navbar__button-search-mobile">
                <img src="<?php echo e(asset('assets/admin/images/search-icon.svg')); ?>"
                    class="navbar-upper__language-icon navbar__button navbar__icon-search-mobile" alt="search icon">
                <span>SEARCH</span>
            </button>
            <div class="navbar__toggler-wrapper">
                <span class="navbar__toggler-text">MENU</span>
                <button class="navbar-toggler toggler-spring navbar__toggler"><span
                        class="navbar-toggler-icon"></span></button>
            </div>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav navbar-mobile">
                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link"><span>Apindo</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="navbar-nav navbar__nav-second">
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/apindo/history">Sejarah</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/apindo/vision-mission">Visi & Misi</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/apindo/organization-structure">Struktur Organisasi</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/apindo/business-unit">Unit Bisnis</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link"><span>Keanggotaan</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="navbar-nav navbar__nav-second">
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/membership/alb-register">Pendaftaran ALB</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown has-notif ">
                        <a class="nav-link navbar__link memberRoomMenu"><span>Ruang Anggota</span> <i
                                class="fa fa-angle-down"></i></a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link"><span>Apindo Daerah</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="navbar-nav navbar__nav-second">
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/apindo-region/news">Berita Daerah</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/apindo-region/contacts">Kontak APINDO Daerah</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link"><span>Media</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="navbar-nav navbar__nav-second">
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/media/press-conferences">Konferensi Pers</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/media/news">Berita</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link"><span>Regulasi</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="navbar-nav navbar__nav-second">
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/regulation/employment">Ketenagakerjaan</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/regulation/trading">Perdagangan</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/regulation/industry">Industri</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/regulation/covid-19">COVID-19</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link"><span>Publikasi &amp; Referensi</span> <i
                                class="fa fa-angle-down"></i></a>
                        <ul class="navbar-nav navbar__nav-second">
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/publication-reference/annual-reports">Laporan Tahunan</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/publication-reference/study-and-researches">Kajian &amp; Penelitian</a>
                            </li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/publication-reference/e-news-letters">Buletin Elektronik</a></li>
                        </ul>
                    </li>
                    <li class="nav-item "><a class="nav-link navbar__link" href="https://apindo.or.id/stunting">Stunting</a></li>

                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link"><span>UMKM</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="navbar-nav navbar__nav-second">
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link" href="https://apindo.or.id/umkm/dpn">UMKM DPN
                                    Apindo</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://aua.topkarir.com/">Portal AUA</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/umkm/dpp-dpk-activities">Kegiatan UMKM DPN/DPP/DPK&nbsp;</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/umkm/publications">Publikasi UMKM</a></li>
                            <li class="nav-item"><a class="nav-link navbar__dropdown-link"
                                    href="https://apindo.or.id/umkm/resources">Artikel UMKM</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown ">
                        <a class="nav-link navbar__link" href="<?php echo e(route('home')); ?>"><span>Daftar Anggota</span> <i
                                class="fa fa-angle-down"></i></a>
                    </li>

                    <li class="nav-item " id="contactMainMenu"><a class="nav-link navbar__link"
                            href="contact.html">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="offcanvas offcanvas-start offcanvas__category" data-bs-scroll="true" tabindex="-1"
        id="offcanvasCategoryNav" aria-labelledby="offcanvasCategoryNavLabel">
        <div class="offcanvas-body"></div>
    </div>



    <div class="offcanvas offcanvas-start offcanvas__filter" data-bs-scroll="true" tabindex="-1" id="offcanvasFilter"
        aria-labelledby="offcanvasFilterLabel">
        <div class="offcanvas-header">
            <span class="theme-filter__text-wrapper">
                <img src="images/filter-icon.svg" class="theme-filter__icon" alt="filter icon">
            </span>
            <span class="offcanvas__header-title">Filter</span>
        </div>
        <div class="offcanvas-body"></div>
    </div>

</header><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/partials/header.blade.php ENDPATH**/ ?>