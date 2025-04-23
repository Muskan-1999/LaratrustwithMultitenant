@php
$isTenantDomain = request()->getHost() !== config('app.domain');
@endphp

@if($isTenantDomain)
    <x-tenant-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>

        <div class="py-6">
            <div class="mx-auto px-4">
                <h2 class="text-2xl font-semibold mb-6">Profile Settings</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Profile Information -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title">Profile Information</h3>
                            <p class="text-sm text-gray-600 mb-4">Update your account's profile information and email address.</p>
                            
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                                @csrf
                                @method('patch')

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Name</span>
                                    </label>
                                    <input type="text" name="name" class="input input-bordered w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Email</span>
                                    </label>
                                    <input type="email" name="email" class="input input-bordered w-full" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="alert alert-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                        <div>
                                            <h3 class="font-bold">Email Unverified!</h3>
                                            <div class="text-sm">
                                                Your email address is unverified.
                                                <button form="send-verification" class="btn btn-sm btn-ghost">
                                                    Click here to re-send the verification email.
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    @if (session('status') === 'verification-link-sent')
                                        <div class="alert alert-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <span>A new verification link has been sent to your email address.</span>
                                        </div>
                                    @endif
                                @endif

                                <div class="flex justify-end">
                                    @if (session('status') === 'profile-updated')
                                        <p class="text-success mr-3 py-3">Saved.</p>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title">Update Password</h3>
                            <p class="text-sm text-gray-600 mb-4">Ensure your account is using a long, random password to stay secure.</p>

                            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                                @csrf
                                @method('put')

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Current Password</span>
                                    </label>
                                    <input type="password" name="current_password" class="input input-bordered w-full" autocomplete="current-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">New Password</span>
                                    </label>
                                    <input type="password" name="password" class="input input-bordered w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Confirm Password</span>
                                    </label>
                                    <input type="password" name="password_confirmation" class="input input-bordered w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="flex justify-end">
                                    @if (session('status') === 'password-updated')
                                        <p class="text-success mr-3 py-3">Saved.</p>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card bg-base-100 shadow-xl col-span-full">
                        <div class="card-body">
                            <h3 class="card-title text-error">Delete Account</h3>
                            <p class="text-sm text-gray-600 mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

                            <button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="btn btn-error"
                            >Delete Account</button>

                            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium">Are you sure you want to delete your account?</h2>
                                    <p class="mt-1 text-sm text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

                                    <div class="mt-6 form-control w-full">
                                        <label class="label">
                                            <span class="label-text">Password</span>
                                        </label>
                                        <input type="password" name="password" class="input input-bordered w-full" placeholder="Password" />
                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <button x-on:click="$dispatch('close')" type="button" class="btn btn-ghost mr-3">Cancel</button>
                                        <button type="submit" class="btn btn-error">Delete Account</button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-tenant-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>

        <div class="py-6">
            <div class="mx-auto px-4">
                <h2 class="text-2xl font-semibold mb-6">Profile Settings</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Profile Information -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title">Profile Information</h3>
                            <p class="text-sm text-gray-600 mb-4">Update your account's profile information and email address.</p>
                            
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                                @csrf
                                @method('patch')

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Name</span>
                                    </label>
                                    <input type="text" name="name" class="input input-bordered w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Email</span>
                                    </label>
                                    <input type="email" name="email" class="input input-bordered w-full" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="alert alert-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                        <div>
                                            <h3 class="font-bold">Email Unverified!</h3>
                                            <div class="text-sm">
                                                Your email address is unverified.
                                                <button form="send-verification" class="btn btn-sm btn-ghost">
                                                    Click here to re-send the verification email.
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    @if (session('status') === 'verification-link-sent')
                                        <div class="alert alert-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <span>A new verification link has been sent to your email address.</span>
                                        </div>
                                    @endif
                                @endif

                                <div class="flex justify-end">
                                    @if (session('status') === 'profile-updated')
                                        <p class="text-success mr-3 py-3">Saved.</p>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title">Update Password</h3>
                            <p class="text-sm text-gray-600 mb-4">Ensure your account is using a long, random password to stay secure.</p>

                            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                                @csrf
                                @method('put')

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Current Password</span>
                                    </label>
                                    <input type="password" name="current_password" class="input input-bordered w-full" autocomplete="current-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">New Password</span>
                                    </label>
                                    <input type="password" name="password" class="input input-bordered w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Confirm Password</span>
                                    </label>
                                    <input type="password" name="password_confirmation" class="input input-bordered w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="flex justify-end">
                                    @if (session('status') === 'password-updated')
                                        <p class="text-success mr-3 py-3">Saved.</p>
                                    @endif
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card bg-base-100 shadow-xl col-span-full">
                        <div class="card-body">
                            <h3 class="card-title text-error">Delete Account</h3>
                            <p class="text-sm text-gray-600 mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

                            <button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="btn btn-error"
                            >Delete Account</button>

                            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium">Are you sure you want to delete your account?</h2>
                                    <p class="mt-1 text-sm text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

                                    <div class="mt-6 form-control w-full">
                                        <label class="label">
                                            <span class="label-text">Password</span>
                                        </label>
                                        <input type="password" name="password" class="input input-bordered w-full" placeholder="Password" />
                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <button x-on:click="$dispatch('close')" type="button" class="btn btn-ghost mr-3">Cancel</button>
                                        <button type="submit" class="btn btn-error">Delete Account</button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>
