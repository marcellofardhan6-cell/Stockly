@props([
    'supplier' => null,
])

@php
    $old = old();
    $val = fn (string $key, $default = '') => $old[$key] ?? ($supplier?->{$key} ?? $default);
@endphp

<div class="grid gap-4">
    <div>
        <label class="field-label" for="nama">Nama Supplier <span class="text-danger">*</span></label>
        <input id="nama" class="field-input @error('nama') border-danger @enderror" type="text" name="nama" value="{{ $val('nama') }}" placeholder="cth. PT Kopi Nusantara">
        @error('nama') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label class="field-label" for="kontak">Kontak / PIC</label>
            <input id="kontak" class="field-input @error('kontak') border-danger @enderror" type="text" name="kontak" value="{{ $val('kontak') }}" placeholder="cth. Budi Santoso">
            @error('kontak') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="field-label" for="telepon">Telepon</label>
            <input id="telepon" class="field-input @error('telepon') border-danger @enderror" type="text" name="telepon" value="{{ $val('telepon') }}" placeholder="cth. 0812-3456-7890">
            @error('telepon') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="field-label" for="email">Email</label>
        <input id="email" class="field-input @error('email') border-danger @enderror" type="email" name="email" value="{{ $val('email') }}" placeholder="cth. sales@supplier.com">
        @error('email') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="alamat">Alamat</label>
        <textarea id="alamat" class="field-input @error('alamat') border-danger @enderror" name="alamat" rows="2" placeholder="Alamat lengkap supplier...">{{ $val('alamat') }}</textarea>
        @error('alamat') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" class="field-input" name="deskripsi" rows="3" placeholder="Catatan singkat tentang supplier (opsional)...">{{ $val('deskripsi') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>
</div>
