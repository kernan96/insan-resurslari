@extends('layouts.index')
@section('css')
    <style>
        .year-box {
            background: #004f9e;
            color: white;
            padding: 18px;
            border-radius: 20px;
            font-size: 20px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 18px;
            transition: 0.2s;
        }
        .year-box:hover {
            background: #003a73;
        }
        a {
            text-decoration: none;
        }
        .pagination .page-item.active .page-link {
            background-color: #3bb26e;
            border-radius: 50%;
            border-color: #3bb26e;
        }
        .pagination .page-link {
            border: none;
            font-weight: bold;
            color: #004f9e;
        }
        .add-btn {
            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="container">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('evaluation-add') }}" class="btn btn-outline-primary add-btn">➕ Əlavə et</a>
            </div>
            <div class="mx-auto" style="max-width: 700px">
                <a href="{{ route('evaluation-list') }}">
                    <div class="year-box">2025</div>
                </a>
                <a href="{{ route('evaluation-list') }}">
                    <div class="year-box">2024</div>
                </a>
                <a href="{{ route('evaluation-list') }}">
                    <div class="year-box">2023</div>
                </a>
                <a href="{{ route('evaluation-list') }}">
                    <div class="year-box">2022</div>
                </a>
                <a href="{{ route('evaluation-list') }}">
                    <div class="year-box">2021</div>
                </a>
                <a href="{{ route('evaluation-list') }}">
                    <div class="year-box">2020</div>
                </a>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">‹</a></li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                </ul>
            </div>
        </div>
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
@endsection
