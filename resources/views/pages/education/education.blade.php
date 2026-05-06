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
                    <input type="hidden" name="user_id">
                    <div class="card mb-4 mt-2" data-card-type="education">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Təhsil və ixtisas</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="education">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="education">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Təhsil müəssisəsinin adı, fakültə</th>
                                            <th class="text-center align-middle" {{--style="width: 10%;"--}}>Daxil olduğu tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 10%;"--}}>Bitirdiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 20%;"--}}>Təhsil haqqında sənəd üzrə ixtisasınız və peşəniz</th>
                                            <th class="text-center align-middle" {{--style="width: 20%;"--}}>Təhsil haqqında sənədin nömrəsi, verildiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Sənəd</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-education"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="course">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Kurslar</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="course">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="course">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Kursun adı</th>
                                            <th class="text-center align-middle" style="width: 5%;">Sertifikat</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-course"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="training">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Təlimlər</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="training">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="training">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Təlimin adı</th>
                                            <th class="text-center align-middle" style="width: 5%;">Sertifikat</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-training"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="academic-degree">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Elmi dərəcə, elmi ad</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="academic-degree">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="academic-degree">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Elmi dərəcə, elmi ad</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Verildiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Hansı qurum tərəfindən verilmişdir</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Diplomun, attestatın nömrəsi, verildiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-academic-degree"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="computer-khnowledge">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Kompüter texnikasından istifadə və digər peşə (ixtisas) bacarıqlarınız</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="computer-khnowledge">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="computer-khnowledge">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Kompüter texnikasından istifadə və digər peşə (ixtisas) bacarıqlarınız</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-computer-khnowledge"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="language">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Dil bilikləri</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="language">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="language">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Dillər</th>
                                            <th class="text-center align-middle">Bilmə dərəcəsi</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-language"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                    <button type="submit" form="kadrForm" class="btn btn-primary">Yadda saxla</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Qalan hissə (cədvəllər) eyni qalır, sadəcə tbody-lərin id-ləri yoxlanılsın -->
    <div class="modal fade" id="tehsilModalEdit" tabindex="-1" aria-labelledby="kadrModalEditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="kadrModalEditLabel">Redaktə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id">
                    <div class="card mb-4 mt-2" data-card-type="education">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Təhsil və ixtisas</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="education">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="education">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Təhsil müəssisəsinin adı, fakültə</th>
                                            <th class="text-center align-middle" {{--style="width: 10%;"--}}>Daxil olduğu tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 10%;"--}}>Bitirdiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 20%;"--}}>Təhsil haqqında sənəd üzrə ixtisasınız və peşəniz</th>
                                            <th class="text-center align-middle" {{--style="width: 20%;"--}}>Təhsil haqqında sənədin nömrəsi, verildiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Sənəd</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-education"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="course">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Kurslar</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="course">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="course">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Kursun adı</th>
                                            <th class="text-center align-middle" style="width: 5%;">Sertifikat</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-course"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="training">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Təlimlər</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="training">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="training">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Təlimin adı</th>
                                            <th class="text-center align-middle" style="width: 5%;">Sertifikat</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-training"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="academic-degree">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Elmi dərəcə, elmi ad</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="academic-degree">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="academic-degree">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Elmi dərəcə, elmi ad</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Verildiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Hansı qurum tərəfindən verilmişdir</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Diplomun, attestatın nömrəsi, verildiyi tarix</th>
                                            <th class="text-center align-middle" {{--style="width: 5%;"--}}>Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-academic-degree"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="computer-khnowledge">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Kompüter texnikasından istifadə və digər peşə (ixtisas) bacarıqlarınız</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="computer-khnowledge">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="computer-khnowledge">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Kompüter texnikasından istifadə və digər peşə (ixtisas) bacarıqlarınız</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-computer-khnowledge"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-2" data-card-type="language">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Dil bilikləri</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="language">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="language">
                            <div class="table-responsive">
                                <table class="data-table table table-bordered table-hover text-center" style="font-size:0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">Dillər</th>
                                            <th class="text-center align-middle">Bilmə dərəcəsi</th>
                                            <th class="text-center align-middle" style="width: 5%;">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-language"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>

                </div>
            </div>
        </div>
    </div>
    <!-- EDIT Modal -->
    <div class="modal fade" id="eduModalEdit" tabindex="-1" aria-labelledby="kadrModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="kadrModalEditLabel">Redaktə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                </div>
                <div class="modal-body">
                    <!-- Form burada açılır -->
                    <form id="kadrFormEdit">
                        <input type="hidden" name="user_id">
                        <input type="hidden" name="edit_card_type" id="edit_card_type">
                        <input type="hidden" name="edit_row_index" id="edit_row_index">

                        <!-- Dinamik content buraya gələcək -->
                        <div id="modalDynamicFields"></div>
                    </form>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                    <button type="submit" form="kadrFormEdit" class="btn btn-primary">Dəyişiklikləri yadda saxla</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === 1. Bütün '+ Əlavə et' düymələri ===
            document.querySelectorAll('.form-add-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const cardType = this.getAttribute('data-card');
                    openAddModal(cardType);
                });
            });

            // === 2. Form submit = yadda saxla (modal) ===
            const editForm = document.getElementById('kadrFormEdit');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    saveFromModal();
                });
            }

            // === 3. Modal bağlananda təmizlə ===
            const modalElem = document.getElementById('eduModalEdit');
            if (modalElem) {
                modalElem.addEventListener('hidden.bs.modal', function() {
                    document.getElementById('modalDynamicFields').innerHTML = '';
                    document.getElementById('edit_card_type').value = '';
                    document.getElementById('edit_row_index').value = '';
                });
            }

            // === 4. Məlumat strukturu (localStorage-da saxlanılır) ===
            let dataStore = {
                education: [],
                course: [],
                training: [],
                'academic-degree': [],
                'computer-khnowledge': [],
                language: []
            };

            // LocalStorage-dan yüklə
            function loadFromStorage() {
                const saved = localStorage.getItem('tehsilData');
                if (saved) {
                    dataStore = JSON.parse(saved);
                }
                renderAllTables();
            }

            // LocalStorage-a yadda saxla
            function saveToStorage() {
                localStorage.setItem('tehsilData', JSON.stringify(dataStore));
            }

            // === 5. Bütün cədvəlləri render et ===
            function renderAllTables() {
                for (const [cardType, records] of Object.entries(dataStore)) {
                    const tbody = document.getElementById(`tbody-${cardType}`);
                    if (!tbody) continue;

                    tbody.innerHTML = '';
                    records.forEach((record, index) => {
                        const row = createTableRow(cardType, record, index);
                        tbody.appendChild(row);
                    });
                }
            }

            // Cədvəl sətiri yarat (statik mətnlər)
            function createTableRow(cardType, data, index) {
                const tr = document.createElement('tr');
                tr.setAttribute('data-index', index);

                switch (cardType) {
                    case 'education':
                        tr.innerHTML = `
                    <td>${escapeHtml(data.institution || '')}</td>
                    <td>${escapeHtml(data.start_date || '')}</td>
                    <td>${escapeHtml(data.end_date || '')}</td>
                    <td>${escapeHtml(data.specialty || '')}</td>
                    <td>${escapeHtml(data.document_info || '')}</td>
                    <td>${escapeHtml(data.document_link || '')}</td>
                    <td class="actions-cell">
                        <button class="btn btn-sm edit-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-edit " ></i></button>
                        <button class="btn btn-sm delete-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-trash" ></i></button>
                    </td>
                `;
                        break;
                    case 'course':
                        tr.innerHTML = `
                    <td>${escapeHtml(data.course_name || '')}</td>
                    <td>${escapeHtml(data.certificate || '')}</td>
                    <td class="actions-cell">
                        <button class="btn btn-sm btn-warning edit-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-edit " ></i></button>
                        <button class="btn btn-sm btn-danger delete-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-trash" ></i></button>
                    </td>
                `;
                        break;
                    case 'training':
                        tr.innerHTML = `
                    <td>${escapeHtml(data.training_name || '')}</td>
                    <td>${escapeHtml(data.certificate || '')}</td>
                    <td class="actions-cell">
                        <button class="btn btn-sm btn-warning edit-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-edit " ></i></button>
                        <button class="btn btn-sm btn-danger delete-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-trash" ></i></button>
                    </td>
                `;
                        break;
                    case 'academic-degree':
                        tr.innerHTML = `
                    <td>${escapeHtml(data.degree_name || '')}</td>
                    <td>${escapeHtml(data.issue_date || '')}</td>
                    <td>${escapeHtml(data.issued_by || '')}</td>
                    <td>${escapeHtml(data.document_no || '')}</td>
                    <td class="actions-cell">
                        <button class="btn btn-sm btn-warning edit-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-edit " ></i></button>
                        <button class="btn btn-sm btn-danger delete-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-trash" ></i></button>
                    </td>
                `;
                        break;
                    case 'computer-khnowledge':
                        tr.innerHTML = `
                    <td>${escapeHtml(data.skill || '')}</td>
                    <td class="actions-cell">
                        <button class="btn btn-sm btn-warning edit-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-edit " ></i></button>
                        <button class="btn btn-sm btn-danger delete-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-trash" ></i></button>
                    </td>
                `;
                        break;
                    case 'language':
                        tr.innerHTML = `
                    <td>${escapeHtml(data.language || '')}</td>
                    <td>${escapeHtml(data.level || '')}</td>
                    <td class="actions-cell">
                        <button class="btn btn-sm btn-warning edit-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-edit " ></i></button>
                        <button class="btn btn-sm btn-danger delete-item" data-type="${cardType}" data-index="${index}"><i class="fas fa-trash" ></i></button>
                    </td>
                `;
                        break;
                }

                // Eventləri əlavə et
                tr.querySelector('.edit-item')?.addEventListener('click', () => openEditModal(cardType, index));
                tr.querySelector('.delete-item')?.addEventListener('click', () => deleteItem(cardType, index));

                return tr;
            }

            // === 6. Modalda əlavə etmək üçün form göstər (eduModalEdit açılır) ===
            function openAddModal(cardType) {
                document.getElementById('edit_card_type').value = cardType;
                document.getElementById('edit_row_index').value = '';

                const fieldsHtml = getFormFields(cardType, {});
                document.getElementById('modalDynamicFields').innerHTML = fieldsHtml;

                // DÜZƏLİŞ: eduModalEdit modalını aç
                const modal = new bootstrap.Modal(document.getElementById('eduModalEdit'));
                modal.show();
            }

            // === 7. Redaktə üçün modal (eduModalEdit açılır) ===
            function openEditModal(cardType, index) {
                const record = dataStore[cardType][index];
                if (!record) return;

                document.getElementById('edit_card_type').value = cardType;
                document.getElementById('edit_row_index').value = index;

                const fieldsHtml = getFormFields(cardType, record);
                document.getElementById('modalDynamicFields').innerHTML = fieldsHtml;

                // DÜZƏLİŞ: eduModalEdit modalını aç
                const modal = new bootstrap.Modal(document.getElementById('eduModalEdit'));
                modal.show();
            }

            // === 8. Form field-larını yarat ===
            function getFormFields(cardType, data) {
                switch (cardType) {
                    case 'education':
                        return `
                        <div class="mb-3">
                            <label class="form-label">Təhsil müəssisəsinin adı, fakültə</label>
                            <input type="text" name="institution" class="form-control" value="${escapeHtml(data.institution || '')}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Daxil olduğu tarix</label>
                                <input type="date" name="start_date" class="form-control" value="${data.start_date || ''}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bitirdiyi tarix</label>
                                <input type="date" name="end_date" class="form-control" value="${data.end_date || ''}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Təhsil haqqında sənəd üzrə ixtisasınız və peşəniz</label>
                            <input type="text" name="specialty" class="form-control" value="${escapeHtml(data.specialty || '')}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Təhsil haqqında sənədin nömrəsi, verildiyi tarix</label>
                            <input type="text" name="document_info" class="form-control" value="${escapeHtml(data.document_info || '')}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sənəd (PDF, JPG, PNG)</label>
                            <input type="file" name="document_link" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            ${data.document_link ? `<div class="mt-2"><small>Mövcud sənəd: <a href="${data.document_link}" target="_blank">Bax</a></small></div>` : ''}
                        </div>
                    `;

                    case 'course':
                        return `
                            <div class="mb-3">
                                <label class="form-label">Kursun adı</label>
                                <input type="text" name="course_name" class="form-control" value="${escapeHtml(data.course_name || '')}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sertifikat (PDF, JPG, PNG)</label>
                                <input type="file" name="certificate" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                ${data.certificate ? `<div class="mt-2"><small>Mövcud sənəd: <a href="${data.certificate}" target="_blank">Bax</a></small></div>` : ''}
                            </div>
                        `;

                    case 'training':
                        return `
                            <div class="mb-3">
                                <label class="form-label">Təlimin adı</label>
                                <input type="text" name="training_name" class="form-control" value="${escapeHtml(data.training_name || '')}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sertifikat (PDF, JPG, PNG)</label>
                                <input type="file" name="certificate" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                ${data.certificate ? `<div class="mt-2"><small>Mövcud sənəd: <a href="${data.certificate}" target="_blank">Bax</a></small></div>` : ''}
                            </div>
                        `;
                    case 'academic-degree':
                        return `
                            <div class="mb-3">
                                <label class="form-label">Elmi dərəcə, elmi ad</label>
                                <input type="text" name="degree_name" class="form-control" value="${escapeHtml(data.degree_name || '')}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Verildiyi tarix</label>
                                <input type="date" name="issue_date" class="form-control" value="${data.issue_date || ''}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hansı qurum tərəfindən verilmişdir</label>
                                <input type="text" name="issued_by" class="form-control" value="${escapeHtml(data.issued_by || '')}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Diplomun, attestatın nömrəsi, verildiyi tarix</label>
                                <input type="text" name="document_no" class="form-control" value="${escapeHtml(data.document_no || '')}">
                            </div>
                        `;
                    case 'computer-khnowledge':
                        return `
                            <div class="mb-3">
                                <label class="form-label">Kompüter texnikasından istifadə və digər peşə (ixtisas) bacarıqlarınız</label>
                                <textarea name="skill" class="form-control" rows="3">${escapeHtml(data.skill || '')}</textarea>
                            </div>
                        `;
                    case 'language':
                        return `
                            <div class="mb-3">
                                <label class="form-label">Dillər</label>
                                <input type="text" name="language" class="form-control" value="${escapeHtml(data.language || '')}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bilmə dərəcəsi</label>
                                <select name="level" class="form-select">
                                    <option value="">Seçin</option>
                                    <option value="Əla" ${data.level === 'Əla' ? 'selected' : ''}>Əla</option>
                                    <option value="Yaxşı" ${data.level === 'Yaxşı' ? 'selected' : ''}>Yaxşı</option>
                                    <option value="Orta" ${data.level === 'Orta' ? 'selected' : ''}>Orta</option>
                                    <option value="Başlanğıc" ${data.level === 'Başlanğıc' ? 'selected' : ''}>Başlanğıc</option>
                                </select>
                            </div>
                        `;
                    default:
                        return '<div class="alert alert-danger">Xəta: Tip tapılmadı</div>';
                }
            }

            // === 9. Form-dan məlumatları yığ ===
            function getFormData() {
                const form = document.getElementById('kadrFormEdit');
                const formData = new FormData(form);
                const data = {};

                // File saxlama üçün
                const fileFields = ['document_link', 'certificate'];

                for (let [key, value] of formData.entries()) {
                    if (key !== 'edit_card_type' && key !== 'edit_row_index' && key !== 'user_id') {
                        if (fileFields.includes(key)) {
                            const file = value;
                            if (file && file.name) {
                                // FAYL JSON-A YAZILMAZ - base64 çevir
                                const reader = new FileReader();
                                reader.readAsDataURL(file);
                                // ASYNC - həll üçün aşağıdakı alternativi istifadə edin
                            } else if (!file.name && data[key]) {
                                data[key] = data[key]; // mövcudu saxla
                            }
                        } else {
                            data[key] = value;
                        }
                    }
                }
                return data;
            }

            // === 10. Yadda saxla (modal-dan) ===
            function saveFromModal() {
                const cardType = document.getElementById('edit_card_type').value;
                const rowIndex = document.getElementById('edit_row_index').value;
                const formData = getFormData();

                if (!cardType) return;

                if (rowIndex === '') {
                    // Yeni əlavə
                    if (!dataStore[cardType]) dataStore[cardType] = [];
                    dataStore[cardType].push(formData);
                } else {
                    // Redaktə
                    if (dataStore[cardType] && dataStore[cardType][rowIndex]) {
                        dataStore[cardType][rowIndex] = formData;
                    }
                }

                saveToStorage();
                renderAllTables();

                // Modalı bağla (eduModalEdit)
                const modal = bootstrap.Modal.getInstance(document.getElementById('eduModalEdit'));
                if (modal) modal.hide();
            }

            // === 11. Sil ===
            function deleteItem(cardType, index) {
                if (confirm('Bu məlumatı silmək istədiyinizdən əminsiniz?')) {
                    if (dataStore[cardType] && dataStore[cardType][index]) {
                        dataStore[cardType].splice(index, 1);
                        saveToStorage();
                        renderAllTables();
                    }
                }
            }

            // === 12. XSS qorunması ===
            function escapeHtml(str) {
                if (!str) return '';
                return str
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            // === Başlat ===
            loadFromStorage();
        });
    </script>
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