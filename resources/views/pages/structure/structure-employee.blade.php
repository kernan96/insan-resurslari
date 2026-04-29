@extends('layouts.index')
@section('css')
<style>
    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h1 {
        color: #2c3e50;
        font-size: 28px;
        margin-bottom: 8px;
    }

    .header p {
        color: #7f8c8d;
        font-size: 16px;
    }

    .range-container {
        position: relative;
        width: 100%;
        height: 100px;
        margin-bottom: 40px;
    }

    .slider-track {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 8px;
        background-color: #e0e0e0;
        border-radius: 4px;
        transform: translateY(-50%);
        z-index: 1;
    }

    .slider-range {
        position: absolute;
        top: 50%;
        height: 8px;
        background: #3498db;
        border-radius: 4px;
        transform: translateY(-50%);
        z-index: 2;
    }

    input[type="range"] {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 8px;
        -webkit-appearance: none;
        background: transparent;
        transform: translateY(-50%);
        z-index: 3;
        pointer-events: none;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background-color: white;
        border: 3px solid #3498db;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        pointer-events: auto;
        transition: all 0.2s ease;
    }

    input[type="range"]::-webkit-slider-thumb:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
    }

    input[type="range"]::-moz-range-thumb {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background-color: white;
        border: 3px solid #3498db;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        pointer-events: auto;
        transition: all 0.2s ease;
    }

    input[type="range"]::-moz-range-thumb:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
    }

    #minSlider1 {
        z-index: 4;
    }

    #minSlider1::-webkit-slider-thumb {
        border-color: #3498db;
    }

    #maxSlider1 {
        z-index: 5;
    }

    #maxSlider1::-webkit-slider-thumb {
        border-color: #3498db;
    }

    .slider-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        color: #7f8c8d;
        font-size: 14px;
    }

    .values-container {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .value-box {
        text-align: center;
        flex: 1;
        padding: 15px;
        background-color: white;
        border-radius: 10px;
        margin: 0 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .value-title {
        font-size: 16px;
        color: #7f8c8d;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .value-title i {
        color: #3498db;
    }

    .value-display {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
    }

    .instructions {
        margin-top: 25px;
        padding: 15px;
        background-color: #f1f8ff;
        border-radius: 10px;
        font-size: 14px;
        color: #5a6c7d;
        text-align: center;
        border-left: 4px solid #3498db;
    }

    .instructions i {
        color: #3498db;
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .values-container {
            flex-direction: column;
            gap: 15px;
        }

        .value-box {
            margin: 0;
        }

        .header h1 {
            font-size: 24px;
        }

        .value-display {
            font-size: 28px;
        }
    }
</style>
<style>
    input.form-control[type="file"][name="profile_photo_path"] {
        font-size: 0.75rem;
        line-height: 1.5;
    }

    .is-invalid {
        border-color: #dc3545 !important;
        background-image: none !important;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
</style>
@endsection
@section('content')
<main class="main blurred" id="main">
    <div class="main">
        <section class="section"></section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">Qurum məlumatları
                    <a href="#" class="btn btn-light " id="editModal" data-bs-toggle="modal"
                        data-bs-target="#editOrgContactModal">
                        <i class="fas fa-edit text-primary"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="col-12 row pt-3" id="org_info">
                        <div class="col-6">
                            <span>Qurum adı: {{ $org_dep->name }}<br></span>
                            @foreach ($types as $type)
                            @if ($type->id == $org_dep->organization_type_id)
                            <span>Qurum növü: {{ $type->name }}<br></span>
                            @endif
                            @endforeach
                            <span>Qurum qısa adı: {{ $org_dep->short_name }}<br></span>
                        </div>
                        <div class="col-6">
                            <span>Ünvan: {{ $org_dep->address }}<br></span>
                            <span>E-poçt ünvanı: {{ $org_dep->email }}<br></span>
                            <span>Fax: {{ $org_dep->fax }}<br></span>
                            <span>Telefon: {{ $org_dep->phone }}<br></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div
                            class="d-flex flex-wrap align-items-start justify-content-between mt-2 mt-md-0 gap-2 mb-3">
                            <span>Vəzifələr</span>
                            <a href="javascript:void(0)" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#addPositionModal">
                                <i class="uil uil-plus me-1"></i> Yenisini yarat
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <table class="table text-center" style="width: 100%; table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th style="width: 10%; text-align: center;">№</th>
                                    <th style="text-align: center;">Vəzifə Adı</th>
                                    <th style="width: 15%; text-align: center;">Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody id="position_table">
                                @foreach ($org_pos as $position)
                                <tr>
                                    <td style="width: 10%; text-align: center;">{{ $loop->iteration }}</td>
                                    <td style="text-align: center;" pos-id="{{ $position->position->id }}">
                                        {{ $position->position->name }}
                                    </td>
                                    <td style="width: 15%; text-align: center;">
                                        <div style="display: flex; justify-content: center; gap: 5px;">
                                            {{-- Edit --}}
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-primary position-edit-btn"
                                                data-position-id="{{ $position->position->id }}"
                                                data-position-name="{{ $position->position->name }}"
                                                data-org-pos-id="{{ $position->id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPositionModal">
                                                <i class="fas fa-edit" title="Redaktə et"></i>
                                            </a>
                                            {{-- Delete --}}
                                            @php
                                            $orgPos = $org_pos->firstWhere('position_id', $position->id);
                                            @endphp
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-danger delete_position"
                                                data-org-pos-id="{{ $position->id }}">
                                                <i class="fas fa-trash" title="Sil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card">
                            <div class="card-header">
                                <div
                                    class="d-flex flex-wrap align-items-start justify-content-between mt-2 mt-md-0 gap-2 mb-3">
                                    <span>Qurum</span>
                                    <a href="javascript:void(0)" class="btn btn-light create_organization" data-id="1959"
                                        data-bs-toggle="modal" data-bs-target="#createOrganizationModal">
                                        <i class="uil uil-plus me-1"></i> Tabe qurum əlavə et
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table text-center">
                                    <tbody>
                                        <tr class="person">
                                            <td>Naxçıvan Muxtar Respublikasının Rəqəmsal
                                                İnkişaf və Nəqliyyat Nazirliyinin "Naxçıvan Avtomobil Nəqliyyatı
                                                Agentliyi" publik hüquqi şəxsi</td>
                                        </tr>
                                        <tr class="person">
                                            <td>Naxçıvan Muxtar Respublikasının Rəqəmsal İnkişaf və Nəqliyyat
                                                Nazirliyinin "Naxçıvanpoçt" Məhdud Məsuliyyətli Cəmiyyəti</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
            </div>
            <div class="col-12" style="max-height:600px;overflow-x:auto;">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Əməkdaşlar
                            <div class="col-md-12">
                                <div
                                    class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                                    <button class="btn bg-info btn-sm d-flex align-items-center text-white"
                                        data-bs-toggle="collapse" data-bs-target="#filterPanel" aria-expanded="false"
                                        aria-controls="filterPanel">
                                        <i class="bi bi-funnel me-1"></i> Axtarış filteri
                                    </button>
                                    <a href="javascript:void(0)" class="btn btn-light" id="contactModal"
                                        data-bs-toggle="modal" data-bs-target="#addContactModal">
                                        <i class="uil uil-plus me-1"></i> Yenisini yarat
                                    </a>
                                </div>
                            </div>
                            <!-- 2) Filtr paneli-->
                            <div id="filterPanel" class="collapse mt-3">
                                <div class="card card-body p-3">
                                    <form id="filtersForm" class="row g-3">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">Vəzifəsi</label>
                                                <div class="input-group">
                                                    <select name="org_position_id" id="filter_org_position_id" class="form-select org_position_class"
                                                        required>
                                                        <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                                        @foreach ($org_pos as $position)
                                                        <option value="{{ $position->position->id }}"
                                                            {{ old('org_position_id') == $position->position->id ? 'selected' : '' }}>
                                                            {{ $position->position->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">Qurum/Şöbə</label>
                                                <div class="input-group">
                                                    <select name="org_org_dep_id" id="filter_org_dep_id" class="form-select"
                                                        required>
                                                        <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="form-label">Cinsiyyət</label>
                                                <div class="input-group">
                                                    <select class="form-select">
                                                        <option selected disabled>Seçin...</option>
                                                        <option>Kişi</option>
                                                        <option>Qadın</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12 col-md-2">
                                                <label class="form-label">Maaş</label>
                                                <input type="number" class="form-control" placeholder="">
                                            </div> -->
                                            <div class="col-12 col-md-2">
                                                <label class="form-label">İşə başlama tarixi</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <label class="form-label">Bitmə tarixi</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="selected-range" id="selected-range-age">
                                                    Yaş Aralığı: <span id="minRangeAge">0</span> - <span id="maxRangeAge">65</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <div class="range-container">
                                                    <div class="slider-track"></div>
                                                    <div class="slider-range" id="rangeAge"></div>
                                                    <input type="range" min="0" max="65" value="0" class="slider" id="minSliderAge">
                                                    <input type="range" min="0" max="65" value="65" class="slider" id="maxSliderAge">
                                                    <div class="slider-labels">
                                                        <span>0</span>
                                                        <span>5</span>
                                                        <span>10</span>
                                                        <span>15</span>
                                                        <span>20</span>
                                                        <span>25</span>
                                                        <span>30</span>
                                                        <span>45</span>
                                                        <span>40</span>
                                                        <span>45</span>
                                                        <span>50</span>
                                                        <span>55</span>
                                                        <span>60</span>
                                                        <span>65</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <div class="selected-range" id="selected-range-salary">
                                                    Maaş Aralığı: <span id="minRangeSalary">0</span> - <span id="maxRangeSalary">65</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <div class="range-container">
                                                    <div class="slider-track"></div>
                                                    <div class="slider-range" id="rangeSalary"></div>
                                                    <input type="range" min="0" max="5000" value="0" class="slider" id="minSliderSalary">
                                                    <input type="range" min="0" max="5000" value="5000" class="slider" id="maxSliderSalary">
                                                    <div class="slider-labels">
                                                        <span>0</span>
                                                        <span>500</span>
                                                        <span>1000</span>
                                                        <span>1500</span>
                                                        <span>2000</span>
                                                        <span>2500</span>
                                                        <span>3000</span>
                                                        <span>3500</span>
                                                        <span>4000</span>
                                                        <span>4500</span>
                                                        <span>5000</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table text-center" style="font-size:0.8rem">
                                <thead>
                                    <tr>
                                        <th scope="col">Şəxs</th>
                                        <th scope="col">FIN</th>
                                        <th scope="col">Vəzifəsi</th>
                                        <th scope="col">Maaş</th>
                                        <th scope="col">Doğum tarixi</th>
                                        <th scope="col">İşə başlama tarixi</th>
                                        <th scope="col">Bitmə tarixi</th>
                                        <th scope="col">Partiyalılığı</txh>
                                        <th scope="col">Orden</th>
                                        <th scope="col">Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody id="employee-table">
                                    @foreach ($employees as $emp)
                                    @php
                                    $employment = $emp->employments->first();
                                    @endphp
                                    @isset($employment->start_date)
                                    <tr class="person">
                                        {{-- Ad Soyad (Ata adı istəsən əlavə et) --}}
                                        <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                                        {{-- FIN --}}
                                        <td>{{ $emp->fin }}</td>
                                        {{-- Vəzifə (hazırda select etməmisən; əlaqə varsa belə göstər) --}}
                                        <td data-org-pos-id="{{$emp->orgPosition?->id}}">{{ $emp->orgPosition?->position?->name ?? '-' }}</td>
                                        {{-- Maaş --}}
                                        <td>
                                            @php
                                            $salary = $emp->salary;
                                            if ($salary === null) {
                                            echo '-';
                                            } else {
                                            $parts = explode('.', number_format((float)$salary, 2, '.', ''));
                                            $int = $parts[0];
                                            $dec = rtrim($parts[1], '0');
                                            echo $int . ($dec !== '' ? '.' . $dec : '') . ' ₼';
                                            }
                                            @endphp
                                        </td>
                                        {{-- Doğum tarixi --}}
                                        <td>{{ $emp->birth_date?->format('Y-m-d') ?? '-' }}</td>
                                        {{-- İşə başlama --}}
                                        <td>{{ $emp->start_date?->format('Y-m-d') ?? '-' }}</td>
                                        {{-- İşdən çıxma --}}
                                        <td>{{ $emp->end_date?->format('Y-m-d') ?? '-' }}</td>
                                        {{-- Partiya qısa adı --}}
                                        <td>{{ $emp->party_short_name ?? '-' }}</td>
                                        {{-- Orden (bool) --}}
                                        <td>{{ $emp->ordenbool ? '+' : '-' }}</td>
                                        <td>
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-primary person-edit-btn"
                                                    data-user-id="{{ $emp->id }}"
                                                    data-user-first_name="{{ $emp->first_name }}"
                                                    data-user-last_name="{{ $emp->last_name }}"
                                                    data-user-father_name="{{ $emp->father_name }}"
                                                    data-user-fin="{{ $emp->fin }}"
                                                    data-user-username="{{ $emp->username }}"
                                                    data-user-email="{{ $emp->email }}"
                                                    data-user-role-id="{{ $emp->role_id }}"
                                                    data-user-org-position-id="{{ $emp->org_position_id }}"
                                                    data-user-birth_date="{{ $emp->birth_date }}"
                                                    data-user-gender="{{ $emp->gender }}"
                                                    data-user-profile-photo-path="{{ $emp->profile_photo_path }}"
                                                    data-user-registered-address="{{ $emp->registered_address }}"
                                                    data-user-residential-address="{{ $emp->residential_address }}"
                                                    data-user-birth-place="{{ $emp->birth_place }}"
                                                    data-user-citizen="{{ $emp->citizen }}"
                                                    data-user-serial-no="{{ $emp->serial_no}}"
                                                    data-user-sin="{{ $emp->sin}}"
                                                    data-user-note="{{ $emp->note}}"
                                                    data-user-emp-id="{{ $employment->id }}"
                                                    data-user-salary="{{ $employment->salary ?? '' }}"
                                                    data-user-start-date="{{ $employment->start_date ?? '' }}"
                                                    data-user-end-date="{{ $employment->end_date ?? '' }}"
                                                    data-user-emp-type-id="{{ $employment->emp_type_id ?? '' }}"
                                                    data-user-contract-no="{{ $employment->contract_no ?? '' }}"
                                                    data-user-emp-note="{{ $employment->note ?? '' }}"
                                                    data-user-marital-status="{{ $emp->marital_status}}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateContactModal">
                                                    <i class="fas fa-edit" title="Redaktə et"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-danger archive_person"
                                                    data-user-emp-id="{{ $employment->id }}"
                                                    data-url="{{ route('structure.employment.archive') }}">
                                                    <i class="bi bi-folder" title="Arxivlə"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-primary employment-btn"
                                                    data-user-id="{{ $emp->id }}"
                                                    data-user-first-name="{{ $emp->first_name }}"
                                                    data-user-last-name="{{ $emp->last_name }}"
                                                    data-user-father-name="{{ $emp->father_name }}"

                                                    data-user-org-position-id="{{ $emp->org_position_id }}"
                                                    data-user-emp-id="{{ $employment->id }}"
                                                    data-user-salary="{{ $employment->salary ?? '' }}"
                                                    data-user-start-date="{{ $employment->start_date ?? '' }}"
                                                    data-user-end-date="{{ $employment->end_date ?? '' }}"
                                                    data-user-emp-type-id="{{ $employment->emp_type_id ?? '' }}"
                                                    data-user-contract-no="{{ $employment->contract_no ?? '' }}"
                                                    data-user-note="{{ $employment->note ?? '' }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addEmploymentModal">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-primary forma-btn"
                                                    data-user-id="{{ $emp->id }}"
                                                    data-user-first-name="{{ $emp->first_name }}"
                                                    data-user-last-name="{{ $emp->last_name }}"
                                                    data-user-father-name="{{ $emp->father_name }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addFormaInfoModal">
                                                    <i class="bi bi-file-earmark"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-primary role-btn"
                                                    data-user-id="{{ $emp->id }}"
                                                    data-user-role-id="{{ $emp->role_id }}"
                                                    data-user-first_name="{{ $emp->first_name }}"
                                                    data-user-last_name="{{ $emp->last_name }}"
                                                    data-user-father_name="{{ $emp->father_name }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#roleModal">
                                                    <i class="bi bi-shield-lock"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endisset
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    {{-- <div class="card">
                            <div class="card-header">
                                <div
                                    class="d-flex flex-wrap align-items-start justify-content-between mt-2 mt-md-0 gap-2 mb-3">
                                    <span>Şöbə</span>
                                    <a href="javascript:void(0)" class="btn btn-light create_organization" data-id="1959"
                                        data-bs-toggle="modal" data-bs-target="#createDepartmentModal">
                                        <i class="uil uil-plus me-1"></i> Şöbə əlavə et
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table text-center">
                                    <tbody>
                                        <tr class="person">
                                            <td>Texnoloji inkişaf şöbəsi</td>
                                        </tr>
                                        <tr class="person">
                                            <td>İnformasiya kommunikasiya texnologiyaları və rəqəmsallaşma şöbəsi
                                            </td>
                                        </tr>
                                        <tr class="person">
                                            <td>Maliyyə və təchizat şöbəsi</td>
                                        </tr>
                                        <tr class="person">
                                            <td>İnsan resursları, hüquq, sənədlərlə və müraciətlərlə iş şöbəsi</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    {{-- <div class="card">
                            <div class="card-header">
                                <div
                                    class="d-flex flex-wrap align-items-start justify-content-between mt-2 mt-md-0 gap-2 mb-3">
                                    <span>Sektor</span>
                                    <a href="javascript:void(0)" class="btn btn-light create_organization" data-id="1959"
                                        data-bs-toggle="modal" data-bs-target="#createSectorModal">
                                        <i class="uil uil-plus me-1"></i> Sektor əlavə et
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table text-center">
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                </div>
            </div>
            <div class="modal fade custom-backdrop" id="addContactModal" tabindex="-1"
                aria-labelledby="addContactModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addContactModalLabel">Yeni əməkdaş əlavə et</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="add-new-employee" method="POST" enctype="multipart/form-data"
                            action="{{ route('structure.employee.store') }}">
                            @csrf
                            <input type="hidden" name="organization_id" value="{{ $org_dep->id ?? '' }}">
                            <div class="modal-body p-4">
                                {{-- 1. Şəxsi məlumatlar --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-light fw-bold">Şəxsi məlumatlar</div>
                                    <div class="card-body row">
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Adı</label>
                                            <input type="text" name="first_name" class="form-control" required value="{{ old('first_name') }}">
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Soyad</label>
                                            <input type="text" name="last_name" class="form-control" required value="{{ old('last_name') }}">
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Ata adı</label>
                                            <input type="text" name="father_name" class="form-control" required value="{{ old('father_name') }}">
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">FİN</label>
                                            <div class="input-group">
                                                <input type="text" name="fin" id="finInput" class="form-control" minlength="7" maxlength="7" required value="{{ old('fin') }}">
                                                <button type="button" class="btn" id="autofillFinBtn" title="Autofill">
                                                    <i class="bi bi-magic"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Seriya nömrəsi</label>
                                            <input type="text" name="serial_no" class="form-control" value="{{ old('serial_no') }}">
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Profil şəkli</label>
                                            <input type="file"
                                                name="profile_photo_path"
                                                class="form-control"
                                                accept="image/jpeg,image/png,image/jpg">
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Doğum tarixi</label>
                                            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}">
                                        </div>
                                        <div class="col-4 mb-3">
                                            <label class="form-label">Doğum yeri</label>
                                            <input type="text" name="birth_place" class="form-control" value="{{ old('birth_place') }}">
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Vətəndaşlıq</label>
                                            <input type="text" name="citizen" class="form-control" value="{{ old('citizen') }}">
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Cinsiyyət</label>
                                            <select name="gender" class="form-select" required>
                                                <option value="" disabled selected>Seçin...</option>
                                                <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Kişi</option>
                                                <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Qadın</option>
                                            </select>
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Ailə vəziyyəti</label>
                                            <select name="marital_status" class="form-select">
                                                <option value="" disabled selected>Seçin...</option>
                                                <option value="0" {{ old('marital_status') == '0' ? 'selected' : '' }}>Subay</option>
                                                <option value="1" {{ old('marital_status') == '1' ? 'selected' : '' }}>Evli</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- 2. İş və təşkilat məlumatları --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-light fw-bold">İş və təşkilat məlumatları</div>
                                    <div class="card-body row">
                                        <div class="col-5 mb-3">
                                            <label class="form-label">Vəzifə</label>
                                            <select name="org_position_id" class="form-select org_position_class" required>
                                                <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                                @foreach ($org_pos as $op)
                                                <option value="{{ $op->id }}" {{ old('org_position_id') == $op->id ? 'selected' : '' }}>
                                                    {{ $op->position->name ?? '-' }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-5 mb-3">
                                            <label class="form-label">İşçi Tipi</label>
                                            <select name="emp_type_id" id="emp_type_id" class="form-select" required>
                                                <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                                @foreach ($employmentTypes as $employmentType)
                                                <option value="{{ $employmentType->id }}" {{ old('emp_type_id') == $employmentType->id ? 'selected' : '' }}>
                                                    {{ $employmentType->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2 mb-3">
                                            <label class="form-label">Maaş</label>
                                            <input type="number" name="salary" class="form-control" value="{{ old('salary') }}">
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="form-label">Başlama tarixi</label>
                                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="form-label">Bitmə tarixi</label>
                                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="form-label">Müqavilə nömrəsi</label>
                                            <input type="text" name="contract_no" class="form-control" value="{{ old('contract_no') }}">
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="form-label">SSN</label>
                                            <input type="text" name="sin" class="form-control" value="{{ old('sin') }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- 3. Sistem giriş məlumatları --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-light fw-bold">Sistem giriş məlumatları</div>
                                    <div class="card-body row">
                                        <div class="col-3 mb-3">
                                            <label class="form-label">İstifadəçi adı</label>
                                            <input type="text" name="username" class="form-control" required value="{{ old('username') }}">
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="form-label">E-poçt</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="form-label">Rol</label>
                                            <select name="role_id" class="form-select" required>
                                                <option value="" disabled selected>Seçin...</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 mb-3">
                                            <label class="form-label">Şifrə</label>
                                            <input type="password"
                                                name="password"
                                                class="form-control"
                                                minlength="8"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                {{-- 4. Ünvan məlumatları --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-light fw-bold">Ünvan məlumatları</div>
                                    <div class="card-body row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Qeydiyyat ünvanı</label>
                                            <input type="text" name="registered_address" class="form-control" value="{{ old('registered_address') }}">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label">Yaşayış ünvanı</label>
                                            <input type="text" name="residential_address" class="form-control" value="{{ old('residential_address') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Bağla</button>
                                <button type="submit" class="btn btn-primary w-sm">Yarat</button>
                            </div>
                        </form>
                        <!-- fin javascript -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const finInput = document.getElementById('finInput');
                                const autofillBtn = document.getElementById('autofillFinBtn');
                                autofillBtn.addEventListener('click', async function() {
                                    const fin = finInput.value.trim();
                                    if (!fin) return;
                                    Swal.fire({
                                        title: 'Yüklənir...',
                                        text: 'Zəhmət olmasa gözləyin',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        }
                                    });
                                    try {
                                        const res = await fetch("{{ route('employee.check-fin') }}", {
                                            method: "POST",
                                            headers: {
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                                "Content-Type": "application/json",
                                                "Accept": "application/json"
                                            },
                                            body: JSON.stringify({
                                                fin
                                            })
                                        });
                                        const data = await res.json();
                                        if (data.exists) {
                                            autofillBtn.classList.remove('btn-warning');
                                            autofillBtn.classList.add('btn-success');
                                            // form inputlarını doldur
                                            const fields = ['username', 'first_name', 'last_name', 'father_name', 'gender', 'birth_date', 'email', 'phone'];
                                            fields.forEach(field => {
                                                const input = document.querySelector(`[name="${field}"]`);
                                                if (input && data.data[field] !== undefined) {
                                                    input.value = data.data[field];
                                                }
                                            });
                                        } else {
                                            autofillBtn.classList.remove('btn-success');
                                            autofillBtn.classList.add('btn-warning');
                                            // forma boşalt
                                            const fields = ['username', 'first_name', 'last_name', 'father_name', 'gender', 'birth_date', 'email', 'phone'];
                                            fields.forEach(field => {
                                                const input = document.querySelector(`[name="${field}"]`);
                                                if (input) input.value = '';
                                            });
                                        }
                                    } catch (err) {
                                        console.error(err);
                                        Swal.fire('Xəta', 'Server ilə əlaqə qurularkən problem yarandı', 'error');
                                    }
                                    Swal.close();
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="modal fade custom-backdrop" id="addEmploymentModal" tabindex="-1"
                aria-labelledby="addEmploymentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEmploymentModalLabel">Müqavilə Əlavə et</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="add-new-employment" method="POST" enctype="multipart/form-data"
                            action="{{ route('structure.employment.store') }}">
                            @csrf
                            <div class="modal-body p-4">
                                <div class="col-12 row mt-3">
                                    <input type="hidden" name="organization_id" value="{{ $org_dep->id ?? '' }}">
                                    {{-- id --}}
                                    <input type="hidden" name="user_id" id="user_id" value="">


                                    {{-- first_name --}}
                                    <div class="col-3 mb-3">
                                        <label class="form-label">Adı</label>
                                        <input type="text" name="first_name" class="form-control" disabled
                                            value="{{ old('first_name') }}">
                                    </div>
                                    {{-- last_name --}}
                                    <div class="col-3 mb-3">
                                        <label class="form-label">Soyad</label>
                                        <input type="text" name="last_name" class="form-control" disabled
                                            value="{{ old('last_name') }}">
                                    </div>
                                    {{-- father_name --}}
                                    <div class="col-3 mb-3">
                                        <label class="form-label">Ata adı</label>
                                        <input type="text" name="father_name" class="form-control" disabled
                                            value="{{ old('father_name') }}">
                                    </div>
                                    <!-- <div class="col-3 mb-3">
                                        <label class="form-label">FİN</label>
                                        <input type="text" name="fin" class="form-control" disabled
                                            value="{{ old('fin') }}">
                                    </div> -->
                                    {{-- contract_no --}}
                                    <div class="col-3 mb-3">
                                        <label class="form-label">Müqavilə nömrəsi</label>
                                        <input type="text" name="contract_no" class="form-control"
                                            value="{{ old('contract_no') }}">
                                    </div>
                                    {{-- emp_type_id (indi səndə employmentType select kimi idi) --}}
                                    <div class="col-3 mb-3">
                                        <label class="form-label">İşçi Tipi</label>
                                        <select name="emp_type_id" id="emp_type_id" class="form-select"
                                            required>
                                            <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                            @foreach ($employmentTypes as $employmentType)
                                            <option value="{{ $employmentType->id }}"
                                                {{ old('emp_type_id') == $employmentType->id ? 'selected' : '' }}>
                                                {{ $employmentType->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label class="form-label">Vəzifə</label>
                                        <select name="org_position_id" class="form-select org_position_class" required>
                                            <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                            @foreach ($org_pos as $op)
                                            <option value="{{ $op->id }}" {{ old('org_position_id') == $op->id ? 'selected' : '' }}>
                                                {{ $op->position->name ?? '-' }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- start_date --}}
                                    <div class="col-2 mb-3">
                                        <label class="form-label">Başlama tarixi</label>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ old('start_date') }}" required>
                                    </div>
                                    {{-- end_date --}}
                                    <div class="col-2 mb-3">
                                        <label class="form-label">Bitmə tarixi</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ old('end_date') }}">
                                    </div>
                                    {{-- salary --}}
                                    <div class="col-2 mb-3">
                                        <label class="form-label">Maaş</label>
                                        <input type="number" name="salary" class="form-control"
                                            value="{{ old('salary') }}">
                                    </div>
                                    {{-- note --}}
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Qeyd</label>
                                        <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="fill-current-contract" style="display:none;">
                                    Cari müqavilənin dəyərlərini doldur
                                </button>
                                <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Bağla</button>
                                <button type="submit" class="btn btn-primary w-sm">Yarat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade custom-backdrop" id="addPositionModal" tabindex="-1"
                aria-labelledby="addPositionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPositionModalLabel">Yeni vəzifə əlavə et</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="add-new-position" method="POST" enctype="multipart/form-data"
                            action="{{ route('structure.position.store') }}">
                            @csrf
                            <input type="hidden" name="org_dep_id" id="org_dep_id" value="{{ $org_dep->id }}">
                            <div class="modal-body p-4">
                                <div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="name" class="form-label">Vəzifə</label>
                                            <input type="text" id="vezifeInput" name="name"
                                                class="form-control" placeholder="Seçin və ya yazın..."
                                                list="vezifeList">
                                            <!-- <datalist id="vezifeList">
                                                @foreach ($allPositions as $pos)
                                                <option value="{{ $pos->name }}"></option>
                                                @endforeach
                                            </datalist> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light w-sm"
                                    data-bs-dismiss="modal">Bağla</button>
                                <button type="submit" class="btn btn-primary w-sm ">Yarat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div aria-hidden="true" aria-labelledby="editOrgContactModal" class="modal fade"
                id="editOrgContactModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <form class="modal-content needs-validation" id="editOrgForm" novalidate="" method="POST"
                        action="{{ route('structure.structure.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editOrgModalLabel">Redaktə et</h5>
                            <button aria-label="Bağla" class="btn-close" data-bs-dismiss="modal"
                                type="button"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 align-items-center">
                                <!--id-->
                                <input type="hidden" name="org_id" id="org_id" value="{{ $org_dep->id }}">
                                <!-- Ad -->
                                <div class="col-md-8">
                                    <label class="form-label" for="org_name">Adı</label>
                                    <input class="form-control" id="org_name" name="name" placeholder=""
                                        required="" type="text" value="{{ $org_dep->name }}">
                                    <div class="invalid-feedback">Adı</div>
                                </div>
                                <!-- Tip -->
                                <div class="col-md-4">
                                    <label class="form-label" for="org_type">Növü</label>
                                    <select class="form-select" id="org_type" name="organization_type_id" required>
                                        <option disabled selected value="">Seçin</option>
                                        @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type->id == $org_dep->organization_type_id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Tip seçin.</div>
                                </div>
                                <!-- Qısa ad -->
                                <div class="col-md-6">
                                    <label class="form-label">Qısa Ad</label>
                                    <input type="text" class="form-control" name="short_name" id="org_short_name"
                                        value="{{ $org_dep->short_name }}">
                                </div>
                                <!-- Ünvan -->
                                <div class="col-md-6">
                                    <label class="form-label">Ünvan</label>
                                    <input type="text" class="form-control" name="address" id="org_address"
                                        value="{{ $org_dep->address }}">
                                </div>
                                <!-- E-poçt -->
                                <div class="col-md-6">
                                    <label class="form-label">E-poçt ünvanı</label>
                                    <input type="email" class="form-control" name="email" id="org_email"
                                        value="{{ $org_dep->email }}">
                                </div>
                                <!-- Fax -->
                                <div class="col-md-3">
                                    <label class="form-label">Fax</label>
                                    <input type="text" class="form-control" name="fax" id="org_fax"
                                        value="{{ $org_dep->fax }}">
                                </div>
                                <!-- Telefon -->
                                <div class="col-md-3">
                                    <label class="form-label">Telefon</label>
                                    <input type="text" class="form-control" name="phone" id="org_phone"
                                        value="{{ $org_dep->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Bağla</button>
                            <button class="btn btn-primary" type="submit">Yadda saxla</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade custom-backdrop" id="createOrganizationModal" tabindex="-1"
                aria-labelledby="createOrganizationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createOrganizationModalLabel">Yenisini yarat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="add-new-organization" method="POST" enctype="multipart/form-data"
                                action="https://smartnet.az/organizations/hierarchy/add">
                                <input type="hidden" name="_token" value="LZ48vid6wijxMI1qUyCJ6yAb0Qw14QI5jaxZAstE"
                                    autocomplete="off">
                                <div class="modal-body p-4">
                                    <div>
                                        <div class="mb-3">
                                            <label for="organization" class="form-label">Qurum adı</label>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light w-sm"
                                        data-bs-dismiss="modal">Bağla</button>
                                    <button type="submit" class="btn btn-primary w-sm add_organization">Əlavə
                                        et</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
    </div>
    <div class="modal fade" id="data">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close close_modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="dynamic-modal-body p-4">
                    <div style="width: 100%; height: 100%; display: flex; justify-content: center;">
                        <div style="bottom: 45%; right: 48%; background: transparent;">
                            <div
                                style="width: 70px; height: 70px; border-radius: 50%; -webkit-box-sizing: border-box; box-sizing: border-box; border: solid 2px #6690F4; border-top-color: #fff; animation: spin 1s infinite linear; -webkit-animation: spin 1s infinite linear; display: inline-block;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade custom-backdrop" id="createDepartmentModal" tabindex="-1"
        aria-labelledby="createDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDepartmentModalLabel">Yenisini yarat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                </div>
                <form id="add-new-department" method="POST" action="#">
                    <div class="modal-body p-4">
                        <input type="hidden" id="organization_id" name="organization_id" value="1959">
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Şöbə adı</label>
                            <input type="text" id="department_name" name="department_name" class="form-control"
                                placeholder="Şöbə adını yazın..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary w-sm">
                            Əlavə et
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade custom-backdrop" id="createSectorModal" tabindex="-1"
        aria-labelledby="createSectorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSectorModalLabel">Yenisini yarat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                </div>
                <form id="add-new-sector" method="POST" action="#">
                    <div class="modal-body p-4">
                        <input type="hidden" id="organization_id" name="organization_id" value="1959">
                        <div class="mb-3">
                            <label for="sector_name" class="form-label">Sektor adı</label>
                            <input type="text" id="sector_name" name="sector_name" class="form-control"
                                placeholder="Sektor adını yazın..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary w-sm">
                            Əlavə et
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- EDIT MODAL -->
    <div class="modal fade" id="editPositionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vəzifəni redaktə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="edit-contact-form" action="{{ route('structure.positions.update') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_position_id" name="position_id" value="">
                        <input type="hidden" id="edit_org_position_id" name="org_position_id" value="">
                        <div class="mb-3">
                            <label class="form-label">Vəzifə adı</label>
                            <input type="text" id="edit_position_name" name="position_name" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary">
                            Yadda saxla
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Forma Modal -->
    <div class="modal fade custom-backdrop" id="addFormaInfoModal" tabindex="-1"
        aria-labelledby="addFormaInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFormaInfoModalLabel">
                        Məlumat əlavə et -
                        <span id="userFullNameSpan">Seçilmiş istifadəçi</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" id="form_user_id">
                <input type="hidden" id="form_current_first_name">
                <input type="hidden" id="form_current_last_name">
                <input type="hidden" id="form_current_father_name">
                <div class="modal-body p-4" id="cardsContainer">
                    <!-- Qohumluq Card -->
                    <div class="card mb-4" data-card-type="relative">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><!--👨‍👩‍👧‍👦--> Qohumluq</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="relative">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="relative">
                            <div class="table-responsive"></div>
                        </div>
                    </div>
                    <!-- Cinayət Card -->
                    <div class="card mb-4" data-card-type="criminal">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><!--⚖️--> Cinayət</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="criminal">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="criminal">
                            <div class="table-responsive"></div>
                        </div>
                    </div>
                    <!-- Hərbi Card -->
                    <div class="card mb-4" data-card-type="military">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><!--🎖️--> Hərbi xidmət</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="military">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="military">
                            <div class="table-responsive"></div>
                        </div>
                    </div>
                    <!-- Telefon Card -->
                    <div class="card mb-4" data-card-type="phone">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><!--📞--> Telefon nömrələri</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="phone">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="phone">
                            <div class="table-responsive"></div>
                        </div>
                    </div>
                    <!-- Köhnə iş yerləri Card -->
                    <div class="card mb-4" data-card-type="employment">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><!--💼--> Köhnə iş yerləri</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="employment">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="employment">
                            <div class="table-responsive"></div>
                        </div>
                    </div>
                    <!-- Ad dəyişmə Card -->
                    <div class="card mb-4" data-card-type="namechange">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><!--✏️--> Ad dəyişmə</span>
                            <button type="button" class="btn btn-sm btn-primary form-add-btn" data-card="namechange">+ Əlavə
                                et</button>
                        </div>
                        <div class="card-body" data-entries="namechange">
                            <div class="table-responsive"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Bağla</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Froma Create/Edit Modal -->
    <div class="modal fade" id="formaItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Əlavə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="itemForm">
                    @csrf
                    <div class="modal-body" id="itemFormModalBody">
                        <!-- Dinamik form buraya gələcək -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary" id="saveModalBtn">Yadda saxla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Form (hidden) -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <div class="modal fade" id="roleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalLabel">Rol əlavə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update-role" method="POST" enctype="multipart/form-data"
                    action="{{ route('structure.role.update') }}">
                    @csrf
                    <input type="hidden" name="organization_id" value="{{ $org_dep->id ?? '' }}">
                    <div class="modal-body p-4">
                        <div class="col-12 row mt-3">
                            {{-- id --}}
                            <input type="hidden" name="user_id" id="user_id" value="">
                            {{-- role_id (əgər rol seçmək istəyirsənsə) --}}
                            <div class="col-12 mb-3">
                                <label class="form-label">Rol</label>
                                <select name="role_id" class="form-select">
                                    <option value="" disabled selected>Seçin...</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary w-sm">Yadda saxla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateContactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContactModalLabel">Əməkdaş Redaktə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update-employee" method="POST" enctype="multipart/form-data"
                    action="{{ route('structure.employee.update') }}">
                    @csrf
                    {{-- id'ler--}}
                    <div class="modal-body p-4">
                        <input type="hidden" name="organization_id" value="{{ $org_dep->id ?? '' }}">
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input type="hidden" name="employment_id" id="user_id" value="">
                        {{-- 1. Şəxsi məlumatlar --}}
                        <div class="card mb-3">
                            <div class="card-header bg-light fw-bold">Şəxsi məlumatlar</div>
                            <div class="card-body row">
                                <div class="col-2 mb-3">
                                    <label class="form-label">Adı</label>
                                    <input type="text" name="first_name" class="form-control" required
                                        value="{{ old('first_name') }}">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Soyad</label>
                                    <input type="text" name="last_name" class="form-control" required
                                        value="{{ old('last_name') }}">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Ata adı</label>
                                    <input type="text" name="father_name" class="form-control" required
                                        value="{{ old('father_name') }}">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">FİN</label>
                                    <input type="text"
                                        name="fin"
                                        class="form-control"
                                        required
                                        minlength="7"
                                        maxlength="7"
                                        value="{{ old('fin') }}">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Seriya nömrəsi</label>
                                    <input type="text" name="serial_no" class="form-control"
                                        value="{{ old('serial_no') }}">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Profil şəkli</label>
                                    <input type="file"
                                        name="profile_photo_path"
                                        class="form-control"
                                        accept="image/jpeg,image/png,image/jpg">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Doğum tarixi</label>
                                    <input type="date" name="birth_date" class="form-control"
                                        value="{{ old('birth_date') }}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="form-label">Doğum yeri</label>
                                    <input type="text" name="birth_place" class="form-control"
                                        value="{{ old('birth_place') }}">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Vətəndaşlıq</label>
                                    <input type="text" name="citizen" class="form-control"
                                        value="{{ old('citizen') }}">
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Ailə vəziyyəti</label>
                                    <select name="marital_status" class="form-select">
                                        <option value="" disabled selected>Seçin...</option>
                                        <option value="0" {{ old('marital_status') == '0' ? 'selected' : '' }}>Subay</option>
                                        <option value="1" {{ old('marital_status') == '1' ? 'selected' : '' }}>Evli</option>
                                    </select>
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Cinsiyyət</label>
                                    <select name="gender" class="form-select" required>
                                        <option value="" disabled selected>Seçin...</option>
                                        <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Kişi</option>
                                        <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Qadın</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- 2. İş və təşkilat məlumatları --}}
                        <div class="card mb-3">
                            <div class="card-header bg-light fw-bold">İş və təşkilat məlumatları</div>
                            <div class="card-body row">
                                <div class="col-5 mb-3">
                                    <label class="form-label">Vəzifə</label>
                                    <select name="org_position_id" id="update_org_position_id" class="form-select org_position_class" required>
                                        <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                        @foreach ($org_pos as $op)
                                        <option value="{{ $op->id }}" {{ old('org_position_id') == $op->id ? 'selected' : '' }}>
                                            {{ $op->position->name ?? '-' }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5 mb-3">
                                    <label class="form-label">İşçi Tipi</label>
                                    <select name="emp_type_id" id="emp_type_id" class="form-select" required>
                                        <option value="" disabled selected>Zəhmət olmasa seçin</option>
                                        @foreach ($employmentTypes as $employmentType)
                                        <option value="{{ $employmentType->id }}" {{ old('emp_type_id') == $employmentType->id ? 'selected' : '' }}>
                                            {{ $employmentType->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 mb-3">
                                    <label class="form-label">Maaş</label>
                                    <input type="number" name="salary" class="form-control" value="{{ old('salary') }}">
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="form-label">Başlama tarixi</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="form-label">Bitmə tarixi</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="form-label">Müqavilə nömrəsi</label>
                                    <input type="text" name="contract_no" class="form-control" value="{{ old('contract_no') }}">
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="form-label">SSN</label>
                                    <input type="text" name="sin" class="form-control" value="{{ old('sin') }}">
                                </div>
                            </div>
                        </div>
                        {{-- 4. Sistem giriş məlumatları --}}
                        <div class="card mb-3">
                            <div class="card-header bg-light fw-bold">Sistem giriş məlumatları</div>
                            <div class="card-body row">
                                <div class="col-3 mb-3">
                                    <label class="form-label">İstifadəçi adı</label>
                                    <input type="text" name="username" class="form-control" required
                                        value="{{ old('username') }}">
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="form-label">E-poçt</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="form-label">Rol</label>
                                    <select name="role_id" class="form-select" required>
                                        <option value="" disabled selected>Seçin...</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 mb-3">
                                    <label class="form-label">Şifrə</label>
                                    <input type="password"
                                        name="password"
                                        minlength="8"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- 3. Ünvan məlumatları --}}
                        <div class="card mb-3">
                            <div class="card-header bg-light fw-bold">Ünvan məlumatları</div>
                            <div class="card-body row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Qeydiyyat ünvanı</label>
                                    <input type="text" name="registered_address" class="form-control"
                                        value="{{ old('registered_address') }}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Yaşayış ünvanı</label>
                                    <input type="text" name="residential_address" class="form-control"
                                        value="{{ old('residential_address') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" class="btn btn-primary w-sm">Yenilə</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="rightbar-overlay"></div>
</main>
<a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
        class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
<script>
    // Funksiya: double slider üçün
    function setupDoubleSlider(minSliderId, maxSliderId, rangeId, minRangeId, maxRangeId, labelPrefix) {
        const minSlider = document.getElementById(minSliderId);
        const maxSlider = document.getElementById(maxSliderId);
        const range = document.getElementById(rangeId);
        const minRange = document.getElementById(minRangeId);
        const maxRange = document.getElementById(maxRangeId);

        function update() {
            if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
                [minSlider.value, maxSlider.value] = [maxSlider.value, minSlider.value];
            }
            minRange.textContent = minSlider.value;
            maxRange.textContent = maxSlider.value;
            const minPercent = (minSlider.value / minSlider.max) * 100;
            const maxPercent = (maxSlider.value / maxSlider.max) * 100;
            range.style.left = `${minPercent}%`;
            range.style.width = `${maxPercent - minPercent}%`;
            // Label update
            const label = document.getElementById(labelPrefix);
            if (minSlider.value === maxSlider.value) {
                label.innerHTML = `${label.dataset.prefix}:<br> <span>${minSlider.value}</span>`;
            } else {
                label.innerHTML = `${label.dataset.prefix}:<br> <span>${minSlider.value}</span> - <span>${maxSlider.value}</span>`;
            }
        }
        minSlider.addEventListener('input', update);
        maxSlider.addEventListener('input', update);
        // Başlanğıcda update
        update();
    }
    // Yaş slider
    document.getElementById('selected-range-age').dataset.prefix = 'Yaş Aralığı';
    setupDoubleSlider('minSliderAge', 'maxSliderAge', 'rangeAge', 'minRangeAge', 'maxRangeAge', 'selected-range-age');
    // Maaş slider
    document.getElementById('selected-range-salary').dataset.prefix = 'Maaş Aralığı';
    setupDoubleSlider('minSliderSalary', 'maxSliderSalary', 'rangeSalary', 'minRangeSalary', 'maxRangeSalary', 'selected-range-salary');
</script>
<script>
    function openeditContactModal(button) {
        let durationId = button.getAttribute("data-duration-id");
        let positionName = button.closest("tr").querySelector("td:nth-child(2)").innerText;
        document.getElementById("edit_duration_id").value = durationId;
        document.getElementById("edit_position_name").value = positionName;
        let modal = new bootstrap.Modal(document.getElementById('editContactModal'));
        modal.show();
    }
</script>
<script>
    document.querySelectorAll(".archive_person").forEach(btn => {
        btn.addEventListener("click", function() {
            const empId = this.dataset.userEmpId;
            const url = this.dataset.url;
            const tr = this.closest("tr"); // tr-i seçirik
            Swal.fire({
                title: 'Arxivləmək istəyirsiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Bəli, arxivlə',
                cancelButtonText: 'Xeyr'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Arxivlənir...',
                        text: 'Zəhmət olmasa gözləyin',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                employment_id: empId
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                // TR elementini DOM-dan sil
                                tr.remove();
                                Swal.fire('Uğurla arxivləndi!', '', 'success');
                            } else {
                                Swal.fire('Xəta baş verdi!', data.message || '', 'error');
                            }
                        })
                        .catch(() => Swal.fire('Xəta baş verdi!', '', 'error'));
                }
            });
        });
    });
</script>
<script>
    document.querySelectorAll(".add_employment").forEach(btn => {
        btn.addEventListener("click", function() {
            let url = this.getAttribute("data-url");
            Swal.fire({
                title: 'Müqavilə əlavə etmək istəyirsiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Bəli',
                cancelButtonText: 'Xeyr'
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener("click", function(e) {
            const btn = e.target.closest(".delete_position");
            if (!btn) return;
            const orgPosId = btn.dataset.orgPosId;
            if (!orgPosId) return;
            const tr = btn.closest("tr");
            Swal.fire({
                title: 'Silmək istəyirsiniz?',
                text: "Bu əməliyyat geri qaytarıla bilməz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Bəli, sil',
                cancelButtonText: 'Xeyr'
            }).then(async (result) => {
                if (!result.isConfirmed) return;
                Swal.fire({
                    title: 'Silinir...',
                    text: 'Zəhmət olmasa gözləyin',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                try {
                    const res = await fetch("{{ route('structure.positions.delete') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            org_pos_id: orgPosId
                        })
                    });
                    const data = await res.json();
                    if (!res.ok || data.status !== 'success') {
                        throw new Error(data.message || 'Xəta baş verdi');
                    }
                    // ✅ TR sil (reload YOX)
                    if (tr) tr.remove();
                    document.querySelectorAll('select[name="org_position_id"]').forEach(select => {
                        select.querySelectorAll('option').forEach(option => {
                            if (option.value == orgPosId) {
                                option.remove();
                            }
                        });
                    });
                    document.querySelectorAll('.person').forEach(row => {
                        const td = row.querySelectorAll('td');
                        if (td.length >= 3) {
                            const targetTd = td[2];
                            if (targetTd.dataset.orgPosId == orgPosId) {
                                row.remove();
                            }
                        }
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Silindi!',
                        text: data.message || 'Uğurla silindi'
                    });
                } catch (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta!',
                        text: err.message || 'Xəta baş verdi'
                    });
                }
            });
        });
    });
</script>
<!-- <script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.position-edit-btn');
        if (!btn) return;
        // modal inputları
        const form = document.getElementById('edit-contact-form');
        form.querySelector('[name="position_id"]').value = btn.dataset.positionId || '';
        form.querySelector('[name="position_name"]').value = btn.dataset.positionName || '';
        form.querySelector('[name="org_position_id"]').value = btn.dataset.orgPosId || '';
    });
</script> -->
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal açılmamışdan əvvəl data-ları dolduraq
        const modalEl = document.getElementById('updateContactModal');
        modalEl.addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget; // klik olunan <a> (transfer-btn)
            if (!btn) return;
            // data-ları götür
            const d = btn.dataset;
            // modal içində form-u tap
            const form = modalEl.querySelector('form');
            // inputlar (name-lə seçmək ən sağlamıdır)
            // select-lər
            const genderSel = form.querySelector('[name="gender"]');
            if (genderSel) genderSel.value = (d.userGender ?? '');
            const roleSel = form.querySelector('[name="role_id"]');
            if (roleSel) roleSel.value = (d.userRoleId ?? '');
            const posSel = form.querySelector('[name="org_position_id"]');
            if (posSel) posSel.value = (d.userOrgPositionId ?? '');
            // istəsən password-u boşla (editdə məcburi olmasın deyə)
            const passInp = form.querySelector('[name="password"]');
            if (passInp) passInp.value = '';
            // istəsən düymə mətnini dəyiş
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.textContent = 'Yadda saxla';
            // istəsən hidden name field-i də yığ
            const hiddenName = form.querySelector('[name="name"]');
            if (hiddenName) {
                const fullName =
                    `${d.userFirst_name ?? ''} ${d.userLast_name ?? ''} ${d.userFather_name ?? ''}`
                    .trim();
                hiddenName.value = fullName;
            }
            // Əgər edit üçün ayrıca route varsa form action-u dinamik dəyiş:
            // form.action = `/employees/${d.userId}`;  // öz route-na uyğun yaz
            // form.querySelector('input[name="_method"]')?.remove();
            // form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="PUT">');
        });
    });
</script> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("editOrgForm");
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            e.stopPropagation();
            const formData = new FormData(form);
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
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu',
                            text: data.message
                        });
                        // div#org_info yenilə
                        const orgDiv = document.getElementById("org_info");
                        if (orgDiv && data.data) {
                            orgDiv.innerHTML = `
                        <div class="col-6">
                            <span>Qurum adı: ${data.data.name}<br></span>
                            <span>Qurum növü: ${data.data.type}<br></span>
                            <span>Qurum qısa adı: ${data.data.short_name}<br></span>
                        </div>
                        <div class="col-6">
                            <span>Ünvan: ${data.data.address}<br></span>
                            <span>E-poçt ünvanı: ${data.data.email}<br></span>
                            <span>Fax: ${data.data.fax}<br></span>
                            <span>Telefon: ${data.data.phone}<br></span>
                        </div>
                    `;
                        }
                        // modalı bağla
                        let modal = bootstrap.Modal.getInstance(document.getElementById('editOrgContactModal'));
                        if (modal) modal.hide();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Xəta',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Server xətası',
                        text: 'Sorğu göndərilərkən problem yarandı'
                    });
                });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("add-new-position");
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            e.stopPropagation();
            const formData = new FormData(form);
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
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Swal ilə uğurlu mesaj
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu',
                            text: data.message
                        });
                        // Modalı bağla
                        let modalEl = document.getElementById('addPositionModal');
                        let modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                        // Formu reset et
                        form.reset();
                        // Yeni tr yarat və tbody-ə əlavə et
                        const tbody = document.getElementById("position_table");
                        if (tbody && data.data) {
                            const newTr = document.createElement("tr");
                            newTr.innerHTML = `
                        <td>#</td>
                        <td>${data.data.name}</td>
                        <td>
                            <div>
                                <a href="javascript:void(0)"
                                    class="btn btn-sm btn-primary position-edit-btn"
                                    data-position-id="${data.data.id}"
                                    data-org-pos-id="${data.data.org_pos_id}"
                                    data-position-name="${data.data.name}"
                                    data-bs-toggle="modal" data-bs-target="#editPositionModal">
                                    <i class="fas fa-edit" title="Redaktə et"></i>
                                </a>
                                <a href="javascript:void(0)"
                                    class="btn btn-sm btn-danger delete_position"
                                    data-org-pos-id="${data.data.org_pos_id}">
                                    <i class="fas fa-trash" title="Sil"></i>
                                </a>
                            </div>
                        </td>
                        `;
                            tbody.prepend(newTr);
                        }
                        // Bütün <select> elementlərinə option əlavə et
                        const selects = document.querySelectorAll('select[name="org_position_id"]')
                        selects.forEach(select => {
                            const option = document.createElement("option");
                            option.value = data.data.org_pos_id;
                            option.text = data.data.name;
                            select.appendChild(option);
                        });
                    } else {
                        // Xəta mesajı
                        Swal.fire({
                            icon: 'error',
                            title: 'Xəta',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Server xətası',
                        text: 'Sorğu göndərilərkən problem yarandı'
                    });
                });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("add-new-employee");
        const tbody = document.getElementById("employee-table");
        form.addEventListener("submit", function(e) {
            e.preventDefault(); // Reload-u dayandır
            e.stopPropagation();
            const formData = new FormData(form);
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
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(async res => {
                    const data = await res.json();
                    if (!res.ok) {
                        // Xetalari formda goster
                        if (res.status === 422 && data.errors) {
                            // Onceki xetalari temizle
                            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                            // Her bir xeta ucun
                            Object.keys(data.errors).forEach(fieldName => {
                                const input = document.querySelector(`[name="${fieldName}"]`);
                                if (input) {
                                    input.classList.add('is-invalid');
                                    const feedback = document.createElement('div');
                                    feedback.className = 'invalid-feedback';
                                    feedback.style.display = 'block';
                                    feedback.innerText = data.errors[fieldName][0];
                                    input.parentNode.insertBefore(feedback, input.nextSibling);
                                }
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Xəta',
                                text: 'Zəhmət olmasa formadakı xətaları düzəldin'
                            });
                        } else {
                            throw new Error(data.message || 'Xəta baş verdi');
                        }
                        return;
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu',
                            text: data.message
                        });
                        // Modalı bağla
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addContactModal'));
                        if (modal) modal.hide();
                        // Formu resetlə
                        form.reset();
                        // Yeni sətir yarat
                        const emp = data.data; // Serverdən JSON data gələ bilər: id, first_name, last_name, fin, position, salary, start_date, end_date, emp_type_id, contract_no, note
                        const newTr = document.createElement("tr");
                        newTr.classList.add("person");
                        newTr.innerHTML = `
                    <td>${emp.first_name} ${emp.last_name}</td>
                    <td>${emp.fin ?? '-'}</td>
                    <td data-org-pos-id="${emp.org_position_id}">${emp.org_position_name ?? '-'}</td>
                    <td>${emp.salary != null ? parseFloat(emp.salary).toString() + ' ₼' : '-'}</td>
                    <td>${emp.birth_date ?? '-'}</td>
                    <td>${emp.start_date ?? '-'}</td>
                    <td>${emp.end_date ?? '-'}</td>
                    <td>${emp.party_short_name ?? '-'}</td>
                    <td>${emp.ordenbool ? '+' : '-'}</td>
                    <td>
                        <div>
                            <a href="javascript:void(0)"
                                class="btn btn-sm btn-primary person-edit-btn"
                                data-user-id="${emp.id}"
                                data-user-first_name="${emp.first_name}"
                                data-user-last_name="${emp.last_name}"
                                data-user-father_name="${emp.father_name ?? ''}"
                                data-user-fin="${emp.fin ?? ''}"
                                data-user-gender="${emp.gender ?? ''}"
                                data-user-birth_date="${emp.birth_date ?? ''}"
                                data-user-username="${emp.username ?? ''}"
                                data-user-email="${emp.email ?? ''}"
                                data-user-phone="${emp.phone ?? ''}"
                                data-user-role-id="${emp.role_id ?? ''}"
                                data-user-org-position-id="${emp.org_position_id ?? ''}"
                                data-user-profile-photo-path="${emp.profile_photo_path ?? ''}"
                                data-user-registered-address="${emp.registered_address ?? ''}"
                                data-user-residential-address="${emp.residential_address ?? ''}"
                                data-user-birth-place="${emp.birth_place ?? ''}"
                                data-user-citizen="${emp.citizen ?? ''}"
                                data-user-serial-no="${emp.serial_no ?? ''}"
                                data-user-sin="${emp.sin ?? ''}"
                                data-user-note="${emp.note ?? ''}"
                                data-user-emp-id="${emp.emp_id ?? ''}"
                                data-user-salary="${emp.salary ?? ''}"
                                data-user-start-date="${emp.start_date ?? ''}"
                                data-user-end-date="${emp.end_date ?? ''}"
                                data-user-emp-type-id="${emp.emp_type_id ?? ''}"
                                data-user-contract-no="${emp.contract_no ?? ''}"
                                data-user-emp-note="${emp.note ?? ''}"
                                data-user-marital-status="${emp.marital_status ?? ''}"
                                data-bs-toggle="modal"
                                data-bs-target="#updateContactModal">
                                <i class="fas fa-edit" title="Redaktə et"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-sm btn-danger archive_person"
                               data-user-emp-id="${emp.emp_id}"
                               data-url="{{ route('structure.employment.archive') }}">
                               <i class="bi bi-folder" title="Arxivlə"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-sm btn-primary employment-btn"
                               data-user-id="${emp.id}"
                               data-user-fin="${emp.fin ?? ''}"
                               data-user-first-name="${emp.first_name}"
                               data-user-last-name="${emp.last_name}"
                               data-user-father-name="${emp.father_name ?? ''}"
                               data-user-org-position-id="${emp.org_position_id ?? ''}"
                               data-user-emp-type-id="${emp.emp_type_id ?? ''}"
                               data-user-emp-id="${emp.emp_id}"
                               data-user-salary="${emp.salary ?? ''}"
                               data-user-start-date="${emp.start_date ?? ''}"
                               data-user-end-date="${emp.end_date ?? ''}"
                               data-user-contract-no="${emp.contract_no ?? ''}"
                               data-user-note="${emp.note ?? ''}"
                               data-bs-toggle="modal"
                               data-bs-target="#addEmploymentModal">
                               <i class="bi bi-file-earmark-text"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-sm btn-primary forma-btn"
                               data-user-id="${emp.id}"
                               data-user-first-name="${emp.first_name}"
                               data-user-last-name="${emp.last_name}"
                               data-user-father-name="${emp.father_name ?? ''}"
                               data-bs-toggle="modal"
                               data-bs-target="#addFormaInfoModal">
                               <i class="bi bi-file-earmark"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-sm btn-primary role-btn"
                               data-user-id="${emp.id}"
                               data-user-role-id="${emp.role_id ?? ''}"
                               data-user-first_name="${emp.first_name}"
                               data-user-last_name="${emp.last_name}"
                               data-user-father_name="${emp.father_name ?? ''}"
                               data-bs-toggle="modal"
                               data-bs-target="#roleModal">
                               <i class="bi bi-shield-lock" title="Redaktə et"></i>
                            </a>
                        </div>
                    </td>
                `;
                        // Yeni sətiri tbody-yə əlavə et
                        tbody.prepend(newTr);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Xəta',
                            text: data.message
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta',
                        text: err.message || 'Sorğu göndərilərkən problem yarandı'
                    });
                });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selected_tr = null;
        let orgPosID = null;
        let positionId = null;
        let positionName = null;
        // Redaktə button-larını kliklə modal açarkən tr və input-ları təyin et
        document.querySelectorAll(".position-edit-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                selected_tr = btn.closest("tr"); // tr seçilir
                // modal inputları
                const form = document.getElementById('edit-contact-form');
                form.querySelector('[name="position_id"]').value = btn.dataset.positionId || '';
                form.querySelector('[name="position_name"]').value = btn.dataset.positionName || '';
                form.querySelector('[name="org_position_id"]').value = btn.dataset.orgPosId || '';
            });
        });
        // Modal form submit
        const form = document.getElementById("edit-contact-form");
        form.addEventListener("submit", async function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            Swal.fire({
                title: 'Yüklənir...',
                text: 'Zəhmət olmasa gözləyin',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            try {
                const res = await fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                });
                const data = await res.json();
                if (data.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Uğurla yeniləndi",
                        text: data.message,
                        confirmButtonText: "OK"
                    }).then(() => {
                        // Modalı bağla
                        const modalInstance = bootstrap.Modal.getInstance(document.getElementById('editPositionModal'));
                        if (modalInstance) modalInstance.hide();
                        // Əgər tr seçilibsə, td və button-ları update et
                        if (selected_tr) {
                            // 2-ci td = vəzifə adı
                            selected_tr.querySelectorAll("td")[1].textContent = data.name;
                            // // Button-ların data-* atributlarını update et
                            const editBtn = selected_tr.querySelector(".position-edit-btn");
                            if (editBtn) {
                                editBtn.dataset.positionName = data.name;
                                // editBtn.dataset.positionId = data.id;
                            } else {
                                console.log("editBtn tapilmadi");
                            }
                            // console.log("orgPosID: " + orgPosID)
                            const selects = document.querySelectorAll('select[name="org_position_id"]');
                            document.querySelectorAll('select[name="org_position_id"]').forEach(select => {
                                select.querySelectorAll('option').forEach(option => {
                                    if (option.value == data.orgPos_id) {
                                        option.text = data.name;
                                    }
                                });
                            });
                            document.querySelectorAll('.person').forEach(row => {
                                const td = row.querySelectorAll('td');
                                if (td.length >= 3) {
                                    const targetTd = td[2];
                                    if (targetTd.dataset.orgPosId == data.orgPos_id) {
                                        targetTd.textContent = data.name;
                                    }
                                }
                            });
                            // const deleteBtn = selected_tr.querySelector(".delete_position");
                            // if (deleteBtn) {
                            //     deleteBtn.dataset.orgPosId = data.id;
                            // }
                        } else {
                            console.log("selected_tr");
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Xəta",
                        text: data.message || "Yenilənmə mümkün olmadı"
                    });
                }
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: "error",
                    title: "Server xətası",
                    text: "Sorğu göndərilərkən problem yarandı"
                });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let person_tr = null; // global dəyişən, edit klikdə təyin olunur
        const formatSalary = (val) => {
            if (val == null || val === '') return '-';
            return Number(val).toString() + ' ₼';
        };
        // .role-btn kliklə person_tr təyin et
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.role-btn');
            if (!btn) return;
            person_tr = btn.closest('tr');
            const form = document.getElementById('update-role');
            form.querySelector('[name="user_id"]').value = btn.dataset.userId || '';
            form.querySelector('label.form-label').textContent = btn.dataset.userFirst_name + " " + btn.dataset.userLast_name + " " + btn.dataset.userFather_name + " " + " rolu" || '';
            form.querySelector('[name="role_id"]').value = btn.dataset.userRoleId || '';
        });
        // AJAX submit
        const updateForm = document.getElementById('update-role');
        if (updateForm) {
            updateForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                // Disable submit button to prevent multiple submissions
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Gözləyin...';
                }
                Swal.fire({
                    title: 'Yüklənir...',
                    text: 'Zəhmət olmasa gözləyin',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async res => {
                        const data = await res.json();
                        if (!res.ok) {
                            // Validation errors
                            let errorMessage = 'Xəta baş verdi';
                            if (data.errors) {
                                errorMessage = Object.values(data.errors).flat().join('\n');
                            } else if (data.message) {
                                errorMessage = data.message;
                            }
                            throw new Error(errorMessage);
                        }
                        return data;
                    })
                    .then(data => {
                        if (data.success && person_tr) {
                            // person_tr içindəki td-ləri yenilə
                            const editAElement = person_tr.querySelector('td:nth-child(10) div a:nth-child(4)');
                            if (editAElement) {
                                editAElement.dataset.userRoleId = data.data.role_id || '';
                            } else(console.log("editAElement tapilmadi"))
                            // Success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Uğurlu',
                                text: 'Məlumat yeniləndi',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            // modalı bağla
                            const modalEl = document.getElementById('roleModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) modal.hide();
                        } else if (!data.success) {
                            throw new Error(data.message || 'Məlumat yenilənərkən xəta baş verdi');
                        }
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Xəta',
                            text: err.message || 'Məlumat yenilənərkən problem baş verdi'
                        });
                    })
                    .finally(() => {
                        // Re-enable submit button
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Yadda saxla';
                        }
                    });
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let person_tr = null; // global dəyişən, edit klikdə təyin olunur
        const formatSalary = (val) => {
            if (val == null || val === '') return '-';
            return Number(val).toString() + ' ₼';
        };
        // person-edit-btn kliklə person_tr təyin et
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.person-edit-btn');
            if (!btn) return;
            person_tr = btn.closest('tr');
            const form = document.getElementById('update-employee');
            // Tarixləri formatla (Y-m-d formatına çevir)
            const formatDate = (dateStr) => {
                if (!dateStr) return '';
                const date = new Date(dateStr);
                if (isNaN(date.getTime())) return '';
                return date.toISOString().split('T')[0];
            };
            // 1) bütün is-invalid class-ları sil
            form.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            // 2) bütün invalid-feedback elementlərini sil
            form.querySelectorAll('.invalid-feedback').forEach(el => {
                el.remove();
            });
            form.querySelector('[name="user_id"]').value = btn.dataset.userId ?? '';
            form.querySelector('[name="employment_id"]').value = btn.dataset.userEmpId ?? '';
            form.querySelector('[name="first_name"]').value = btn.dataset.userFirst_name ?? '';
            form.querySelector('[name="last_name"]').value = btn.dataset.userLast_name ?? '';
            form.querySelector('[name="father_name"]').value = btn.dataset.userFather_name ?? '';
            form.querySelector('[name="fin"]').value = btn.dataset.userFin ?? '';
            form.querySelector('[name="username"]').value = btn.dataset.userUsername ?? '';
            form.querySelector('[name="email"]').value = btn.dataset.userEmail ?? '';
            form.querySelector('[name="profile_photo_path"]').value = ''; // file input-a value təyin etmək olmur
            form.querySelector('[name="registered_address"]').value = btn.dataset.userRegisteredAddress || '';
            form.querySelector('[name="residential_address"]').value = btn.dataset.userResidentialAddress || '';
            form.querySelector('[name="birth_place"]').value = btn.dataset.userBirthPlace || '';
            form.querySelector('[name="citizen"]').value = btn.dataset.userCitizen || '';
            form.querySelector('[name="serial_no"]').value = btn.dataset.userSerialNo || '';
            form.querySelector('[name="sin"]').value = btn.dataset.userSin || '';
            form.querySelector('[name="marital_status"]').value = btn.dataset.userMaritalStatus || '';
            form.querySelector('[name="gender"]').value = btn.dataset.userGender || '';
            form.querySelector('[name="role_id"]').value = btn.dataset.userRoleId || '';
            form.querySelector('[name="birth_date"]').value = formatDate(btn.dataset.userBirth_date);
            // employment hissəsi
            form.querySelector('[name="salary"]').value = btn.dataset.userSalary || '';
            form.querySelector('[name="start_date"]').value = formatDate(btn.dataset.userStartDate);
            form.querySelector('[name="end_date"]').value = formatDate(btn.dataset.userEndDate);
            form.querySelector('[name="emp_type_id"]').value = btn.dataset.userEmpTypeId || '';
            form.querySelector('[name="org_position_id"]').value = btn.dataset.userOrgPositionId || '';
            form.querySelector('[name="contract_no"]').value = btn.dataset.userContractNo || '';
            //form.querySelector('[name="note"]').value = btn.dataset.userEmpNote || '';
            // Profil şəkli (file input-a value təyin etmək olmur)
            form.querySelector('[name="profile_photo_path"]').value = '';
            form.querySelector('[name="password"]').value = '';
        });
        // AJAX submit
        const updateForm = document.getElementById('update-employee');
        if (updateForm) {
            updateForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                // Disable submit button to prevent multiple submissions
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Gözləyin...';
                }
                Swal.fire({
                    title: 'Yüklənir...',
                    text: 'Zəhmət olmasa gözləyin',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async res => {
                        const data = await res.json();
                        if (!res.ok) {
                            if (res.status === 422 && data.errors) {
                                // Onceki xetalari temizle
                                document.querySelectorAll('#update-employee .invalid-feedback').forEach(el => el.remove());
                                document.querySelectorAll('#update-employee .is-invalid').forEach(el => el.classList.remove('is-invalid'));
                                // Xetalari goster
                                Object.keys(data.errors).forEach(fieldName => {
                                    const input = document.querySelector(`#update-employee [name="${fieldName}"]`);
                                    if (input) {
                                        input.classList.add('is-invalid');
                                        const feedback = document.createElement('div');
                                        feedback.className = 'invalid-feedback';
                                        feedback.style.display = 'block';
                                        feedback.innerText = data.errors[fieldName][0];
                                        input.parentNode.insertBefore(feedback, input.nextSibling);
                                    }
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Xəta',
                                    text: 'Zəhmət olmasa formadakı xətaları düzəldin'
                                });
                            } else {
                                throw new Error(data.message || 'Xəta baş verdi');
                            }
                            return;
                        }
                        return data;
                    })
                    .then(data => {
                        if (data.success && person_tr) {
                            // person_tr içindəki td-ləri yenilə
                            const nameCell = person_tr.querySelector('td:nth-child(1)');
                            const finCell = person_tr.querySelector('td:nth-child(2)');
                            const positionCell = person_tr.querySelector('td:nth-child(3)');
                            const salaryCell = person_tr.querySelector('td:nth-child(4)');
                            const birthDateCell = person_tr.querySelector('td:nth-child(5)');
                            const startDateCell = person_tr.querySelector('td:nth-child(6)');
                            const endDateCell = person_tr.querySelector('td:nth-child(7)');
                            const editAElement = person_tr.querySelector('td:nth-child(10) div a:nth-child(1)');
                            if (nameCell) nameCell.textContent = data.data.first_name + ' ' + data.data.last_name;
                            if (finCell) finCell.textContent = data.data.fin || '-';
                            if (positionCell) {
                                positionCell.textContent = data.data.org_position_name || '-';
                                positionCell.dataset.orgPosId = data.data.org_position_id;
                            }
                            if (salaryCell) salaryCell.textContent = formatSalary(data.data.salary);
                            if (birthDateCell) birthDateCell.textContent = data.data.birth_date || '-';
                            if (startDateCell) startDateCell.textContent = data.data.start_date || '-';
                            if (endDateCell) endDateCell.textContent = data.data.end_date || '-';
                            if (editAElement) {
                                // editAElement.dataset.userId = data.data.id || '';
                                editAElement.dataset.userFirst_name = data.data.first_name || '';
                                editAElement.dataset.userLast_name = data.data.last_name || '';
                                editAElement.dataset.userFather_name = data.data.father_name || '';
                                editAElement.dataset.userFin = data.data.fin || '';
                                editAElement.dataset.userUsername = data.data.username || '';
                                editAElement.dataset.userEmail = data.data.email || '';
                                editAElement.dataset.userRoleId = data.data.role_id || '';
                                // editAElement.dataset.userOrgPositionId = data.data.org_position_id || '';
                                editAElement.dataset.userBirth_date = data.data.birth_date || '';
                                editAElement.dataset.userGender = data.data.gender ?? '';
                                editAElement.dataset.userProfilePhotoPath = data.data.profile_photo_path || '';
                                editAElement.dataset.userRegisteredAddress = data.data.registered_address || '';
                                editAElement.dataset.userResidentialAddress = data.data.residential_address || '';
                                editAElement.dataset.userBirthPlace = data.data.birth_place || '';
                                editAElement.dataset.userCitizen = data.data.citizen || '';
                                editAElement.dataset.userSerialNo = data.data.serial_no || '';
                                editAElement.dataset.userSin = data.data.sin || '';
                                editAElement.dataset.userNote = data.data.note || '';
                                editAElement.dataset.userMaritalStatus = data.data.marital_status ?? '';
                                // EMPLOYMENT
                                // editAElement.dataset.userEmpId = data.data.emp_id || '';
                                editAElement.dataset.userSalary = data.data.salary || '';
                                editAElement.dataset.userStartDate = data.data.start_date || '';
                                editAElement.dataset.userEndDate = data.data.end_date || '';
                                editAElement.dataset.userEmpTypeId = data.data.emp_type_id || '';
                                editAElement.dataset.userContractNo = data.data.contract_no || '';
                                editAElement.dataset.userEmpNote = data.data.emp_note || '';
                            } else(console.log("editAElement tapilmadi"))
                            // Success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Uğurlu',
                                text: 'Məlumat yeniləndi',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            // modalı bağla
                            const modalEl = document.getElementById('updateContactModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) modal.hide();
                        } else if (!data.success) {
                            throw new Error(data.message || 'Məlumat yenilənərkən xəta baş verdi');
                        }
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        // Xeta validation errors-dan gəlibsə
                        if (err.errors) {
                            // Onceki xetalari temizle
                            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                            // Her bir xeta ucun
                            Object.keys(err.errors).forEach(fieldName => {
                                const input = document.querySelector(`#update-employee [name="${fieldName}"]`);
                                if (input) {
                                    input.classList.add('is-invalid');
                                    const feedback = document.createElement('div');
                                    feedback.className = 'invalid-feedback';
                                    feedback.style.display = 'block';
                                    feedback.innerText = err.errors[fieldName][0];
                                    input.parentNode.insertBefore(feedback, input.nextSibling);
                                }
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Xəta',
                                text: 'Zəhmət olmasa formadakı xətaları düzəldin'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Xəta',
                                text: err.message || 'Məlumat yenilənərkən problem baş verdi'
                            });
                        }
                    })
                    .finally(() => {
                        // Re-enable submit button
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Yadda saxla';
                        }
                    });
            });
        }
    });
</script>
<script>
    let person_tr = null;
    // Funksiya: date stringi YYYY-MM-DD formatına çevirir
    function formatDateForInput(dateStr) {
        if (!dateStr) return '';
        const date = new Date(dateStr);
        if (isNaN(date)) return '';
        const yyyy = date.getFullYear();
        const mm = String(date.getMonth() + 1).padStart(2, '0'); // month 0-11
        const dd = String(date.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }
    document.addEventListener('click', function(e) {
        if (e.target.closest('.employment-btn')) {
            const btn = e.target.closest('.employment-btn');
            person_tr = btn.closest('tr');
            const form = document.getElementById('add-new-employment');
            form.user_id.value = btn.dataset.userId;
            // form.employment_id.value = btn.dataset.userEmpId || '';
            // form.org_position_id.value = btn.dataset.userOrgPositionId || '';
            // Disabled ad-soyad sahələri
            // əvvəlki errorları sil
            form.querySelectorAll('.error-text').forEach(el => el.remove());
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            form.querySelector('input[name="first_name"]').value = btn.dataset.userFirstName;
            form.querySelector('input[name="last_name"]').value = btn.dataset.userLastName;
            form.querySelector('input[name="father_name"]').value = btn.dataset.userFatherName;

            // Digər sahələr üçün dataset dəyərləri
            const hasValues = btn.dataset.userStartDate || btn.dataset.userEndDate || btn.dataset.userSalary || btn.dataset.userContractNo || btn.dataset.userNote || btn.dataset.userEmpTypeId;
            const fillBtn = document.getElementById('fill-current-contract');
            if (hasValues) {
                fillBtn.style.display = 'inline-block';
                fillBtn.textContent = 'Cari müqavilənin dəyərlərini doldur';
            } else {
                fillBtn.style.display = 'none';
            }
            //Toggle state üçün flag
            let isFilled = false;
            fillBtn.onclick = function() {
                if (!isFilled) {
                    // Doldur
                    form.querySelector('input[name="start_date"]').value = formatDateForInput(btn.dataset.userStartDate);
                    form.querySelector('input[name="end_date"]').value = formatDateForInput(btn.dataset.userEndDate);
                    form.querySelector('input[name="salary"]').value = btn.dataset.userSalary || '';
                    form.querySelector('input[name="contract_no"]').value = btn.dataset.userContractNo || '';
                    form.querySelector('textarea[name="note"]').value = btn.dataset.userNote || '';
                    form.querySelector('select[name="emp_type_id"]').value = btn.dataset.userEmpTypeId || '';
                    form.querySelector('[name="emp_type_id"]').value = btn.dataset.userEmpTypeId || '';
                    form.querySelector('[name="org_position_id"]').value = btn.dataset.userOrgPositionId || '';
                    fillBtn.textContent = 'Müqavilə dəyərlərini sil';
                    isFilled = true;
                } else {
                    // Sil
                    form.querySelector('[name="emp_type_id"]').value = '';
                    form.querySelector('[name="org_position_id"]').value = '';
                    form.querySelector('input[name="start_date"]').value = '';
                    form.querySelector('input[name="end_date"]').value = '';
                    form.querySelector('input[name="salary"]').value = '';
                    form.querySelector('input[name="contract_no"]').value = '';
                    form.querySelector('textarea[name="note"]').value = '';
                    form.querySelector('select[name="emp_type_id"]').value = '';
                    fillBtn.textContent = 'Cari müqavilənin dəyərlərini doldur';
                    isFilled = false;
                }
            };
        }
    });
    // 2) Form submit AJAX ilə
    document.getElementById('add-new-employment').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const url = form.action;
        const formData = new FormData(form);

        // əvvəlki errorları sil
        form.querySelectorAll('.error-text').forEach(el => el.remove());
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        Swal.fire({
            title: 'Yüklənir...',
            text: 'Zəhmət olmasa gözləyin',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => Swal.showLoading()
        });

        fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(async res => {
                if (!res.ok) {
                    const errorData = await res.json();
                    throw errorData;
                }
                return res.json();
            })
            .then(data => {
                Swal.close();

                if (data.success) {
                    // success kodların (səndə var)
                }
            })
            .catch(err => {
                Swal.close();

                // validation error
                if (err.errors) {
                    Object.keys(err.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('is-invalid');

                            const div = document.createElement('div');
                            div.className = 'invalid-feedback error-text';
                            div.innerText = err.errors[field][0];

                            input.closest('.mb-3')?.appendChild(div);
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta',
                        text: 'Server xətası baş verdi!'
                    });
                }
            });
    });
    // 2) Form submit AJAX ilə
    // document.getElementById('add-new-employment').addEventListener('submit', function(e) {
    //     e.preventDefault();
    //     if (!person_tr) return alert('Xəta: tr tapılmadı.');
    //     const form = this;
    //     const url = form.action;
    //     const formData = new FormData(form);
    //     Swal.fire({
    //         title: 'Yüklənir...',
    //         text: 'Zəhmət olmasa gözləyin',
    //         allowOutsideClick: false,
    //         allowEscapeKey: false,
    //         didOpen: () => {
    //             Swal.showLoading();
    //         }
    //     });
    //     fetch(url, {
    //             method: 'POST',
    //             headers: {
    //                 'X-Requested-With': 'XMLHttpRequest'
    //             },
    //             body: formData
    //         })
    //         .then(res => res.json())
    //         .then(data => {

    //             Swal.fire({
    //                 icon: 'info',
    //                 title: 'Debug Output',
    //                 html: `<pre style="text-align:left">${JSON.stringify(data, null, 2)}</pre>`,
    //                 width: 700
    //             });

    //         })
    //         .catch(err => {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Xəta',
    //                 text: err.message
    //             });
    //         });
    // });
</script>
<!-- //forma script -->
<script>
    // Global dəyişənlər
    let relationshipTypes = [];
    let militaryTypes = [];
    let phoneTypes = [];
    async function loadRelationshipTypes() {
        try {
            let response = await fetch('/struktur/struktur-etrafli/get-relationship-types', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            let result = await response.json();
            if (result.success) {
                relationshipTypes = result.data;
            }
        } catch (e) {
            console.error('relationship_types yüklənmədi:', e);
        }
    }
    async function loadMilitaryTypes() {
        try {
            let response = await fetch('/struktur/struktur-etrafli/get-military-types', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            let result = await response.json();
            if (result.success) {
                militaryTypes = result.data;
            }
        } catch (e) {
            console.error('military_types yüklənmədi:', e);
        }
    }
    async function loadPhoneTypes() {
        try {
            let response = await fetch('/struktur/struktur-etrafli/get-phone-types', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            let result = await response.json();
            if (result.success) {
                phoneTypes = result.data;
            }
        } catch (e) {
            console.error('phone_types yüklənmədi:', e);
        }
    }
    // Səhifə yükləndikdə çağırın
    document.addEventListener('DOMContentLoaded', () => {
        loadRelationshipTypes();
        loadMilitaryTypes();
        loadPhoneTypes();
    });
    let currentCardType = null;
    let currentEditIndex = null;
    let currentEditId = null;
    let addFormaInfoModal = null

    //form yuklenme
    document.addEventListener('click', async function(e) {
        let btn = e.target.closest('.forma-btn');
        if (!btn) return;
        const modal = document.querySelector('#addFormaInfoModal');
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


        let userId = btn.dataset.userId;
        let firstName = btn.dataset.userFirstName;
        let lastName = btn.dataset.userLastName;
        let fatherName = btn.dataset.userFatherName;

        addFormaInfoModal = document.getElementById('addFormaInfoModal');

        addFormaInfoModal.querySelector('#userFullNameSpan').innerText =
            `${firstName} ${lastName} ${fatherName}`.trim();

        addFormaInfoModal.querySelector('#form_user_id').value = userId;
        addFormaInfoModal.querySelector('#form_current_first_name').value = firstName;
        addFormaInfoModal.querySelector('#form_current_last_name').value = lastName;
        addFormaInfoModal.querySelector('#form_current_father_name').value = fatherName;

        // Backend data
        await loadDataFromBackend(userId);

        // table yarat
        addFormaInfoModal.querySelectorAll('[data-entries]').forEach(body => {
            if (body.querySelector('.table-responsive table')) return;
            createTableForCard(body);
        });
        Swal.close();
        modal.classList.remove("blurred");
    });
    //table yaratma
    function createTableForCard(cardBody) {
        let container = cardBody.querySelector('.table-responsive');
        if (!container) return;
        let cardType = cardBody.closest('[data-card-type]')?.dataset.cardType;
        let table = document.createElement('table');
        table.className = 'data-table table table-bordered table-hover text-center';
        let thead = document.createElement('thead');
        let tbody = document.createElement('tbody');
        tbody.id = `tbody-${cardType}`;
        let headers = [];
        let columnWidths = [];
        if (cardType === 'relative') {
            headers = ['Qohumluq', 'Tam ad', 'Doğum tarixi', 'İş yeri', 'Vəzifə', 'Ünvan', 'Əməliyyatlar'];
            columnWidths = ['8%', '', '10%', '15%', '12%', '23%', '10%'];
        } else if (cardType === 'criminal') {
            headers = ['Səbəb', 'Tarix', 'Əməliyyatlar'];
            columnWidths = ['', '10%', '10%'];
        } else if (cardType === 'military') {
            headers = ['Rütbə növü', 'Rütbə', 'Vəzifə', 'Xidmət tarixi', 'Əməliyyatlar'];
            columnWidths = ['12%', '', '', '10%', '9%'];
        } else if (cardType === 'phone') {
            headers = ['Növ', 'Nömrə', 'Əməliyyatlar'];
            columnWidths = ['10%', '', '10%'];
        } else if (cardType === 'employment') {
            headers = ['Başlama', 'Bitmə', 'Təşkilat', 'Vəzifə', 'Əməliyyatlar'];
            columnWidths = ['10%', '10%', '', '', '10%'];
        } else if (cardType === 'namechange') {
            headers = ['Köhnə ad', 'Köhnə soyad', 'Köhnə ata adı', 'Tarix', 'Səbəb', 'Əməliyyatlar'];
            columnWidths = ['12%', '12%', '12%', '10%', '', '9%'];
        }
        let tr = document.createElement('tr');
        headers.forEach((h, index) => {
            let th = document.createElement('th');
            th.innerText = h;
            th.classList.add('text-center');
            if (columnWidths[index]) {
                th.style.width = columnWidths[index];
                th.style.whiteSpace = 'nowrap';
            }
            tr.appendChild(th);
        });
        thead.appendChild(tr);
        table.appendChild(thead);
        table.appendChild(tbody);
        container.innerHTML = '';
        container.appendChild(table);
    }
    //tbody duzenleme
    function renderTableRows(cardType, data) {
        let tbody = document.getElementById(`tbody-${cardType}`);
        if (!tbody) return;
        tbody.innerHTML = '';
        data.forEach((item, idx) => {
            let row = tbody.insertRow();
            let actionhtml = `<i class="fas fa-edit form-edit-item" 
                            data-type="${cardType}" 
                            data-index="${idx}" 
                            data-id="${item.id || ''}"></i> 
                            <i class="fas fa-trash form-delete-item"
                            data-type="${cardType}"
                            data-index="${idx}"
                            data-id="${item.id || ''}"></i>`;

            if (cardType === 'relative') {
                let relationshipName = relationshipTypes.find(t => t.id == item.relationship_type_id)?.name || '';
                let cell0 = row.insertCell(0);
                let cell1 = row.insertCell(1);
                let cell2 = row.insertCell(2);
                let cell3 = row.insertCell(3);
                let cell4 = row.insertCell(4);
                let cell5 = row.insertCell(5);
                let cell6 = row.insertCell(6);
                [cell0, cell1, cell2, cell3, cell4, cell5, cell6].forEach(cell => cell.classList.add('text-center'));

                cell0.innerText = relationshipName; // əvvəl item.degree idi
                cell1.innerText = item.full_name || item.fullname || '';
                cell2.innerText = item.birth_date || item.birthdate || '';
                cell3.innerText = item.workplace || '';
                cell4.innerText = item.position || '';
                cell5.innerText = item.registered_address || item.address || '';
                cell6.innerHTML = actionhtml;
            } else if (cardType === 'criminal') {
                let cell0 = row.insertCell(0);
                let cell1 = row.insertCell(1);
                let cell2 = row.insertCell(2);
                [cell0, cell1, cell2].forEach(cell => cell.classList.add('text-center'));
                cell0.innerText = item.reason || '';
                cell1.innerText = item.date || '';
                cell2.innerHTML = actionhtml;
            } else if (cardType === 'military') {
                let militaryTypeName = militaryTypes.find(t => t.id == item.military_type_id)?.name || '';
                let cell0 = row.insertCell(0);
                let cell1 = row.insertCell(1);
                let cell2 = row.insertCell(2);
                let cell3 = row.insertCell(3);
                let cell4 = row.insertCell(4);

                [cell0, cell1, cell2, cell3, cell4].forEach(cell => cell.classList.add('text-center'));


                cell0.innerText = militaryTypeName; // əvvəl rankTypeText idi
                cell1.innerText = item.rank || '';
                cell2.innerText = item.position || '';
                cell3.innerText = item.service_date || item.serviceDate || '';
                cell4.innerHTML = actionhtml;
            } else if (cardType === 'phone') {
                let phoneTypeName = phoneTypes.find(t => t.id == item.phone_type_id)?.name || '';
                let cell0 = row.insertCell(0);
                let cell1 = row.insertCell(1);
                let cell2 = row.insertCell(2);
                [cell0, cell1, cell2].forEach(cell => cell.classList.add('text-center'));
                cell0.innerText = phoneTypeName; // əvvəl item.type idi
                cell1.innerText = item.number || '';
                cell2.innerHTML = actionhtml;
            } else if (cardType === 'employment') {
                let cell0 = row.insertCell(0);
                let cell1 = row.insertCell(1);
                let cell2 = row.insertCell(2);
                let cell3 = row.insertCell(3);
                let cell4 = row.insertCell(4);
                [cell0, cell1, cell2, cell3, cell4].forEach(cell => cell.classList.add('text-center'));
                cell0.innerText = item.start_date || item.start || '';
                cell1.innerText = item.end_date || item.end || '';
                cell2.innerText = item.organization || item.org || '';
                cell3.innerText = item.position || '';
                cell4.innerHTML = actionhtml;
            } else if (cardType === 'namechange') {
                let cell0 = row.insertCell(0);
                let cell1 = row.insertCell(1);
                let cell2 = row.insertCell(2);
                let cell3 = row.insertCell(3);
                let cell4 = row.insertCell(4);
                let cell5 = row.insertCell(5);
                [cell0, cell1, cell2, cell3, cell4, cell5].forEach(cell => cell.classList.add('text-center'));
                cell0.innerText = item.old_first_name || '';
                cell1.innerText = item.old_last_name || '';
                cell2.innerText = item.old_father_name || '';
                cell3.innerText = item.date || '';
                cell4.innerText = item.reason || '';
                cell5.innerHTML = actionhtml;
            }
        });
    }
    let dataStore = {
        relative: [],
        criminal: [],
        military: [],
        phone: [],
        employment: [],
        namechange: []
    };
    //forma add,update modal acilma html kodu
    function getFormHTML(cardType, editData = null, userId = null) {
        if (cardType === 'relative') {
            let degreeOptions = relationshipTypes.map(type =>
                `<option ${editData?.relationship_type_id == type.id ? 'selected' : ''} value="${type.id}">${type.name}</option>`
            ).join('');
            return `
                <div class="row g-2">
                    <input type="hidden" name="user_id" value="${userId}">
                    <input type="hidden" name="id" value="${editData?.id || ''}">
                    <div class="col-md-3"><label>Qohumluq dərəcəsi</label><select name="relationship_type_id" class="form-control" required>${degreeOptions}</select></div>
                    <div class="col-md-6"><label>Tam ad</label><input type="text" name="fullname" class="form-control" value="${editData?.fullname || ''}" required></div>
                    <div class="col-md-3"><label>Doğum tarixi</label><input type="date" name="birthdate" class="form-control" value="${editData?.birthdate || ''}"></div>
                    <div class="col-md-6"><label>İş yeri</label><input type="text" name="workplace" class="form-control" value="${editData?.workplace || ''}"></div>
                    <div class="col-md-6"><label>Vəzifə</label><input type="text" name="position" class="form-control" value="${editData?.position || ''}"></div>
                    <div class="col-12"><label>Qeydiyyat ünvanı</label><input type="text" name="address" class="form-control" value="${editData?.address || ''}"></div>
                </div>`;
        } else if (cardType === 'criminal') {
            return `
                <div class="row">
                <input type="hidden" name="user_id" value="${userId}">
                    <input type="hidden" name="id" value="${editData?.id || ''}">
                    <div class="col-12"><label>Səbəb</label><textarea name="reason" class="form-control" rows="2" required>${editData?.reason || ''}</textarea></div>
                    <div class="col-12 mt-2"><label>Tarix</label><input type="date" name="date" class="form-control" value="${editData?.date || ''}" required></div>
                </div>`;
        } else if (cardType === 'military') {
            let rankTypeOptions = militaryTypes.map(type =>
                `<option ${editData?.military_type_id == type.id ? 'selected' : ''} value="${type.id}">${type.name}</option>`
            ).join('');
            return `
                <div class="row">
                <input type="hidden" name="user_id" value="${userId}">
                    <input type="hidden" name="id" value="${editData?.id || ''}">
                    <div class="col-3"><label>Rütbə növü</label><select name="military_type_id" class="form-control" required>${rankTypeOptions}</select></div>
                    <div class="col-3"><label>Rütbə</label><input type="text" name="rank" class="form-control" value="${editData?.rank || ''}" required></div>
                    <div class="col-3"><label>Vəzifə</label><input type="text" name="position" class="form-control" value="${editData?.position || ''}"></div>
                    <div class="col-3"><label>Xidmət tarixi</label><input type="date" name="serviceDate" class="form-control" value="${editData?.serviceDate || ''}"></div>
                </div>`;
        } else if (cardType === 'phone') {

            let phoneTypeOptions = phoneTypes.map(type =>
                `<option ${editData?.phone_type_id == type.id ? 'selected' : ''} value="${type.id}">${type.name}</option>`
            ).join('');
            return `
                <div class="row">
                <input type="hidden" name="user_id" value="${userId}">
                    <input type="hidden" name="id" value="${editData?.id || ''}">
                    <div class="col-3"><label>Növ</label> <select name="phone_type_id" class="form-control" required>${phoneTypeOptions}</select></div>
                    <div class="col-9"><label>Nömrə</label><input type="text" name="number" class="form-control" value="${editData?.number || ''}" required></div>
                </div>`;
        } else if (cardType === 'employment') {
            return `
                <div class="row">
                <input type="hidden" name="user_id" value="${userId}">
                    <input type="hidden" name="id" value="${editData?.id || ''}">
                    <div class="col-3"><label>Başlama</label><input type="date" name="start" class="form-control" value="${editData?.start || ''}"></div>
                    <div class="col-3"><label>Bitmə</label><input type="date" name="end" class="form-control" value="${editData?.end || ''}"></div>
                    <div class="col-3"><label>Təşkilat</label><input type="text" name="org" class="form-control" value="${editData?.org || ''}" required></div>
                    <div class="col-3"><label>Vəzifə</label><input type="text" name="position" class="form-control" value="${editData?.position || ''}"></div>
                </div>`;
        } else if (cardType === 'namechange') {
            let firstName = document.getElementById('form_current_first_name').value;
            let lastName = document.getElementById('form_current_last_name').value;
            let fatherName = document.getElementById('form_current_father_name').value;
            return `
                <div class="row">
                <input type="hidden" name="user_id" value="${userId}">
                    <input type="hidden" name="id" value="${editData?.id || ''}">
                    <div class="col-3"><label>Köhnə ad</label><input type="text" name="old_first_name" class="form-control" value="${editData?.old_first_name || firstName}" required></div>
                    <div class="col-3"><label>Köhnə soyad</label><input type="text" name="old_last_name" class="form-control" value="${editData?.old_last_name || lastName}" required></div>
                    <div class="col-3"><label>Köhnə ata adı</label><input type="text" name="old_father_name" class="form-control" value="${editData?.old_father_name || fatherName}"></div>
                    <div class="col-3"><label>Tarix</label><input type="date" name="date" class="form-control" value="${editData?.date || ''}" required></div>
                    <div class="col-12"><label>Səbəb</label><textarea name="reason" class="form-control" required>${editData?.reason || ''}</textarea></div>
                </div>`;
        }
        return '';
    }
    //forma route secim
    function getRouteByCardType(cardType, isEdit = false, id = null, userId = null) {
        // const routes = {
        //     relative: isEdit ? `/struktur/struktur-etrafli/forma-qohum-redakte-et/${id}` : `/struktur/struktur-etrafli/forma-qohum-elave-et/${userId}`,
        //     criminal: isEdit ? `/struktur/struktur-etrafli/forma-cinayet-redakte-et/${id}` : `/struktur/struktur-etrafli/forma-cinayet-elave-et/${userId}`,
        //     military: isEdit ? `/struktur/struktur-etrafli/forma-rutbe-redakte-et/${id}` : `/struktur/struktur-etrafli/forma-rutbe-elave-et/${userId}`,
        //     phone: isEdit ? `/struktur/struktur-etrafli/forma-telefon-redakte-et/${id}` : `/struktur/struktur-etrafli/forma-telefon-elave-et/${userId}`,
        //     employment: isEdit ? `/struktur/struktur-etrafli/forma-is-yeri-redakte-et/${id}` : `/struktur/struktur-etrafli/forma-is-yeri-elave-et/${userId}`,
        //     namechange: isEdit ? `/struktur/struktur-etrafli/forma-ad-deyisme-redakte-et/${id}` : `/struktur/struktur-etrafli/forma-ad-deyisme-elave-et/${userId}`,
        // };
        // return routes[cardType] || '#';
        return '/struktur/struktur-etrafli/forma-emeliyyat';
    }
    //forma add,update modal acilma
    function openModalForCard(cardType, editIndex = null, editId = null, userId = null) {
        currentCardType = cardType;
        currentEditIndex = editIndex;
        currentEditId = editId;

        let editData = (editIndex !== null && dataStore[cardType][editIndex]) ? dataStore[cardType][editIndex] : null;
        document.getElementById('modalTitle').innerText = editIndex !== null ? 'Redaktə et' : 'Yeni əlavə et';
        document.getElementById('itemFormModalBody').innerHTML = getFormHTML(cardType, editData, userId);

        let form = document.getElementById('itemForm');
        form.action = getRouteByCardType(); // Tək route
        form.method = 'POST';

        // CSRF token əlavə et
        let csrfInput = form.querySelector('input[name="_token"]');
        if (!csrfInput) {
            csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
            form.appendChild(csrfInput);
        }

        let modal = new bootstrap.Modal(document.getElementById('formaItemModal'));
        modal.show();
    }
    //forma add, update submit
    document.getElementById('itemForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let url = getRouteByCardType();

        // Əməliyyat növünü və kart tipini əlavə et
        if (currentEditIndex !== null) {
            formData.append('_action', 'update');
            formData.append('id', currentEditId);
        } else {
            formData.append('_action', 'store');
        }
        formData.append('card_type', currentCardType);

        try {
            Swal.fire({
                title: 'Yüklənir...',
                text: 'Zəhmət olmasa gözləyin',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            let response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            let result = await response.json();

            if (result.success) {
                // Backend-dən gələn məlumatları frontend formatına çevir
                let formattedData = formatDataForFrontend(currentCardType, result.data);

                if (currentEditIndex !== null) {
                    dataStore[currentCardType][currentEditIndex] = formattedData;
                } else {
                    dataStore[currentCardType].push(formattedData);
                }

                renderTableRows(currentCardType, dataStore[currentCardType]);
                bootstrap.Modal.getInstance(document.getElementById('formaItemModal')).hide();
                Swal.fire('Uğurlu!', result.message, 'success');
            } else {
                Swal.fire('Xəta!', result.message, 'error');
            }
        } catch (error) {
            console.error(error);
            Swal.fire('Xəta!', 'Serverə göndərilərkən problem yarandı', 'error');
        }
    });

    // Backend məlumatlarını frontend formatına çevirən funksiya
    function formatDataForFrontend(cardType, backendData) {
        if (cardType === 'relative') {
            return {
                id: backendData.id,
                relationship_type_id: backendData.relationship_type_id, // əlavə edildi
                fullname: backendData.full_name || '',
                birthdate: backendData.birth_date || '',
                workplace: backendData.workplace || '',
                position: backendData.position || '',
                address: backendData.registered_address || ''
            };
        } else if (cardType === 'criminal') {
            return {
                id: backendData.id,
                reason: backendData.reason || '',
                date: backendData.date || ''
            };
        } else if (cardType === 'military') {
            return {
                id: backendData.id,
                military_type_id: backendData.military_type_id, // dəyişdi (əvvəl rankType)
                rank: backendData.rank || '',
                position: backendData.position || '',
                serviceDate: backendData.service_date || backendData.serviceDate || ''
            };
        } else if (cardType === 'phone') {
            return {
                id: backendData.id,
                phone_type_id: backendData.phone_type_id, // dəyişdi (əvvəl type)
                number: backendData.number || ''
            };
        } else if (cardType === 'employment') {
            return {
                id: backendData.id,
                start: backendData.start_date || '',
                end: backendData.end_date || '',
                org: backendData.organization || '',
                position: backendData.position || ''
            };
        } else if (cardType === 'namechange') {
            return {
                id: backendData.id,
                old_first_name: backendData.old_first_name || '',
                old_last_name: backendData.old_last_name || '',
                old_father_name: backendData.old_father_name || '',
                date: backendData.date || '',
                reason: backendData.reason || ''
            };
        }
        return backendData;
    }
    //forma modal acilma
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('form-add-btn')) {
            let btn = e.target;
            let cardType = btn.dataset.card;
            let userId = document.querySelector('#form_user_id').value;
            console.log('let userId = document.querySelector(#form_user_id).value;:' + userId);
            openModalForCard(cardType, null, null, userId);
        }
        if (e.target.classList.contains('form-edit-item')) {
            let idx = e.target.dataset.index;
            let cardType = e.target.dataset.type;
            let id = e.target.dataset.id;
            openModalForCard(cardType, parseInt(idx), id, null);
        }
        // Delete handler hissəsini dəyişdirin
        if (e.target.classList.contains('form-delete-item')) {
            let idx = e.target.dataset.index;
            let cardType = e.target.dataset.type;
            let id = e.target.dataset.id;

            Swal.fire({
                title: 'Əminsiniz?',
                text: "Bu məlumat silinəcək!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Ləğv et'
            }).then(async (result) => {

                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('_action', 'delete');
                    formData.append('card_type', cardType);
                    formData.append('id', id);
                    formData.append('_token', document.querySelector('input[name="_token"]').value);
                    Swal.fire({
                        title: 'Yüklənir...',
                        text: 'Zəhmət olmasa gözləyin',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    try {
                        let response = await fetch(getRouteByCardType(), {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        let result = await response.json();

                        if (result.success) {
                            dataStore[cardType].splice(idx, 1);
                            renderTableRows(cardType, dataStore[cardType]);
                            Swal.fire('Silindi!', '', 'success');
                        } else {
                            Swal.fire('Xəta!', result.message, 'error');
                        }
                    } catch (error) {
                        console.error(error);
                        Swal.fire('Xəta!', 'Silinərkən problem yarandı', 'error');
                    }
                }
            });
        }
    });
    document.querySelectorAll('[data-entries]').forEach(body => {
        createTableForCard(body);
    });
    // Backend-dən bütün məlumatları çəkən funksiya
    async function loadDataFromBackend(userId) {
        if (!userId) return;


        try {
            let response = await fetch(`/struktur/struktur-etrafli/${userId}/get-all-data`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            let result = await response.json();

            if (result.success) {
                // Hər bir card type üçün dataları formatla
                for (let cardType of ['relative', 'criminal', 'military', 'phone', 'employment', 'namechange']) {
                    if (result.data[cardType] && Array.isArray(result.data[cardType])) {
                        dataStore[cardType] = result.data[cardType].map(item =>
                            formatDataForFrontend(cardType, item)
                        );
                        renderTableRows(cardType, dataStore[cardType]);
                    }
                }
            }
        } catch (error) {
            console.error('Backend-dən data çəkilərkən xəta:', error);
        }
    }
</script>
<!-- 
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Uğurlu!',
        text: "{{ session('success') }}",
    });
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Xəta!',
        text: "{{ session('error') }}",
    });
</script>
@endif -->
@endsection