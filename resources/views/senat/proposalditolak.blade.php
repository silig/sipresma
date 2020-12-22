@extends('layouts.master')

@section('title')
    <title>LPJ Masuk</title>
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
            <h1>Daftar Proposal yang DITOLAK</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">Proposal</li>
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
                

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100px;">
                      
                  </div>
                </div>
              </div>
              @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
              @endif
              @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
              @endif
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover display nowrap" id="example" style="width:100%" data-page-length="25">
                  <thead>
            <tr>
                <th>No</th>
                <th>Action</th>
                <th>Tanggal Pengajuan</th>
                <th>Nomor Proposal</th>
                <th>Nama Kegiatan</th>
                <th>Bentuk Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jumlah Dana Disetujui</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @forelse ($lpj as $rew => $row)
          
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                  @if ($row->jenis_proposal=='delegasi')
                      <a href="{{ route('delegasi.detail', encrypt($row->id) ) }}"  target="_blank"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button></a>
                      <div class="btn-group" >
                      
      
                  @endif
                  @if ($row->jenis_proposal=='penyelenggara')
                      <a href="{{ route('penyelenggara.detail', encrypt($row->id) ) }}" target="_blank"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button></a>
                      
                  @endif  

                </td>
                <td>{{ Tanggal::Indo(substr($row->created_at,0,10)) }}</td>
                <td>{{ $row->nomor_proposal }}</td>
                <td>{{ $row->nama_kegiatan }}</td>
                <td>{{ $row->bentuk_kegiatan }}</td>
                <td>{{ Tanggal::Indo($row->tglmulai) }}</td>
                <td>{{ Tanggal::Indo($row->tglselesai) }}</td>
                <td>Rp. {{ number_format($row->danadisetujui,0,",",".") }}</td>
            </tr>
          
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
  