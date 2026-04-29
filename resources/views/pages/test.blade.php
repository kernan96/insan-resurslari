<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>SVG Test - SVG vs IMG</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }
        .method {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background: #f9f9f9;
        }
        .method h3 {
            margin-top: 0;
            text-align: center;
        }
        .icon-box {
            width: 100px;
            height: 100px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .icon-box svg {
            width: 50px;
            height: 50px;
        }
        .icon-box img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }
        .icon-box span {
            margin-top: 10px;
            font-size: 12px;
            color: #666;
        }
        hr {
            margin: 30px 0;
        }
        .note {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>SVG faylların müqayisəsi</h1>
    <p><strong>2.svg</strong> və <strong>3.svg</strong> faylları - həm SVG, həm IMG kimi çağırılıb</p>
    <div class="container">
        <!-- 2.svg - SVG kimi (file_get_contents) -->
        <div class="method">
            <h3>📄 2.svg - SVG kimi</h3>
            <div class="icon-box">
                {!! file_get_contents(public_path('files/2.svg')) !!}
                <span>file_get_contents()</span>
            </div>
            <small>CSS ilə rəng dəyişə bilər, amma !important lazımdır</small>
        </div>
        <!-- 2.svg - IMG kimi -->
        <div class="method">
            <h3>🖼️ 2.svg - IMG kimi</h3>
            <div class="icon-box">
                <img src="{{ asset('files/2.svg') }}" alt="2.svg">
                <span>&lt;img src=""&gt;</span>
            </div>
            <small>CSS ilə rəng dəyişməz, statik şəkil kimi görünür</small>
        </div>
        <!-- 3.svg - SVG kimi (file_get_contents) -->
        <div class="method">
            <h3>📄 3.svg - SVG kimi</h3>
            <div class="icon-box">
                {!! file_get_contents(public_path('files/3.svg')) !!}
                <span>file_get_contents()</span>
            </div>
            <small>CSS ilə rəng dəyişə bilər, amma !important lazımdır</small>
        </div>
        <!-- 3.svg - IMG kimi -->
        <div class="method">
            <h3>🖼️ 3.svg - IMG kimi</h3>
            <div class="icon-box">
                <img src="{{ asset('files/3.svg') }}" alt="3.svg">
                <span>&lt;img src=""&gt;</span>
            </div>
            <small>CSS ilə rəng dəyişməz, statik şəkil kimi görünür</small>
        </div>
    </div>
    <hr>
    <h2>Orijinal ölçüdə (img kimi):</h2>
    <div style="display: flex; gap: 20px;">
        <div>
            <strong>2.svg</strong><br>
            <img src="/files/2.svg" alt="2.svg" style="width: 200px; border:1px solid #ccc;">
        </div>
        <div>
            <strong>3.svg</strong><br>
            <img src="/files/3.svg" alt="3.svg" style="width: 200px; border:1px solid #ccc;">
        </div>
    </div>
    <div class="note">
        <strong>📌 Qeyd:</strong>
        <ul>
            <li><strong>SVG kimi (file_get_contents)</strong> - HTML-in içinə yazılır, CSS ilə rəng, ölçü dəyişdirmək olar</li>
            <li><strong>IMG kimi</strong> - Ayrı bir fayl kimi yüklənir, CSS ilə rəng dəyişməz</li>
            <li>Hər iki üsulda da SVG görünmürsə, <strong>fayl yolu</strong> səhvdir və ya <strong>fayllar zədəlidir</strong></li>
        </ul>
    </div>
    <script>
        // Konsola fayl yollarını yaz
        console.log('2.svg yolu:', '{{ asset('files/2.svg') }}');
        console.log('3.svg yolu:', '{{ asset('files/3.svg') }}');
    </script>
</body>
</html>