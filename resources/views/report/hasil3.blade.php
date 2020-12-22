<!-- <a href="{{route('report.prestasi')}}"><button class="btn btn-success">Download excel</button></a> -->

<table border="1">
	<tr>
		<th style="background-color: grey">No</th>
		<th style="background-color: grey">NOMOR PROPOSAL</th>
		<th style="background-color: grey">PENYELENGGARA KEGIATAN</th>
		<th style="background-color: grey">UNIT KEGIATAN</th>
		<th style="background-color: grey">NAMA KEGIATAN</th>
		<th style="background-color: grey">TANGGAL PELAKSANAAN</th>
		<th style="background-color: grey">STATUS </th>
	</tr>
	@php
	 $a = 1;
	 @endphp
	@forelse($data as $dat => $row)
		@if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::penyelenggara($row->id) == false)	
			<tr style="text-align: center;">
				<td>{{$a++}} </td>
				<td>{{$row->nomor_proposal}} </td>
				<td>{{$row->penyelenggara_kegiatan}}</td>
				@if(isset($row->unit_kegiatan))
				<td>{{$row->unit_kegiatan}}</td>
				@else
				<td>-</td>
				@endif
				<td>{{$row->nama_kegiatan}}</td>
				<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
				<td>Proposal disetujui</td>
			</tr>
		@endif

		@if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::penyelenggara($row->id) == true)
		<tr style="text-align: center;">
				<td>{{$a++}} </td>
				<td>{{$row->nomor_proposal}} </td>
				<td>{{$row->penyelenggara_kegiatan}}</td>
				@if(isset($row->unit_kegiatan))
				<td>{{$row->unit_kegiatan}}</td>
				@else
				<td>-</td>
				@endif
				<td>{{$row->nama_kegiatan}}</td>
				<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
				<td>Berkas LPJ lengkap</td>
			</tr>
		@endif

		@if ($row->statuspro == 1 && $row->statuslpj == 1)
		<tr style="text-align: center;">
				<td>{{$a++}} </td>
				<td>{{$row->nomor_proposal}} </td>
				<td>{{$row->penyelenggara_kegiatan}}</td>
				@if(isset($row->unit_kegiatan))
				<td>{{$row->unit_kegiatan}}</td>
				@else
				<td>-</td>
				@endif
				<td>{{$row->nama_kegiatan}}</td>
				<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
				<td>LPJ disetujui</td>
			</tr>
		@endif
	@empty
	<tr>
		<td colspan="8" style="text-align: center">Data kosong</td>
	</tr>
	@endforelse
</table>
