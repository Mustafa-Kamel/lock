@include('blog.layouts.header')

<div style="margin-top:1in;"></div>
<div class="container">
    <div class="row">
        @include('blog.layouts.flash')

        @yield('content')

    </div>
</div>

@include('blog.layouts.footer')