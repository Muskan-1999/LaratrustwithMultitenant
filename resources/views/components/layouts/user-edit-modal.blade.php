@props(['user' => null, 'roles' => [], 'show' => false])

<div x-data="{ open: @entangle($attributes->wire('model')) }">
    <dialog class="modal" :open="open">
        <div class="modal-box w-11/12 max-w-2xl">
            <h3 class="font-bold text-lg mb-4">Edit User</h3>

            @if($user)
                <form wire:submit.prevent="updateUser">
                    <div class="form-control mb-2">
                        <label class="label">Name</label>
                        <input wire:model="editForm.name" type="text" class="input input-bordered" />
                    </div>

                    <div class="form-control mb-2">
                        <label class="label">Email</label>
                        <input wire:model.defer="editForm.email" type="email" class="input input-bordered" />
                    </div>

                    <div class="form-control mb-2">
    <label class="label">Roles</label>
    <div class="space-y-1">
            @foreach($roles as $role)
        <label class="cursor-pointer flex items-center gap-2">
            <input
                type="checkbox"
                value="{{ $role->id }}"
                wire:model.defer="editForm.roles"
                class="checkbox checkbox-sm"
            />
            <span class="label-text">{{ $role->name }}</span>
        </label>
        @endforeach
    </div>
</div>


                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn" @click="open = false">Cancel</button>
                    </div>
                </form>
            @else
                <p>No user selected for editing.</p>
            @endif
        </div>
    </dialog>
</div>
