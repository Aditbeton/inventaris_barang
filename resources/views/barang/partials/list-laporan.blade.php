 <table>
     <thead>
         <tr>
             <th>No</th>
             <th>Kode Barang</th>
             <th>Nama Barang</th>
             <th>Kategori</th>
             <th>Lokasi</th>
             <th>Jumlah</th>
             <th>Kondisi</th>
             <th>Tanggal Pengadaan</th>
         </tr>
     </thead>

     <tbody>
         @forelse ($barangs as $index => $barang)
             <tr>
                 <td>{{ $index + 1 }}</td>
                 <td>{{ $barang->kode_barang }}</td>
                 <td>{{ $barang->nama_barang }}</td>
                 <td>{{ $barang->kategori->nama_kategori }}</td>
                 <td>{{ $barang->lokasi->nama_lokasi }}</td>
                 <td>{{ $barang->jumlah }} {{ $barang->satuan }}</td>
                 <td>{{ $barang->kondisi }}</td>
                 <td>
                     {{ date('d-m-Y', strtotime($barang->tanggal_pengadaan)) }}
                 </td>
             </tr>

         @empty
             <tr>
                 <td colspan="8" style="text-align: center; ">Tidak ada data.</td>
             </tr>
         @endforelse
     </tbody>
 </table>
 <h4 style="margin-top: 20px;">Rekap Kondisi Barang</h4>
 <p>
     <strong>Baik:</strong> {{ $kondisiBaik ?? 0 }}<br>
     <strong>Rusak Ringan:</strong> {{ $kondisiRusakRingan ?? 0 }}<br>
     <strong>Rusak Berat:</strong> {{ $kondisiRusakBerat ?? 0 }}
 </p>
