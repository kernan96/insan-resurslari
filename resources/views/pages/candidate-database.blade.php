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
                    <h5 class="mb-0 text-dark">Namizəd bazası</h5>
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
                            <div class="row g-3">
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Ad soyad, ata adı</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Kateqoriya</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Qəbul edildi</option>
                                            <option>Gözləmədə</option>
                                            <option>Uğursuz</option>
                                        </select>
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
                                    <th>Qəbul tarixi</th>
                                    <th>Statusu</th>
                                    <th>Qeyd</th>
                                    <th>CV</th>
                                    <th>Email</th>
                                    <th>Nömrə</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kənan Əliyev Fərhad</td>
                                    <td>03.05.2025</td>
                                    <td>Qəbul edildi</td>
                                    <td>Namizəd ilə aparılan müsahibə nəticəsində tələb olunan kompetensiyalar üzrə yüksək
                                        uyğunluq müşahidə olundu. Praktiki tapşırığı uğurla yerinə yetirdi. Komanda ilə
                                        işləmə bacarığı və motivasiyası müsbət qiymətləndirildi. Vəzifəyə qəbul üçün tövsiyə
                                        olunur.</td>
                                    <!-- data-order tarixə görə düzgün sıralama üçündür (YYYY-MM-DD) -->
                                    <td data-order="2022-05-13"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                    </td>
                                    <td>test@gmail.com</td>
                                    <td>060-252-20-33</td>
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
                                    <td>Uğursuz</td>
                                    <td>Namizədin təqdim etdiyi bilik və bacarıqlar vakansiyanın tələblərinə tam uyğun
                                        olmadığından müsbət qərar verilmədi. Ünsiyyət bacarıqları güclü olsa da, texniki
                                        sahədə çatışmazlıqlar müşahidə olundu. Gələcək vakansiyalar üçün məlumat bazasında
                                        saxlanıla bilər.</td>
                                    <td data-order="2023-03-18"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                    </td>
                                    <td>test1@gmail.com</td>
                                    <td>060-252-99-33</td>
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
                                    <td>Gözləmədə</td>
                                    <td>Namizədin texniki bilikləri qənaətbəxşdir, lakin əlavə dəqiqləşdirmələr tələb
                                        olunur. İkinci mərhələ müsahibəsinə yönləndiriləcək. Hazırda digər namizədlərlə
                                        müqayisə aparıldığı üçün qərar gözləmədə saxlanılıb.</td>
                                    <td data-order="2021-05-14"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                    </td>
                                    <td>test3@gmail.com</td>
                                    <td>060-252-20-66</td>
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
                        <h5 class="modal-title" id="kadrModalLabel">Yenisini yarat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kadrForm">
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Ad</label>
                                    <input type="text" class="form-control" placeholder="Adı daxil edin">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Soyad</label>
                                    <input type="text" class="form-control" placeholder="Soyadı daxil edin">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Ata adı</label>
                                    <input type="text" class="form-control" placeholder="Ata adını daxil edin">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Qəbul tarixi</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Statusu</label>
                                    <select class="form-select">
                                        <option selected disabled>Seçin...</option>
                                        <option>Qəbul edildi</option>
                                        <option>Gözləmədə</option>
                                        <option>Uğursuz</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email ünvanını daxil edin">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Telefon nömrəsi</label>
                                    <input type="text" class="form-control" placeholder="+994 XX XXX XX XX">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">CV</label>
                                    <input type="file" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Qeyd</label>
                                    <textarea class="form-control" rows="4" placeholder="Əlavə qeydləri daxil edin..."></textarea>
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
        <div class="modal fade" id="kadrModalEdit" tabindex="-1" aria-labelledby="kadrModalEditLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="kadrModalEditLabel">Redaktə et</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kadrFormEdit">
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Ad</label>
                                    <input type="text" class="form-control" name="name" value="Kənan" />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Soyad</label>
                                    <input type="text" class="form-control" name="surname" value="Əliyev" />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Ata adı</label>
                                    <input type="text" class="form-control" name="father_name" value="Fərhad" />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Qəbul tarixi</label>
                                    <input type="date" class="form-control" name="hire_date" value="2025-05-03" />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Statusu</label>
                                    <select class="form-select" name="status">
                                        <option disabled>Seçin...</option>
                                        <option selected>Qəbul edildi</option>
                                        <option>Gözləmədə</option>
                                        <option>Uğursuz</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="kenan.aliyev@example.com" />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Telefon nömrəsi</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="+994 50 777 88 99" />
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label">CV</label>
                                    <input type="file" class="form-control" name="cv" />
                                    <div class="mt-2 small text-muted">Mövcud CV faylı:</div>
                                    <div id="cvExisting" class="vstack gap-2">
                                        <div
                                            class="d-flex align-items-center justify-content-between bg-light px-2 py-1 rounded existing-file">
                                            <span class="small">CV_Kənan_Əliyev.pdf</span>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger btnExistingRemove">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        Yeni CV seçilsə, köhnə fayl yenilənəcək. Mövcud faylı silmək üçün X düyməsini sıxın.
                                    </small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Qeyd</label>
                                    <textarea class="form-control" name="note" rows="4">
Namizəd ilkin müsahibədən uğurla keçmiş, texniki tapşırığı vaxtında təqdim etmişdir.
              </textarea>
                                </div>
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
@endsection
