@props([
    'kategori' => null,
])

@php
    $old = old();
    $val = fn (string $key, $default = '') => $old[$key] ?? ($kategori?->{$key} ?? $default);
@endphp

<div class="grid gap-4">
    <div>
        <label class="field-label" for="nama">Nama Kategori <span class="text-danger">*</span></label>
        <input id="nama" class="field-input @error('nama') border-danger @enderror" type="text" name="nama" value="{{ $val('nama') }}" placeholder="cth. Minuman">
        @error('nama') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="category_code">Kode Kategori <span class="text-danger">*</span></label>
        <input id="category_code" class="field-input @error('category_code') border-danger @enderror" type="text" name="category_code" value="{{ $val('category_code') }}" placeholder="cth. MIN" maxlength="5" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g,'')">
        <p class="mt-1 text-xs text-subtle">Maksimal 5 karakter, hanya huruf &amp; angka. Otomatis dijadikan huruf besar.</p>
        @error('category_code') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" class="field-input" name="deskripsi" rows="3" placeholder="Deskripsi singkat kategori (opsional)...">{{ $val('deskripsi') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>
</div>
