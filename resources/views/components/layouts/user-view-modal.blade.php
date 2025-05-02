@props(['user' => null, 'show' => false])

<div x-data="{ open: @entangle($attributes->wire('model')) }">
    <dialog class="modal" :open="open">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="font-bold text-lg mb-4">User Details</h3>

            @if($user)
                <div class="mb-4 space-y-2">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Roles:</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>
                    <p><strong>Status:</strong> {{ $user->status ?? 'N/A' }}</p>
                    <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y') }}</p>
                </div>
            @else
                <p>No user selected.</p>
            @endif

            <div class="modal-action">
                <button type="button" class="btn" @click="open = false">Close</button>
            </div>
        </div>
    </dialog>
</div>
