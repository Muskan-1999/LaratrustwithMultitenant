@php
    $status = strtolower($status);
    $badgeClass = match($status) {
        'ongoing' => 'badge-info',
        'completed' => 'badge-success',
        'cancelled' => 'badge-error',
        'pending' => 'badge-warning',
        default => 'badge-secondary',
    };
@endphp

<div class="badge badge-outline {{ $badgeClass }}">
    {{ ucfirst($status) }}
</div>
