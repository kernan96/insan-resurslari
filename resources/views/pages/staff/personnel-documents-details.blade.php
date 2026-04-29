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
                    </div>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table id="employeesTable" class="table table-striped table-hover w-100 align-middle text-center">
                            <thead class="table-light bg-primary text-white">
                                <tr>
                                    <th> Kadrlar uçotunun şəxsi vərəqəsi </th>
                                    <th> Tərcümeyi-hal </th>
                                    <th> Bioqrafik arayış </th>
                                    <th> Kadrlar uçotunun şəxsi vərəqəsi </th>
                                    <th> Dövlət qulluqçusunun şəxsi vərəqəsi </th>
                                    <th> Sertifikatlar </th>
                                    <th> Əmrlər </th>
                                    <th> Müqavilələr </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></td>
                                    <td><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></td>
                                    <td><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></td>
                                    <td><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></td>
                                    <td><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></td>
                                    <td><a href="{{ route('certificates') }}" class="text-primary"><i
                                                class="bi bi-eye-fill"></i></a>
                                    </td>
                                    <td><a href="{{ route('order') }}" class="text-primary"><i
                                                class="bi bi-eye-fill"></i></a></td>
                                    <td><a href="{{ route('contract') }}" class="text-primary"><i
                                                class="bi bi-eye-fill"></i></a>
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
@endsection
