 <table>
     <thead>
         <tr>
             <th>No</th>
             <th>Nama Peminjam</th>
             <th>Nama peminjaman</th>
             <th>Jumlah</th>
             <th>Tanggal Pinjam</th>
             <th>Tanggal Kembali</th>
             <th>Status</th>
             <th>Tanggal Dikembalikan</th>
         </tr>
     </thead>
     </tr>
     </thead>

     <tbody>
         @forelse ($peminjamans as $index => $peminjaman)
             <tr>
                 <td>{{ $index + 1 }}</td>
                 <td>{{ $peminjaman->nama_peminjam }}</td>
                 <td>{{ $peminjaman->barang->nama_barang ?? '-' }}</td>
                 <td>{{ $peminjaman->jumlah }}</td>
                 <td>{{ $peminjaman->tanggal_pinjam }}</td>
                 <td>{{ $peminjaman->tanggal_kembali }}</td>
                 <td>{{ $peminjaman->status }}</td>
                 <td>{{ $peminjaman->tanggal_dikembalikan ?? '-'}}</td>
             </tr>

         @empty
             <tr>
                 <td colspan="8" style="text-align: center; ">Tidak ada data.</td>
             </tr>
         @endforelse
     </tbody>
 </table>
