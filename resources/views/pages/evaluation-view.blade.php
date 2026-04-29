@extends('layouts.index')
@section('css')
    <style>
        .eval-table th {
            background-color: #00529b;
            color: #fff;
            text-align: center;
            vertical-align: middle;
        }
        .eval-table td {
            vertical-align: middle;
            font-size: 0.9rem;
        }
        .eval-table .summary-row td {
            background-color: #e6e6e6;
            font-weight: 600;
        }
        .eval-table .score-cell {
            text-align: center;
            width: 70px;
            white-space: nowrap;
        }
        .eval-table .indicator-cell {
            width: 240px;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="my-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-black">
                    <h5 class="mb-0 text-dark">İşçinin qiymətləndirilməsi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered eval-table mb-2 mt-3 align-middle text-center">
                            <thead>
                                <tr>
                                    <th class="indicator-cell">Göstəricilər</th>
                                    <th class="score-cell">Bal</th>
                                    <th>Qeyd</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Keyfiyyət</td>
                                    <td class="score-cell">8</td>
                                    <td>
                                        İşlər əsasən yüksək keyfiyyətlə yerinə yetirilir,
                                        detallara diqqət var.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kəmiyyət</td>
                                    <td class="score-cell">4</td>
                                    <td>
                                        Görülən işlərin həcmi azdır, daha çox məhsuldarlıq
                                        gözlənilir.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vaxta nəzarət</td>
                                    <td class="score-cell">7</td>
                                    <td>
                                        Tapşırıqların əksəriyyəti vaxtında tamamlanır, ara-sıra
                                        gecikmələr olur.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Təşəbbüskarlıq</td>
                                    <td class="score-cell">9</td>
                                    <td>
                                        Çox fəaldır, yeni ideyalar və təkliflərlə çıxış edir.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Komanda işinə yararlılıq</td>
                                    <td class="score-cell">3</td>
                                    <td>
                                        Komanda ilə işləməkdə ciddi çətinliklər mövcuddur,
                                        əməkdaşlıq bacarığı zəifdir.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Məsuliyyət</td>
                                    <td class="score-cell">6</td>
                                    <td>
                                        Tapşırıqları qəbul edir, amma bəzən məsuliyyəti tam
                                        daşımır.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Peşəkar bilik və bacarıqlar</td>
                                    <td class="score-cell">5</td>
                                    <td>
                                        Bilklər orta səviyyədədir, əlavə təlim və təcrübəyə
                                        ehtiyac var.
                                    </td>
                                </tr>
                                <tr>
                                    <td>İntizam</td>
                                    <td class="score-cell">9</td>
                                    <td>İş intizamı çox yaxşıdır, qaydalara tam əməl edir.</td>
                                </tr>
                                <tr>
                                    <td>Kommunikasiya</td>
                                    <td class="score-cell">10</td>
                                    <td>
                                        Əla ünsiyyət bacarığına malikdir, fikirlərini açıq və
                                        dəqiq çatdırır.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Problem həlli</td>
                                    <td class="score-cell">5</td>
                                    <td>
                                        Problemlərin həllində orta səviyyədədir, daha çevik
                                        yanaşmaya ehtiyac var.
                                    </td>
                                </tr>
                                <tr class="summary-row">
                                    <td>Orta bal</td>
                                    <td class="score-cell">6.6</td>
                                    <td></td>
                                </tr>
                                <tr class="summary-row">
                                    <td>Nəticə</td>
                                    <td class="score-cell"></td>
                                    <td>Orta</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
@endsection
