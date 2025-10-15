{{-- Notifikasi alert (otomatis hilang) --}}
<x-notif-alert class="mb-4" />

{{-- Form Tambah Peminjaman --}}
<form action="{{ route('peminjaman.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="barang_id" class="form-label fw-semibold">Pilih Barang</label>
        <select name="barang_id" id="barang_id" class="form-select" required>
            <option value="">-- Pilih Barang --</option>
            @foreach ($barangs as $barang)
                <option value="{{ $barang->id }}" @selected(old('barang_id') == $barang->id) @disabled($barang->jumlah_tersedia <= 0)>
                    {{ $barang->nama_barang }}
                    @if ($barang->jumlah_tersedia <= 0)
                        (Tidak tersedia)
                    @else
                        (Tersedia: {{ $barang->jumlah_tersedia }} {{ $barang->satuan }})
                    @endif
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Nama Peminjam</label>
        <input type="text" name="nama_peminjam" class="form-control" value="{{ old('nama_peminjam') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" min="1" value="{{ old('jumlah', 1) }}"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Tanggal Pinjam</label>
        <input type="datetime-local" name="tanggal_pinjam" class="form-control"
            value="{{ old('tanggal_pinjam', \Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Tanggal Kembali (rencana)</label>
        <input type="datetime-local" name="tanggal_kembali" class="form-control"
            value="{{ old('tanggal_kembali', \Carbon\Carbon::now()->addDays(7)->format('Y-m-d\TH:i')) }}" required>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</form>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $('#barang_id').select2({
                placeholder: 'Cari atau pilih barang',
                allowClear: true,
                width: '100%',
                language: {
                    noResults: () => "Barang tidak ditemukan"
                }
            });
        });
    </script>
@endpush
