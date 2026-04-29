@extends('layouts.index')
@section('css')
    <style>
        body {
            background: #f7f7fb;
        }
        .card {
            border: 0;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }
        .dt-buttons .btn {
            margin-right: 0.5rem;
        }
        table.dataTable>tbody>tr>td {
            vertical-align: middle;
        }
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
                    <h5 class="mb-0 text-dark">Qiymətləndirmə</h5>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn bg-info btn-sm d-flex align-items-center text-white" data-bs-toggle="collapse"
                            data-bs-target="#filterPanel" aria-expanded="false" aria-controls="filterPanel">
                            <i class="bi bi-funnel me-1"></i> Axtarış filteri
                        </button>
                        <a href="{{ route('evaluation-add') }}" class="btn btn-success btn-sm d-flex align-items-center">
                            <i class="bi bi-plus-circle me-1"></i> Əlavə et
                        </a>
                    </div>
                </div>
                <div id="filterPanel" class="collapse mt-3">
                    <div class="card card-body p-3">
                        <form id="filtersForm" class="row g-3">
                            <div class="row g-3">
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
                                    <label class="form-label">Nəticə</label>
                                    <div class="input-group">
                                        <select class="form-select">
                                            <option selected disabled>Seçin...</option>
                                            <option>Yüksək</option>
                                            <option>Orta</option>
                                            <option>Aşağı</option>
                                            <option>Qənaətbəxş olmayan</option>
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
                                    <th>Orta bal</th>
                                    <th>Nəticə</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kənan Əliyev Fərhad</td>
                                    <td>6.4</td>
                                    <td>Yüksək</td>
                                    <td class="action-btns">
                                        <a href="{{ route('evaluation-view') }}" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="tooltip" data-bs-title="Bax">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('evaluation-edit') }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger btnDelete" data-bs-title="Sil">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Süleymanova Günel Alməmməd</td>
                                    <td>7.2</td>
                                    <td>Orta</td>
                                    <td class="action-btns">
                                        <a href="{{ route('evaluation-view') }}" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="tooltip" data-bs-title="Bax">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('evaluation-edit') }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger btnDelete" data-bs-title="Sil">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Süleymanova Günel Alməmməd</td>
                                    <td>6.2</td>
                                    <td>Aşağı</td>
                                    <td class="action-btns">
                                        <a href="{{ route('evaluation-view') }}" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="tooltip" data-bs-title="Bax">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('evaluation-edit') }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger btnDelete" data-bs-title="Sil">
                                            <i class="bi bi-trash"></i>
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
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
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
