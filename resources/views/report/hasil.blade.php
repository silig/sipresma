<!-- <a href="{{route('report.prestasi')}}"><button class="btn btn-success">Download excel</button></a> -->
@if($request)
<form method="post" action="{{route('report.prestasi')}}">
@csrf
<input type="hidden" name="tahun" value="{{$request->tahun}}"></input>
<input type="hidden" name="jenis" value="{{$request->jenis}}"></input>
<input type="hidden" name="tingkat" value="{{$request->tingkat}}"></input>
<input type="submit" value="Download excel1"></input>	
</form>
@endif
<table border="1">
	<tr>
		<th style="background-color: grey">No</th>
		<th style="background-color: grey">STATUS</th>
		<th style="background-color: grey">NOMOR PROPOSAL</th>
		<th style="background-color: grey">NOMOR KONTAK</th>
		<th style="background-color: grey">NAMA KEGIATAN</th>
		<th style="background-color: grey">TEMPAT KEGIATAN</th>
		<th style="background-color: grey">PRESTASI KEGIATAN</th>
		<th style="background-color: grey">TINGKAT</th>
		<th style="background-color: grey">TANGGAL PELAKSANAAN</th>
		<th style="background-color: grey">URL</th>
		<th style="background-color: grey">ANGGOTA</th>
	</tr>
	@php
	 $a = 1;
	 @endphp
	@forelse($data as $dat => $row)
	<tr style="text-align: center;">
		<td>{{$a++}} </td>
					@if ($row->statuspro == 0)
                      <td> <a style="background-color: #ff8c00"> Proposal Belum Disetujui </a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::delegasi($row->id) == false)
                      <td><a style="background-color: #3d9970">Proposal Disetujui</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::delegasi($row->id) == true)
                      <td><a style="background-color: #17a2b8">Berkas LPJ lengkap</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 1)
                      <td><a style="background-color: #dc3545">LPJ disetujui</a></td>
                    @endif

                    @if ($row->statuspro == 2)
                      <td><a style="background-color: black;color: white">Proposal ditolak</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 2)
                      <td><a style="background-color: #605ca8;">LPJ ditolak</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 3)
                      <td><a style="background-color: #adb5bd;color: Black">Tidak terlaksana</a></td>
                    @endif
		<td>{{$row->nomor_proposal}}</td>
		<td>{{$row->nohp}}</td>
		<td>{{$row->nama_kegiatan}}</td>
		<td>{{$row->lokasi_kegiatan}}</td>
		<td>{{$row->capaian}}</td>
		<td>{{$row->tingkat}}</td>
		<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
		<td>{{$row->url}}</td>
		<td style="text-align: left">@php
				$anggota= DB::select(DB::raw("SELECT a.id,NIM, Nama, jabatan, nama_departemen, id_proposal FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal= $row->id order by jabatan desc" ));
				$no = 1;
		        @endphp
		        @foreach($anggota as $comel => $ngah)
		        {{$no++}}. {{ucwords($ngah->Nama)}} - {{ucfirst($ngah->NIM)}}<br>
		        @endforeach</td>
	</tr>
	@empty
	<tr>
		<td colspan="8" style="text-align: center">Data kosong</td>
	</tr>
	@endforelse
</table>