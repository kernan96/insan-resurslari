@extends('layouts.index')
@section('css')
    <style>
      .card-box {
    background-color: #ffffff;
    border: 1px solid rgba(83, 93, 107, 0.1); /* color-mix əvəzi */
    border-radius: 25px;
    padding: 50px 20px;
    min-width: 220px;
    height: 100%;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 8px 32px rgba(83, 93, 107, 0.1);
}
.card-box h4 {
    color: #003b7a;
    font-weight: 700;
    margin: 0;
}
.card-box:hover {
    background-color: #003b7a;
    transform: translateY(-5px);
}
.card-box:hover h4 {
    color: #fff;
}
.btn-kechid {
    display: inline-block;
    background-color: #003b7a;
    color: #fff;
    font-weight: 700;
    letter-spacing: 1px;
    border: none;
    padding: 6px 16px;
    border-radius: 3px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
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
        <div class="row g-4 justify-content-start">
            <div class="col-10 col-sm-6 col-md-3">
                <div class="card-box" onclick="window.location='{{ route('personal.document') }}'">
                    <h4>Kadr sənədləri</h4>
                </div>
            </div>
            {{--
            <div class="col-10 col-sm-6 col-md-3">
                <div class="card-box" onclick="window.location='{{ route('graduation-schedule') }}'">
                    <h4>Məzuniyyətlər</h4>
                </div>
            </div>
            <div class="col-10 col-sm-6 col-md-3">
                <div class="card-box" onclick="window.location='{{ route('permission-schedule') }}'">
                    <h4>İcazələr</h4>
                </div>
            </div>
            <div class="col-10 col-sm-6 col-md-3">
                <div class="card-box" onclick="window.location='{{ route('evaluation') }}'">
                    <h4>Qiymətləndirmə</h4>
                </div>
            </div>
            --}}
            <div class="col-10 col-sm-6 col-md-3">
                <div class="card-box" onclick="window.location='{{ route('education') }}'">
                    <h4>Təhsil və peşəkar inkişaf</h4>
                </div>
            </div>
            {{--
            <div class="col-10 col-sm-6 col-md-3">
                <div class="card-box" onclick="window.location='{{ route('training') }}'">
                    <h4>Təlim</h4>
                </div>
            </div>
            --}}
        </div>
    </section>
</main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
    <script>
        document.querySelectorAll('.card-box').forEach(card => {
            card.addEventListener('click', () => {
                const link = card.querySelector('a');
                if (link) {
                    window.location.href = link.href;
                }
            });
        });
    </script>
@endsection
