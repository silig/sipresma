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
            <h1>Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <hr>
    </section>
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

    <center>
    <!-- Main content -->
	    <section class="content col-sm-8" style="margin-left: 15px;margin-right: 15px">
		    <div class="card card-primary ">
	              <div class="card-header" >
	                <a class="card-title" >Pilih kriteria</a>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form" action="{{ route('report.delegasi.hasil') }}" method="post">
                @csrf
	                <div class="card-body col-sm-5">
	                  <div class="form-group"> 
	                    <label class="card-title" >Tahun</label>
	                    <select class="form-control" name="tahun" style="text-align-last:center" required="">
                            <option value="">-- Pilih --</option>
                            @php $tahun = date('Y');
                            $jarak = $tahun-4;
                            @endphp
                            @for ($tahun;$tahun >= $jarak;$tahun--)
                            <option value="{{ $tahun }}"> {{$tahun}} </option>
                            @endfor
                        </select>
	                  </div>
	                  <div class="form-group">
	                    <label class="card-title" >Jenis</label>
	                    <select class="form-control" name="jenis" style="text-align-last:center" required="">
		                          <option value="">-- Pilih --</option>
		                          <option value="semua">Semua</option>
		                          	<option value="lomba"> Lomba</option>
                                    <option value="nonlomba"> Non Lomba</option>
		                </select>
	                  </div>
	                  <div class="form-group">
	                    <label class="card-title" >Tingkat</label>
	                    <select class="form-control" name="tingkat" style="text-align-last:center" required="">
		                          <option value="">-- Pilih --</option>
		                          <option value="semua">Semua</option>
		                          	<option value="internasional"> internasional</option>
                                    <option value="nasional"> nasional/regional</option>
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

  