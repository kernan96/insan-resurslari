@extends('layouts.index')
@section('css')
    <style>
        .card-box {
            background-color: #004a99;
            color: white;
            border-radius: 25px;
            text-align: center;
            padding: 50px 20px;
            min-width: 220px;
            transition: 0.3s;
        }
        .card-box:hover {
            background-color: #003b7a;
            transform: translateY(-5px);
        }
        .btn-kechid {
            background-color: white;
            color: #c2185b;
            font-weight: 700;
            letter-spacing: 1px;
            border: none;
            padding: 6px 16px;
            border-radius: 3px;
            font-size: 0.9rem;
        }
        .btn-kechid:hover {
            background-color: #f2f2f2;
            color: #a01548;
        }
    </style>
    <style>
        .card-soft {
            border: 1px solid rgba(0, 0, 0, .06);
            box-shadow: 0 6px 18px rgba(16, 24, 40, .06);
            border-radius: 14px;
        }
        .badge-soft {
            font-weight: 600;
            border-radius: 999px;
            padding: .45rem .6rem;
        }
        .badge-soft-secondary {
            background: rgba(108, 117, 125, .12);
            color: #6c757d;
        }
        .badge-soft-warning {
            background: rgba(255, 193, 7, .18);
            color: #8a6d00;
        }
        .badge-soft-success {
            background: rgba(25, 135, 84, .16);
            color: #146c43;
        }
        .badge-soft-info {
            background: rgba(13, 202, 240, .18);
            color: #055160;
        }
        .badge-soft-primary {
            background: rgba(13, 110, 253, .16);
            color: #0a58ca;
        }
        .badge-soft-danger {
            background: rgba(220, 53, 69, .16);
            color: #b02a37;
        }
        .badge-soft-dark {
            background: rgba(33, 37, 41, .12);
            color: #212529;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="container-fluid my-3">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
                <div>
                    <h4 class="mb-0">Təlim planlaşdırılması</h4>
                    <div class="text-muted small">Təlimlərin planlanması, icrası və nəticələrin izlənməsi</div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center" id="btnfilteronoff"
                        type="button">
                        <i class="bi bi-funnel me-1"></i>
                        Filter
                    </button>
                    <button class="btn btn-primary btn-sm d-flex align-items-center" type="button" data-bs-toggle="modal"
                        data-bs-target="#planModal">
                        <i class="bi bi-calendar-plus me-1"></i> Plan əlavə et
                    </button>
                </div>
            </div>
            <!-- Filters -->
            <div class="collapse mb-3" id="planFilters">
                <div class="card card-soft">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label">Qurum</label>
                                <select class="form-select form-select-sm" id="pfOrg">
                                    <option value="">Hamısı</option>
                                    <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                    <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Təlim növü</label>
                                <select class="form-select form-select-sm" id="pfType">
                                    <option value="">Hamısı</option>
                                    <option value="Daxili">Daxili</option>
                                    <option value="Xarici">Xarici</option>
                                    <option value="Onlayn">Onlayn</option>
                                    <option value="Mentorluq">Mentorluq</option>
                                    <option value="İş yerində">İş yerində</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select form-select-sm" id="pfStatus">
                                    <option value="">Hamısı</option>
                                    <option value="Planlandı">Planlandı</option>
                                    <option value="Davam edir">Davam edir</option>
                                    <option value="Tamamlandı">Tamamlandı</option>
                                    <option value="Ləğv edildi">Ləğv edildi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Tarix aralığı</label>
                                <div class="d-flex gap-2">
                                    <input type="date" class="form-control form-control-sm" id="pfFrom">
                                    <input type="date" class="form-control form-control-sm" id="pfTo">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Axtarış</label>
                                <input type="text" class="form-control form-control-sm" id="pfSearch"
                                    placeholder="Təlim adı, mövzu, təlimçi, qeyd...">
                            </div>
                            <div class="col-12 col-md-6 d-flex gap-2 align-items-end justify-content-end">
                                <button class="btn btn-outline-secondary btn-sm" id="btnResetPlanFilters" type="button">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Sıfırla
                                </button>
                                <button class="btn btn-success btn-sm" id="btnApplyPlanFilters" type="button">
                                    <i class="bi bi-check2-circle me-1"></i> Tətbiq et
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="card card-soft">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="planTable" class="table table-sm align-middle table-hover w-100 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Qurum</th>
                                    <th class="text-center">Şöbə</th>
                                    <th class="text-center">Əməkdaş</th>
                                    <th class="text-center">Təlim adı</th>
                                    <th class="text-center">Növ</th>
                                    <th class="text-center">Tarix</th>
                                    <th class="text-center">İcraçı</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Gözlənilən nəticə</th>
                                    <th class="text-center">Büdcə</th>
                                    <th class="text-center">Sənəd</th>
                                    <th class="text-center">Qeyd</th>
                                    <th class="text-end">Əməliyyat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</td>
                                    <td>Rəqəmsallaşma şöbəsi</td>
                                    <td>Abbasov Əli Həsən</td>
                                    <td>Rəqəmsal İnnovasiya</td>
                                    <td><span class="badge badge-soft badge-soft-info">Daxili</span></td>
                                    <td>2025-12-29<br>2025-12-30</td>
                                    <td>İT şöbəsi (12 nəfər)</td>
                                    <td><span class="badge badge-soft badge-soft-secondary">Planlandı</span></td>
                                    <td>Rəqəmsal İnnovasiya haqqında marifləndirmə</td>
                                    <td>1000</td>
                                    <td><i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i></td>
                                    <td>Yoxdur</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary btn-sm ms-1" type="button"
                                            data-bs-toggle="modal" data-bs-target="#editModal"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-sm ms-1 btnDelete"><i
                                                class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD / EDIT Modal -->
        <div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="planModalLabel">Təlim planı əlavə et</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="planForm" class="row g-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Qurum / Şöbə / Əməkdaş</h6>
                                <button type="button" id="btnAddPersonRow" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                </button>
                            </div>
                            <div id="personRows" class="vstack gap-3">
                                <div class="row g-3 person-row align-items-end">
                                    <div class="col-12 col-md-3">
                                        <label class="form-label">Qurum</label>
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                            <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-label">Şöbə</label>
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Rəqəmsallaşma şöbəsi</option>
                                            <option>Maliyyə şöbəsi</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="form-label">Əməkdaş</label>
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Abbasov Əli Həsən</option>
                                            <option>Süleymanova Günel Alməmməd</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-1 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm btnRemoveRow"
                                            style="display: none;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Təlim adı</label>
                                <input type="text" class="form-control" name="title"
                                    placeholder="Məs: Kibertəhlükəsizlik (praktiki)" required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Təlim növü</label>
                                <select class="form-select" name="type" required>
                                    <option value="" selected disabled>Seçin...</option>
                                    <option value="Daxili">Daxili</option>
                                    <option value="Xarici">Xarici</option>
                                    <option value="Onlayn">Onlayn</option>
                                    <option value="Mentorluq">Mentorluq</option>
                                    <option value="İş yerində">İş yerində</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Başlama tarixi</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Bitmə tarixi</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İcraçı / Təlimçi</label>
                                <input type="text" class="form-control" name="trainer"
                                    placeholder="Məs: Daxili təlimçi / Şirkət adı">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="Planlandı" selected>Planlandı</option>
                                    <option value="Davam edir">Davam edir</option>
                                    <option value="Tamamlandı">Tamamlandı</option>
                                    <option value="Ləğv edildi">Ləğv edildi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Gözlənilən nəticə</label>
                                <textarea class="form-control" name="expected" rows="2"
                                    placeholder="Məs: sistemdən istifadə bacarıqlarının artırılması, praktiki bilik..."></textarea>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Büdcə (AZN)</label>
                                <input type="number" min="0" class="form-control" name="budget"
                                    placeholder="0">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Sənəd (istəyə bağlı)</label>
                                <input type="file" class="form-control" name="doc"
                                    accept=".pdf,.doc,.docx,.jpg,.png">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Qeyd</label>
                                <textarea class="form-control" name="note" rows="3"
                                    placeholder="Əlavə qeydlər, təşkili detallar, əlaqə şəxsi və s."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="planForm" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Yadda saxla
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="editModalLabel">Təlim planı redaktə et</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" class="row g-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Qurum / Şöbə / Əməkdaş</h6>
                                <button type="button" id="btnAddPersonRow" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                </button>
                            </div>
                            <div id="personRows" class="vstack gap-3">
                                <div class="row g-3 person-row align-items-end">
                                    <div class="col-12 col-md-3">
                                        <label class="form-label">Qurum</label>
                                        <select class="form-select">
                                            <option selected disabled>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                            <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                            <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-label">Şöbə</label>
                                        <select class="form-select">
                                            <option selected disabled>Rəqəmsallaşma şöbəsi</option>
                                            <option>Rəqəmsallaşma şöbəsi</option>
                                            <option>Maliyyə şöbəsi</option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-12 col-md-3">
                                          <label class="form-label">Vəzifə</label>
                                          <select class="form-select">
                                            <option selected disabled>Aparıcı məsləhətçi</option>
                                            <option>Aparıcı məsləhətçi</option>
                                            <option>Baş məsləhətçi</option>
                                          </select>
                                        </div> -->
                                    <div class="col-12 col-md-2">
                                        <label class="form-label">Əməkdaş</label>
                                        <select class="form-select">
                                            <option selected disabled>Abbasov Əli Həsən</option>
                                            <option>Abbasov Əli Həsən</option>
                                            <option>Süleymanova Günel Alməmməd</option>
                                        </select>
                                    </div>
                                    <!-- SİLMƏ -->
                                    <div class="col-12 col-md-1 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm btnRemoveRow"
                                            style="display: none;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Təlim adı</label>
                                <input type="text" class="form-control" name="title"
                                    placeholder="Məs: Kibertəhlükəsizlik (praktiki)" value="Rəqəmsal İnnovasiya" required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Təlim növü</label>
                                <select class="form-select" name="type" required>
                                    <option value="" selected disabled>Daxili</option>
                                    <option value="Daxili">Daxili</option>
                                    <option value="Xarici">Xarici</option>
                                    <option value="Onlayn">Onlayn</option>
                                    <option value="Mentorluq">Mentorluq</option>
                                    <option value="İş yerində">İş yerində</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Başlama tarixi</label>
                                <input type="date" class="form-control" name="start_date" value="2025-12-29"
                                    required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Bitmə tarixi</label>
                                <input type="date" class="form-control" name="end_date" value="2025-12-30" required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İcraçı / Təlimçi</label>
                                <input type="text" class="form-control" name="trainer"
                                    placeholder="Məs: Daxili təlimçi / Şirkət adı" value="Kənan Qurbanlı">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="Planlandı" selected>Planlandı</option>
                                    <option value="Davam edir">Davam edir</option>
                                    <option value="Tamamlandı">Tamamlandı</option>
                                    <option value="Ləğv edildi">Ləğv edildi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Gözlənilən nəticə</label>
                                <textarea class="form-control" name="expected" rows="2"
                                    placeholder="Məs: sistemdən istifadə bacarıqlarının artırılması, praktiki bilik...">Rəqəmsal İnnovasiya haqqında marifləndirmə</textarea>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Büdcə (AZN)</label>
                                <input type="number" min="0" class="form-control" name="budget"
                                    placeholder="1000">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Sənəd (istəyə bağlı)</label>
                                <input type="file" class="form-control" name="doc"
                                    accept=".pdf,.doc,.docx,.jpg,.png">
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#" class="text-decoration-none me-2">sened.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Qeyd</label>
                                <textarea class="form-control" name="note" rows="3"
                                    placeholder="Əlavə qeydlər, təşkili detallar, əlaqə şəxsi və s."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="planForm" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Yadda saxla
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End #main -->
    <!-- ======= Footer ======= -->
    <!-- <footer class="footer" id="footer">
                                    <div class="copyright">
                                          © Copyright <strong><span>RİNN</span></strong>. All Rights Reserved
                                        </div>
                                    <div class="credits">
                                          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                                    </div>
                                    </footer> -->
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
    <script>
        function typeBadge(t) {
            if (t === "Daxili") return '<span class="badge badge-soft badge-soft-info">Daxili</span>';
            if (t === "Xarici") return '<span class="badge badge-soft badge-soft-warning">Xarici</span>';
            if (t === "Onlayn") return '<span class="badge badge-soft badge-soft-primary">Onlayn</span>';
            if (t === "Mentorluq") return '<span class="badge badge-soft badge-soft-success">Mentorluq</span>';
            return '<span class="badge badge-soft badge-soft-secondary">İş yerində</span>';
        }
        function planStatusBadge(s) {
            const map = {
                "Planlandı": "secondary",
                "Davam edir": "info",
                "Tamamlandı": "success",
                "Ləğv edildi": "danger"
            };
            const c = map[s] || "secondary";
            return `<span class="badge badge-soft badge-soft-${c}">${s}</span>`;
        }
        const pdt = $('#planTable').DataTable({
            pageLength: 10,
            lengthChange: false,
            order: [
                [0, 'desc']
            ],
            language: {
                search: "Axtarış:",
                paginate: {
                    next: "Növbəti",
                    previous: "Əvvəlki"
                },
                info: "_TOTAL_ qeyddən _START_-_END_ arası göstərilir",
                infoEmpty: "Göstəriləcək məlumat yoxdur",
                zeroRecords: "Uyğun nəticə tapılmadı"
            }
        });
        const planFilters = document.getElementById('planFilters');
        const filterBtn = document.getElementById('btnfilteronoff');
        const filterCollapse = new bootstrap.Collapse(planFilters, {
            toggle: false
        });
        filterBtn.addEventListener('click', () => {
            if (planFilters.classList.contains('show')) {
                filterCollapse.hide();
            } else {
                filterCollapse.show();
            }
        });
        function applyPlanFilters() {
            const org = $('#pfOrg').val();
            const type = $('#pfType').val();
            const status = $('#pfStatus').val();
            const text = $('#pfSearch').val();
            pdt.column(1).search(org || '', true, false);
            pdt.column(3).search(type || '', true, false);
            pdt.column(6).search(status || '', true, false);
            pdt.search(text || '');
            pdt.draw();
        }
        $('#btnApplyPlanFilters').on('click', function() {
            applyPlanFilters();
            filterCollapse.hide();
        });
        $('#btnResetPlanFilters').on('click', function() {
            $('#pfOrg, #pfType, #pfStatus').val('');
            $('#pfFrom, #pfTo, #pfSearch').val('');
            pdt.search('').columns().search('').draw();
            filterCollapse.hide();
        });
        document.getElementById('planForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            const org = fd.get('org');
            const title = fd.get('title');
            const type = fd.get('type');
            const start = fd.get('start_date');
            const end = fd.get('end_date');
            const status = fd.get('status');
            const participants = fd.get('participants') || '-';
            const rowId = pdt.data().count() + 1;
            pdt.row.add([
                rowId,
                org,
                title,
                typeBadge(type),
                participants,
                `${start} → ${end}`,
                planStatusBadge(status),
                `<div class="text-end">
         <button type="button" class="btn btn-outline-primary btn-sm ms-1"><i class="bi bi-pencil-square"
                    type="button" data-bs-toggle="modal" data-bs-target="#editModal"></i></button>
         <button type="button" class="btn btn-outline-danger btn-sm ms-1 btnDelete"><i class="bi bi-trash"></i></button>
       </div>`
            ]).draw(false);
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById('planModal')).hide();
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        });
    </script>
    <script>
        const personRows = document.getElementById('personRows');
        const btnAddPersonRow = document.getElementById('btnAddPersonRow');
        btnAddPersonRow.addEventListener('click', () => {
            const firstRow = personRows.querySelector('.person-row');
            const clone = firstRow.cloneNode(true);
            clone.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
            personRows.appendChild(clone);
            toggleRemoveButtons();
        });
        personRows.addEventListener('click', (e) => {
            if (e.target.closest('.btnRemoveRow')) {
                const rows = personRows.querySelectorAll('.person-row');
                if (rows.length > 1) {
                    e.target.closest('.person-row').remove();
                    toggleRemoveButtons();
                }
            }
        });
    </script>
    <script>
        function toggleRemoveButtons() {
            const rows = personRows.querySelectorAll('.person-row');
            rows.forEach(row => {
                const btn = row.querySelector('.btnRemoveRow');
                btn.style.display = rows.length > 1 ? 'inline-block' : 'none';
            });
        }
    </script>
    <script>
        document.querySelectorAll(".btnDelete").forEach((btn) => {
            btn.addEventListener("click", function() {
                Swal.fire({
                    title: "Əminsiniz?",
                    text: "Bu məlumat silinəcək!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Bəli, sil",
                    cancelButtonText: "Ləğv et",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Silindi!", "Məlumat uğurla silindi.", "success");
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.body.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-close')) {
                    const chip = e.target.closest('.d-inline-flex');
                    if (chip) chip.remove();
                }
            });
        });
    </script>
@endsection
