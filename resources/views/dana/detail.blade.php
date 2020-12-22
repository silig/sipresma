@extends('layouts.master')

@section('title')
    <title>Manajemen dana</title>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dana Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">Dana</li>
              <li class="breadcrumb-item active">Dana Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-left: 15px;margin-right: 15px">

	    <!-- Form update -->
	    <div class="card card-info">
	              <div class="card-header">
	                <h3 class="card-title">Form Dana Detail</h3>
	               
	              </div>
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
	              <!-- /.card-header -->
	              <!-- form start -->
	              
	    </div>
	    
	    <!-- table anggota proposal -->  
	    <div class="row" style="margin-top: 50px;margin-bottom: 50px;">
	          <div class="col-12">
	            <div class="card">
	              <div class="card-header">
	             	 <button type="button" class="btn btn-block bg-gradient-info btn-sm col-1" data-toggle="modal" data-target="#modal-lg">Add</button>
	                

	                <div class="card-tools">
	                  <!-- kolom search -->
	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body table-responsive p-0" style="height: 300px;">
	                <table class="table table-head-fixed">
	                
	                  <thead>
	                    <tr>
	                      <th>Departemen / Fakultas</th>
	                      <th>Jumlah</th>
	                      <th>Action</th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                @forelse ($danadetail as $rew => $row)
	                    <tr>
	                      @if($row->jenis == "PU")
	                      <td>Penyelenggara Lainnya</td>
	                      @endif
	                      @if($row->jenis == "PS")
	                      <td>Penyelenggara Softskill</td>
	                      @endif
	                      @if($row->jenis == "PL")
	                      <td>Penyelenggara Lomba</td>
	                      @endif
	                      @if($row->jenis == "DL")
	                      <td>Delegasi Lomba</td>
	                      @endif
	                      @if($row->jenis == "DN")
	                      <td>Delegasi Non Lomba</td>
	                      @endif
	                      <td>{{$row->jumlah}}</td>
	                      <td>
                             <a href="{{ route('dana.hapusdetail', $row->id) }}"
                                            class="btn btn-danger btn-sm">
                             <i class="fa fa-trash"></i> Hapus
                             </a>
                           </td>
	                    </tr>
	                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
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

	    <!-- Modal Tambah Dana -->
	    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true" data-backdrop="static">
	        <div class="modal-dialog modal-lg">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h4 class="modal-title">Rincian Dana</h4>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	              </button>
	            </div>
	            <div class="modal-body">
				          <form role="form" action="{{ route('dana.adddetail', encrypt($dana->id)) }}" method="POST">
			                @csrf
			                <div class="card-body">
			                  <div class="form-group">
		                        <label>Anggaran Dana</label>
		                        <input type="text" class="form-control" placeholder="{{ $dana->jumlah }}" readonly="">
							  </div>
			                  <div class="form-group">
		                        <label>Jenis Dana</label>
		                        <select class="form-control" name="jenis" required>
		                          <option value="">Pilih</option>
		                          			<option value="DL"> Delegasi Lomba</option>
		                          			<option value="DN"> Delegasi Non Lomba</option>
		                                    <option value="PL"> Penyelenggara Lomba</option>                        			
		                                    <option value="PS"> Penyelenggara Softskill</option>                        			
		                                    <option value="PU"> Penyelenggara Lainnya</option>                        			
		                        </select>
							  </div>
							  <div class="form-group">
			                    <label>Jumlah</label>
			                    <input type="number" class="form-control" name="jumlah" placeholder="jumlah" required="">
			                  </div>
			                  
			                </div>             
	            </div>
	            <div class="modal-footer justify-content-between">
	              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	              <button type="Submit" class="btn btn-primary">Tambah</button>
	              			</form>
	            </div>
	          </div>
	          <!-- /.modal-content -->
	        </div>
	        <!-- /.modal-dialog -->
	    </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection

  