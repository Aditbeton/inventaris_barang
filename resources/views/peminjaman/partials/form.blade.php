 <!-- Form Tambah/Edit Peminjaman -->
 <div class="mb-3">
     <label for="barang_id">Pilih Barang</label>
     <select name="barang_id" id="barang_id" class="form-control"
         @if (isset($peminjaman)) disabled @else required @endif>
         <option value="">-- Pilih Barang --</option>
         @foreach ($barangs as $barang)
             <option value="{{ $barang->id }}" @if (old('barang_id', $peminjaman->barang_id ?? '') == $barang->id) selected @endif
                 @if ($barang->jumlah_tersedia <= 0 && (!isset($peminjaman) || $peminjaman->barang_id != $barang->id)) disabled @endif>
                 {{ $barang->nama_barang }}
                 @if (!isset($peminjaman))
                     @if ($barang->jumlah_tersedia <= 0)
                         (Tidak tersedia)
                     @else
                         (Tersedia: {{ $barang->jumlah_tersedia }} {{ $barang->satuan }})
                     @endif
                 @endif
             </option>
         @endforeach
     </select>

     @if (isset($peminjaman))
         <input type="hidden" name="barang_id" value="{{ $peminjaman->barang_id }}">
     @endif
 </div>

 <div class="mb-3">
     <label>Nama Peminjam</label>
     <input type="text" name="nama_peminjam" class="form-control"
         value="{{ old('nama_peminjam', $peminjaman->nama_peminjam ?? '') }}"
         @if (isset($peminjaman)) disabled @else required @endif>

     @if (isset($peminjaman))
         <input type="hidden" name="nama_peminjam" value="{{ $peminjaman->nama_peminjam }}">
     @endif
 </div>


 <div class="mb-3">
     <label>Jumlah</label>
     <input type="number" name="jumlah" class="form-control" min="1"
         value="{{ old('jumlah', $peminjaman->jumlah ?? 1) }}" required>
 </div>

 <div class="mb-3">
     <label>Tanggal Pinjam</label>
     <input type="date" name="tanggal_pinjam" class="form-control"
         value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam ?? date('Y-m-d')) }}" required>
 </div>

 <div class="mb-3">
     <label>Tanggal Kembali (rencana)</label>
     <input type="date" name="tanggal_kembali" class="form-control"
         value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali ?? date('Y-m-d', strtotime('+7 days'))) }}"
         required>
 </div>

 <button type="submit" class="btn btn-primary">{{ $tombol }}</button>
 <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>


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
                 noResults: function() {
                     return "Barang tidak ditemukan";
                 }
             }
         });
     });
 </script>
