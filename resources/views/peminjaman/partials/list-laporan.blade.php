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
                 <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</td>
                 <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}</td>
                 <td>
                     @php
                         $badgeClass = 'bg-warning text-dark'; // default dipinjam
                         if ($peminjaman->status === 'Dikembalikan') {
                             $badgeClass = 'bg-success';
                         }
                         if ($peminjaman->status === 'Terlambat') {
                             $badgeClass = 'bg-danger';
                         }
                     @endphp

                     <span class="badge {{ $badgeClass }}">
                         {{ $peminjaman->status }}
                     </span>
                 </td>
             </tr>

         @empty
             <tr>
                 <td colspan="8" style="text-align: center; ">Tidak ada data.</td>
             </tr>
         @endforelse
     </tbody>
 </table>
