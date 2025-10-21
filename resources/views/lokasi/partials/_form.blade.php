@csrf
<div class="mb-3">
    <x-form-input label="Nama Lokasi" name="nama_lokasi" :value="$lokasi->nama_lokasi" />
</div>
<div class="mt-4">
    <x-primary-button>
        {{ isset($update) ? __('Perbarui') : __('Simpan') }}
    </x-primary-button>
    <x-kembali-ke-back :href="route('lokasi.index')" />
</div>
