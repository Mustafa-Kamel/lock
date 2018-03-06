@include('blog.layouts.header')

<div style="margin-top:1in;"></div>
<div class="container">
    @include('blog.layouts.flash')
    <div class="row">

        @yield('content')
        @include('blog.layouts.sidebar')

    </div>
</div>

@include('blog.layouts.footer')