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
        .dt-buttons {
            display: none;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="container-fluid my-3">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
                <div>
                    <h4 class="mb-0">Təlim ehtiyacları</h4>
                    <div class="text-muted small">Əməkdaşların təlim ehtiyaclarının qeydiyyatı və izlənməsi</div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center" id="btnNeedFilters"
                        type="button">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                    <button class="btn btn-primary btn-sm d-flex align-items-center" type="button" data-bs-toggle="modal"
                        data-bs-target="#needModal">
                        <i class="bi bi-plus-circle me-1"></i> Əlavə et
                    </button>
                </div>
            </div>
            <!-- Filters -->
            <div class="collapse mb-3" id="needFilters">
                <div class="card card-soft">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label">Qurum</label>
                                <select class="form-select form-select-sm" id="fOrg">
                                    <option value="">Hamısı</option>
                                    <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                    <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Şöbə</label>
                                <select class="form-select form-select-sm" id="fDept">
                                    <option value="">Hamısı</option>
                                    <option>HR</option>
                                    <option>İT</option>
                                    <option>Telekom</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select form-select-sm" id="fStatus">
                                    <option value="">Hamısı</option>
                                    <option value="Yaradıldı">Yaradıldı</option>
                                    <option value="Təsdiqləndi">Təsdiqləndi</option>
                                    <option value="Plana salındı">Plana salındı</option>
                                    <option value="Təlim keçirildi">Təlim keçirildi</option>
                                    <option value="Qiymətləndirildi">Qiymətləndirildi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Prioritet</label>
                                <select class="form-select form-select-sm" id="fPriority">
                                    <option value="">Hamısı</option>
                                    <option value="Yüksək">Yüksək</option>
                                    <option value="Orta">Orta</option>
                                    <option value="Aşağı">Aşağı</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Axtarış</label>
                                <input type="text" class="form-control form-control-sm" id="fSearch"
                                    placeholder="Əməkdaş adı, mövzu, qeyd...">
                            </div>
                            <div class="col-12 col-md-6 d-flex gap-2 align-items-end justify-content-end">
                                <button class="btn btn-outline-secondary btn-sm" id="btnResetFilters" type="button">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Sıfırla
                                </button>
                                <button class="btn btn-success btn-sm" id="btnApplyFilters" type="button">
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
                        <table id="needsTable" class="table table-striped table-hover w-100 align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Qurum</th>
                                    <th class="text-center">Şöbə</th>
                                    <th class="text-center">Əməkdaş</th>
                                    <th class="text-center">Təlim mövzusu</th>
                                    <th class="text-center">Təlim növü</th>
                                    <th class="text-center">Ehtiyac səbəbi</th>
                                    <th class="text-center">Prioritet</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">İstinad tarixi</th>
                                    <th class="text-center">Sənəd</th>
                                    <th class="text-end">Əməliyyat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</td>
                                    <td>İT</td>
                                    <td>Süleymanova Günel</td>
                                    <td>İnformasiya təhlükəsizliyi (əsaslar)</td>
                                    <td>Daxili təlim</td>
                                    <td>Software program təminatının biliyin gücləndirilməsi</td>
                                    <td><span class="badge badge-soft badge-soft-warning">Orta</span></td>
                                    <td><span class="badge badge-soft badge-soft-secondary">Yaradıldı</span></td>
                                    <td>2025-12-29</td>
                                    <td><i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i></td>
                                    <td class="text-end">
                                        <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm ms-1 btnDelete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADD / EDIT Modal -->
        <div class="modal fade" id="needModal" tabindex="-1" aria-labelledby="needModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="needModalLabel">Təlim ehtiyacı əlavə et</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="needForm" class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label">Qurum</label>
                                <select class="form-select" name="org" required>
                                    <option value="" selected disabled>Seçin...</option>
                                    <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                    <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Şöbə</label>
                                <select class="form-select" name="dept" required>
                                    <option value="" selected disabled>Seçin...</option>
                                    <option>HR</option>
                                    <option>İT</option>
                                    <option>Telekom</option>
                                    <option>Poçt</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Əməkdaş</label>
                                <select class="form-select" name="employee" required>
                                    <option value="" selected disabled>Seçin...</option>
                                    <option>Abbasov Əli Həsən</option>
                                    <option>Süleymanova Günel</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Prioritet</label>
                                <select class="form-select" name="priority" required>
                                    <option value="" selected disabled>Seçin...</option>
                                    <option value="Yüksək">Yüksək</option>
                                    <option value="Orta">Orta</option>
                                    <option value="Aşağı">Aşağı</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Təlim mövzusu</label>
                                <input type="text" class="form-control" name="topic"
                                    placeholder="Məs: Elektron hökumət, İT təhlükəsizliyi, Data analitika..." required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Təlim növü</label>
                                <select class="form-select" name="type" required>
                                    <option value="" selected disabled>Seçin...</option>
                                    <option>Daxili təlim</option>
                                    <option>Xarici təlim</option>
                                    <option>Onlayn təlim</option>
                                    <option>Mentorluq</option>
                                    <option>İş yerində təlim</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="Yaradıldı" selected>Yaradıldı</option>
                                    <option value="Təsdiqləndi">Təsdiqləndi</option>
                                    <option value="Plana salındı">Plana salındı</option>
                                    <option value="Təlim keçirildi">Təlim keçirildi</option>
                                    <option value="Qiymətləndirildi">Qiymətləndirildi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Ehtiyacın səbəbi / təsviri</label>
                                <textarea class="form-control" name="note" rows="3"
                                    placeholder="Məs: yeni sistem tətbiqi, performans qiymətləndirməsi nəticəsi, vəzifə dəyişikliyi..."></textarea>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İstinad tarixi</label>
                                <input type="date" class="form-control" name="ref_date" value="">
                                <div class="form-text">İstəyə bağlı (məs: ehtiyacın qeyd olunduğu tarix)</div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Sənəd (istəyə bağlı)</label>
                                <input type="file" class="form-control" name="doc"
                                    accept=".pdf,.doc,.docx,.jpg,.png">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="needForm" class="btn btn-primary">
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
                        <h5 class="modal-title" id="editModalLabel">Təlim ehtiyacı redaktə et</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label">Qurum</label>
                                <select class="form-select" name="org" required>
                                    <option value="" selected disabled>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi
                                    </option>
                                    <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                    <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Şöbə</label>
                                <select class="form-select" name="dept" required>
                                    <option value="" selected disabled>İT</option>
                                    <option>HR</option>
                                    <option>İT</option>
                                    <option>Telekom</option>
                                    <option>Poçt</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Əməkdaş</label>
                                <select class="form-select" name="employee" required>
                                    <option value="" selected disabled>Süleymanova Günel</option>
                                    <option>Abbasov Əli Həsən</option>
                                    <option>Süleymanova Günel</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Prioritet</label>
                                <select class="form-select" name="priority" required>
                                    <option value="" selected disabled>Orta</option>
                                    <option value="Yüksək">Yüksək</option>
                                    <option value="Orta">Orta</option>
                                    <option value="Aşağı">Aşağı</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Təlim mövzusu</label>
                                <input type="text" class="form-control" name="topic"
                                    placeholder="Məs: Elektron hökumət, İT təhlükəsizliyi, Data analitika..."
                                    value="Software program təminatı" required>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Təlim növü</label>
                                <select class="form-select" name="type" required>
                                    <option value="" selected disabled>Daxili təlim</option>
                                    <option>Daxili təlim</option>
                                    <option>Xarici təlim</option>
                                    <option>Onlayn təlim</option>
                                    <option>Mentorluq</option>
                                    <option>İş yerində təlim</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="Yaradıldı" selected>Yaradıldı</option>
                                    <option value="Təsdiqləndi">Təsdiqləndi</option>
                                    <option value="Plana salındı">Plana salındı</option>
                                    <option value="Təlim keçirildi">Təlim keçirildi</option>
                                    <option value="Qiymətləndirildi">Qiymətləndirildi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Ehtiyacın səbəbi / təsviri</label>
                                <textarea class="form-control" name="note" rows="3"
                                    placeholder="Məs: yeni sistem tətbiqi, performans qiymətləndirməsi nəticəsi, vəzifə dəyişikliyi...">Software program təminatının biliyin gücləndirilməsi</textarea>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İstinad tarixi</label>
                                <input type="date" class="form-control" name="ref_date" value="2025-12-29">
                                <div class="form-text">İstəyə bağlı (məs: ehtiyacın qeyd olunduğu tarix)</div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Sənəd (istəyə bağlı)</label>
                                <input type="file" class="form-control" name="doc"
                                    accept=".pdf,.doc,.docx,.jpg,.png">
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#" class="text-decoration-none me-2">Shexsi_Vereqe.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="editForm" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Yadda saxla
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
    <script>
        function priorityBadge(p) {
            if (p === "Yüksək") return '<span class="badge badge-soft badge-soft-danger">Yüksək</span>';
            if (p === "Orta") return '<span class="badge badge-soft badge-soft-warning">Orta</span>';
            return '<span class="badge badge-soft badge-soft-success">Aşağı</span>';
        }
        function statusBadge(s) {
            const map = {
                "Yaradıldı": "secondary",
                "Təsdiqləndi": "primary",
                "Plana salındı": "info",
                "Təlim keçirildi": "success",
                "Qiymətləndirildi": "dark"
            };
            const c = map[s] || "secondary";
            return `<span class="badge badge-soft badge-soft-${c}">${s}</span>`;
        }
        const dt = $('#needsTable').DataTable({
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
        const needFilters = document.getElementById('needFilters');
        const btnNeedFilters = document.getElementById('btnNeedFilters');
        const needFiltersCollapse = new bootstrap.Collapse(needFilters, {
            toggle: false
        });
        btnNeedFilters.addEventListener('click', () => {
            if (needFilters.classList.contains('show')) {
                needFiltersCollapse.hide();
            } else {
                needFiltersCollapse.show();
            }
        });
        function applyFilters() {
            const org = $('#fOrg').val();
            const dept = $('#fDept').val();
            const status = $('#fStatus').val();
            const priority = $('#fPriority').val();
            const text = $('#fSearch').val();
            dt.column(1).search(org || '', true, false); // Qurum
            dt.column(2).search(dept || '', true, false); // Şöbə
            dt.column(6).search(status || '', true, false); // Status
            dt.column(5).search(priority || '', true, false); // Prioritet
            dt.search(text || '');
            dt.draw();
        }
        $('#btnApplyFilters').on('click', function() {
            applyFilters();
            needFiltersCollapse.hide();
        });
        $('#btnResetFilters').on('click', function() {
            $('#fOrg, #fDept, #fStatus, #fPriority').val('');
            $('#fSearch').val('');
            dt.search('').columns().search('').draw();
            needFiltersCollapse.hide();
        });
        document.getElementById('needForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            const org = fd.get('org');
            const dept = fd.get('dept');
            const employee = fd.get('employee');
            const topic = fd.get('topic');
            const priority = fd.get('priority');
            const status = fd.get('status');
            const refDate = fd.get('ref_date') || new Date().toISOString().slice(0, 10);
            const rowId = dt.data().count() + 1;
            dt.row.add([
                rowId,
                org,
                dept,
                employee,
                topic,
                priorityBadge(priority),
                statusBadge(status),
                refDate,
                `<div class="text-end">
         <button type="button" class="btn btn-outline-primary btn-sm">
           <i class="bi bi-pencil-square"></i>
         </button>
         <button type="button" class="btn btn-outline-danger btn-sm ms-1">
           <i class="bi bi-trash"></i>
         </button>
       </div>`
            ]).draw(false);
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById('needModal')).hide();
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@endsection
