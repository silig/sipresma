@extends('layouts.master')

@section('title')
    <title>Daftar Proposal Masuk</title>
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
            <h1>Proposal Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              
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
                <th>Nomor Proposal</th>
                <th>Nama Kegiatan</th>
                <th>Bentuk Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jumlah Dana Ajuan</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @forelse ($proposal as $rew => $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                @if ($row->jenis_proposal=='delegasi')
                    <a href="{{ route('delegasi.detail', encrypt($row->id) ) }}" target="_blank"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button></a>
                    <div class="btn-group" >
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve{{ $row->id}}">Setujui</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#tolak{{ $row->id}}">Tolak</a>
                          
                          </div>
                    </div>
    
                @endif
                @if ($row->jenis_proposal=='penyelenggara')
                    <a href="{{ route('penyelenggara.detail', encrypt($row->id) ) }}" target="_blank"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button></a>
                    <div class="btn-group" >
                      
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" style="background-color: #adb5bd">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve{{ $row->id}}">Setujui</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#tolak{{ $row->id}}">Tolak</a>
                          
                          </div>
                    </div>
                @endif  

                    <!-- modal-approve -->
                                        <div class="modal fade" id="approve{{ $row->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
                                              <div class="modal-content" style="width: 500px">
                                                <div class="modal-header" style="background-color: #007bff">
                                                  <h4 class="modal-title" style="color: #f8f9fa">Setujui</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <form role="form" method="POST" action="{{ route('DaftarMasuk.approve', encrypt($row->id) ) }}">
                                                  @csrf
                                                  <input type="hidden" name="_method" value="PUT">
                                                    <div class="card-body">
                                                      <div class="form-group">
                                                      <input type="hidden" name="dept" value="{{$row->departemen}}"></input>
                                                      <input type="hidden" name="jenis" value="{{substr($row->nomor_proposal,0,2)}}"></input>
                                                      <input type="hidden" name="tahun" value="{{substr($row->created_at,0,4)}}"></input>
                                                        <label>Jumlah Sisa Anggaran Dana {{$row->jenis_proposal}} Tahun {{substr($row->created_at,0,4)}}</label>
                                                        
                                                        @if(DanaSisa::sisa(substr($row->nomor_proposal,0,2),$row->departemen,substr($row->created_at,0,4)) < 0)
                                                          <input type="text" class="form-control" id="tesi" value="Rp. 0" readonly>
                                                        @endif
                                                        @if(DanaSisa::sisa(substr($row->nomor_proposal,0,2),$row->departemen,substr($row->created_at,0,4)) > 0)
                                                        <input type="text" class="form-control" id="testis" value="Rp. {{ number_format(DanaSisa::sisa(substr($row->nomor_proposal,0,2),$row->departemen,substr($row->created_at,0,4)),0,",",".") }}" readonly>
                                                        @endif
                                                        @if(empty(DanaSisa::sisa(substr($row->nomor_proposal,0,2),$row->departemen,substr($row->created_at,0,4))))
                                                        <input type="text" class="form-control" id="test" value="Belum ditentukan anggaran dananya" readonly>
                                                        @endif
                                                        
                                                        

                                                      </div>
                                                      <div class="form-group">
                                                        <label>Jumlah Pengajuan Dana</label>
                                                        <input type="text" class="form-control" id="test" value="Rp. {{ number_format($row->ajuandana,0,",",".")}}" readonly>
                                                      </div>
                                                      <div class="form-group">
                                                        <label>Jumlah Dana Disetujui</label>
                                                        @if(DanaSisa::sisa($row->jenis_proposal,$row->departemen,substr($row->created_at,0,4)) > $row->ajuandana)
                                                        <input type="number" class="form-control" id="test" placeholder="" name="danadisetujui" value="" min="0" max="{{$row->ajuandana}}" required="">
                                                        @endif
                                                        @if(empty(DanaSisa::sisa($row->jenis_proposal,$row->departemen,substr($row->created_at,0,4))))
                                                        <input type="number" class="form-control" id="test" placeholder="" name="danadisetujui" value="" min="0" max="{{$row->ajuandana}}" required="">
                                                        @endif
                                                        @if(DanaSisa::sisa($row->jenis_proposal,$row->departemen,substr($row->created_at,0,4)) < $row->ajuandana && !empty(DanaSisa::sisa($row->jenis_proposal,$row->departemen,substr($row->created_at,0,4))))
                                                        <input type="number" class="form-control" id="test" placeholder="" name="danadisetujui" value="" min="0" max="{{ DanaSisa::sisa($row->jenis_proposal,$row->departemen,substr($row->created_at,0,4)) }}" required="">
                                                        @endif
                                                      </div>
                                                    </div>
                                                    <!-- /.card-body --> 
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                  </form>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                        </div>
                                        <!-- /.modal-edit -->

                                        <!-- modal-tolak -->
                                        <div class="modal fade" id="tolak{{ $row->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
                                              <div class="modal-content" style="width: 500px">
                                                <div class="modal-header" style="background-color: #dc3545">
                                                  <h4 class="modal-title" style="color: #f8f9fa">Tolak</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <form role="form" method="POST" action="{{ route('DaftarMasuk.tolak', encrypt($row->id) ) }}">
                                                  @csrf
                                                  <input type="hidden" name="_method" value="PUT">
                                                    <div class="card-body">
                                                      <div class="form-group">
                                                        <label>Berikan Alasan</label>
                                                        <input type="textbox" class="form-control" id="test" placeholder="" name="alasan" value="">
                                                      </div>
                                                    </div>
                                                    <!-- /.card-body --> 
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                  </form>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                        </div>
                                        <!-- /.modal-tolak -->                    

                                        

                </td>
                <td>{{ $row->nomor_proposal }}</td>
                <td>{{ $row->nama_kegiatan }}</td>
                <td>{{ $row->bentuk_kegiatan }}</td>
                <td>{{ Tanggal::indo($row->tglmulai) }}</td>
                <td>{{ Tanggal::Indo($row->tglselesai) }}</td>
                <td>Rp. {{ number_format($row->ajuandana,0,",",".") }}</td>
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
  