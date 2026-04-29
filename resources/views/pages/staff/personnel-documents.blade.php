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
<style>
    .order-row {
        display: flex;
        justify-content: space-between;
        padding: 8px;
        margin-bottom: 6px;
        background: #f8f9fa;
        border: 1px solid #ddd;
    }

    .btn-delete {
        cursor: pointer;
        color: red;
        font-weight: bold;
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
                        data-bs-target="#addKadrModal">
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
                                    <select id="filterqurumSelect" class="form-select">
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
                                    <select id="filtersobeSelect" class="form-select">
                                        <option disabled selected>Seçin...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label">Sektor</label>
                                <div class="input-group">
                                    <select id="filtersektorSelect" class="form-select">
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
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }} {{ $user->father_name }}</td>
                                <td>
                                    {{ $user->orgPosition->organizationDepartment->name ?? '-' }}
                                </td>
                                <td>
                                    {{ $user->orgPosition->position->name ?? '-' }}
                                </td>
                                @php
                                $emp = $user->activeEmployment;
                                @endphp
                                <!-- İşə başlama tarixi -->
                                <td data-order="{{ optional($emp)->start_date }}">
                                    {{ optional($emp)->start_date ? \Carbon\Carbon::parse($emp->start_date)->translatedFormat('d F Y') : '-' }}
                                </td>
                                <!-- Staj -->
                                <td data-order="{{ optional($emp)->start_date }}">
                                    @if($emp && $emp->start_date)
                                    {{ \Carbon\Carbon::parse($emp->start_date)->diffForHumans(null, true) }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <!-- Müqavilə növü -->
                                <td>
                                    @php
                                    $start = \Carbon\Carbon::parse($emp->start_date);
                                    $end = \Carbon\Carbon::parse($emp->end_date);
                                    $diff = $start->diff($end);
                                    $result = [];
                                    if ($diff->y) $result[] = $diff->y . ' il';
                                    if ($diff->m) $result[] = $diff->m . ' ay';
                                    if ($diff->d) $result[] = $diff->d . ' gün';
                                    @endphp
                                    @if(!$emp->end_date)
                                    Müddətsiz
                                    @else
                                    {{ implode(' ', $result) ?: '0 gün' }}
                                    @endif
                                </td>
                                <!-- Placeholder (dərəcə və tarix - əlavə data varsa dəyişərsən) -->
                                <td>
                                    -
                                </td>
                                <!-- Action buttons -->
                                <td class="action-btns">
                                    <button class="btn btn-sm btn-outline-primary me-1"
                                        data-bs-toggle="modal"
                                        data-user-id="{{ $user->id }}"
                                        data-bs-target="#kadrModalEdit"
                                        data-bs-title="Redaktə et">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1"
                                        data-user-id="{{ $user->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kadrModalView">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <a href="#"
                                        data-user-id="{{ $user->id }}"
                                        class="btn btn-sm btn-outline-success"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Endir"
                                        download>
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="{{ route('user.export.word.forma.2', $user->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="tooltip"
                                        data-user-id="{{ $user->id }}"
                                        data-bs-title="Forma 2">
                                        <div>
                                            {!! file_get_contents(public_path('files/css/data/2.svg')) !!}
                                        </div>
                                    </a>
                                    <a href="{{ route('user.export.word.forma.3', $user->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        target="_blank">
                                        <div>
                                            {!! file_get_contents(public_path('files/css/data/3.svg')) !!}
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="tableActionsMobile" class="d-md-none mt-3"></div>
            </div>
        </div>
    </div>
    <!-- Create Modal -->
    <div class="modal fade" id="addkadrModal" tabindex="-1" aria-labelledby="kadrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="kadrModalLabel">Yenisini yarat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                </div>
                <div class="modal-body">
                    <form id="kadrForm" method="POST" enctype="multipart/form-data" action="{{ route('personal.document.store') }}">
                        @csrf
                        <!-- 1-ci KART: Qurum və Əməkdaş Məlumatları -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light py-2">
                                <span class="fw-semibold">
                                    <i class="bi bi-building me-2"></i>Qurum və Əməkdaş məlumatları
                                </span>
                            </div>
                            <div class="card-body py-3">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label class="form-label small fw-semibold">Qurum <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" id="addqurumSelect" name="qurum_id" required>
                                            <option selected disabled value="">Seçin...</option>
                                            @foreach($organizations as $org)
                                            <option value="{{ $org->id }}">{{ $org->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label small fw-semibold">Şöbə</label>
                                        <select class="form-select form-select-sm" id="addsobeSelect" name="sobe_id" disabled>
                                            <option selected disabled value="">Əvvəlcə qurum seçin...</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label small fw-semibold">Sektor</label>
                                        <select class="form-select form-select-sm" id="addsektorSelect" name="sektor_id" disabled>
                                            <option selected disabled value="">Əvvəlcə şöbə seçin...</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label small fw-semibold">Əməkdaş</label>
                                        <select class="form-select form-select-sm" id="emekdasSelect" name="user_id" disabled>
                                            <option selected disabled value="">Əvvəlcə bölmə seçin...</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label small fw-semibold">Vəzifə</label>
                                        <input type="text" class="form-control form-control-sm" id="addvezifeInput" name="position_name" readonly disabled placeholder="Əməkdaş seçildikdə avtomatik dolacaq">
                                        <input type="hidden" id="add_position_id" name="add_position_id">
                                    </div>
                                    <input type="hidden" id="add_selected_user_id" name="user_id" required>
                                </div>
                            </div>
                        </div>
                        <!-- 2-ci KART: Sənəd Məlumatları -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-light py-2">
                                <span class="fw-semibold">
                                    <i class="bi bi-files me-2"></i>Sənəd məlumatları
                                </span>
                            </div>
                            <div class="card-body py-3" id="mediainputs">
                                <!-- 1-ci sıra: 3 əsas sənəd -->
                                <div class="row g-3 mb-3">
                                    @foreach($documentTypes0 as $document_type)
                                    <div class="col-12 col-md-4">
                                        <label class="form-label small fw-semibold">
                                            @if($document_type->icon_class)
                                            <i class="{{ $document_type->icon_class }} me-1"></i>
                                            @endif
                                            {{ $document_type->name }}
                                        </label>
                                        <input
                                            type="file"
                                            class="form-control form-control-sm"
                                            name="{{ $document_type->input_name }}"
                                            data-name="{{ $document_type->input_name }}"
                                            id="add_{{ $document_type->input_name }}"
                                            accept=".pdf"
                                            disabled>
                                        <div
                                            class="chips-container"
                                            id="add_{{ $document_type->input_name }}_Chips">
                                        </div>
                                        @if($document_type->description)
                                        <div class="form-text small">
                                            {{ $document_type->description }}
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                <!-- 3-cü sıra: Əmr, Müqavilə, Sertifikat -->
                                <div class="row g-3">
                                    <div class="row g-3">
                                        @foreach($documentTypes1 as $document_type)
                                        <div class="col-12 col-md-4">
                                            <div class="border rounded p-2">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="fw-semibold small">
                                                        @if($document_type->icon_class)
                                                        <i class="{{ $document_type->icon_class }} me-1"></i>
                                                        @endif
                                                        {{ $document_type->name }}
                                                    </span>
                                                    <button type="button"
                                                        id="btn_{{$document_type->input_name}}"
                                                        class="btn btn-xs btn-outline-primary py-0 px-2"
                                                        disabled>
                                                        <i class="bi bi-plus-lg"></i> Əlavə et
                                                    </button>
                                                </div>
                                                <div id="ordersWrap" class="vstack gap-2">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input
                                                            type="file"
                                                            name="{{ $document_type->input_name }}[]"
                                                            data-name="{{ $document_type->input_name }}"
                                                            class="form-control form-control-sm"
                                                            multiple
                                                            accept=".pdf"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <!-- Nəticə göstəricisi üçün container -->
                                                <div class="chips-container mt-2" id="add_{{ $document_type->input_name }}_Chips"></div>
                                                <div class="form-text small">
                                                    @if($document_type->description)
                                                    {{ $document_type->description }}
                                                    @else
                                                    Bir neçə fayl yükləyə bilərsiniz
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- Footer Butonları -->
                <div class="d-flex justify-content-end gap-2 m-2 pt-2 border-top">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                    <button type="submit" class="btn btn-sm btn-primary">Yadda saxla</button>
                </div>
                <!-- Feedback mesajları burda göstəriləcək -->
                <div id="form-feedback" class="mt-3"></div>
                </form>
                <script id="dynamic-file-input">
                    document.addEventListener('DOMContentLoaded', function() {
                        // Hər bir "Əlavə et" button-u üçün
                        document.querySelectorAll('button[id^="btn_"]').forEach(btn => {
                            btn.addEventListener('click', function() {
                                // button id-dən input_name çıxarılır
                                const inputName = this.id.replace('btn_', '');
                                // wrap element eyni input_name ilə
                                const wrap = this.closest('.border').querySelector('.vstack.gap-2');
                                if (wrap) {
                                    const row = document.createElement('div');
                                    row.className = 'd-flex align-items-center gap-2 assignee-row';
                                    row.innerHTML = `
                                            <input type="file" 
                                            name="${inputName}[]" 
                                            data-name="${inputName}"
                                            class="form-control 
                                            form-control-sm" 
                                            accept=".pdf">
                                            <div class="chips-container mt-2" id="add_${inputName}_Chips"></div>
                                            <button type="button" class="btn btn-sm btn-outline-danger btnRemove">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        `;
                                    wrap.appendChild(row);
                                    // Remove button
                                    row.querySelector('.btnRemove').addEventListener('click', () => {
                                        row.remove();
                                    });
                                }
                            });
                        });
                    });
                </script>
                <script>
                    document.getElementById('kadrForm').addEventListener('submit', function(e) {
                        e.preventDefault(); // ⛔ reload-un qarşısını alır
                        let form = this;
                        let formData = new FormData(form);
                        // Loading göstər
                        Swal.fire({
                            title: 'Yüklənir...',
                            text: 'Zəhmət olmasa gözləyin',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        fetch(form.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                let successMessages = [];
                                let errorMessages = [];
                                // data.uploadResults.forEach(result => {
                                //     let div = document.querySelector('#add_' + result.input_name + '_Chips');
                                //     if (div) {
                                //         div.innerText = result.message;
                                //     }
                                //     if (result.status === 'success') {
                                //         successMessages.push(result.message);
                                //     } else {
                                //         errorMessages.push(result.message || 'Xəta baş verdi');
                                //     }
                                // });
                                // SweetAlert
                                if (errorMessages.length > 0 && successMessages.length > 0) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Qismən tamamlandı',
                                        html: `
                                                <b>Uğurlu:</b><br>${successMessages.join('<br>')}<br><br>
                                                <b>Xətalar:</b><br>${errorMessages.join('<br>')}
                                            `
                                    });
                                } else if (errorMessages.length > 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Xəta',
                                        html: errorMessages.join('<br>')
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Uğurlu',
                                        html: successMessages.join('<br>')
                                    });
                                }
                            })
                            .catch(err => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Server xətası',
                                    text: 'Sorğu zamanı problem yarandı'
                                });
                            });
                    });
                </script>
                <script>
                    document.querySelectorAll('input[type="file"]').forEach(input => {
                        input.addEventListener('change', function() {
                            let formData = new FormData();
                            let inputName = this.dataset.name;
                            // user_id də göndərmək lazımdır
                            formData.append('user_id', document.querySelector('[name="user_id"]').value);
                            // file əlavə et
                            if (this.multiple) {
                                Array.from(this.files).forEach(file => {
                                    formData.append(inputName + '[]', file);
                                });
                            } else {
                                formData.append(inputName, this.files[0]);
                            }
                            fetch("{{ route('validate.document') }}", {
                                    method: "POST",
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                    }
                                })
                                .then(res => {
                                    if (res.status === 422) {
                                        return res.json().then(data => {
                                            showErrors(inputName, data.errors);
                                        });
                                    } else {
                                        clearErrors(inputName);
                                    }
                                });
                        });
                    });

                    function showErrors(inputName, errors) {
                        let container = document.querySelector('#add_' + inputName + '_Chips');
                        if (!container) return;
                        container.innerHTML = '';
                        Object.values(errors).forEach(errArr => {
                            errArr.forEach(msg => {
                                container.innerHTML += `<div class="text-danger form-text small">${msg}</div>`;
                            });
                        });
                    }

                    function clearErrors(inputName) {
                        let container = document.querySelector('#add_' + inputName + '_Chips');
                        if (container) {
                            container.innerHTML = '';
                        }
                    }
                </script>
                <!-- Əlavə CSS -->
                <style>
                    .chips-container {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 0.25rem;
                        margin-top: 0.25rem;
                    }

                    .chip {
                        background-color: #eef2ff;
                        border-radius: 1rem;
                        padding: 0.1rem 0.5rem;
                        font-size: 0.65rem;
                        display: inline-flex;
                        align-items: center;
                        gap: 0.25rem;
                    }

                    .chip i {
                        font-size: 0.65rem;
                        cursor: pointer;
                    }

                    .form-text {
                        font-size: 0.65rem;
                        margin-top: 0.25rem;
                    }

                    .border {
                        border-color: #dee2e6 !important;
                    }
                </style>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js">
                </script>
                <script>
                    $(document).ready(function() {
                        // Qurum seçildikdə
                        $('#addqurumSelect').on('change', function() {
                            var organizationId = $(this).val();
                            var container = $('#mediainputs');
                            if (organizationId) {
                                // Şöbələri yüklə (Quruma bağlı Şöbələr)
                                loadDepartments(organizationId);
                                // Sektorları yüklə (Quruma bağlı birbaşa Sektorlar)
                                loadSectorsByOrganization(organizationId);
                                // Quruma bağlı birbaşa əməkdaşları yüklə
                                loadUsersByOrganization(organizationId);
                                // Vəzifəni təmizlə
                                $('#addvezifeInput').val('');
                                $('#add_position_id').val('');
                                $('#add_selected_user_id').val('');
                                container.find('input, select, textarea, button').prop('disabled', true);
                                container.find('input, select, textarea, button').prop('disabled', true); // User ID hidden inputu təmizlə
                            } else {
                                resetAllSelects();
                            }
                        });
                        // Şöbə seçildikdə
                        $('#addsobeSelect').on('change', function() {
                            var departmentId = $(this).val();
                            var organizationId = $('#addqurumSelect').val();
                            var container = $('#mediainputs');
                            if (departmentId) {
                                // Şöbəyə bağlı Sektorları yüklə (Şöbənin altında olan Sektorlar)
                                loadSectorsByDepartment(departmentId, organizationId);
                                // Şöbəyə bağlı əməkdaşları yüklə
                                loadUsersByDepartment(departmentId);
                                // Vəzifəni təmizlə
                                $('#addvezifeInput').val('');
                                $('#add_position_id').val('');
                                $('#add_selected_user_id').val('');
                                container.find('input, select, textarea, button').prop('disabled', true);
                                container.find('input, select, textarea, button').prop('disabled', true); // User ID hidden inputu təmizlə
                            } else {
                                // Şöbə seçilməyibsə, quruma bağlı sektorları göstər
                                if (organizationId) {
                                    loadSectorsByOrganization(organizationId);
                                    loadUsersByOrganization(organizationId);
                                }
                                $('#addvezifeInput').val('');
                                $('#add_position_id').val('');
                                $('#add_selected_user_id').val('');
                                container.find('input, select, textarea, button').prop('disabled', true);
                                container.find('input, select, textarea, button').prop('disabled', true);
                            }
                        });
                        // Sektor seçildikdə
                        $('#addsektorSelect').on('change', function() {
                            var sectorId = $(this).val();
                            var container = $('#mediainputs');
                            if (sectorId) {
                                // Sektora bağlı əməkdaşları yüklə
                                loadUsersBySector(sectorId);
                                $('#addvezifeInput').val('');
                                $('#add_position_id').val('');
                                $('#add_selected_user_id').val('');
                                container.find('input, select, textarea, button').prop('disabled', true);
                                container.find('input, select, textarea, button').prop('disabled', true);
                            } else {
                                // Sektor seçilməyibsə, hansı bölmə seçilibsə ona bağlı əməkdaşları göstər
                                var organizationId = $('#addqurumSelect').val();
                                var departmentId = $('#addsobeSelect').val();
                                if (departmentId) {
                                    loadUsersByDepartment(departmentId);
                                } else if (organizationId) {
                                    loadUsersByOrganization(organizationId);
                                }
                                $('#addvezifeInput').val('');
                                $('#add_position_id').val('');
                                $('#add_selected_user_id').val('');
                                container.find('input, select, textarea, button').prop('disabled', true);
                                container.find('input, select, textarea, button').prop('disabled', true);
                            }
                        });
                        // Əməkdaş seçildikdə vəzifəni avtomatik doldur və user_id-ni saxla
                        $('#emekdasSelect').on('change', function() {
                            var userId = $(this).val();
                            var selectedOption = $(this).find('option:selected');
                            var positionName = selectedOption.data('position-name');
                            var positionId = selectedOption.data('position-id');
                            var container = $('#mediainputs');
                            if (userId && positionName) {
                                $('#addvezifeInput').val(positionName);
                                $('#add_position_id').val(positionId);
                                $('#add_selected_user_id').val(userId);
                                container.find('input, select, textarea, button').prop('disabled', false);
                                container.find('input, select, textarea, button').prop('disabled', false); // User ID-ni hidden inputda saxla
                            } else if (userId) {
                                loadPositionByUser(userId);
                            } else {
                                $('#addvezifeInput').val('');
                                $('#add_position_id').val('');
                                $('#add_selected_user_id').val('');
                                container.find('input, select, textarea, button').prop('disabled', true);
                                container.find('input, select, textarea, button').prop('disabled', true);
                            }
                        });
                        // Şöbələri yüklə (Quruma bağlı Şöbələr)
                        function loadDepartments(organizationId) {
                            $.ajax({
                                url: '/get-departments-by-organization',
                                type: 'GET',
                                data: {
                                    organization_id: organizationId
                                },
                                success: function(data) {
                                    var addsobeSelect = $('#addsobeSelect');
                                    addsobeSelect.empty();
                                    if (data && data.length > 0) {
                                        addsobeSelect.append('<option selected disabled value="">Şöbə seçin...</option>');
                                        $.each(data, function(key, department) {
                                            addsobeSelect.append('<option value="' + department.id + '">' + department.name + '</option>');
                                        });
                                        addsobeSelect.prop('disabled', false);
                                    } else {
                                        addsobeSelect.append('<option selected disabled value="">Şöbə yoxdur</option>');
                                        addsobeSelect.prop('disabled', true);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Şöbələr yüklənərkən xəta:', error);
                                    var addsobeSelect = $('#addsobeSelect');
                                    addsobeSelect.empty();
                                    addsobeSelect.append('<option selected disabled value="">Xəta baş verdi</option>');
                                    addsobeSelect.prop('disabled', true);
                                }
                            });
                        }
                        // Quruma bağlı birbaşa Sektorları yüklə
                        function loadSectorsByOrganization(organizationId) {
                            $.ajax({
                                url: '/get-sectors-by-organization',
                                type: 'GET',
                                data: {
                                    organization_id: organizationId
                                },
                                success: function(data) {
                                    var addsektorSelect = $('#addsektorSelect');
                                    addsektorSelect.empty();
                                    if (data && data.length > 0) {
                                        addsektorSelect.append('<option selected disabled value="">Sektor seçin...</option>');
                                        $.each(data, function(key, sector) {
                                            addsektorSelect.append('<option value="' + sector.id + '">' + sector.name + '</option>');
                                        });
                                        addsektorSelect.prop('disabled', false);
                                    } else {
                                        addsektorSelect.append('<option selected disabled value="">Sektor yoxdur</option>');
                                        addsektorSelect.prop('disabled', true);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Sektorlar yüklənərkən xəta:', error);
                                    var addsektorSelect = $('#addsektorSelect');
                                    addsektorSelect.empty();
                                    addsektorSelect.append('<option selected disabled value="">Xəta baş verdi</option>');
                                    addsektorSelect.prop('disabled', true);
                                }
                            });
                        }
                        // Şöbəyə bağlı Sektorları yüklə
                        function loadSectorsByDepartment(departmentId, organizationId) {
                            $.ajax({
                                url: '/get-sectors-by-department',
                                type: 'GET',
                                data: {
                                    department_id: departmentId
                                },
                                success: function(data) {
                                    var addsektorSelect = $('#addsektorSelect');
                                    if (data && data.length > 0) {
                                        // Şöbəyə bağlı sektorlar varsa, onları göstər
                                        addsektorSelect.empty();
                                        addsektorSelect.append('<option selected disabled value="">Sektor seçin...</option>');
                                        $.each(data, function(key, sector) {
                                            addsektorSelect.append('<option value="' + sector.id + '">' + sector.name + '</option>');
                                        });
                                        addsektorSelect.prop('disabled', false);
                                    } else {
                                        // Şöbəyə bağlı sektor yoxdursa, sektor selectini tamamilə sıfırla
                                        addsektorSelect.empty();
                                        addsektorSelect.append('<option selected disabled value="">Sektor yoxdur</option>');
                                        addsektorSelect.prop('disabled', true);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Sektorlar yüklənərkən xəta:', error);
                                    var addsektorSelect = $('#addsektorSelect');
                                    addsektorSelect.empty();
                                    addsektorSelect.append('<option selected disabled value="">Xəta baş verdi</option>');
                                    addsektorSelect.prop('disabled', true);
                                }
                            });
                        }
                        // Quruma bağlı əməkdaşları yüklə
                        function loadUsersByOrganization(organizationId) {
                            $.ajax({
                                url: '/get-users-by-organization',
                                type: 'GET',
                                data: {
                                    organization_id: organizationId
                                },
                                success: function(data) {
                                    populateUserSelect(data);
                                },
                                error: function(xhr, status, error) {
                                    console.error('İstifadəçilər yüklənərkən xəta:', error);
                                    var emekdasSelect = $('#emekdasSelect');
                                    emekdasSelect.empty();
                                    emekdasSelect.append('<option selected disabled value="">Xəta baş verdi</option>');
                                    emekdasSelect.prop('disabled', true);
                                }
                            });
                        }
                        // Şöbəyə bağlı əməkdaşları yüklə
                        function loadUsersByDepartment(departmentId) {
                            $.ajax({
                                url: '/get-users-by-department',
                                type: 'GET',
                                data: {
                                    department_id: departmentId
                                },
                                success: function(data) {
                                    populateUserSelect(data);
                                },
                                error: function(xhr, status, error) {
                                    console.error('İstifadəçilər yüklənərkən xəta:', error);
                                    var emekdasSelect = $('#emekdasSelect');
                                    emekdasSelect.empty();
                                    emekdasSelect.append('<option selected disabled value="">Xəta baş verdi</option>');
                                    emekdasSelect.prop('disabled', true);
                                }
                            });
                        }
                        // Sektora bağlı əməkdaşları yüklə
                        function loadUsersBySector(sectorId) {
                            $.ajax({
                                url: '/get-users-by-sector',
                                type: 'GET',
                                data: {
                                    sector_id: sectorId
                                },
                                success: function(data) {
                                    populateUserSelect(data);
                                },
                                error: function(xhr, status, error) {
                                    console.error('İstifadəçilər yüklənərkən xəta:', error);
                                    var emekdasSelect = $('#emekdasSelect');
                                    emekdasSelect.empty();
                                    emekdasSelect.append('<option selected disabled value="">Xəta baş verdi</option>');
                                    emekdasSelect.prop('disabled', true);
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
                                $('#addvezifeInput').val('');
                                $('#add_position_id').val('');
                                $('#add_selected_user_id').val('');
                                container.find('input, select, textarea, button').prop('disabled', true);
                                container.find('input, select, textarea, button').prop('disabled', true);
                            }
                        }
                        // İstifadəçinin vəzifəsini yüklə
                        function loadPositionByUser(userId) {
                            $.ajax({
                                url: '/get-position-by-user',
                                type: 'GET',
                                data: {
                                    user_id: userId
                                },
                                success: function(data) {
                                    if (data && data.position_name) {
                                        $('#addvezifeInput').val(data.position_name);
                                        $('#add_position_id').val(data.position_id);
                                        $('#add_selected_user_id').val(userId);
                                        container.find('input, select, textarea, button').prop('disabled', false);
                                        container.find('input, select, textarea, button').prop('disabled', false);
                                    } else {
                                        $('#addvezifeInput').val('Vəzifə tapılmadı');
                                        $('#add_position_id').val('');
                                        $('#add_selected_user_id').val('');
                                        container.find('input, select, textarea, button').prop('disabled', true);
                                        container.find('input, select, textarea, button').prop('disabled', true);
                                    }
                                },
                                error: function() {
                                    $('#addvezifeInput').val('Xəta baş verdi');
                                    $('#add_position_id').val('');
                                    $('#add_selected_user_id').val('');
                                    container.find('input, select, textarea, button').prop('disabled', true);
                                    container.find('input, select, textarea, button').prop('disabled', true);
                                }
                            });
                        }
                        // Bütün selectləri sıfırla
                        function resetAllSelects() {
                            $('#addsobeSelect').empty();
                            $('#addsobeSelect').append('<option selected disabled value="">Əvvəlcə qurum seçin...</option>');
                            $('#addsobeSelect').prop('disabled', true);
                            $('#addsektorSelect').empty();
                            $('#addsektorSelect').append('<option selected disabled value="">Əvvəlcə qurum seçin...</option>');
                            $('#addsektorSelect').prop('disabled', true);
                            $('#emekdasSelect').empty();
                            $('#emekdasSelect').append('<option selected disabled value="">Əvvəlcə bölmə seçin...</option>');
                            $('#emekdasSelect').prop('disabled', true);
                            $('#addvezifeInput').val('');
                            $('#add_position_id').val('');
                            $('#add_selected_user_id').val('');
                            container.find('input, select, textarea, button').prop('disabled', true);
                            container.find('input, select, textarea, button').prop('disabled', true);
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="kadrModalEdit" tabindex="-1"
        aria-labelledby="kadrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-dark" id="kadrModalh5">
                        </i> Kadr sənədləri - Redaktə et
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                </div>
                <div class="modal-body">
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.querySelectorAll('button[data-bs-target="#kadrModalEdit"]').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    const userId = this.dataset.userId;
                                    const modal = document.querySelector('#kadrModalEdit');
                                    const loader = document.getElementById('page-loader');
                                    [
                                        '#edit-full-name',
                                        '#edit-org-dep-type-name',
                                        '#edit-org-dep-name',
                                        '#edit-user-position',
                                        '#edit-end-date',
                                        '#edit-start-date',
                                        '#edit-contract-no',
                                        '#hiddenUserIdInput'
                                    ].forEach(selector => {
                                        const el = modal.querySelector(selector);
                                        if (!el) {
                                            console.error('Tapılmadı:', selector);
                                        } else {
                                            el.textContent = '';
                                        }
                                    });
                                    const rows = document.querySelectorAll('#editdocumentsTableBody tr');
                                    rows.forEach(row => {
                                        const secondCol = row.querySelector('td:nth-child(2)');
                                        if (secondCol) {
                                            secondCol.innerHTML = '';
                                        }
                                    });
                                    modal.querySelectorAll('.multi-doc-list').forEach(div => {
                                        div.innerHTML = ''; // bütün içindəkiləri silir
                                    });
                                    modal.classList.add("blurred");
                                    Swal.fire({
                                        title: 'Yüklənir...',
                                        text: 'Zəhmət olmasa gözləyin',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        }
                                    });
                                    fetch(`/kadr-ucotu/kadr-senedleri/user/${userId}`)
                                        .then(res => res.json())
                                        .then(user => {
                                            // Modal başlığı
                                            modal.querySelector('.modal-title').textContent = `Redaktə et: ${user.first_name} ${user.last_name}`;
                                            // User sahələri
                                            modal.querySelector('#edit-full-name').textContent = `${user.first_name} ${user.last_name} ${user.father_name}`;
                                            modal.querySelector('#hiddenUserIdInput').value = user.id;
                                            // Active employment sahələri
                                            modal.querySelector('#edit-org-dep-type-name').textContent =
                                                `${user.org_position.organization_department.organization_type?.name}:` ?? 'Şöbə:';
                                            modal.querySelector('#edit-org-dep-name').textContent =
                                                user.org_position.organization_department?.name ?? '-';
                                            modal.querySelector('#edit-user-position').textContent =
                                                user.org_position.position?.name ?? '-';
                                            if (user.active_employment) {
                                                const d = new Date(user.active_employment.start_date);
                                                const formatted =
                                                    String(d.getDate()).padStart(2, '0') + '.' +
                                                    String(d.getMonth() + 1).padStart(2, '0') + '.' +
                                                    d.getFullYear();
                                                modal.querySelector('#edit-start-date').textContent = formatted;
                                                if (user.active_employment?.end_date && user.active_employment?.start_date) {
                                                    const start = new Date(user.active_employment.start_date);
                                                    const end = new Date(user.active_employment.end_date);
                                                    let years = end.getFullYear() - start.getFullYear();
                                                    let months = end.getMonth() - start.getMonth();
                                                    let days = end.getDate() - start.getDate();
                                                    if (days < 0) {
                                                        months--;
                                                        const prevMonth = new Date(end.getFullYear(), end.getMonth(), 0);
                                                        days += prevMonth.getDate();
                                                    }
                                                    if (months < 0) {
                                                        years--;
                                                        months += 12;
                                                    }
                                                    let result = [];
                                                    if (years) result.push(years + ' il');
                                                    if (months) result.push(months + ' ay');
                                                    if (days) result.push(days + ' gün');
                                                    modal.querySelector('#edit-end-date').textContent = result.join(' ') || '0 gün';
                                                } else {
                                                    modal.querySelector('#edit-end-date').textContent = 'Müddətsiz';
                                                }
                                                modal.querySelector('#edit-contract-no').value = user.active_employment.contract_no ?? '-';
                                            } else {
                                                modal.querySelector('#edit-start-date').value = '-';
                                                modal.querySelector('#edit-end-date').value = '-';
                                                modal.querySelector('#edit-contract-no').value = '-';
                                            }
                                            // Documents table
                                            user.documents.forEach(doc => {
                                                if (doc.document_type.is_multiple == 0) {
                                                    // id olduğu halda #
                                                    const td = modal.querySelector(`#edit_files_${doc.document_type?.input_name}`);
                                                    if (!td) return; // əgər tapılmazsa, pass
                                                    const newFileDiv = document.createElement('div');
                                                    newFileDiv.className = 'file-item d-inline-flex align-items-center border rounded px-2 py-1 bg-light';
                                                    newFileDiv.innerHTML = `
                                                    <a href="${doc.file_path}" target="_blank" class="text-decoration-none me-2">
                                                        <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
                                                        ${doc.original_name}
                                                    </a>
                                                    <span class="text-danger fw-bold flex-shrink-0 remove-file-btn-edit" 
                                                    data-doc-id="${doc.id}" 
                                                    style="cursor:pointer;">×</span>
                                                `;
                                                    td.appendChild(newFileDiv);
                                                } else {
                                                    const list = modal.querySelector(`.${doc.document_type?.input_name}-list`);
                                                    const newItem = document.createElement('div');
                                                    newItem.className = 'certificate-item d-flex justify-content-between align-items-center p-2 mb-2 bg-light border rounded';
                                                    newItem.innerHTML = `
                                                                <div class="d-flex justify-content-between align-items-start w-100">
                                                                    <a href="${doc.file_path}" 
                                                                    target="_blank" 
                                                                    class="text-primary me-2" style="word-break: break-word; flex: 1;">
                                                                        <i class="bi bi-file-earmark-text me-2"></i>${doc.original_name}
                                                                    </a>
                                                                    <span class="text-danger fw-bold edit-delete-doc flex-shrink-0" 
                                                                        data-doc-id="${doc.id}" 
                                                                        style="cursor:pointer; margin-left: 10px;">×</span>
                                                                </div>
                                                            `;
                                                    list.appendChild(newItem);
                                                }
                                            });
                                            Swal.close();
                                            modal.classList.remove("blurred");
                                            // Modalı aç (single instance)
                                            const bsModal = bootstrap.Modal.getOrCreateInstance(modal);
                                            bsModal.show();
                                        })
                                        .catch(err => console.error(err));
                                });

                                function escapeHtml(str) {
                                    if (!str) return '';
                                    return str.replace(/[&<>]/g, function(m) {
                                        if (m === '&') return '&amp;';
                                        if (m === '<') return '&lt;';
                                        if (m === '>') return '&gt;';
                                        return m;
                                    });
                                }
                            });
                        });
                    </script>
                    <script>
                        document.body.addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-file-btn-edit')) {
                                const fileDiv = e.target.closest('.file-item');
                                const docId = e.target.getAttribute('data-doc-id');
                                if (!fileDiv) return;
                                // Əgər docId yoxdursa (yeni yüklənmiş fayl)
                                if (!docId || docId === '') {
                                    Swal.fire({
                                        title: "Silmək istəyirsiniz?",
                                        text: "Bu faylı silmək istədiyinizə əminsiniz?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonText: "Bəli, sil!",
                                        cancelButtonText: "Ləğv et",
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            fileDiv.remove();
                                            Swal.fire({
                                                title: "Silindi!",
                                                text: "Fayl uğurla silindi.",
                                                icon: "success",
                                                timer: 1200,
                                                showConfirmButton: false
                                            });
                                        }
                                    });
                                    return;
                                }
                                // DocId varsa (database-də olan fayl)
                                Swal.fire({
                                    title: "Silmək istəyirsiniz?",
                                    text: "Bu faylı silmək istədiyinizə əminsiniz?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: "Bəli, sil!",
                                    cancelButtonText: "Ləğv et",
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        // 🔹 LOADING BURADA
                                        Swal.fire({
                                            title: 'Silinir...',
                                            text: 'Zəhmət olmasa gözləyin',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            didOpen: () => {
                                                Swal.showLoading();
                                            }
                                        });
                                        fetch(`/kadr-ucotu/kadr-senedleri/sened-sil/${docId}`, {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                    'Accept': 'application/json'
                                                }
                                            })
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.success) {
                                                    fileDiv.remove();
                                                    Swal.fire({
                                                        title: "Silindi!",
                                                        text: "Fayl uğurla silindi.",
                                                        icon: "success",
                                                        timer: 1200,
                                                        showConfirmButton: false
                                                    });
                                                } else {
                                                    Swal.fire("Xəta!", "Silinmədi", "error");
                                                }
                                            })
                                            .catch(() => {
                                                Swal.fire("Xəta!", "Server xətası", "error");
                                            });
                                    }
                                });
                            }
                        });
                    </script>
                    <!-- Yuxarı hissə: Fake məlumat kartları -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="border rounded p-3 bg-white h-100">
                                <div class="text-primary mb-2"><i class="bi bi-person-circle"></i> <strong>Şəxsi məlumatlar</strong></div>
                                <div class="small">
                                    <div><span class="text-muted">Ad, soyad, ata adı:</span> <strong id="edit-full-name">-</strong></div>
                                    <div class="mt-1"><span id="edit-org-dep-type-name" class="text-muted">-:</span> <strong id="edit-org-dep-name">-</strong></div>
                                    <div class="mt-1"><span class="text-muted">Vəzifəsi:</span> <strong id="edit-user-position">-</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 bg-white h-100">
                                <div class="text-success mb-2"><i class="bi bi-calendar-event"></i> <strong>Əmək müqaviləsi</strong></div>
                                <div class="small">
                                    <div><span class="text-muted">Müqavilə nömrəsi:</span> <strong id="edit-contract-no">-</strong></div>
                                    <div><span class="text-muted">İşə başlama tarixi:</span> <strong id="edit-start-date">-</strong></div>
                                    <div class="mt-1"><span class="text-muted">Müqavilə müddəti:</span> <strong id="edit-end-date">-</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 bg-white h-100">
                                <div class="text-warning mb-2"><i class="bi bi-award"></i> <strong>İxtisas</strong></div>
                                <div class="small">
                                    <div><span class="text-muted">İxtisas dərəcəsi:</span> <strong>-</strong></div>
                                    <div class="mt-1"><span class="text-muted">Verilmə tarixi:</span> <strong>-</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Aşağı hissə: Sənədlər cədvəli -->
                    <h6 class="border-bottom pb-2 mb-3">Rəqəmsal sənədlər</h6>
                    <div class="table-responsive">
                        <div class="table-responsive mb-4">
                            <!-- Yığcam Sənədlər Cədvəli -->
                            <div class="table-responsive mt-3">
                                <table id="edittable" class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 30%">Sənəd növü</th>
                                            <th style="width: 50%">Mövcud fayl</th>
                                            <th style="width: 20%">Əməliyyatlar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="editdocumentsTableBody">
                                        <!-- $document_type->input_name
                                        $document_type->name
                                        $document_type->icon_class
                                        $document_type->description -->
                                        @foreach($documentTypes0 as $document_type)
                                        <tr data-doc-type="{{$document_type->input_name}}"">
                                            <td class=" fw-semibold" id="edit_title_{{$document_type->input_name}}">{{$document_type->name}}</td>
                                            <td id="edit_files_{{$document_type->input_name}}">
                                            </td>
                                            <td>
                                                <button type="button" id="edit_button_{{$document_type->input_name}}"
                                                    class="btn btn-sm btn-outline-primary add-file-btn"
                                                    data-doc-type="{{$document_type->input_name}}">
                                                    <i class="bi bi-plus-circle me-1"></i> Fayl əlavə et
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <form id="editForm" method="POST" enctype="multipart/form-data" action="{{ route('personal.document.store') }}">
                                @csrf
                                <!-- File əlavə etmək üçün gizli file input -->
                                <input type="file"
                                    id="hiddenFileInputEdit"
                                    style="display: none"
                                    name=""
                                    data-name=""
                                    accept=".pdf"
                                    multiple>
                                <input id="hiddenUserIdInput" type="hidden" name="user_id">
                            </form>
                        </div>
                        <div class="row g-3">
                            @foreach($documentTypes1 as $document_type)
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="{{$document_type->icon_class}} me-2"></i>{{$document_type->name}}</h6>
                                        <button type="button"
                                            class="btn btn-sm btn-light multi-doc-list-btn btn-add-{{$document_type->input_name}}"
                                            data-doc-type="{{$document_type->input_name}}"">
                                            <i class=" bi bi-plus-circle me-1"></i> Əlavə et
                                        </button>
                                    </div>
                                    <div class="card-body multi-doc-list {{$document_type->input_name}}-list" style="max-height: 300px; overflow-y: auto;">
                                        <!-- <div class="certificate-item d-flex justify-content-between align-items-center p-2 mb-2 bg-light border rounded">
                                            <span class="text-primary"><i class="bi bi-file-earmark-text me-2"></i>Python sertifikatı</span>
                                            <span class="text-danger fw-bold btn-delete-certificate" style="cursor:pointer;">×</span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // ========== EDIT MODAL (kadrModalEdit) ÜÇÜN ==========
                                const editFileInput = document.getElementById('hiddenFileInputEdit');
                                const form = document.getElementById('editForm');
                                let editCurrentDocType = null;
                                document.querySelectorAll('.add-file-btn').forEach(btn => {
                                    btn.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                        editCurrentDocType = this.getAttribute('data-doc-type');
                                        editFileInput.setAttribute('name', editCurrentDocType);
                                        editFileInput.setAttribute('data-name', editCurrentDocType);
                                        editFileInput.removeAttribute('multiple');
                                        editFileInput.value = '';
                                        editFileInput.click();
                                    });
                                });
                                editFileInput.addEventListener('change', function(e) {
                                    if (!editCurrentDocType) return;
                                    const files = Array.from(e.target.files);
                                    const container = document.querySelector(`#kadrModalEdit #edit_files_${editCurrentDocType}`);
                                    if (!container) return;
                                    const formData = new FormData(form);
                                    // 🔹 LOADING BURADA
                                    Swal.fire({
                                        title: 'Yüklənir...',
                                        text: 'Zəhmət olmasa gözləyin',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        }
                                    });
                                    fetch(form.action, {
                                            method: 'POST',
                                            body: formData,
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.status === 'success') {
                                                // Hər bir yüklənən fayl üçün
                                                data.uploadResults.forEach((result, index) => {
                                                    const newFileDiv = document.createElement('div');
                                                    newFileDiv.className = 'file-item d-inline-flex align-items-center border rounded px-2 py-1 bg-light';
                                                    newFileDiv.innerHTML = `
                                                        <a href="${result.file_path}" target="_blank"  class="text-decoration-none me-2">
                                                            <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
                                                            ${escapeHtml(result.original_name)}
                                                        </a>
                                                        <span class="text-danger fw-bold flex-shrink-0 remove-file-btn-edit" 
                                                            data-doc-id="${result.doc_id}" 
                                                            style="cursor:pointer;">×</span>
                                                    `;
                                                    container.appendChild(newFileDiv);
                                                });
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Uğurlu!',
                                                    text: data.message,
                                                    timer: 1500,
                                                    showConfirmButton: false
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Xəta!',
                                                    text: data.message
                                                });
                                            }
                                        });
                                    editCurrentDocType = null;
                                });
                                // ========== SERTİFİKAT, ƏMR, MÜQAVİLƏ ƏLAVƏ ETMƏ (Edit Modal) ==========
                                const editModal = document.getElementById('kadrModalEdit');
                                if (editModal) {
                                    document.addEventListener('click', function(e) {
                                        const btn = e.target.closest('.multi-doc-list-btn');
                                        if (!btn) return;
                                        // ən yaxın card (h-100)
                                        const card = btn.closest('.h-100');
                                        if (!card) return;
                                        // həmin card içindəki list
                                        const list = card.querySelector('.multi-doc-list');
                                        if (!list) return;
                                        // Sənəd tipini əldə et (btn-dan və ya card-dan)
                                        let docType = btn.getAttribute('data-doc-type');
                                        if (!docType) {
                                            // card-dan class adı ilə tapmağa çalış
                                            const cardClass = Array.from(card.classList).find(c => c.includes('-list'));
                                            if (cardClass) {
                                                docType = cardClass.replace('-list', '');
                                            }
                                        }
                                        if (!docType) return;
                                        // file input yarat
                                        const fileInput = document.createElement('input');
                                        fileInput.type = 'file';
                                        fileInput.style.display = 'none';
                                        fileInput.setAttribute('multiple', 'multiple');
                                        fileInput.setAttribute('accept', '.pdf');
                                        fileInput.addEventListener('change', function() {
                                            if (this.files.length === 0) return;
                                            const files = Array.from(this.files);
                                            // FormData hazırla
                                            const formData = new FormData();
                                            const userId = document.getElementById('hiddenUserIdInput').value;
                                            formData.append('user_id', userId);
                                            formData.append('_token', document.querySelector('input[name="_token"]').value);
                                            // Faylları əlavə et (hamısını eyni input_name ilə)
                                            files.forEach(file => {
                                                formData.append(`${docType}[]`, file);
                                            });
                                            // Loading göstər
                                            Swal.fire({
                                                title: 'Yüklənir...',
                                                text: 'Zəhmət olmasa gözləyin',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                }
                                            });
                                            // AJAX ilə göndər
                                            fetch('/kadr-ucotu/kadr-senedleri/sened-elave-et', { // və ya form action URL-i
                                                    method: 'POST',
                                                    body: formData,
                                                    headers: {
                                                        'X-Requested-With': 'XMLHttpRequest'
                                                    }
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.status === 'success') {
                                                        // Hər bir yüklənən fayl üçün UI-a əlavə et
                                                        data.uploadResults.forEach((result, index) => {
                                                            const newItem = document.createElement('div');
                                                            newItem.className = 'certificate-item d-flex justify-content-between align-items-center p-2 mb-2 bg-light border rounded';
                                                            newItem.innerHTML = `
                                                                <div class="d-flex justify-content-between align-items-start w-100">
                                                                    <a href="${result.file_path}"
                                                                    target="_blank" 
                                                                    class="text-primary me-2" style="word-break: break-word; flex: 1;">
                                                                        <i class="bi bi-file-earmark-text me-2"></i>${escapeHtml(result.original_name || files[index]?.name)}
                                                                    </a>
                                                                    <span class="text-danger fw-bold edit-delete-doc flex-shrink-0" 
                                                                        data-doc-id="${result.doc_id}" 
                                                                        style="cursor:pointer; margin-left: 10px;">×</span>
                                                                </div>
                                                            `;
                                                            list.appendChild(newItem);
                                                        });
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Uğurlu!',
                                                            text: data.message || `${files.length} fayl uğurla yükləndi`,
                                                            timer: 1500,
                                                            showConfirmButton: false
                                                        });
                                                    } else {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Xəta!',
                                                            text: data.message || 'Fayl yüklənərkən xəta baş verdi'
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Upload error:', error);
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Server xətası!',
                                                        text: 'Fayl yüklənərkən server xətası baş verdi'
                                                    });
                                                });
                                        });
                                        fileInput.click();
                                    });
                                }
                                // ========== SİLMƏ EVENTLƏRİ (Event Delegation) ==========
                                document.body.addEventListener('click', function(e) {
                                    if (e.target.classList.contains('edit-delete-doc')) {
                                        const item = e.target.closest('div.certificate-item');
                                        const docId = e.target.getAttribute('data-doc-id');
                                        if (!item || !docId) return;
                                        confirmDelete(() => {
                                            fetch(`/kadr-ucotu/kadr-senedleri/sened-sil/${docId}`, {
                                                    method: 'DELETE',
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                        'Accept': 'application/json'
                                                    }
                                                })
                                                .then(async res => {
                                                    let text = await res.text();
                                                    console.log("RAW RESPONSE:", text);
                                                    try {
                                                        let data = JSON.parse(text);
                                                        if (data.success) {
                                                            item.remove();
                                                            showSuccessMessage("Element uğurla silindi.");
                                                        } else {
                                                            Swal.fire("Xəta!", data.error ?? "Silinmədi", "error");
                                                        }
                                                    } catch (e) {
                                                        Swal.fire("Server cavabı:", text, "error");
                                                    }
                                                })
                                                .catch(err => {
                                                    Swal.fire("Fetch error", err.message, "error");
                                                });
                                        }, "Element uğurla silindi.");
                                    }
                                });
                                // ========== KÖMƏKÇİ FUNKSİYALAR ==========
                                function confirmDelete(deleteCallback, successMessage) {
                                    Swal.fire({
                                        title: "Silmək istəyirsiniz?",
                                        text: "Bu elementi silmək istədiyinizə əminsiniz?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#d33",
                                        cancelButtonColor: "#6c757d",
                                        confirmButtonText: "Bəli, sil!",
                                        cancelButtonText: "Ləğv et"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire({
                                                title: 'Silinir...',
                                                text: 'Zəhmət olmasa gözləyin',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                }
                                            });
                                            deleteCallback(); // artıq AJAX işləyir
                                        }
                                    });
                                }

                                function showSuccessMessage(message) {
                                    Swal.fire({
                                        title: "Əməliyyat tamamlandı!",
                                        text: message,
                                        icon: "success",
                                        timer: 1300,
                                        showConfirmButton: false
                                    });
                                }

                                function escapeHtml(str) {
                                    if (!str) return '';
                                    return str.replace(/[&<>]/g, function(m) {
                                        if (m === '&') return '&amp;';
                                        if (m === '<') return '&lt;';
                                        if (m === '>') return '&gt;';
                                        return m;
                                    });
                                }
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                </div>
            </div>
        </div>
    </div>
    <!-- VIEW MODAL - -->
    <div class="modal fade" id="kadrModalView" tabindex="-1"
        aria-labelledby="kadrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-dark" id="kadrModalh5">
                        </i> Kadr sənədləri - Redaktə et
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                </div>
                <div class="modal-body">
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.querySelectorAll('button[data-bs-target="#kadrModalView"]').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    console.log("clicki aldi")
                                    const userId = this.dataset.userId;
                                    const modal = document.querySelector('#kadrModalView');
                                    [
                                        '#view-full-name',
                                        '#view-org-dep-type-name',
                                        '#view-org-dep-name',
                                        '#view-user-position',
                                        '#view-end-date',
                                        '#view-start-date',
                                        '#view-contract-no',
                                    ].forEach(selector => {
                                        const el = modal.querySelector(selector);
                                        if (!el) {
                                            console.error('Tapılmadı:', selector);
                                        } else {
                                            el.textContent = '';
                                        }
                                    });
                                    const rows = document.querySelectorAll('#viewdocumentsTableBody tr');
                                    rows.forEach(row => {
                                        const secondCol = row.querySelector('td:nth-child(2)');
                                        if (secondCol) {
                                            secondCol.innerHTML = '';
                                        }
                                    });
                                    modal.querySelectorAll('.multi-doc-list').forEach(div => {
                                        div.innerHTML = ''; // bütün içindəkiləri silir
                                    });
                                    Swal.fire({
                                        title: 'Yüklənir...',
                                        text: 'Zəhmət olmasa gözləyin',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        }
                                    });
                                    fetch(`/kadr-ucotu/kadr-senedleri/user/${userId}`)
                                        .then(res => res.json())
                                        .then(user => {
                                            // Modal başlığı
                                            modal.querySelector('.modal-title').textContent = `Redaktə et: ${user.first_name} ${user.last_name}`;
                                            // User sahələri
                                            modal.querySelector('#view-full-name').textContent = `${user.first_name} ${user.last_name} ${user.father_name}`;
                                            // Active employment sahələri
                                            modal.querySelector('#view-org-dep-type-name').textContent =
                                                `${user.org_position.organization_department.organization_type?.name}:` ?? 'Şöbə:';
                                            modal.querySelector('#view-org-dep-name').textContent =
                                                user.org_position.organization_department?.name ?? '-';
                                            modal.querySelector('#view-user-position').textContent =
                                                user.org_position.position?.name ?? '-';
                                            if (user.active_employment) {
                                                const d = new Date(user.active_employment.start_date);
                                                const formatted =
                                                    String(d.getDate()).padStart(2, '0') + '.' +
                                                    String(d.getMonth() + 1).padStart(2, '0') + '.' +
                                                    d.getFullYear();
                                                modal.querySelector('#view-start-date').textContent = formatted;
                                                if (user.active_employment?.end_date && user.active_employment?.start_date) {
                                                    const start = new Date(user.active_employment.start_date);
                                                    const end = new Date(user.active_employment.end_date);
                                                    let years = end.getFullYear() - start.getFullYear();
                                                    let months = end.getMonth() - start.getMonth();
                                                    let days = end.getDate() - start.getDate();
                                                    if (days < 0) {
                                                        months--;
                                                        const prevMonth = new Date(end.getFullYear(), end.getMonth(), 0);
                                                        days += prevMonth.getDate();
                                                    }
                                                    if (months < 0) {
                                                        years--;
                                                        months += 12;
                                                    }
                                                    let result = [];
                                                    if (years) result.push(years + ' il');
                                                    if (months) result.push(months + ' ay');
                                                    if (days) result.push(days + ' gün');
                                                    modal.querySelector('#view-end-date').textContent = result.join(' ') || '0 gün';
                                                } else {
                                                    modal.querySelector('#view-end-date').textContent = 'Müddətsiz';
                                                }
                                                modal.querySelector('#view-contract-no').value = user.active_employment.contract_no ?? '-';
                                            } else {
                                                modal.querySelector('#view-start-date').value = '-';
                                                modal.querySelector('#view-end-date').value = '-';
                                                modal.querySelector('#view-contract-no').value = '-';
                                            }
                                            // Documents table
                                            user.documents.forEach(doc => {
                                                if (doc.document_type.is_multiple == 0) {
                                                    // id olduğu halda #
                                                    const td = modal.querySelector(`#view_files_${doc.document_type?.input_name}`);
                                                    if (!td) return; // əgər tapılmazsa, pass
                                                    const newFileDiv = document.createElement('div');
                                                    newFileDiv.className = 'file-item d-inline-flex align-items-center border rounded px-2 py-1 bg-light';
                                                    newFileDiv.innerHTML = `
                                                    <a href="${doc.file_path}" target="_blank" class="text-decoration-none me-2">
                                                        <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
                                                        ${doc.original_name}
                                                    </a>
                                                `;
                                                    td.appendChild(newFileDiv);
                                                } else {
                                                    const list = modal.querySelector(`.${doc.document_type?.input_name}-list`);
                                                    const newItem = document.createElement('div');
                                                    newItem.className = 'certificate-item d-flex justify-content-between align-items-center p-2 mb-2 bg-light border rounded';
                                                    newItem.innerHTML = `
                                                                <div class="d-flex justify-content-between align-items-start w-100">
                                                                    <a href="${doc.file_path}" 
                                                                    target="_blank" 
                                                                    class="text-primary me-2" style="word-break: break-word; flex: 1;">
                                                                        <i class="bi bi-file-earmark-text me-2"></i>${doc.original_name}
                                                                    </a>
                                                                </div>
                                                            `;
                                                    list.appendChild(newItem);
                                                }
                                            });
                                            Swal.close();
                                            // Modalı aç (single instance)
                                            const bsModal = bootstrap.Modal.getOrCreateInstance(modal);
                                            bsModal.show();
                                        })
                                        .catch(err => console.error(err));
                                });

                                function escapeHtml(str) {
                                    if (!str) return '';
                                    return str.replace(/[&<>]/g, function(m) {
                                        if (m === '&') return '&amp;';
                                        if (m === '<') return '&lt;';
                                        if (m === '>') return '&gt;';
                                        return m;
                                    });
                                }
                            });
                        });
                    </script>
                    <script>
                        document.body.addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-file-btn-view')) {
                                const fileDiv = e.target.closest('.file-item');
                                const docId = e.target.getAttribute('data-doc-id');
                                if (!fileDiv) return;
                                // Əgər docId yoxdursa (yeni yüklənmiş fayl)
                                if (!docId || docId === '') {
                                    Swal.fire({
                                        title: "Silmək istəyirsiniz?",
                                        text: "Bu faylı silmək istədiyinizə əminsiniz?",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonText: "Bəli, sil!",
                                        cancelButtonText: "Ləğv et",
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            fileDiv.remove();
                                            Swal.fire({
                                                title: "Silindi!",
                                                text: "Fayl uğurla silindi.",
                                                icon: "success",
                                                timer: 1200,
                                                showConfirmButton: false
                                            });
                                        }
                                    });
                                    return;
                                }
                                // DocId varsa (database-də olan fayl)
                                Swal.fire({
                                    title: "Silmək istəyirsiniz?",
                                    text: "Bu faylı silmək istədiyinizə əminsiniz?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: "Bəli, sil!",
                                    cancelButtonText: "Ləğv et",
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        Swal.fire({
                                            title: 'Silinir...',
                                            text: 'Zəhmət olmasa gözləyin',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            didOpen: () => {
                                                Swal.showLoading();
                                            }
                                        });
                                        fetch(`/kadr-ucotu/kadr-senedleri/sened-sil/${docId}`, {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                    'Accept': 'application/json'
                                                }
                                            })
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.success) {
                                                    fileDiv.remove();
                                                    Swal.fire({
                                                        title: "Silindi!",
                                                        text: "Fayl uğurla silindi.",
                                                        icon: "success",
                                                        timer: 1200,
                                                        showConfirmButton: false
                                                    });
                                                } else {
                                                    Swal.fire("Xəta!", "Silinmədi", "error");
                                                }
                                            })
                                            .catch(() => {
                                                Swal.fire("Xəta!", "Server xətası", "error");
                                            });
                                    }
                                });
                            }
                        });
                    </script>
                    <!-- Yuxarı hissə: Fake məlumat kartları -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="border rounded p-3 bg-white h-100">
                                <div class="text-primary mb-2"><i class="bi bi-person-circle"></i> <strong>Şəxsi məlumatlar</strong></div>
                                <div class="small">
                                    <div><span class="text-muted">Ad, soyad, ata adı:</span> <strong id="view-full-name">-</strong></div>
                                    <div class="mt-1"><span id="view-org-dep-type-name" class="text-muted">-:</span> <strong id="view-org-dep-name">-</strong></div>
                                    <div class="mt-1"><span class="text-muted">Vəzifəsi:</span> <strong id="view-user-position">-</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 bg-white h-100">
                                <div class="text-success mb-2"><i class="bi bi-calendar-event"></i> <strong>Əmək müqaviləsi</strong></div>
                                <div class="small">
                                    <div><span class="text-muted">Müqavilə nömrəsi:</span> <strong id="view-contract-no">-</strong></div>
                                    <div><span class="text-muted">İşə başlama tarixi:</span> <strong id="view-start-date">-</strong></div>
                                    <div class="mt-1"><span class="text-muted">Müqavilə müddəti:</span> <strong id="view-end-date">-</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 bg-white h-100">
                                <div class="text-warning mb-2"><i class="bi bi-award"></i> <strong>İxtisas</strong></div>
                                <div class="small">
                                    <div><span class="text-muted">İxtisas dərəcəsi:</span> <strong>-</strong></div>
                                    <div class="mt-1"><span class="text-muted">Verilmə tarixi:</span> <strong>-</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Aşağı hissə: Sənədlər cədvəli -->
                    <h6 class="border-bottom pb-2 mb-3">Rəqəmsal sənədlər</h6>
                    <div class="table-responsive">
                        <div class="table-responsive mb-4">
                            <!-- Yığcam Sənədlər Cədvəli -->
                            <div class="table-responsive mt-3">
                                <table id="viewtable" class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 35%">Sənəd növü</th>
                                            <th style="width: 65%">Mövcud fayl</th>
                                        </tr>
                                    </thead>
                                    <tbody id="viewdocumentsTableBody">

                                        @foreach($documentTypes0 as $document_type)
                                        <tr data-doc-type="{{$document_type->input_name}}"">
                                            <td class=" fw-semibold" id="view_title_{{$document_type->input_name}}">{{$document_type->name}}</td>
                                            <td id="view_files_{{$document_type->input_name}}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row g-3">
                            @foreach($documentTypes1 as $document_type)
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><i class="{{$document_type->icon_class}} me-2"></i>{{$document_type->name}}</h6>
                                    </div>
                                    <div class="card-body multi-doc-list {{$document_type->input_name}}-list" style="max-height: 300px; overflow-y: auto;">
                                        <!-- <div class="certificate-item d-flex justify-content-between align-items-center p-2 mb-2 bg-light border rounded">
                                            <span class="text-primary"><i class="bi bi-file-earmark-text me-2"></i>Python sertifikatı</span>
                                            <span class="text-danger fw-bold btn-delete-certificate" style="cursor:pointer;">×</span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
        class="bi bi-arrow-up-short"></i></a>
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