<table>
<thead>
@php
$no = 1;
@endphp
<tr>
	<th style="text-align: center;">No</th>
	<th style="text-align: center;">Nomor Proposal</th>
	<th style="text-align: center;">Nama Kegiatan</th>
	<th style="text-align: center;">Tahun</th>
	<th style="text-align: center;">Prestasi</th>
</tr>
</thead>
<tbody>
@forelse($proposal as $cilupba => $row)
<tr>
<td>{{$no++}}</td>
<td>{{$row->nomor_proposal}}</td>
<td>{{$row->nama_kegiatan}}</td>
<td>{{$row->tahun}}</td>
@if(isset($row->capaian))
<td>{{$row->capaian}}</td>
@endif
@if(!isset($row->capaian))
<td>Panitia</td>
@endif
</tr>
	@empty
<tr>
 <td colspan="3" class="text-center">Tidak ada data</td>
</tr>
@endforelse 
</tbody>
</table>
