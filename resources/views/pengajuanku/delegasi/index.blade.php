@extends('layouts.master')

@section('title')
    <title>Delegasi</title>
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
            <h1>Proposal Delegasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">Delegasi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

	    <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                @endif
                @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
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
                <th>Status</th>
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
<!-- proposal belum disetujui -->          
          @if ($row->status == 0)
            <tr >
                <td>{{ $no++ }}</td>
                
                <td >
                    <div class="btn-group">
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('delegasi.detail', encrypt($row->id)) }}" target="_blank">Detail</a>
                          <a class="dropdown-item" href="{{ route('delegasi.edit', encrypt($row->id)) }}">Edit</a>
                          </div>
                      </div>
                </td>
                <td> <a style="background-color: #ff8c00"> Proposal Belum Disetujui </a></td>
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
                <td>Rp. {{ number_format($row->ajuandana) }}</td>
            </tr>
          @endif
<!--End proposal belum disetujui -->

<!-- proposal disetujui, LPJ belum -->      
          @if ($row->status == 1 && $row->statuslpj == 0 && CekLengkap::delegasi($row->id) == false)
            <tr >
                <td>{{ $no++ }}</td>
                
                <td >
                    <div class="btn-group" >
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('delegasi.detail', encrypt($row->id)) }}" target="_blank">Detail</a>
                          <a class="dropdown-item" href="{{ route('lpj.delegasi', encrypt($row->id)) }}">LPJ</a>
                          </div>
                      </div>
                </td>
                <td><a style="background-color: #3d9970">Proposal Disetujui</a></td>
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
                <td>Rp. {{ number_format($row->ajuandana) }}</td>
            </tr>
          @endif
<!-- end proposal disetujui, LPJ belum -->

<!-- Berkas lengkap -->
          @if ($row->status == 1 && $row->statuslpj == 0 && CekLengkap::delegasi($row->id) == true)
            <tr >
                <td>{{ $no++ }}</td>
                
                <td >
                    <div class="btn-group" >
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('delegasi.detail', encrypt($row->id)) }}" target="_blank">Detail</a>
                          <a class="dropdown-item" href="{{ route('lpj.delegasi', encrypt($row->id)) }}">LPJ</a>
                          </div>
                      </div>
                </td>
                <td><a style="background-color: #17a2b8">Berkas LPJ lengkap</a></td>
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
                <td>Rp. {{ number_format($row->ajuandana) }}</td>
            </tr>
          @endif
<!--End Berkas lengkap -->

<!-- proposal disetujui dan lpj disetujui -->
          @if ($row->status == 1 && $row->statuslpj == 1)
            <tr >
                <td>{{ $no++ }}</td>
                
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
                <td><a style="background-color: #dc3545">LPJ disetujui</a></td>
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
                <td>Rp. {{ number_format($row->ajuandana) }}</td>
            </tr>
          @endif
<!-- end proposal disetujui dan lpj disetujui -->

<!--proposal tolak -->
          @if ($row->status == 2)
            <tr >
                <td style="color: black">{{ $no++ }}</td>
                
                <td >
                    <div class="btn-group">
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('delegasi.detail', encrypt($row->id)) }}" target="_blank">Detail</a>
                          </div>
                    </div>
                </td>
                <td><a style="background-color: black;color: white">Proposal ditolak</a></td>
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
                <td>Rp. {{ number_format($row->ajuandana) }}</td>
            </tr>
          @endif
<!-- tolak -->

<!--lpj tolak -->
          @if ($row->status == 1 && $row->statuslpj == 2)
            <tr ">
                <td>{{ $no++ }}</td>
                
                <td >
                    <div class="btn-group">
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('delegasi.detail', encrypt($row->id)) }}" target="_blank">Detail</a>
                          <a class="dropdown-item" href="{{ route('lpj.delegasi', encrypt($row->id)) }}">LPJ</a>
                          </div>
                    </div>
                </td>
                <td><a style="background-color: #605ca8;">LPJ ditolak</a></td>
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
                <td>Rp. {{ number_format($row->ajuandana) }}</td>
            </tr>
          @endif
<!-- tolak -->

<!--tidak terlaksana -->
          @if ($row->status == 1 && $row->statuslpj == 3)
            <tr >
                <td style="color: #adb5bd">{{ $no++ }}</td>
                
                <td >
                    <div class="btn-group">
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{ route('delegasi.detail', encrypt($row->id)) }}" target="_blank">Detail</a>
                          </div>
                    </div>
                </td>
                <td><a style="background-color: #adb5bd;color: Black">Tidak terlaksana</a></td>
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
                <td>Rp. {{ number_format($row->ajuandana) }}</td>
            </tr>
          @endif
<!-- tolak -->

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
@endsection
  