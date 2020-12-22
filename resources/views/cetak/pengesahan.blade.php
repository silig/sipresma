<!DOCTYPE html>
<html>
<head>
	<title>Lembar pengesahan</title>
	
</head>
<body >


<center><h2>LEMBAR PENGESAHAN</h2></center>
<br><br>
<table border="0" align="center" width="100%" cellpadding="1" >

<tr>
	<td width="10%"></td>
	<td colspan="8"><b>Nama Kegiatan</b></td>
</tr>
<tr>
	<td width="10%"></td>
	<td width="25px"><td colspan="7" style="margin-left: 30px">{{ ucfirst($proposal->nama_kegiatan) }}</td>
</tr>
@if(isset($proposal->penyelenggara_kegiatan))
<tr>
	<td width="10%"></td>
	<td colspan="8"><b>Penyelenggara Kegiatan</b></td>
</tr>
<tr>
	<td width="10%"></td>
	<td width="25px"><td colspan="7">@if(isset($proposal->penyelenggara_kegiatan)) {{ucfirst($proposal->penyelenggara_kegiatan)}} @endif @if(!isset($proposal->penyelenggara_kegiatan)) - @endif</td>
</tr>
@endif
<tr>
	<td width="10%"></td>
	<td colspan="8"><b>Bentuk Kegiatan</b></td>
</tr>
<tr>
<td width="10%"></td>
<td width="25px"><td colspan="7">{{ucfirst($proposal->bentuk_kegiatan)}}</td>
</tr>
<tr>
	<td width="10%"></td>
	<td colspan="8"><b>Waktu dan Tempat Pelaksanaan</b></td>
</tr>
<tr>
	<td width="10%"></td>
	<td width="25px"><td width="10%">Tanggal</td>
	<td width="5px" align="center">:</td>
	<td width="40%" colspan="2">{{$tglmulai}}</td>
	<td width="60px" align="left">s/d</td>
	<td width="35%">{{$tglselesai}}</td>
	<td></td>
</tr>
<tr>
	<td width="10%"></td>
	<td width="25px"></td>
	<td width="10%">Tempat</td>
	<td width="5px" align="center">:</td>
	<td colspan="5">{{$proposal->lokasi_kegiatan}}</td>
</tr>
<tr>
	<td width="10%"></td>
	<td colspan="8"><b>Sumber Dana</b></td>
</tr>
@if($proposal->sumberdana == 2)
<tr>
	<td width="10%"></td>
	<td width="25px"></td>
	<td width="10%">Departemen</td>
	<td width="5px" align="center">:</td>
	<td width="5px" align="center">Rp.</td>
	<td colspan="1" align="right">{{ number_format($proposal->danadisetujui,0,",",".") }}</td>
</tr>
@endif
@if($proposal->sumberdana == 1)
<tr>
	<td width="10%"></td>
	<td width="25px"></td>
	<td width="10%">Fakultas</td>
	<td width="5px" align="center">:</td>
	<td width="5px" align="center">Rp.</td>
	<td colspan="1" align="right">{{ number_format($proposal->danadisetujui,0,",",".") }}</td>
</tr>
@endif
<tr>
<td width="10%"></td>
<td width="25px"></td>
<td width="10%">Lainnya</td>
<td width="5px" align="center">:</td>
<td width="5px" align="center">Rp.</td>
@if(isset($proposal->sumberdana1))
<td colspan="1" align="right">{{number_format($proposal->danalainnya,0,",",".")}}</td>
@endif
@if(!isset($proposal->sumberdana1))
<td colspan="1" align="right">-</td>
@endif
</tr>
<tr>
<td width="10%"></td>
<td width="25px"></td>
<td width="10%"><b>Total</b></td>
<td width="5px" align="center">:</td>
<td width="5px" align="center">Rp.</td>
<td colspan="1" align="right">{{number_format($proposal->danadisetujui+$proposal->danalainnya,0,",",".")}}</td>
</tr>

</table>
<br>

<br>
<table border="0" width="100%" align="center" cellpadding="1">
	<tr>
		<td width="10%"></td>
		<td align="center" width="45%"></td>
		<td width="10%"></td>
		<td align="center" width="35%">Semarang, {{$tglpengajuan}}</td>
	</tr>
	<tr>
		<td width="10%"></td>
		<td align="center" width="45%">Ketua Departemen {{$ketua[0]->nama_departemen}}</td>
		<td width="10%"></td>
		@if(isset($proposal->penyelenggara_kegiatan))
				<td align="center" width="35%">Ketua Penyelenggara</td>
		@else
				<td align="center" width="35%">Ketua Delegasi</td>
		@endif
	</tr>
	<tr>
		<td width="10%"></td>
		<td align="center" width="45%">Fakultas Teknik Universitas Diponegoro</td>
		<td width="10%"></td>
		<td align="center" width="35%"></td>
	</tr>
	<tr>
		<td width="10%"></td>
		<td height="100" colspan="3"></td>
	</tr>
	<tr>
		<td width="10%"></td>
		<td align="center" width="45%"><u><b>{{$ketua[0]->kadep}}</b></u></td>
		<td width="10%"></td>
		<td align="center" width="35%"><u><b>{{$ketua[0]->Nama}}<u><b></td>
	</tr>
	<tr>
		<td width="10%"></td>
		<td align="center" width="45%">NIP. {{$ketua[0]->nip}}</td>
		<td width="10%"></td>
		<td align="center" width="35%">NIM. {{ucwords($ketua[0]->NIM)}}</td>
	</tr>
</table>
<br>
<table border="0" width="100%" align="center" cellpadding="1">
<tr>
		<td width="10%"></td>
		<td align="center" width="20%"></td>
		<td align="center" width="60%"> Mengetahui dan Menyetujui,</td>
		<td align="center" width="20%"></td>
</tr>
<tr>
		<td width="10%"></td>
		<td align="center" width="20%"></td>
		<td align="center" width="60%">Wakil Dekan Bidang Akademik dan Kemahasiswaan</td>
		<td align="center" width="20%"></td>
</tr>
<tr>
		<td width="10%"></td>
		<td align="center" width="20%"></td>
		<td align="center" width="60%"> Fakultas Teknik Universitas Diponegoro</td>
		<td align="center" width="20%"></td>
</tr>
<tr>
		<td width="10%"></td>
		<td height="100" colspan="3"></td>
</tr>
<tr>
		<td width="10%"></td>
		<td align="center" width="20%"></td>
		<td align="center" width="60%"><u><b>{{$formcetak->nama}}<u><b></td>
		<td align="center" width="20%"></td>
</tr>
<tr>
		<td width="10%"></td>
		<td align="center" width="20%"></td>
		<td align="center" width="60%"> NIP. {{$formcetak->nip}}</td>
		<td align="center" width="20%"></td>
</tr>
</table>
</body>
</html>