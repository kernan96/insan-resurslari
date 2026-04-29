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
                        <div class="col-12 col-md-2">
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
                                <option>İşçi 1</option>
                                <option>İşçi 2</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label d-block">Kateqoriya</label>
                            <select id="dovletqullugu" class="form-select form-select-sm">
                                <option value="0">İnzibati vəzifə tutan dövlət qulluqçusu</option>
                                <option value="1">Digər</option>
                                <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;Yardımçı vəzifə tutan dövlət
                                    qulluqçusu
                                </option>
                                <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;Müqaviləli işçi</option>
                                <option disabled style="font-style:italic">&nbsp;&nbsp;&nbsp;Tabeli qurum işçisi</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2" id="rehbersexs">
                            <label class="form-label d-block">Rəhbər şəxsdir?</label>
                            <select id="isManager" class="form-select form-select-sm">
                                <option value="0" selected>Xeyr</option>
                                <option value="1">Bəli</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="row g-3" id="qiymetlendirme-inzibati">
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="1" class="criteria-title">
                                <b>peşə bilikləri</b> - dövlət qulluqçusunun tutduğu vəzifə üzrə nəzəri və praktiki
                                biliklərə malik
                                olmasının və həmin biliklərin əmək funksiyalarının icrası zamanı düzgün tətbiqinin, habelə
                                vəzifəsinin
                                tələblərinə uyğun olan səviyyədə inzibati icraat və kargüzarlıq sahəsində normativ hüquqi
                                aktlara dair
                                biliklərinin qiymətləndirilməsi nəzərdə tutulur
                            </div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%" />
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10" />
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly
                                        placeholder="Hesablanır" />
                                </div>
                                <div class="col-6 dhqeyd">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="2" class="criteria-title">
                                <b>qulluq (xidməti) vəzifələrinə münasibəti</b> – dövlət qulluqçusunun öz vəzifələrini, o
                                cümlədən
                                verilən tapşırıqları minimum nəzarətlə sərbəst, tələb edilən səviyyədə və vaxtında yerinə
                                yetirmək,
                                sənədləri keyfiyyətlə tərtib etmək, fəal olmaq, tələb olunandan artıq nailiyyətlər əldə
                                etmək üçün
                                çalışmaq bacarıqlarının qiymətləndirilməsi nəzərdə tutulur
                            </div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%" />
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10" />
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly
                                        placeholder="Hesablanır" />
                                </div>
                                <div class="col-6 dhqeyd">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="3" class="criteria-title">
                                <b>təhlil aparmaq, problem həll etmək və qərar vermək bacarığı</b> – sənəd və faktları
                                diqqətlə təhlil
                                etmək, problemləri müəyyən etmək və anlamaq, düzgün nəticəyə gəlmək üçün müxtəlif
                                mənbələrdən olan
                                məlumatları müqayisə etmək və problemlərin həlli yollarını müəyyənləşdirmək, qanunauyğun və
                                məntiqi
                                qərarlar qəbul etmək bacarıqlarının qiymətləndirilməsi nəzərdə tutulur
                            </div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%" />
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10" />
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly
                                        placeholder="Hesablanır" />
                                </div>
                                <div class="col-6 dhqeyd">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="4" class="criteria-title">
                                <b>yaradıcılıq və təşəbbüskarlıq</b> – qulluq keçdiyi sahənin inkişafı ilə bağlı yaradıcı və
                                səmərəli
                                təkliflər irəli sürmək, işdəki problemlər və faktlarla bağlı müxtəlif və qeyri-standart
                                həlletmə
                                variantlarını sınaqdan keçirmək bacarıqlarının, təşəbbüs göstərməkdə sərbəstliyinin
                                qiymətləndirilməsi
                                nəzərdə tutulur
                            </div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%" />
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10" />
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly
                                        placeholder="Hesablanır" />
                                </div>
                                <div class="col-6 dhqeyd">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="5" class="criteria-title">
                                <b>iş təcrübəsi və onu bölüşmə</b> – qulluq keçdiyi sahədə malik olduğu iş təcrübəsini
                                kollektiv
                                üzvləri ilə bölüşmək və yeni təcrübəyə yiyələnmək bacarıqlarının qiymətləndirilməsi nəzərdə
                                tutulur
                            </div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%" />
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10" />
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly
                                        placeholder="Hesablanır" />
                                </div>
                                <div class="col-6 dhqeyd">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="6" class="criteria-title">
                                <b>kollektivdə işləmək və ünsiyyət bacarığı</b> – komanda tərkibində və iş yoldaşları ilə
                                sıx əlaqədə
                                işləmək, rəhbərlərlə və iş yoldaşları ilə ünsiyyət, xoş və işgüzar münasibətlər qurmaq, iş
                                yoldaşlarına dəstək olmaq və lazım gəldikdə onlardan dəstək ala bilmək, qrupun aktiv üzvü
                                olaraq qrup
                                hədəflərinə nail olmağa çalışmaq, iş üzrə hədəflərə nail olmaq üçün digər bölmə və
                                qurumların
                                əməkdaşları ilə əlaqələr qurmaq bacarıqlarının qiymətləndirilməsi nəzərdə tutulur
                            </div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%" />
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10" />
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: block;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly
                                        placeholder="Hesablanır" />
                                </div>
                                <div class="col-6 dhqeyd">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="managerCriteria" style="display:none;">
                        <div class="col-12">
                            <div class="criteria-card">
                                <div criteriatitleid="7" class="criteria-title">
                                    <b>proqnozlaşdırma</b> – rəhbərlik etdiyi struktur bölmənin fəaliyyət istiqamətinə uyğun
                                    layihələrə
                                    dair
                                    təkliflər vermək və gələcək planlarla bağlı nəticələrin qiymətləndirilməsi nəzərdə
                                    tutulur
                                </div>
                                <div class="row g-2">
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="%">
                                    </div>
                                    <div class="col-2 qiymet">
                                        <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                    </div>
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Fərdi qiymət</label>
                                        <input type="number" class="form-control form-control-sm" readonly
                                            placeholder="Hesablanır">
                                    </div>
                                    <div class="col-6 dhqeyd">
                                        <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                        <textarea class="form-control form-control-sm" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="criteria-card">
                                <div criteriatitleid="8" class="criteria-title">
                                    <b>idarəetmə</b> – işçilərə rəhbərlik etmək, onları istiqamətləndirmək, bilik və
                                    bacarıqlarını
                                    inkişaf etdirmək,
                                    kadr potensialından düzgün istifadə etmək və işin səmərəli təşkilinə nail olmaq
                                    bacarıqlarının
                                    qiymətləndirilməsi nəzərdə tutulur
                                </div>
                                <div class="row g-2">
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="%">
                                    </div>
                                    <div class="col-2 qiymet">
                                        <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                    </div>
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Fərdi qiymət</label>
                                        <input type="number" class="form-control form-control-sm" readonly
                                            placeholder="Hesablanır">
                                    </div>
                                    <div class="col-6 dhqeyd">
                                        <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                        <textarea class="form-control form-control-sm" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="criteria-card">
                                <div criteriatitleid="9" class="criteria-title">
                                    <b>kollektiv daxilində nüfuz və ruhlandırmaq bacarığı</b> – tabeliyindəki əməkdaşları
                                    motivasiya
                                    etmək,
                                    onlarla düzgün işgüzar münasibətlər qurmaq və problemlərin həllində dəstək olmaq
                                    bacarıqlarının
                                    qiymətləndirilməsi nəzərdə tutulur
                                </div>
                                <div class="row g-2">
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="%">
                                    </div>
                                    <div class="col-2 qiymet">
                                        <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                    </div>
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Fərdi qiymət</label>
                                        <input type="number" class="form-control form-control-sm" readonly
                                            placeholder="Hesablanır">
                                    </div>
                                    <div class="col-6 dhqeyd">
                                        <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                        <textarea class="form-control form-control-sm" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="criteria-card">
                                <div criteriatitleid="10" class="criteria-title">
                                    <b>komanda qurmaq bacarığı</b> – tabeliyindəki işçiləri səfərbər etmək, etimada
                                    əsaslanan kollektiv
                                    formalaşdırmaq
                                    və verilmiş tapşırıqları komanda ilə müvəffəqiyyətlə icra etmək bacarıqlarının
                                    qiymətləndirilməsi
                                    nəzərdə tutulur
                                </div>
                                <div class="row g-2">
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="%">
                                    </div>
                                    <div class="col-2 qiymet">
                                        <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                        <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                    </div>
                                    <div class="col-2 ferdiqiymet" style="display: block;">
                                        <label class="form-label form-label-sm">Fərdi qiymət</label>
                                        <input type="number" class="form-control form-control-sm" readonly
                                            placeholder="Hesablanır">
                                    </div>
                                    <div class="col-6 dhqeyd">
                                        <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                        <textarea class="form-control form-control-sm" rows="1"></textarea>
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
                </div>
                <div class="row g-3" id="qiymetlendirme-diger" style="display:none;">
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="1" class="criteria-title"><b>Peşəkar bilik və bacarıqlar</b> – Vəzifənin
                                icrası üçün
                                zəruri olan bilik və bacarıqlara malik olmaq və onları daim inkişaf etdirmək.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="2" class="criteria-title"><b>Keyfiyyət</b> – Tapşırıqların dəqiqliklə,
                                səhvsiz
                                icrası və əldə edilən nəticələrin tələb olunan standartlara uyğunluğu.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="3" class="criteria-title"><b>Problem həlli</b> – Problemləri düzgün
                                müəyyənləşdirmək, təhlil etmək və effektiv həll yolları tapmaq.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="4" class="criteria-title"><b>Təşəbbüskarlıq</b> – Yeni ideyalar irəli
                                sürmək,
                                problemləri müstəqil şəkildə həll etmək və işin təkmilləşdirilməsi üçün təşəbbüs göstərmək.
                            </div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="5" class="criteria-title"><b>Kəmiyyət</b> – Müəyyən edilmiş müddət
                                ərzində yerinə
                                yetirilən işin həcmi.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="6" class="criteria-title"><b>Kommunikasiya</b> – Şifahi və yazılı
                                formada aydın,
                                düzgün və effektiv ünsiyyət qurmaq.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="7" class="criteria-title"><b>Vaxta nəzarət</b> – Tapşırıqların müəyyən
                                edilmiş
                                vaxt çərçivəsində vaxtında və tam şəkildə tamamlanması.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="8" class="criteria-title"><b>Məsuliyyət</b> – Vəzifə öhdəliklərinə
                                vicdanla
                                yanaşmaq, verilmiş tapşırıqlara və qəbul edilmiş qərarlara əməl etmək.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="9" class="criteria-title"><b>Komanda işinə yararlılıq</b> – İş
                                yoldaşları ilə
                                effektiv əməkdaşlıq etmək, qarşılıqlı dəstək göstərmək və ümumi məqsədə nail olmaq üçün səy
                                göstərmək.
                                Bu zaman digər əməkdaşların rəyləri də nəzərə alına bilər (360 dərəcə qiymətləndirmə).</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="criteria-card">
                            <div criteriatitleid="10" class="criteria-title"><b>İntizam</b>Daxili əmək intizamı
                                qaydalarına riayət
                                etmək.</div>
                            <div class="row g-2">
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Meyarın mühümlük dərəcəsi (%)</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="%">
                                </div>
                                <div class="col-2 qiymet">
                                    <label class="form-label form-label-sm">Meyar üzrə verilən qiymət</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0 - 10">
                                </div>
                                <div class="col-2 ferdiqiymet" style="display: none;">
                                    <label class="form-label form-label-sm">Fərdi qiymət</label>
                                    <input type="number" class="form-control form-control-sm" readonly=""
                                        placeholder="Hesablanır">
                                </div>
                                <div class="dhqeyd col-10">
                                    <label class="form-label form-label-sm">Dəyişiklik haqqında qeyd</label>
                                    <textarea class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            Yadda saxla
                        </button>
                    </div>
                </div>
            </div>
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
    <script>
        document.getElementById('isManager').addEventListener('change', function() {
            let block = document.getElementById('managerCriteria');
            if (this.value == "1") {
                block.style.display = "block";
            } else {
                block.style.display = "none";
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const select = document.getElementById("dovletqullugu");
            const rehber = document.getElementById("rehbersexs");
            const inzibatiDiv = document.getElementById("qiymetlendirme-inzibati");
            const digerDiv = document.getElementById("qiymetlendirme-diger");
            function handleChange() {
                const value = select.value;
                if (value === "0") {
                    rehber.style.display = "";
                    inzibatiDiv.style.display = "flex";
                    digerDiv.style.display = "none";
                }
                if (value === "1") {
                    rehber.style.display = "none";
                    inzibatiDiv.style.display = "none";
                    digerDiv.style.display = "flex";
                }
            }
            select.addEventListener("change", handleChange);
            handleChange();
        });
    </script>
@endsection
