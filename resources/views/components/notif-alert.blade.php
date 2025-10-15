@php
    $message = session('success') ?? session('error');
    $type = session('success') ? 'success' : 'danger';
@endphp

@if ($message)
    <div id="flash-alert"
        {{ $attributes->merge([
            'class' => 'alert alert-' . $type . ' alert-dismissible fade show',
            'role' => 'alert',
        ]) }}>
        {{ $message }}
    </div>
@endif

<script>
    // Auto-hide alert setelah 5 detik (konsisten di semua blade)
    setTimeout(() => {
        const alert = document.getElementById('flash-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 1500);
</script>
