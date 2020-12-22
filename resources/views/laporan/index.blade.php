@extends('layouts.master')

@section('title')
    <title>Laporan</title>
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection


@section('content')




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <hr>
    </section>
    @if (session('error'))
        <p class="toastrDefaultError"></p>                        
    @endif

    <center>
    <!-- Main content -->
	    <section class="content col-sm-8" style="margin-left: 15px;margin-right: 15px">
		    <div class="card card-primary ">
	              <div class="card-header" >
	                <a class="card-title" >Pilih kriteria</a>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form" action="{{ route('laporan.hasil') }}" method="post">
                @csrf
	                <div class="card-body col-sm-5">
	                  <div class="form-group"> 
	                    <label class="card-title" >Tahun</label>
	                    <select class="form-control" name="tahun" style="text-align-last:center">
                            <option value="">Pilih</option>
                            @php $tahun = date('Y');
                            $jarak = $tahun-4;
                            @endphp
                            @for ($tahun;$tahun >= $jarak;$tahun--)
                            <option value="{{ $tahun }}"> {{$tahun}} </option>
                            @endfor
                        </select>
	                  </div>
	                  <div class="form-group">
	                    <label class="card-title" >Departemen</label>
	                    <select class="form-control" name="dept" style="text-align-last:center">
		                          <option value="">Pilih</option>
		                          	
                                    <option value="99"> Fakultas</option>
                              @foreach ($departemen as $row)
                                            <option value="{{ $row->id }}">{{ $row->nama_departemen }}</option>
                              @endforeach		
		                </select>
	                  </div>
	                  
	                  
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
	                  <button type="submit" class="btn btn-primary">Submit</button>
	                </div>
	              </form>
	            </div>

	    </section>
    <!-- /.content -->
    </center>
  </div>
@endsection

@section('javascript')
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $('.swalDefaultError').show(function() {
      Toast.fire({
        type: 'error',
        title: 'Tidak boleh ada yang kosong'
      })
    });
    $('.toastrDefaultError').show(function() {
      toastr.error('Tidak boleh ada yang kosong')
    });
    
  });

</script>

@endsection

  