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
        .action-btns {
            white-space: nowrap;
        }
        thead.bg-primary th {
            background-color: #0d6efd !important;
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
                    <h5 class="mb-0 text-dark">Məzuniyyət qrafiki</h5>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn bg-primary btn-sm d-flex align-items-center text-white" data-bs-toggle="collapse"
                            data-bs-target="#filterPanel" aria-expanded="false" aria-controls="filterPanel">
                            <i class="bi bi-funnel me-1"></i> Axtarış filteri
                        </button>
                        <button class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#kadrModal">
                            <i class="bi bi-plus-circle me-1"></i> Əlavə et
                        </button>
                        <button class="btn btn-info btn-sm d-flex align-items-center text-white" data-bs-toggle="modal"
                            data-bs-target="#mezuniyyetModalPdf">
                            <i class="bi bi-calendar-week me-1"></i> Məzuniyyət qrafiki
                        </button>
                    </div>
                </div>
                <div id="filterPanel" class="collapse mt-3">
                    <div class="card card-body p-3">
                        <form id="filtersForm" class="row g-3">
                            <div class="row g-3">
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Qurum</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                            <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Əməkdaş</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Abbasov Əli Həsən</option>
                                            <option>Süleymanova Günel Alməmməd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Kateqoriya</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Əmək məzuniyyəti</option>
                                            <option>Ödənişsiz məzuniyyət</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Başlama tarixi</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Bitmə tarixi</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table id="employeesTable" class="table table-striped table-hover w-100 align-middle text-center">
                            <thead class="table-light bg-primary text-white">
                                <tr>
                                    <th>Ad soyad, ata adı</th>
                                    <th>İş stajı</th>
                                    <th>Başlama tarixi</th>
                                    <th>Bitmə tarixi</th>
                                    <th>İstifadə olunan gün</th>
                                    <th>Qalan gün</th>
                                    <th>Kateqoriya</th>
                                    <th>Digər</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kənan Əliyev Fərhad</td>
                                    <td>3 il 2 ay 20 gün</td>
                                    <td>03.05.2025</td>
                                    <td>06.04.2025</td>
                                    <td>25</td>
                                    <td>5</td>
                                    <!-- data-order tarixə görə düzgün sıralama üçündür (YYYY-MM-DD) -->
                                    <td data-order="2022-05-13">Əmək məzuniyyəti</td>
                                    <td class="action-btns">
                                        <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                            data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Süleymanova Günel Alməmməd</td>
                                    <td>4 il 15 gün</td>
                                    <td>06.04.2025</td>
                                    <td>08.06.2025</td>
                                    <td>25</td>
                                    <td>5</td>
                                    <td data-order="2023-03-18">Ödənişsiz məzuniyyət</td>
                                    <td class="action-btns">
                                        <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                            data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Süleymanova Günel Alməmməd</td>
                                    <td>7 il 9 ay</td>
                                    <td>07.02.2025</td>
                                    <td>08.03.2025</td>
                                    <td>17</td>
                                    <td>15</td>
                                    <td data-order="2021-05-14">Ödənişsiz məzuniyyət</td>
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
        <!-- Create Modal -->
        <div class="modal fade" id="kadrModal" tabindex="-1" aria-labelledby="kadrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="kadrModalLabel">Yenisini yarat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kadrForm">
                            <div class="row g-3">
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Qurum</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                            <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Əməkdaş</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Abbasov Əli Həsən</option>
                                            <option>Süleymanova Günel Alməmməd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Kateqoriya</label>
                                    <div class="input-group">
                                        <select class="form-select" name="mezuniyyet_category_id" required>
                                            <option selected disabled>Seçin...</option>
                                            <option value="1">Əmək məzuniyyəti</option>
                                            <option value="2">Doğum məzuniyyəti</option>
                                            <option value="3">Analıq məzuniyyəti</option>
                                            <option value="4">Atalıq məzuniyyəti</option>
                                            <option value="5">Təhsil məzuniyyəti</option>
                                            <option value="6">Digər məzuniyyətlər</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Başlama tarixi</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Bitmə tarixi</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="">
                                    </div>
                                </div>
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
        <!-- Məzuniyyət qrafiki Modal -->
        <div class="modal fade" id="mezuniyyetModalPdf" tabindex="-1" aria-labelledby="mezuniyyetModalPdfLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="mezuniyyetModalPdfLabel">
                            Məzuniyyət qrafiki – sənəd yüklə
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="mezuniyyetPdfForm">
                            <div class="mb-3">
                                <label class="form-label">Sənəd (PDF)</label>
                                <input type="file" class="form-control" accept=".pdf" required>
                                <div class="form-text">
                                    Yalnız <b>PDF</b> formatında fayl yükləyə bilərsiniz.
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Bağla
                        </button>
                        <button type="submit" form="mezuniyyetPdfForm" class="btn btn-primary">
                            Yadda saxla
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="kadrModalEdit" tabindex="-1" aria-labelledby="kadrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="kadrModalLabel">Redaktə et</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kadrForm">
                            <div class="row g-3">
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Qurum</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                            <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Əməkdaş</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Abbasov Əli Həsən</option>
                                            <option>Süleymanova Günel Alməmməd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Kateqoriya</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Əmək məzuniyyəti</option>
                                            <option>Ödənişsiz məzuniyyət</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Başlama tarixi</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="2025-05-18">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Bitmə tarixi</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="2025-05-18">
                                    </div>
                                </div>
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
@endsection
