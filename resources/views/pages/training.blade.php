@extends('layouts.index')
@section('css')
    <style>
        .card-box {
            background-color: #004a99;
            color: white;
            border-radius: 25px;
            text-align: center;
            padding: 50px 20px;
            min-width: 220px;
            transition: 0.3s;
        }
        .card-box:hover {
            background-color: #003b7a;
            transform: translateY(-5px);
        }
        .btn-kechid {
            background-color: white;
            color: #c2185b;
            font-weight: 700;
            letter-spacing: 1px;
            border: none;
            padding: 6px 16px;
            border-radius: 3px;
            font-size: 0.9rem;
        }
        .btn-kechid:hover {
            background-color: #f2f2f2;
            color: #a01548;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <section class="container-fluid py-5">
            <div class="row g-4">
                <div class="col-10 col-sm-6 col-md-3">
                    <div class="card-box">
                        <h4 class="mb-4 fw-bold">Təlim ehtiyacları</h4>
                        <a href="{{ route('training-needs') }}" class="btn-kechid">KEÇİD ET</a>
                    </div>
                </div>
                <div class="col-10 col-sm-6 col-md-3">
                    <div class="card-box">
                        <h4 class="mb-4 fw-bold">Təlim planlaşdırılması</h4>
                        <a href="{{ route('training-planning') }}" class="btn-kechid">KEÇİD ET</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
@endsection
