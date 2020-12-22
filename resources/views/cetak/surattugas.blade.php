<!DOCTYPE html>
<html>
<head>
	<title>Surat Tugas</title>
	<style>
table {
	  border-collapse: collapse;
	}

</style>
</head>
<body>

<table border="0" style="text-align: center" width="100%">
<tr>	
	<td  width="15%"><img src="{{ public_path().'/images/LOGOUNDIP1.png' }}" width="145" height="170"></td>
	<td width="45%" height="100" style="text-align: left;vertical-align: top; padding-top: 30">
				<font size="2" >KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</font><br>
				<font size="4" ><b>UNIVERSITAS DIPONEGORO</b></font><br>
				<font size="3" ><b>FAKULTAS TEKNIK</b></font>
	</td>
	<td width="40%" height="100" style="text-align: right;vertical-align: bottom;padding-bottom: 20">
				<font size="1" >Jalan Prof. Soedarto,SH</font><br>
				<font size="1" >Tembalang -Semarang, Kode Pos 50275</font><br>
				<font size="1" >Tel. (024) 7460055, (024) 7460053, Faks. (024) 7460053</font><br>
				<font size="1" >www.ft.undip.ac.id email: teknik@undip.ac.id</font>
	</td>
</tr>

</table>

<table border="0" style="text-align: center" width="100%" align="center">
<tr>
<td width="5%"></td>

</tr>
</table>

<br>
<br>

<table border="0" style="text-align: center" width="100%" align="center">
<tr>
	<td width="10%"></td>
	<td colspan="3"><font size="4"><b>SURAT TUGAS</b></font></td>		
</tr>
<tr>
	@php
		$tahun = date('Y');
	@endphp 
	<td width="10%"></td>
	<td width="30%" style="text-align: right"><font size="4">No :</font></td>
	<td width="30%" style="text-align: right"><font size="4">/UN7.5.3.2.1/KP/{{$tahun}}</font></td>	
	<td width="30%"></td>

</tr>
</table>

<br><br><br>

<table border="0" style="text-align: justify;" width="100%" align="center">
<tr>
	<td width="5%"></td>
	<td colspan="6">Pimpinan Fakultas Teknik Universitas Diponegoro Semarang dengan ini menugaskan kepada mahasiswa tersebut dibawah ini :</td>
</tr>
<tr>
	<td width="5%"></td>
	<td colspan="6" style="padding-top: 10;padding-bottom: 10">
		<table border=1 width="80%" align="center">
			<tr>
				<th style="text-align: center">No</th>
				<th style="text-align: center">Nama</th>
				<th style="text-align: center">NIM</th>
				<th style="text-align: center">DEPARTEMEN</th>
			</tr>
			@php
				$no = 1;
			@endphp
			@foreach ($anggota as $rew => $row)
			<tr>
				<td style="text-align: center">{{$no++}}</td>
				<td>{{ $row->Nama }}</td>
				<td style="text-align: center">{{ $row->NIM }}</td>
				<td style="text-align: center">{{ $row->nama_departemen }}</td>
			</tr>
			@endforeach
		</table>
	</td>
</tr>
<tr>
	<td width="5%"></td>
	<td colspan="6">Untuk Mengikuti kegiatan pada :</td>
</tr>
<tr>
	<td width="5%"></td>
	<td width="20%">Tanggal</td><td width="5%">:</td><td width="25%"> {{$tglmulai}} </td><td width="5%">s/d</td><td width="25%"> {{$tglselesai}}</td><td width="15%"></td>
</tr>
<tr>
	<td width="5%"></td>
	<td>Acara</td><td >:</td><td colspan="4"> {{ucfirst($proposal->nama_kegiatan)}} </td>
</tr>
<tr>
	<td width="5%"></td>
	<td>Tempat</td><td>:</td><td colspan="4">{{$proposal->lokasi_kegiatan}} </td>
</tr>
<tr>
	<td width="5%"></td>
	<td><br><br></td>
</tr>
<tr>
	<td width="5%"></td>
	<td colspan="6">Demikian untuk dapat dilaksanakan sebaik-baiknya dan menyampaikan laporan setelah selesai melaksanakan tugas.</td>
</tr>
</table>

<br><br><br>

<table border="1" style="text-align: center" width="100%" align="center">
<tr>
	<td width="25%"></td><td width="30%"></td><td width="45%" align="left">A.n Dekan <br>Wakil Dekan Akademik dan Kemahasiswaan<br>
	U.b Kepala Bagian Tata Usaha,</td>
</tr>
<tr>
	<td colspan="3"><br><br><br><br></td>
</tr>
<tr>
	<td width="25%"></td><td width="30%"></td><td width="45%" align="left"><b><u>{{$formcetak->nama}}</u></b></td>
</tr>
<tr>
	<td width="25%"></td><td width="30%"></td><td width="45%" align="left">NIP. {{$formcetak->nip}}</td>
</tr>

</table>
</body>
</html>