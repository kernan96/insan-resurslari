@extends('layouts.index')
@section('css')
    <style>
        body {
            background: #f7f7fb;
        }
        .card {
            border: 0;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .06);
        }
        .dt-buttons .btn {
            margin-right: .5rem;
        }
        table.dataTable>tbody>tr>td {
            vertical-align: middle;
        }
        /* Kiçik ekranlar üçün "Digər" düymələri sətirdə sıxsığmazsa sındırmasın */
        .action-btns {
            white-space: nowrap;
        }
        thead.bg-primary th {
            background-color: #0d6efd !important;
            /* Bootstrap primary */
            color: #fff !important;
            font-weight: 600;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between bg-light text-white">
                    <h5 class="mb-0 text-dark">Müsahibə planlaması</h5>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn bg-info btn-sm d-flex align-items-center text-white" data-bs-toggle="collapse"
                            data-bs-target="#filterPanel" aria-expanded="false" aria-controls="filterPanel">
                            <i class="bi bi-funnel me-1"></i> Axtarış filteri
                        </button>
                        <button class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#kadrModal">
                            <i class="bi bi-plus-circle me-1"></i> Əlavə et
                        </button>
                    </div>
                </div>
                <div id="filterPanel" class="collapse mt-3">
                    <div class="card card-body p-3">
                        <form id="filtersForm" class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label">Namizəd</label>
                                <input type="text" class="form-control" placeholder="Ad, soyad, ata adı">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Müsahibə tarixi</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Müsahibə saatı</label>
                                <input type="time" class="form-control">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Müsahibə formatı</label>
                                <select class="form-select">
                                    <option selected disabled>Seçin...</option>
                                    <option>Online</option>
                                    <option>Yerli qurumda</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Müsahibə statusu</label>
                                <select class="form-select">
                                    <option selected disabled>Seçin...</option>
                                    <option>Planlaşdırılıb</option>
                                    <option>Təxirə salınıb</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Bildiriş statusu</label>
                                <select class="form-select">
                                    <option selected disabled>Seçin...</option>
                                    <option>Göndərildi</option>
                                    <option>Uğursuz</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table id="employeesTable" class="table table-striped table-hover w-100 align-middle text-center">
                            <thead class="table-light bg-primary text-white">
                                <tr>
                                    <th>Namizəd</th>
                                    <th>Müsahibə tarixi</th>
                                    <th>Müsahibə saatı</th>
                                    <th>Müsahibə formatı</th>
                                    <th>Müsahibə statusu</th>
                                    <th>Bildiriş statusu</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kənan Əliyev Fərhad</td>
                                    <td>03.05.2025</td>
                                    <td>15:00</td>
                                    <td>Online</td>
                                    <td>Planlaşdırılıb</td>
                                    <td>Göndərildi</td>
                                    <td class="action-btns">
                                        <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                            data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Süleymanova Günel Alməmməd</td>
                                    <td>06.04.2025</td>
                                    <td>16:00</td>
                                    <td>Yerli qurumda</td>
                                    <td>Təxirə salınıb</td>
                                    <td>Uğursuz</td>
                                    <td class="action-btns">
                                        <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                            data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Süleymanova Günel Alməmməd</td>
                                    <td>07.02.2025</td>
                                    <td>17:00</td>
                                    <td>Online</td>
                                    <td>Planlaşdırılıb</td>
                                    <td>Göndərildi</td>
                                    <td class="action-btns">
                                        <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                            data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tableActionsMobile" class="d-md-none mt-3"></div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="kadrModal" tabindex="-1" aria-labelledby="kadrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="kadrModalLabel">Müsahibə – yeni qeyd</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kadrForm" class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label">Namizəd</label>
                                <input type="text" class="form-control" placeholder="Ad, soyad, ata adı">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə tarixi</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə saatı</label>
                                <input type="time" class="form-control">
                            </div>
                            <!-- 2-ci sətir -->
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə formatı</label>
                                <select class="form-select">
                                    <option selected disabled>Seçin...</option>
                                    <option>Online</option>
                                    <option>Yerli qurumda</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə statusu</label>
                                <select class="form-select">
                                    <option selected disabled>Seçin...</option>
                                    <option>Planlaşdırılıb</option>
                                    <option>Təxirə salınıb</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Bildiriş statusu</label>
                                <select class="form-select">
                                    <option selected disabled>Seçin...</option>
                                    <option>Göndərildi</option>
                                    <option>Uğursuz</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="kadrForm" class="btn btn-primary">Yadda saxla</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- EDIT Modal -->
        <div class="modal fade" id="kadrModalEdit" tabindex="-1" aria-labelledby="kadrModalEditLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="kadrModalEditLabel">Redaktə et</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kadrFormEdit" class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label">Namizəd</label>
                                <input type="text" class="form-control" name="candidate"
                                    value="Kənan Əliyev Fərhad" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə tarixi</label>
                                <input type="date" class="form-control" name="interview_date" value="2025-05-03" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə saatı</label>
                                <input type="time" class="form-control" name="interview_time" value="15:00" />
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə formatı</label>
                                <select class="form-select" name="interview_format">
                                    <option disabled>Seçin...</option>
                                    <option selected>Online</option>
                                    <option>Yerli qurumda</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Müsahibə statusu</label>
                                <select class="form-select" name="interview_status">
                                    <option disabled>Seçin...</option>
                                    <option selected>Planlaşdırılıb</option>
                                    <option>Təxirə salınıb</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Bildiriş statusu</label>
                                <select class="form-select" name="notification_status">
                                    <option disabled>Seçin...</option>
                                    <option selected>Göndərildi</option>
                                    <option>Uğursuz</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="kadrFormEdit" class="btn btn-primary">Yadda saxla</button>
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
        document.addEventListener('DOMContentLoaded', () => {
            document.body.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-close')) {
                    const chip = e.target.closest('.d-inline-flex');
                    if (chip) chip.remove();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formEdit = document.getElementById('kadrFormEdit');
            const existingCvWrap = document.getElementById('cvExisting');
            if (existingCvWrap) {
                existingCvWrap.querySelectorAll('.btnExistingRemove').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const row = this.closest('.existing-file');
                        if (row) row.remove();
                        let hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'delete_cv';
                        hidden.value = '1';
                        formEdit.appendChild(hidden);
                    });
                });
            }
        });
    </script>
@endsection
