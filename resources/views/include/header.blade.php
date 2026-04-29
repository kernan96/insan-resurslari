    <header class="header fixed-top d-flex align-items-center" id="header">
        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center" href="{{ route('home') }}">
                <img id="logo_photo" alt="" src="{{asset('files/img/logo.png')}}" calss="h-100" />
                <img id="rinn_yazi" alt="" src="{{asset('files/img/rinn_yazi.png')}}" />
                <span class="d-none d-lg-block"></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <div class="search-bar">
            <form action="#" class="search-form d-flex align-items-center" method="POST">
                <input name="query" placeholder="Axtar" title="Enter search keyword" type="text" />
                <button title="Search" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            Sizin 4 yeni bildirişiniz var
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Hamısına
                                    bax</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-danger"></i>
                            <div>
                                <h4>Müqavilə müddəti başa çatır</h4>
                                <p>İşçinin əmək müqaviləsinin müddəti yaxın günlərdə bitir.</p>
                                <p>30 dəq əvvəl</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-info-circle text-warning"></i>
                            <div>
                                <h4>İxtisas dərəcəsinin müddəti tamamlanır</h4>
                                <p>İşçinin ixtisas dərəcəsinin qüvvədə olma vaxtı sona çatır.</p>
                                <p>1 saat əvvəl</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Əmək məzuniyyəti başlayır</h4>
                                <p>İşçi bu gündən əmək məzuniyyətinə çıxır.</p>
                                <p>2 saat əvvəl</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li class="notification-item">
                            <i class="bi bi-calendar-event text-primary"></i>
                            <div>
                                <h4>Əmək məzuniyyəti başa çatır</h4>
                                <p>İşçinin əmək məzuniyyəti bu gün sona çatır.</p>
                                <p>4 saat əvvəl</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Bütün bildirişləri göstər</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown"
                        href="#">
                        <img alt="Profile" class="rounded-circle" src="{{asset('files/img/noprofile.jpg')}}" />
                        <span class="d-none d-md-block dropdown-toggle ps-2">Əli Məmmədov</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Çıxış</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <style>
            /* Blur veriləcək əsas content */
            .blurred {
                filter: blur(5px);
                pointer-events: none;
                user-select: none;
            }
            /* Loading Overlay */
            #page-loader {
                position: fixed;
                inset: 0;
                background: rgba(255, 255, 255, 0.9);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }
        </style>
        <div id="page-loader">
            <button class="btn btn-primary" disabled="disabled" type="button">
                <span aria-hidden="true" class="spinner-border spinner-border-sm" role="status"></span>
                Yüklənir...
            </button>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // blur aktiv et
                document.getElementById("main").classList.add("blurred");
                // səhifə tam yüklənəndə aradan qaldır
                window.onload = function() {
                    document.getElementById("page-loader").style.display = "none";
                    document.getElementById("main").classList.remove("blurred");
                };
            });
        </script>
    </header>