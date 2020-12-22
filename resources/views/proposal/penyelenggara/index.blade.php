@extends('layouts.master')

@section('title')
    <title>Proposal Penyelenggara</title>
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
            <h1>Proposal Penyelenggara</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penyelenggara</li>
            </ol>
          </div>
        </div>
        <hr>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	    <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <form class="card-title" method="get" action="{{ route('penyelenggara.cari') }}">
                    <input type="date" name="awal" value="{{ substr($wingi,0,10) }}" style="width: 160px;"></input>
                    <a> - </a>
                    <input type="date" name="akhir" value="{{ substr($now,0,10) }}" style="width: 160px;"></input>
                    
                    <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-search"></i></button>
                    
                  </form>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100px;">
                    
                    <h3 class="card-title float-right">
                     <a href="{{ route('penyelenggara.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a></h3>
                    
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
                                
                                <th>Jumlah Dana Ajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($proposal as $rew => $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <a href="{{ route('penyelenggara.detail', encrypt($row->id) ) }}" target="_blank"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button></a>
                                </td>
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
                                <td>Rp. {{ number_format($row->ajuandana,0,",",".") }}</td>
                                
                            </tr>
                            @empty
                            <tr>
                            	<td colspan="10" class="text-center">Tidak ada data</td>
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
  