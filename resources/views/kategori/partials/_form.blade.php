@csrf
<div class="mb-3">
    <x-form-input label="Nama Kategori" name="nama_kategori" :value="$kategori->nama_kategori" />
</div>
<div class="mt-4">
    <x-primary-button>
        {{ isset($update) ? __('Perbarui') : __('Simpan') }}
    </x-primary-button>
    <x-kembali-ke-back :href="route('kategori.index')" />
</div>
