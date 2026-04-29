@extends('layouts.index')
@section('css')
    <style>
        .eval-wrapper {
            background-color: #f5f6f8;
            padding: 1.5rem;
            border-radius: 0.75rem;
            border: 1px solid #dee2e6;
        }
        .criteria-card {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 0.75rem 0.75rem 1rem;
            height: 100%;
        }
        .criteria-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
            padding-bottom: 0.2rem;
            border-bottom: 1px solid #dee2e6;
        }
        .form-label-sm {
            font-size: 0.75rem;
            margin-bottom: 0.15rem;
        }
        textarea.form-control-sm {
            min-height: 90px;
            resize: vertical;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="container-fluid my-3">
            <div class="eval-wrapper">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-3">
                            <label class="form-label">İl</label>
                            <select class="form-select form-select-sm">
                                <option selected>Zəhmət olmasa seçin</option>
                                <option>2024</option>
                                <option>2025</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Ad, soyad, ata adı</label>
                            <select class="form-select form-select-sm">
                                <option selected>Zəhmət olmasa seçin</option>
                                <option>Əli Əliyev</option>
                                <option>Günel Məmmədova</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Keyfiyyət</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="4" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    İşini yüksək keyfiyyətlə yerinə yetirir.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Kəmiyyət</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="4" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Tapşırıqları vaxtında və lazımi sayda yerinə yetirir.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Vaxta nəzarət</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="5" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Hər zaman vaxtında olur və gecikmə etmir.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Təşəbbüskarlıq</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="3" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Yeni ideyalar təklif etməyə çalışır.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Komanda işinə yararlılıq</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="5" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Komanda ilə yaxşı işləyir.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Məsuliyyət</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="5" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Öz işinə ciddi yanaşır.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Peşəkar bilik və bacarıqlar</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="4" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Peşəkar biliyi yaxşı səviyyədədir.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">İntizam</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="5" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    İş qaydalarına ciddi riayət edir.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Kommunikasiya</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="4" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Açıq və səmərəli ünsiyyət qurur.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="criteria-card">
                                <div class="criteria-title">Problem həlli</div>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <label class="form-label form-label-sm">Bal</label>
                                        <input type="number" class="form-control form-control-sm" value="3" />
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label form-label-sm">Qeyd</label>
                                        <textarea class="form-control form-control-sm">
    Problemlərə yaradıcı yanaşır.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            Yadda saxla
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
@endsection
