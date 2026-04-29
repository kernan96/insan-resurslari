@extends('layouts.index')
@section('css')
    <style>
        .employee-item {
            border: 2px solid #0d6efd;
            border-radius: 12px;
        }
        .employee-header {
            cursor: pointer;
        }
        .employee-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-right: 10px;
            font-size: 18px;
        }
        .tab-pill .nav-link {
            border-radius: 999px;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Təhsil və peşəkar inkişaf</h5>
                    <button class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#tehsilModalAdd">
                        <i class="bi bi-plus-circle me-1"></i> Əlavə et
                    </button>
                </div>
                <div class="card-body">
                    <div class="employee-item mb-3">
                        <div class="employee-header d-flex justify-content-between align-items-center p-3"
                            data-bs-toggle="collapse" data-bs-target="#employee1">
                            <div class="d-flex align-items-center">
                                <div class="employee-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        Abbasov Məhəmmədəli Oqtay oğlu
                                    </div>
                                    <span class="badge bg-light text-secondary border">
                                        Maliyyə
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-danger btnDelete">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#tehsilModalEdit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <i class="bi bi-chevron-down fs-5"></i>
                            </div>
                        </div>
                        <div id="employee1" class="collapse show border-top">
                            <div class="p-3">
                                <ul class="nav nav-pills mb-1 tab-pill" id="eduTabs1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="edu1-tab" data-bs-toggle="tab" data-bs-target="#edu1"
                                            type="button" role="tab">
                                            Təhsil və ixtisas
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="courses1-tab" data-bs-toggle="tab"
                                            data-bs-target="#courses1" type="button" role="tab">
                                            Kurslar
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="trainings1-tab" data-bs-toggle="tab"
                                            data-bs-target="#trainings1" type="button" role="tab">
                                            Təlimlər
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="cert1-tab" data-bs-toggle="tab" data-bs-target="#cert1"
                                            type="button" role="tab">
                                            Sertifikatlar
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="eduTabs1Content">
                                    <div class="tab-pane fade" id="edu1" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Buraya Təhsil və ixtisas məlumatları gələcək.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade show active" id="courses1" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Analitiki
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Uçotu (ACCA F1 daxil)
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Hesabatlarının hazırlanması
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Auditi
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="trainings1" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Burada təlimlər barədə məlumat olacaq.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="cert1" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Burada sertifikatlar barədə məlumat olacaq.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="employee-item mb-3">
                        <div class="employee-header d-flex justify-content-between align-items-center p-3"
                            data-bs-toggle="collapse" data-bs-target="#employee2">
                            <div class="d-flex align-items-center">
                                <div class="employee-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        Kərimov Yusif Əli oğlu
                                    </div>
                                    <span class="badge bg-light text-secondary border">
                                        Maliyyə
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-danger btnDelete">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#tehsilModalEdit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <i class="bi bi-chevron-down fs-5"></i>
                            </div>
                        </div>
                        <div id="employee2" class="collapse border-top">
                            <div class="p-3">
                                <ul class="nav nav-pills mb-2 tab-pill" id="eduTabs2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="edu2-tab" data-bs-toggle="tab"
                                            data-bs-target="#edu2" type="button" role="tab">
                                            Təhsil və ixtisas
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="courses2-tab" data-bs-toggle="tab"
                                            data-bs-target="#courses2" type="button" role="tab">
                                            Kurslar
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="trainings2-tab" data-bs-toggle="tab"
                                            data-bs-target="#trainings2" type="button" role="tab">
                                            Təlimlər
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="cert2-tab" data-bs-toggle="tab"
                                            data-bs-target="#cert2" type="button" role="tab">
                                            Sertifikatlar
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="eduTabs2Content">
                                    <div class="tab-pane fade" id="edu2" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Buraya Təhsil və ixtisas məlumatları gələcək.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade show active" id="courses2" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Analitiki
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Uçotu (ACCA F2 daxil)
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Hesabatlarının hazırlanması
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Auditi
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="trainings2" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Burada təlimlər barədə məlumat olacaq.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="cert2" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Burada sertifikatlar barədə məlumat olacaq.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="employee-item mb-1">
                        <div class="employee-header d-flex justify-content-between align-items-center p-3"
                            data-bs-toggle="collapse" data-bs-target="#employee3">
                            <div class="d-flex align-items-center">
                                <div class="employee-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">
                                        Əliyev Məhəmməd Oqtay oğlu
                                    </div>
                                    <span class="badge bg-light text-secondary border">
                                        Maliyyə
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-danger btnDelete">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#tehsilModalEdit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <i class="bi bi-chevron-down fs-5"></i>
                            </div>
                        </div>
                        <div id="employee3" class="collapse border-top">
                            <div class="p-3">
                                <ul class="nav nav-pills mb-3 tab-pill" id="eduTabs3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="edu3-tab" data-bs-toggle="tab"
                                            data-bs-target="#edu3" type="button" role="tab">
                                            Təhsil və ixtisas
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="courses3-tab" data-bs-toggle="tab"
                                            data-bs-target="#courses3" type="button" role="tab">
                                            Kurslar
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="trainings3-tab" data-bs-toggle="tab"
                                            data-bs-target="#trainings3" type="button" role="tab">
                                            Təlimlər
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="cert3-tab" data-bs-toggle="tab"
                                            data-bs-target="#cert3" type="button" role="tab">
                                            Sertifikatlar
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="eduTabs3Content">
                                    <div class="tab-pane fade" id="edu3" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Buraya Təhsil və ixtisas məlumatları gələcək.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade show active" id="courses3" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Analitiki
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Uçotu (ACCA F3 daxil)
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Hesabatlarının hazırlanması
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Maliyyə Auditi
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="trainings3" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Burada təlimlər barədə məlumat olacaq.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="cert3" role="tabpanel">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                Burada sertifikatlar barədə məlumat olacaq.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="tehsilModalAdd" tabindex="-1" aria-labelledby="kadrModalLabel" aria-hidden="true">
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
                            </div>
                            <div class="row">
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-ruled me-2"></i>Təhsil və ixtisas
                                            </span>
                                            <button type="button" id="btnAddEducation"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="educationWrap" class="vstack gap-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="education[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Lazım olduqda bir neçə təhsil faylı yükləyə bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-medical me-2"></i>Kurslar
                                            </span>
                                            <button type="button" id="btnAddCourse"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="coursesWrap" class="vstack gap-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="courses[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Lazım olduqda bir neçə kurs faylı yükləyə bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-medical me-2"></i>Təlimlər
                                            </span>
                                            <button type="button" id="btnAddTraining"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="trainingsWrap" class="vstack gap-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="trainings[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Lazım olduqda bir neçə təlim faylı yükləyə bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-medical me-2"></i>Sertifikatlar
                                            </span>
                                            <button type="button" id="btnAddCertificate"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="certificatesWrap" class="vstack gap-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="certificates[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Lazım olduqda bir neçə sertifikat faylı yükləyə bilərsiniz.
                                            </div>
                                        </div>
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
        <!-- EDIT Modal -->
        <div class="modal fade" id="tehsilModalEdit" tabindex="-1" aria-labelledby="kadrModalEditLabel"
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
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Qurum</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option disabled>Seçin...</option>
                                            <option selected>Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi</option>
                                            <option>Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Əməkdaş</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option disabled>Seçin...</option>
                                            <option selected>Abbasov Əli Həsən</option>
                                            <option>Süleymanova Günel Alməmməd</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-ruled me-2"></i>Təhsil və ixtisas
                                            </span>
                                            <button type="button" id="btnAddEducationEdit"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="educationWrapEdit" class="vstack gap-3 mb-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="education[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="mb-2 small text-muted">Mövcud fayllar:</div>
                                            <div id="educationExisting" class="vstack gap-2">
                                                <div
                                                    class="d-flex align-items-center justify-content-between bg-light px-2 py-1 rounded existing-file">
                                                    <span class="small">Diplom_ali_tehsil.pdf</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger btnExistingRemove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-between bg-light px-2 py-1 rounded existing-file">
                                                    <span class="small">Diplom_magistratura.pdf</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger btnExistingRemove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Lazım olduqda əlavə təhsil faylları yükləyə və mövcud faylları silə
                                                bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-medical me-2"></i>Kurslar
                                            </span>
                                            <button type="button" id="btnAddCourseEdit"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="coursesWrapEdit" class="vstack gap-3 mb-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="courses[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="mb-2 small text-muted">Mövcud fayllar:</div>
                                            <div id="coursesExisting" class="vstack gap-2">
                                                <div
                                                    class="d-flex align-items-center justify-content-between bg-light px-2 py-1 rounded existing-file">
                                                    <span class="small">Maliyyə_analizi_kurs.pdf</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger btnExistingRemove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Kurslarla bağlı olan faylları yeniləyə və silə bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-medical me-2"></i>Təlimlər
                                            </span>
                                            <button type="button" id="btnAddTrainingEdit"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="trainingsWrapEdit" class="vstack gap-3 mb-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="trainings[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="mb-2 small text-muted">Mövcud fayllar:</div>
                                            <div id="trainingsExisting" class="vstack gap-2">
                                                <div
                                                    class="d-flex align-items-center justify-content-between bg-light px-2 py-1 rounded existing-file">
                                                    <span class="small">Risk_idarəetməsi_təlimi.pdf</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger btnExistingRemove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Təlimlər üzrə olan sənədləri idarə edə bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-medical me-2"></i>Sertifikatlar
                                            </span>
                                            <button type="button" id="btnAddCertificateEdit"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="certificatesWrapEdit" class="vstack gap-3 mb-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="certificates[]"
                                                        class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]"
                                                        class="form-control form-control-sm" placeholder="Fayl adı...">
                                                </div>
                                            </div>
                                            <div class="mb-2 small text-muted">Mövcud fayllar:</div>
                                            <div id="certificatesExisting" class="vstack gap-2">
                                                <div
                                                    class="d-flex align-items-center justify-content-between bg-light px-2 py-1 rounded existing-file">
                                                    <span class="small">ACCA_level1_sertifikat.pdf</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger btnExistingRemove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Sertifikat fayllarını burada görə və silə bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="kadrFormEdit" class="btn btn-primary">Dəyişiklikləri yadda
                            saxla</button>
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
        document.querySelectorAll('.btnDelete').forEach(btn => {
            btn.addEventListener('click', function() {
                Swal.fire({
                    title: "Silmək istəyirsiniz?",
                    text: "Bu əməliyyat geri qaytarıla bilməz!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Bəli, sil!",
                    cancelButtonText: "Xeyr"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Silindi!',
                            text: 'Məlumat uğurla silindi.',
                            confirmButtonColor: '#0d6efd'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function addRow(buttonId, wrapId, inputName) {
            const btn = document.getElementById(buttonId);
            const wrap = document.getElementById(wrapId);
            if (!btn || !wrap) return;
            btn.addEventListener("click", () => {
                const row = document.createElement("div");
                row.className = "d-flex align-items-center gap-2 assignee-row";
                row.innerHTML = `
        <input type="file" name="${inputName}[]" class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]" class="form-control form-control-sm" placeholder="Fayl adı...">
        <button type="button" class="btn btn-sm btn-outline-danger btnRemove">
          <i class="bi bi-x-lg"></i>
        </button>
      `;
                wrap.appendChild(row);
                const removeBtn = row.querySelector(".btnRemove");
                removeBtn.addEventListener("click", () => {
                    row.remove();
                });
            });
        }
        addRow("btnAddEducation", "educationWrap", "education");
        addRow("btnAddCourse", "coursesWrap", "courses");
        addRow("btnAddTraining", "trainingsWrap", "trainings");
        addRow("btnAddCertificate", "certificatesWrap", "certificates");
    </script>
    <script>
        function addRow(buttonId, wrapId, inputName) {
            const btn = document.getElementById(buttonId);
            const wrap = document.getElementById(wrapId);
            if (!btn || !wrap) return;
            btn.addEventListener("click", () => {
                const row = document.createElement("div");
                row.className = "d-flex align-items-center gap-2 assignee-row";
                row.innerHTML = `
        <input type="file" name="${inputName}[]" class="form-control form-control-sm">
                                                    <input type="text" name="educationname[]" class="form-control form-control-sm" placeholder="Fayl adı...">
        <button type="button" class="btn btn-sm btn-outline-danger btnRemove">
          <i class="bi bi-x-lg"></i>
        </button>
      `;
                wrap.appendChild(row);
                row.querySelector(".btnRemove").addEventListener("click", () => {
                    row.remove();
                });
            });
        }
        function initExistingRemove() {
            document.querySelectorAll(".btnExistingRemove").forEach(btn => {
                btn.addEventListener("click", function() {
                    this.closest(".existing-file").remove();
                });
            });
        }
        document.addEventListener("DOMContentLoaded", () => {
            addRow("btnAddEducationEdit", "educationWrapEdit", "education");
            addRow("btnAddCourseEdit", "coursesWrapEdit", "courses");
            addRow("btnAddTrainingEdit", "trainingsWrapEdit", "trainings");
            addRow("btnAddCertificateEdit", "certificatesWrapEdit", "certificates");
            initExistingRemove();
        });
    </script>
@endsection
