@extends('layouts.master')

@section('title')
    <title>Manajemen Kategori</title>
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

              <li class="breadcrumb-item"><a href="{{ asset('storage/uploads/Proposal/proposaltesting1568867107.pdf') }}">Home</a></li>
              <li class="breadcrumb-item ">Delegasi</li>
              <li class="breadcrumb-item active">Edit</li>
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
	                <h3 class="card-title">Form Pengajuan</h3>
	               
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
	              <form role="form" class="form-horizontal" files="true" action="{{ route('delegasi.update', encrypt($data->id)) }}" method="post" enctype="multipart/form-data">
	                                @csrf
	                    <div class="card-body">
	                      <div class="form-group row">
	                          <label  class="col-sm-4 control-label">Jenis Kegiatan *</label>
	                          <div class="col-sm-2">
	                              <input type="radio" onchange="Check();" name="jenis_kegiatan" id="lomba" value="lomba" {{ $data->jenis_kegiatan == 'lomba' ? 'checked':''}} > Lomba <br>
	                          </div>    
	                          <div class="col-sm-2">
	                              <input type="radio" onclick="Check();" id="non_lomba" name="jenis_kegiatan" value="nonlomba" {{ $data->jenis_kegiatan == 'nonlomba' ? 'checked':''}}> Non Lomba<br>
	                          </div>
	                          <div class="col-sm-2">
	                          </div>
	                          <div class="col-sm-2"></div>
	                        <p class="text-danger">{{ $errors->first('jenis_kegiatan') }}</p> 
	                      </div>
	                      <div class="form-group row" id="jenisrekognisi" style="display: none;">
	                        <label class="col-sm-4 control-label">Jenis Rekognisi *</label>
	                        <div class="col-sm-8">
	                          <input type="input" name="jenis_rekognisi" class="form-control"  placeholder="Jenis Rekognisi" value="{{ $data->jenis_rekognisi }}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('jenis_rekognisi') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Nama Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="input" name="nama_kegiatan" class="form-control"  placeholder="Nama Kegiatan" value="{{ $data->nama_kegiatan }}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('nama_kegiatan') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Bentuk Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="input" class="form-control" name="bentuk_kegiatan" placeholder="Bentuk Kegiatan" value="{{ $data->bentuk_kegiatan }}">
	                        </div>
	                         <p class="text-danger">{{ $errors->first('bentuk_kegiatan') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Tanggal Mulai *</label>
	                        <div class="col-sm-8">
	                          <input type="date" name="tglmulai" class="form-control" value="{{ $data->tglmulai }}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('tglmulai') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label class="col-sm-4 control-label">Tanggal Selesai *</label>
	                        <div class="col-sm-8">
	                          <input type="date" name="tglselesai" class="form-control" value="{{ $data->tglselesai }}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('tglselesai') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Tingkat *</label>
	                            <div class="col-sm-8">
	                              <select name="tingkat" class="form-control" required="">
	                              <option >Pilih</option>
	                                  <option value="Regional" {{ $data->tingkat == 'Regional' ? 'selected':'' }}>Regional</option>
	                                  <option value="Nasional" {{ $data->tingkat == 'Nasional' ? 'selected':'' }}>Nasional</option>
	                                  <option value="Internasional" {{ $data->tingkat == 'Internasional' ? 'selected':'' }}>Internasional</option>
	                              </select>
	                            </div>
	                        <p class="text-danger">{{ $errors->first('tingkat') }}</p>    
	                      </div>
	                      <div class="form-group row">
	                        <label class="col-sm-4 control-label">Link / Url Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="url" name="url" class="form-control" value="{{ $data->url}}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('url') }}</p>
	                      </div>   
	                    <div class="form-group row">
                        	<label class="col-sm-4 control-label">Sumber Dana *</label>
                            <div class="col-sm-8">
                              <select name="sumberdana"  onchange="selek();" class="form-control" id="sumberdana">
                                  <option value="">Pilih</option>
                                  <option value="1" id="fak" {{ $data->sumberdana == '1' ? 'selected':'' }}>Fakultas</option>
                                  <option value="2" id="dep" {{ $data->sumberdana == '2' ? 'selected':'' }}>Departemen</option>
                              </select>
                            </div>
                      	</div>
	                     <div class="form-group row" id="depart" class="colors"  style="display:none">
                        	<label class="col-sm-4 control-label">Departemen *</label>
                            <div class="col-sm-8">
                              <select name="departemen"  class="form-control">
                                  <option value="">Pilih</option>
                                  @foreach ($departemen as $row)
                                            <option value="{{ encrypt($row->id) }}"{{ $row->id == $data->departemen ? 'selected':'' }}>{{ ucfirst($row->nama_departemen) }}</option>
                                  @endforeach
                              </select>
                            </div>
                     	</div>
	                      <div class="form-group row">
	                        <label class="col-sm-4 control-label">Sumber Dana Lain <sup class="label label-success">(optional)</sup></label>
	                        <div class="col-sm-8">
	                              <select name="sumberdana1"  class="form-control">
	                                  <option value="" >Pilih</option>
	                                  <option value="1" {{ $data->sumberdana1 == '1' ? 'selected':'' }}>Universitas</option>
	                                  <option value="2" {{ $data->sumberdana1 == '2' ? 'selected':'' }}>Lainnya</option>
	                              </select>
	                        </div>
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Jumlah dana yang diajukan *</label>
	                        <div class="col-sm-8">
	                          <input type="input" name="jumlah_dana" class="form-control" value="{{ $data->ajuandana }}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('jumlah_dana') }}</p>
	                      </div>   
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Surat Undangan * <sup class="label label-success">(.pdf max 2mb)</sup></label>
	                        <div class="col-sm-8">
	                          <input type="file" name="file_surat_undangan" class="form-control">
	                          @if (!empty($data->file_surat_undangan))
                                        
                                        <button type="button" class="btn btn-warning" style="margin-top: 10px"><a href="{{ asset('storage/uploads/SuratUndangan/'. $data->file_surat_undangan) }}">download</a></button>
                               @endif
	                        </div>
	                        <p class="text-danger">{{ $errors->first('file_surat_undangan') }}</p>
	                      </div> 
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">File Proposal * <sup class="label label-success">(.pdf max 2mb)</sup></label>
	                        <div class="col-sm-8">
	                          <input type="file" name="file_proposal" class="form-control">
	                          @if (!empty($data->file_proposal))
                                        
                                        <button type="button" class="btn btn-warning" style="margin-top: 10px"><a href="{{ asset('storage/uploads/Proposal/'. $data->file_proposal) }}">download</a></button>
                               @endif
	                        </div>

	                         <p class="text-danger">{{ $errors->first('file_proposal') }}</p>
	                      </div> 
	                    </div>
	                    <!-- /.card-body -->
	                    <div class="card-footer">
	                      <div class="col-sm-6">
	                      <button type="submit" class="btn btn-info float-right">Update</button>
	                      </div>
	                    </div>
	                <!-- /.card-footer -->
	              </form>
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
	                      <th>NIM</th>
	                      <th>Nama</th>
	                      <th>Departemen</th>
	                      <th>Jabatan</th>
	                      <th>aksi</th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                @forelse ($anggota as $rew => $row)
	                    <tr>
	                      <td>{{$row->NIM}}</td>
	                      <td>{{$row->Nama}}</td>
	                      <td>{{$row->nama_departemen}}</td>
	                      <td>{{$row->jabatan}}</td>
	                      <td>
                             <form action="{{ route('delegasi.hapusAnggota', encrypt($row->id)) }}" method="POST">
                              @csrf
                              <input type="hidden" name="_method" value="DELETE">
                              <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                              </form>
                           </td>
	                    </tr>
	                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
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

	    <!-- Modal Tambah Mahasiswa -->
	    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true" data-backdrop="static">
	        <div class="modal-dialog modal-lg">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h4 class="modal-title">Tambah Anggota</h4>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	              </button>
	            </div>
	            <div class="modal-body">
				          <form role="form" action="{{ route('delegasi.addAnggota', $data->id) }}" method="POST">
			                @csrf
			                <div class="card-body">
			                  <div class="form-group">
			                    <label>NIM</label>
			                    <input type="text" class="form-control" name="nim_anggota" placeholder="NIM">
			                  </div>
			                  <div class="form-group">
			                    <label>Nama</label>
			                    <input type="text" class="form-control" name="nama_anggota" placeholder="Nama">
			                  </div>
			                  <div class="form-group">
		                        <label>Departemen</label>
		                        <select class="form-control" name="id_departemen">
		                          <option>Pilih</option>
		                          @foreach ($departemen as $row)
                                            <option value="{{ encrypt($row->id) }}">{{ ucfirst($row->nama_departemen) }}</option>
                                  @endforeach
		                        </select>
							  </div>
			                  <div class="form-group">
		                        <label>Jabatan</label>
		                        <select class="form-control" name="jabatan">
		                          <option>Pilih</option>
		                          <option value="ketua">Ketua</option>
		                          <option value="anggota">Anggota</option>
		                        </select>
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
<script>
/**$(function() {
        var scntDiv = $('#addanggota');
        var i = $('#addanggota').size() + 1;
        
        $('#btnadd').on('click', function() {
                $('<input type="input" name="anggota' + i +'" class="form-control">').appendTo(scntDiv);
                i++;
                return false;
        });
        
});

$('.non_lombas').click(function () {
    $(this).parent().parent().find('#jenisrekognisi').hide();
    $(this).siblings('#jenisrekognisi').show(); 
    
});
**/
function Check() {
    if (document.getElementById('non_lomba').checked) {
        document.getElementById('jenisrekognisi').style.display = '';
    } 
    else if (document.getElementById('lomba').checked) {
        document.getElementById('jenisrekognisi').style.display = 'none';

   }
}
function selek() {
    if (document.getElementById('fak').selected) {
        document.getElementById('depart').style.display = 'none';
    } 
    else if (document.getElementById('dep').selected) {
        document.getElementById('depart').style.display = '';
   }
}

 if(document.getElementById('dep').selected == true){
 	document.getElementById('depart').style.display = '';
 }
 if(document.getElementById('non_lomba').checked == true){
 	document.getElementById('jenisrekognisi').style.display = '';
 }
</script>
@endsection

  