@props([
    'produk' => null,
    'kategori' => [],
    'skuPreview' => collect(),
    'generateSku' => false,
])

@php
    $old = old();
    $val = fn (string $key, $default = '') => $old[$key] ?? ($produk?->{$key} ?? $default);
    $previewJson = $skuPreview instanceof \Illuminate\Support\Collection
        ? $skuPreview->toJson()
        : json_encode((array) $skuPreview);
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label class="field-label" for="nama">Nama Produk <span class="text-danger">*</span></label>
        <input id="nama" class="field-input @error('nama') border-danger @enderror" type="text" name="nama" value="{{ $val('nama') }}" placeholder="cth. Kopi Arabica Biji 1kg">
        @error('nama') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="sku-preview">SKU <span class="text-danger">*</span></label>
        @if ($generateSku)
            <input id="sku-preview" class="field-input bg-surface-hover" type="text" readonly
                value="— Pilih kategori terlebih dahulu —"
                data-sku-preview data-preview-map='{!! $previewJson !!}' placeholder="—">
            <p class="mt-1 text-xs text-subtle">SKU dibuat otomatis berdasarkan kategori setelah disimpan.</p>
        @else
            <input id="sku-preview" class="field-input bg-surface-hover" type="text" readonly value="{{ $val('sku') }}">
            <p class="mt-1 text-xs text-subtle">SKU adalah identitas produk dan tidak dapat diubah.</p>
        @endif
    </div>

    <div>
        <label class="field-label" for="kategori">Kategori <span class="text-danger">*</span></label>
        <select id="kategori" class="field-input @error('kategori_id') border-danger @enderror" name="kategori_id">
            <option value="">— Pilih kategori —</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}" @selected((string) $val('kategori_id') === (string) $kat->id)>{{ $kat->nama }}</option>
            @endforeach
        </select>
        @error('kategori_id') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="field-label" for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" class="field-input" name="deskripsi" rows="3" placeholder="Deskripsi singkat produk...">{{ $val('deskripsi') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="stok">Stok <span class="text-danger">*</span></label>
        <input id="stok" class="field-input @error('stok') border-danger @enderror" type="number" name="stok" min="0" value="{{ $val('stok') }}">
        @error('stok') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="stok_minimal">Stok Minimal <span class="text-danger">*</span></label>
        <input id="stok_minimal" class="field-input @error('stok_minimal') border-danger @enderror" type="number" name="stok_minimal" min="0" value="{{ $val('stok_minimal') }}">
        @error('stok_minimal') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
        <input id="harga_beli" class="field-input @error('harga_beli') border-danger @enderror" type="number" name="harga_beli" min="0" step="1" value="{{ $val('harga_beli') }}">
        @error('harga_beli') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="field-label" for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
        <input id="harga_jual" class="field-input @error('harga_jual') border-danger @enderror" type="number" name="harga_jual" min="0" step="1" value="{{ $val('harga_jual') }}">
        @error('harga_jual') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
    </div>
</div>

@if ($generateSku)
    <script>
        (function () {
            var select = document.getElementById('kategori');
            var preview = document.getElementById('sku-preview');
            if (!select || !preview) return;

            var map = {};
            try { map = JSON.parse(preview.getAttribute('data-preview-map') || '{}'); } catch (e) { map = {}; }

            function update() {
                var id = select.value;
                if (!id || !map[id]) {
                    preview.value = '— Pilih kategori terlebih dahulu —';
                } else {
                    preview.value = map[id];
                }
            }

            select.addEventListener('change', update);
            update();
        })();
    </script>
@endif
