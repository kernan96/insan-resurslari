<!DOCTYPE html>
<html lang="az">
<head>
    @include('include.head')
    {{-- səhifəyə özəl CSS --}}
    @yield('css')
</head>
<body>
    @include('include.header')
    @include('include.sidebar')
    @yield('content')
    @include('include.footer')
    {{-- səhifəyə özəl JS --}}
    @yield('js')
</body>
</html>
