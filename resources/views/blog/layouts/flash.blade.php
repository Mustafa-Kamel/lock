@if (session('message'))
    <div class="alert alert-{{ session('message')['alert'] }}">
        {{ session('message')['message'] }}
    </div>
@endif