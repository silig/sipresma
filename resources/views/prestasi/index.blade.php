@extends('layouts.master')

@section('title')
    <title>Prestasi Mahasiswa</title>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style type="text/css">
    div.dataTables_wrapper {
        width: auto;
        margin: 5px;
    }</style>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          	<h1>Prestasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item ">Prestasi</li>
            </ol>
          </div>
        </div>

      </div><!-- /.container-fluid -->
      <hr>
    </section>

    <!-- Main content -->
    <section class="content">

	    <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              @if(!empty($data))
                <a href="{{route('export.prestasi')}}"><button class="btn btn-success">Download excel</button></a>
              @endif
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                                        
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover display nowrap" id="example" style="width:100%" data-page-length="25">
                  <thead>
            <tr>
                <th>No</th>
                <th>Action</th>
                <th>Nomor Proposal</th>
                <th>Departemen/Fakultas</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Link/Url</th>
                <th>Tingkat</th>
                <th>Jumlah Dana Ajuan</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @forelse ($data as $rew => $row)

          @if ($row->status == 1 && $row->statuslpj == 1)
            <tr style="background-color: #dc3545">
                <td>{{ $no++ }}</td>
                
                @if(substr($row->nomor_proposal,0,1) == 'D')
                <td >
                    <div class="btn-group">
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('delegasi.detail', encrypt($row->id)) }}">Detail</a>
                          </div>
                      </div>
                </td>
                @endif
                @if(substr($row->nomor_proposal,0,1) == 'P')
                <td >
                    <div class="btn-group">
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('penyelenggara.detail', encrypt($row->id)) }}">Detail</a>
                          </div>
                      </div>
                </td>
                @endif

                <td>{{ $row->nomor_proposal }}</td>
                <td>@php 
                          foreach ($departemen as $dept) {
                          if($dept->id == $row->departemen ) {echo e($dept->nama_departemen);}
                          }
                          if($row->departemen == 99) {echo e('Fakultas');} 
                    @endphp
                </td>
                <td>{{ $row->nama_kegiatan }}</td>
                <td>{{ Tanggal::indo($row->tglmulai) }}</td>
                <td>{{ Tanggal::indo($row->tglselesai) }}</td>
                <td>{{ $row->url }}</td>
                <td>{{ $row->tingkat }}</td>
                <td>Rp. {{ number_format($row->danadisetujui) }}</td>
            </tr>
          @endif
              
            @empty
            <tr>
            	<td colspan="11" class="text-center">Tidak ada data</td>
			      </tr>
        @endforelse    
        </tbody>
    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        "scrollY": 350,
        "scrollX": true,
        
        
    } );
} );
</script>
<script>
	window.setTimeout("waktu()", 1000);
 
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}
</script>
@endsection
  