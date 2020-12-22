@extends('layouts.master')

@section('title')
    <title>Manajemen Mahasiswa</title>
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
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid" >
                <div class="row mb-2" style="margin-left: 20px">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Mahasiswa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Mahasiswa</li>
                        </ol>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
	           <div class="row">
		          <div class="col-12" style="margin-left: 10px">
		            <div class="card">
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
		              <div class="card-header">
                    <button class="btn btn-info" id="readdata" data-toggle="modal" data-target="#modal-sm">import</button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-add">tambah</button>
		                <div class="card-tools">
		                  <div class="input-group input-group-sm" style="width: 300px;">
                      <form method="get" action="{{route('mahasiswa.cari')}}">
                              <div class="row">
                                <div class="col-4">
                                  <select name="tahun" required class="form-control">
                                        <option value="">Pilih</option>
                                        @php $tahun = date('Y');
                                             $jarak = $tahun-7;
                                        @endphp
                                        @for ($tahun;$tahun >= $jarak;$tahun--)
                                                              <option value="{{ $tahun }}" {{ $tahun == $angkatan ? 'selected':'' }}> {{$tahun}} </option>
                                        @endfor

                                  </select>
                                </div>
                                <div class="col-6">
                                   <select name="jurusan"  
                                          required class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                          <option value="">Pilih</option>
                                          @foreach ($jurusan as $row)
                                              <option value="{{ $row->id }}" {{ $row->id == $jurs ? 'selected':'' }} >
                                                  {{ $row->program.' '.$row->jurusan }}
                                              </option>
                                          @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                              </div>
		                  </form>
		                </div>
		              </div>
                  <hr>
		              <!-- /.card-header -->
		              <div class="card-body table-responsive p-0">
                <table class="table table-hover display nowrap" id="example" style="width:100%" data-page-length="25">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Jurusan</th>
                                <th>Angkatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @forelse ($mahasiswa as $maha)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $maha->NIM }}</td>
                                <td>{{ $maha->nama_mhs }}</td>
                                <td>@php 
                                    foreach ($jurusan as $jur) {
                                    if($jur->id == $maha->id_jurusan ) {echo e($jur->program.' '.$jur->jurusan);}
                                    }
                                    @endphp
                                </td>
                                <td>{{ $maha->angkatan }}</td>
                                <td><a data-toggle="modal" data-target="#edit{{$maha->NIM}}"
                                            class="btn btn-primary btn-sm" title="edit">
                                            <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                      <div class="modal fade" id="edit{{$maha->NIM}}" aria-hidden="true" style="display: none;">
                                          <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                              <div class="modal-body">
                                              <form role="form" method="post" action="{{route('mahasiswa.update', $maha->NIM)}}">
                                              @csrf
                                              <div class="row">
                                                <div class="col-sm-6">
                                                  <!-- text input -->
                                                  <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control" placeholder="Enter ..." value="{{$maha->username}}">
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" name="password" class="form-control" placeholder="Masukkan password baru" >
                                                    <p>* kosongkan jika tidak ingin mengganti password</p>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-sm-6">
                                                  <!-- textarea -->
                                                  <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="Enter ..." value="{{$maha->nama_mhs}}">
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label>NIM</label>
                                                    <input type="text" name="nim" class="form-control" placeholder="Enter ..." value="{{$maha->NIM}}" disabled="">
                                                  </div>
                                                </div>
                                              </div>

                                              <!-- input states -->
                                              <div class="row">
                                                <div class="col-sm-6">
                                                  <!-- checkbox -->
                                                  <div class="form-group">
                                                    <div class="form-group">
                                                    <label>Angkatan</label>
                                                    <input type="number" name="angkatan" class="form-control" placeholder="Enter ..." value="{{$maha->angkatan}}">
                                                  </div>
                                                  </div>
                                                </div> 
                                                <div class="col-sm-6">
                                                  <!-- radio -->
                                                  <div class="form-group">
                                                    <label>Jurusan</label>
                                                    <select name="jurusan" class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                                          <option value="">Pilih</option>
                                                          @foreach ($jurusan as $row)
                                                              <option value="{{ $row->id }}" {{ $row->id == $maha->id_jurusan ? 'selected':'' }} >
                                                                  {{ $row->program.' '.$row->jurusan }}
                                                              </option>
                                                          @endforeach
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              </div>
                                              <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                              </div>
                                              </form> 
                                            </div>
                                            <!-- /.modal-content -->
                                          </div>
                                          <!-- /.modal-dialog -->
                                      </div>  
                            </tr>
                            @empty
                            <tr>
                              <td colspan="6" class="text-center"><a style="background-color: red">Tidak ada data</a></td>
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
            </div>
        </section>

        <div class="modal fade show" id="modal-sm" style="display: none; padding-right: 17px;" aria-modal="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
          <div id="overlay" ><i id="muter2" class="fas fa-2x fa-sync fa-spin" style="display: none;"></i></div>
          <form method="post" action="{{ route('import')}}" enctype="multipart/form-data" onsubmit="overlay();">
            <div class="modal-header">
              <h4 class="modal-title">Import Excel</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <label><font color="red">sebelum mengimport data mohon baca dulu<a href="{{ asset('uploads/Panduan Format Import database mahasiswa.docx') }}">  panduan import data</a></font></label>
              {{ csrf_field() }}
 
              <label>Pilih file excel</label>
              <div class="form-group">
                <input type="file" name="file" required="required">
              </div>
 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Import">
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- modal add -->
      <div class="modal fade" id="modal-add" aria-hidden="true" style="display: none;">
                                          <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                              <div class="modal-body">
                                              <form role="form" method="post" action="{{route('mahasiswa.add')}}">
                                              @csrf
                                              <div class="row">
                                                <div class="col-sm-6">
                                                  <!-- text input -->
                                                  <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control" placeholder="username ..." value="">
                                                    <p style="color: orange">* untuk login di sistem
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="password ..." >
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-sm-6">
                                                  <!-- textarea -->
                                                  <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="nama ..." value="">
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label>NIM</label>
                                                    <input type="text" name="nim" class="form-control" placeholder="nim ..." value="" >
                                                  </div>
                                                </div>
                                              </div>

                                              <!-- input states -->
                                              <div class="row">
                                                <div class="col-sm-6">
                                                  <!-- checkbox -->
                                                  <div class="form-group">
                                                    <div class="form-group">
                                                    <label>Angkatan</label>
                                                    <input type="number" name="angkatan" class="form-control" placeholder="angkatan ..." value="">
                                                  </div>
                                                  </div>
                                                </div> 
                                                <div class="col-sm-6">
                                                  <!-- radio -->
                                                  <div class="form-group">
                                                    <label>Jurusan</label>
                                                    <select name="jurusan" class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                                          <option value="">Pilih</option>
                                                          @foreach ($jurusan as $row)
                                                              <option value="{{ $row->id }}" >
                                                                  {{ $row->program.' '.$row->jurusan }}
                                                              </option>
                                                          @endforeach
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              </div>
                                              <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                              </div>
                                              </form> 
                                            </div>
                                            <!-- /.modal-content -->
                                          </div>
                                          <!-- /.modal-dialog -->
      </div> 
      <!-- end modal add -->

    </div>
  @endsection

  @section('javascript')
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        "scrollY": 350,
        "scrollX": true,
        "paging" : true,

        
    } );
} );
</script>
<script type="text/javascript">
function overlay(){
  document.getElementById('overlay').setAttribute("class", "overlay d-flex justify-content-center align-items-center"); 
  document.getElementById('muter2').style.display = '';
};
</script>
  @endsection