@props(['user' => null])

@php
    $old = old();
    $val = fn (string $key, $default = '') => $old[$key] ?? ($user?->{$key} ?? $default);
@endphp

<div class="grid gap-4">
    <div>
        <label class="field-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
        <input id="name" class="field-input @error('name') border-danger @enderror" type="text" name="name" value="{{ $val('name') }}" placeholder="cth. Budi Santoso">
        @error('name') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="email">Email <span class="text-danger">*</span></label>
        <input id="email" class="field-input @error('email') border-danger @enderror" type="email" name="email" value="{{ $val('email') }}" placeholder="cth. budi@stockly.id">
        @error('email') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="role">Role <span class="text-danger">*</span></label>
        <select id="role" class="field-input @error('role') border-danger @enderror" name="role">
            <option value="kasir" @selected($val('role', 'kasir') === 'kasir')>Kasir</option>
            <option value="admin" @selected($val('role') === 'admin')>Admin</option>
        </select>
        @error('role') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="password">
            Password @if (! $user) <span class="text-danger">*</span> @else <span class="text-subtle">(kosongkan jika tidak diubah)</span> @endif
        </label>
        <input id="password" class="field-input @error('password') border-danger @enderror" type="password" name="password" placeholder="Minimal 6 karakter" autocomplete="new-password">
        @error('password') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>
</div>