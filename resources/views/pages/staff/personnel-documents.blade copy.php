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
                <h5 class="mb-0 text-dark">Kadr sənədləri</h5>
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
                                <label class="form-label">Qurum</label>
                                <div class="input-group">
                                    <select id="qurumSelect" class="form-select">
                                        <option disabled selected>Seçin...</option>
                                        @foreach($organizations as $org)
                                        @if($org->parent_id == null)
                                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Şöbə</label>
                                <div class="input-group">
                                    <select id="sobeSelect" class="form-select">
                                        <option disabled selected>Seçin...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Şöbə</label>
                                <div class="input-group">
                                    <select id="sobeSelect" class="form-select">
                                        <option disabled selected>Seçin...</option>
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
                                <label class="form-label">Cinsiyyət</label>
                                <div class="input-group">
                                    <select class="form-select">
                                        <option selected disabled>Seçin...</option>
                                        <option>Kişi</option>
                                        <option>Qadın</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-12 col-md-3">
                                <label class="form-label">İşə başlama tarixi</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Müqavilə müddəti</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İxtisas dərəcəsi</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İxtisas dərəcəsinin verilmə tarixi</label>
                                <input type="date" class="form-control" placeholder="">
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
                                <th>Şöbə</th>
                                <th>Vəzifəsi</th>
                                <th>İşə başlama tarixi</th>
                                <th>İş stajı</th>
                                <th>Müqavilə müddəti</th>
                                <th>İxtisas dərəcəsi və növbəti verilmə tarixi</th>
                                <th>Digər</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kənan Əliyev Fərhad</td>
                                <td>Maliyyə şöbəsi</td>
                                <td>Aparıcı məsləhətçi</td>
                                <!-- data-order tarixə görə düzgün sıralama üçündür (YYYY-MM-DD) -->
                                <td data-order="2022-05-13">13 May 2022</td>
                                <td data-order="2022-05-13">3 il</td>
                                <td>Müddətsiz</td>
                                <td>II dərəcəli dq | 15.03.2024</td>
                                <td class="action-btns">
                                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('pages.staff.personnel-documents-details') }}"
                                        class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                        data-bs-title="Bax">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip"
                                        data-bs-title="Endir" download>
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                        data-bs-title="Forma 3">
                                        <i class="bi bi-file-earmark-person me-1"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Süleymanova Günel Alməmməd</td>
                                <td>Hüquqşünas</td>
                                <td>Aparıcı məsləhətçi</td>
                                <td data-order="2023-03-18">18 Mar 2023</td>
                                <td data-order="2023-03-18">2 il</td>
                                <td>1 il</td>
                                <td>-</td>
                                <td class="action-btns">
                                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('pages.staff.personnel-documents-details') }}"
                                        class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                        data-bs-title="Bax">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip"
                                        data-bs-title="Endir" download>
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                        data-bs-title="Forma 3">
                                        <i class="bi bi-file-earmark-person me-1"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Süleymanova Günel Alməmməd</td>
                                <td>Maliyyə şöbəsi</td>
                                <td>Baş məsləhətçi</td>
                                <td data-order="2021-05-14">14 May 2021</td>
                                <td data-order="2021-05-14">4 il</td>
                                <td>3 ay</td>
                                <td>-</td>
                                <td class="action-btns">
                                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#kadrModalEdit" data-bs-title="Redaktə et">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="{{ route('pages.staff.personnel-documents-details') }}"
                                        class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                        data-bs-title="Bax">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip"
                                        data-bs-title="Endir" download>
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                        data-bs-title="Forma 3">
                                        <i class="bi bi-file-earmark-person me-1"></i>
                                    </a>
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
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label">Qurum <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-select" id="qurumSelect" name="qurum_id" required>
                                        <option selected disabled value="">Seçin...</option>
                                        @foreach($organizations as $org)
                                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Şöbə</label>
                                <div class="input-group">
                                    <select class="form-select" id="sobeSelect" name="sobe_id" disabled>
                                        <option selected disabled value="">Əvvəlcə qurum seçin...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Sektor</label>
                                <div class="input-group">
                                    <select class="form-select" id="sektorSelect" name="sektor_id" disabled>
                                        <option selected disabled value="">Əvvəlcə şöbə seçin...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Əməkdaş</label>
                                <div class="input-group">
                                    <select class="form-select" id="emekdasSelect" name="user_id" disabled>
                                        <option selected disabled value="">Əvvəlcə bölmə seçin...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Vəzifə</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="vezifeInput" name="position_name" readonly disabled placeholder="Əməkdaş seçildikdə avtomatik dolacaq">
                                    <input type="hidden" id="position_id" name="position_id">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row g-3 mt-2">
                                <div class="col-12 col-md-3">
                                    <label class="form-label">İşə başlama tarixi</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Müqavilə müddəti</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">İxtisas dərəcəsi</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label">İxtisas dərəcəsinin verilmə tarixi</label>
                                    <input type="date" class="form-control" placeholder="">
                                </div>
                            </div> -->
                        <div class="row g-3 mt-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label"> Kadrlar uçotunun şəxsi vərəqəsi </label>
                                <input type="file" class="form-control" id="bioFile">
                                <div class="mt-2" id="bioChips"></div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label"> Tərcümeyi-hal</label>
                                <input type="file" class="form-control" id="contractFile">
                                <div class="mt-2" id="contractChips"></div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label"> Bioqrafik arayış</label>
                                <input type="file" class="form-control" id="certFile" multiple>
                                <div class="mt-2 d-flex flex-wrap gap-2" id="certChips"></div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label"> Kadrlar uçotunun şəxsi vərəqəsi </label>
                                <input type="file" class="form-control" id="certFile" multiple>
                                <div class="mt-2 d-flex flex-wrap gap-2" id="certChips"></div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label"> Dövlət qulluqçusunun şəxsi vərəqəsi</label>
                                <input type="file" class="form-control" id="certFile" multiple>
                                <div class="mt-2 d-flex flex-wrap gap-2" id="certChips"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 mt-3">
                                <div class="card assignees-card shadow-sm border-primary-subtle">
                                    <div class="card-header d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold">
                                            <i class="bi bi-file-earmark-ruled me-2"></i>Əmr
                                        </span>
                                        <button type="button" id="btnAddOrder"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="ordersWrap" class="vstack gap-3">
                                            <div class="d-flex align-items-center gap-2 assignee-row">
                                                <input type="file" name="orders[]"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="form-text mt-2">
                                            Lazım olduqda bir neçə əmr faylı yükləyə bilərsiniz.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-3">
                                <div class="card assignees-card shadow-sm border-primary-subtle">
                                    <div class="card-header d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold">
                                            <i class="bi bi-file-earmark-medical me-2"></i>Müqavilə
                                        </span>
                                        <button type="button" id="btnAddContract"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="contractsWrap" class="vstack gap-3">
                                            <div class="d-flex align-items-center gap-2 assignee-row">
                                                <input type="file" name="contracts[]"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="form-text mt-2">
                                            Lazım olduqda bir neçə müqavilə faylı yükləyə bilərsiniz.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-3">
                                <div class="card assignees-card shadow-sm border-primary-subtle">
                                    <div class="card-header d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold">
                                            <i class="bi bi-file-earmark-text me-2"></i>Sertifikat
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
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            console.log('Document ready'); // Debug üçün
                            // Qurum seçildikdə
                            $('#qurumSelect').on('change', function() {
                                var organizationId = $(this).val();
                                console.log('Qurum seçildi:', organizationId); // Debug üçün
                                if (organizationId) {
                                    // Şöbələri yüklə
                                    loadDepartments(organizationId);
                                    // Quruma bağlı istifadəçiləri yüklə
                                    loadUsersByOrganization(organizationId);
                                    // Digər selectləri sıfırla
                                    resetSelects(['#sobeSelect', '#sektorSelect']);
                                    $('#vezifeInput').val('');
                                    $('#position_id').val('');
                                } else {
                                    resetAllSelects();
                                }
                            });
                            // Şöbə seçildikdə
                            $('#sobeSelect').on('change', function() {
                                var departmentId = $(this).val();
                                console.log('Şöbə seçildi:', departmentId); // Debug üçün
                                if (departmentId) {
                                    // Sektorları yüklə
                                    loadSectors(departmentId);
                                    // Şöbəyə bağlı istifadəçiləri yüklə
                                    loadUsersByDepartment(departmentId);
                                    // Sektor selectini sıfırla
                                    $('#sektorSelect').html('<option selected disabled value="">Sektor seçin...</option>').prop('disabled', true);
                                    $('#vezifeInput').val('');
                                    $('#position_id').val('');
                                } else {
                                    $('#sektorSelect').html('<option selected disabled value="">Əvvəlcə şöbə seçin...</option>').prop('disabled', true);
                                    $('#emekdasSelect').html('<option selected disabled value="">Əvvəlcə bölmə seçin...</option>').prop('disabled', true);
                                    $('#vezifeInput').val('');
                                    $('#position_id').val('');
                                }
                            });
                            // Sektor seçildikdə
                            $('#sektorSelect').on('change', function() {
                                var sectorId = $(this).val();
                                console.log('Sektor seçildi:', sectorId); // Debug üçün
                                if (sectorId) {
                                    // Sektora bağlı istifadəçiləri yüklə
                                    loadUsersBySector(sectorId);
                                    $('#vezifeInput').val('');
                                    $('#position_id').val('');
                                } else {
                                    $('#emekdasSelect').html('<option selected disabled value="">Əvvəlcə bölmə seçin...</option>').prop('disabled', true);
                                    $('#vezifeInput').val('');
                                    $('#position_id').val('');
                                }
                            });
                            // Əməkdaş seçildikdə vəzifəni avtomatik doldur
                            $('#emekdasSelect').on('change', function() {
                                var userId = $(this).val();
                                var selectedOption = $(this).find('option:selected');
                                var positionName = selectedOption.data('position-name');
                                var positionId = selectedOption.data('position-id');
                                console.log('Əməkdaş seçildi:', userId, 'Vəzifə:', positionName); // Debug üçün
                                if (userId && positionName) {
                                    $('#vezifeInput').val(positionName);
                                    $('#position_id').val(positionId);
                                } else if (userId) {
                                    loadPositionByUser(userId);
                                } else {
                                    $('#vezifeInput').val('');
                                    $('#position_id').val('');
                                }
                            });
                            // Şöbələri yüklə
                            function loadDepartments(organizationId) {
                                console.log('Şöbələr yüklənir...'); // Debug üçün
                                $.ajax({
                                    url: '/get-departments-by-organization',
                                    type: 'GET',
                                    data: {
                                        organization_id: organizationId
                                    },
                                    success: function(data) {
                                        console.log('Şöbələr gəldi:', data); // Debug üçün
                                        var sobeSelect = $('#sobeSelect');
                                        sobeSelect.empty();
                                        sobeSelect.append('<option selected disabled value="">Şöbə seçin...</option>');
                                        $.each(data, function(key, department) {
                                            sobeSelect.append('<option value="' + department.id + '">' + department.name + '</option>');
                                        });
                                        sobeSelect.prop('disabled', false);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Şöbələr yüklənərkən xəta:', error);
                                        console.log('Xəta cavabı:', xhr.responseText);
                                    }
                                });
                            }
                            // Sektorları yüklə
                            function loadSectors(departmentId) {
                                console.log('Sektorlar yüklənir...'); // Debug üçün
                                $.ajax({
                                    url: '/get-sectors-by-department',
                                    type: 'GET',
                                    data: {
                                        department_id: departmentId
                                    },
                                    success: function(data) {
                                        console.log('Sektorlar gəldi:', data); // Debug üçün
                                        var sektorSelect = $('#sektorSelect');
                                        sektorSelect.empty();
                                        sektorSelect.append('<option selected disabled value="">Sektor seçin...</option>');
                                        $.each(data, function(key, sector) {
                                            sektorSelect.append('<option value="' + sector.id + '">' + sector.name + '</option>');
                                        });
                                        sektorSelect.prop('disabled', false);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Sektorlar yüklənərkən xəta:', error);
                                        console.log('Xəta cavabı:', xhr.responseText);
                                    }
                                });
                            }
                            // Quruma bağlı istifadəçiləri yüklə
                            function loadUsersByOrganization(organizationId) {
                                console.log('İstifadəçilər yüklənir (qurum)...'); // Debug üçün
                                $.ajax({
                                    url: '/get-users-by-organization',
                                    type: 'GET',
                                    data: {
                                        organization_id: organizationId
                                    },
                                    success: function(data) {
                                        console.log('İstifadəçilər gəldi:', data); // Debug üçün
                                        populateUserSelect(data);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('İstifadəçilər yüklənərkən xəta:', error);
                                    }
                                });
                            }
                            // Şöbəyə bağlı istifadəçiləri yüklə
                            function loadUsersByDepartment(departmentId) {
                                console.log('İstifadəçilər yüklənir (şöbə)...'); // Debug üçün
                                $.ajax({
                                    url: '/get-users-by-department',
                                    type: 'GET',
                                    data: {
                                        department_id: departmentId
                                    },
                                    success: function(data) {
                                        console.log('İstifadəçilər gəldi:', data); // Debug üçün
                                        populateUserSelect(data);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('İstifadəçilər yüklənərkən xəta:', error);
                                    }
                                });
                            }
                            // Sektora bağlı istifadəçiləri yüklə
                            function loadUsersBySector(sectorId) {
                                console.log('İstifadəçilər yüklənir (sektor)...'); // Debug üçün
                                $.ajax({
                                    url: '/get-users-by-sector',
                                    type: 'GET',
                                    data: {
                                        sector_id: sectorId
                                    },
                                    success: function(data) {
                                        console.log('İstifadəçilər gəldi:', data); // Debug üçün
                                        populateUserSelect(data);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('İstifadəçilər yüklənərkən xəta:', error);
                                    }
                                });
                            }
                            // İstifadəçi selectini doldur
                            function populateUserSelect(users) {
                                var emekdasSelect = $('#emekdasSelect');
                                emekdasSelect.empty();
                                if (users && users.length > 0) {
                                    emekdasSelect.append('<option selected disabled value="">Əməkdaş seçin...</option>');
                                    $.each(users, function(key, user) {
                                        emekdasSelect.append('<option value="' + user.id + '" data-position-id="' + (user.position_id || '') + '" data-position-name="' + (user.position_name || '') + '">' + user.full_name + '</option>');
                                    });
                                    emekdasSelect.prop('disabled', false);
                                } else {
                                    emekdasSelect.append('<option selected disabled value="">Bu bölmədə əməkdaş yoxdur</option>');
                                    emekdasSelect.prop('disabled', true);
                                    $('#vezifeInput').val('');
                                    $('#position_id').val('');
                                }
                            }
                            // İstifadəçinin vəzifəsini yüklə
                            function loadPositionByUser(userId) {
                                console.log('Vəzifə yüklənir...'); // Debug üçün
                                $.ajax({
                                    url: '/get-position-by-user',
                                    type: 'GET',
                                    data: {
                                        user_id: userId
                                    },
                                    success: function(data) {
                                        console.log('Vəzifə gəldi:', data); // Debug üçün
                                        if (data && data.position_name) {
                                            $('#vezifeInput').val(data.position_name);
                                            $('#position_id').val(data.position_id);
                                        } else {
                                            $('#vezifeInput').val('Vəzifə tapılmadı');
                                            $('#position_id').val('');
                                        }
                                    },
                                    error: function() {
                                        $('#vezifeInput').val('Xəta baş verdi');
                                        $('#position_id').val('');
                                    }
                                });
                            }
                            // Selectləri sıfırla
                            function resetSelects(selectors) {
                                $.each(selectors, function(index, selector) {
                                    $(selector).html('<option selected disabled value="">Seçin...</option>').prop('disabled', true);
                                });
                            }
                            // Bütün selectləri sıfırla
                            function resetAllSelects() {
                                $('#sobeSelect').html('<option selected disabled value="">Əvvəlcə qurum seçin...</option>').prop('disabled', true);
                                $('#sektorSelect').html('<option selected disabled value="">Əvvəlcə şöbə seçin...</option>').prop('disabled', true);
                                $('#emekdasSelect').html('<option selected disabled value="">Əvvəlcə bölmə seçin...</option>').prop('disabled', true);
                                $('#vezifeInput').val('');
                                $('#position_id').val('');
                            }
                        });
                    </script>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                    <button type="submit" form="kadrForm" class="btn btn-primary">Yadda saxla</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="kadrFormEdit">
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label">Qurum</label>
                                <select class="form-select">
                                    <option disabled>Seçin...</option>
                                    <option>Şəhər Rabitə İdarəsi</option>
                                    <option selected>Ntelecom MMC</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Əməkdaş</label>
                                <select class="form-select">
                                    <option disabled>Seçin...</option>
                                    <option>Abbasov Əli Həsən</option>
                                    <option selected>Süleymanova Günel Alməmməd</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Şöbə</label>
                                <select class="form-select">
                                    <option disabled>Seçin...</option>
                                    <option>Rəqəmsallaşma şöbəsi</option>
                                    <option selected>Maliyyə şöbəsi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Vəzifə</label>
                                <select class="form-select">
                                    <option disabled>Seçin...</option>
                                    <option selected>Aparıcı məsləhətçi</option>
                                    <option>Baş məsləhətçi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-12 col-md-3">
                                <label class="form-label">İşə başlama tarixi</label>
                                <input type="date" class="form-control" value="2018-02-12">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Müqavilə müddəti</label>
                                <input type="text" class="form-control" value="3 ay">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İxtisas dərəcəsi</label>
                                <input type="text" class="form-control" value="1">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">İxtisas verilmə tarixi</label>
                                <input type="date" class="form-control" value="2019-02-12">
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label">Kadrlar uçotunun şəxsi vərəqəsi</label>
                                <input type="file" class="form-control">
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div
                                        class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#" class="text-decoration-none me-2">Shexsi_Vereqe.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Tərcümeyi-hal</label>
                                <input type="file" class="form-control">
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div
                                        class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#" class="text-decoration-none me-2">Tərcümeyi-hal.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Bioqrafik arayış</label>
                                <input type="file" class="form-control">
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div
                                        class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#" class="text-decoration-none me-2">Bioqrafik_arayish.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-12 col-md-4">
                                <label class="form-label">Kadrlar uçotunun şəxsi vərəqəsi (əlavə)</label>
                                <input type="file" class="form-control">
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div
                                        class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#" class="text-decoration-none me-2">Kadr_ucotu_elave.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Dövlət qulluqçusunun şəxsi vərəqəsi</label>
                                <input type="file" class="form-control">
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div
                                        class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#"
                                            class="text-decoration-none me-2">Dovlet_qulluqcusu_verenqe.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">Sertifikatlar (ümumi)</label>
                                <input type="file" class="form-control" multiple>
                                <div class="mt-2">
                                    <label class="form-text fw-semibold">Mövcud sənədlər:</label>
                                    <div
                                        class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                        <a href="#"
                                            class="text-decoration-none me-2">Umumi_sertifikatlar.pdf</a>
                                        <button type="button" class="btn-close btn-sm"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-md-4 mt-3">
                                <div class="card assignees-card shadow-sm border-primary-subtle">
                                    <div class="card-header d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold"><i
                                                class="bi bi-file-earmark-ruled me-2"></i>Əmr</span>
                                        <button type="button" id="btnEditOrder"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="editOrdersWrap" class="vstack gap-3">
                                            <div class="d-flex align-items-center gap-2 assignee-row">
                                                <input type="file" name="orders[]"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-text fw-semibold">Mövcud əmr sənədləri:</label>
                                            <div
                                                class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                                <a href="#" class="text-decoration-none me-2">Emr_01.pdf</a>
                                                <button type="button" class="btn-close btn-sm"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-3">
                                <div class="card assignees-card shadow-sm border-primary-subtle">
                                    <div class="card-header d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold"><i
                                                class="bi bi-file-earmark-medical me-2"></i>Müqavilə</span>
                                        <button type="button" id="btnEditContract"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="editContractsWrap" class="vstack gap-3">
                                            <div class="d-flex align-items-center gap-2 assignee-row">
                                                <input type="file" name="contracts[]"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-text fw-semibold">Mövcud müqavilə sənədləri:</label>
                                            <div
                                                class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                                <a href="#"
                                                    class="text-decoration-none me-2">Muqavile_2022.pdf</a>
                                                <button type="button" class="btn-close btn-sm"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-3">
                                <div class="card assignees-card shadow-sm border-primary-subtle">
                                    <div
                                        class="card-header d-flex можете justify-content-between align-items-center py-2">
                                        <span class="fw-semibold"><i
                                                class="bi bi-file-earmark-text me-2"></i>Sertifikat</span>
                                        <button type="button" id="btnEditCertificate"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="editCertificatesWrap" class="vstack gap-3">
                                            <div class="d-flex align-items-center gap-2 assignee-row">
                                                <input type="file" name="certificates[]"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-text fw-semibold">Mövcud sertifikat sənədləri:</label>
                                            <div
                                                class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light mt-1">
                                                <i class="bi bi-file-earmark-pdf-fill text-danger fs-5 me-2"></i>
                                                <a href="#"
                                                    class="text-decoration-none me-2">Sertifikat_01.pdf</a>
                                                <button type="button" class="btn-close btn-sm"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    function addRow(buttonId, wrapId, inputName) {
        const btn = document.getElementById(buttonId);
        const wrap = document.getElementById(wrapId);
        btn.addEventListener("click", () => {
            const row = document.createElement("div");
            row.className = "d-flex align-items-center gap-2 assignee-row";
            row.innerHTML = `
                <input type="file" name="${inputName}[]" class="form-control form-control-sm">
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
    // Əmr
    addRow("btnAddOrder", "ordersWrap", "orders");
    // Müqavilə
    addRow("btnAddContract", "contractsWrap", "contracts");
    // Sertifikat (yeni)
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
    /* ------------------------
       REDAKTE ET MODAL – dinamik sətirlər (əlavə et modalından ayrı)
    --------------------------- */
    // ƏMR
    addRow("btnEditOrder", "editOrdersWrap", "orders");
    // MÜQAVİLƏ
    addRow("btnEditContract", "editContractsWrap", "contracts");
    // SERTİFİKAT
    addRow("btnEditCertificate", "editCertificatesWrap", "certificates");
</script>
@endsection