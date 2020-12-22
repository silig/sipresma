@extends('layouts.master')

@section('title')
    <title>Edit proposal penyelenggara</title>
      <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/ui-lightness/jquery-ui.min.css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/lookup/css/lookupbox.css') }}" />

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

              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="#" onclick="back()">Penyelenggara</a></li>
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
	              <form files="true" action="{{ route('penyelenggara.update', encrypt($data->id)) }}" method="POST" enctype="multipart/form-data">
	                                @csrf
	                                <input type="hidden" name="_method" value="PUT">
	                    <div class="card-body">
	                      <div class="form-group row">
	                        <label class="col-sm-4 control-label">Penyelenggara Kegiatan *</label>
                            <div class="col-sm-8">
                              <select name="penyelenggara_kegiatan"  onchange="tes()" class="form-control" >
                                  <option value="" id="pil">Pilih</option>
                                  <option value="BEM" id="bem" {{ $data->penyelenggara_kegiatan == 'BEM' ? 'selected':''}}>BEM</option>
                                  <option value="Senat" id="senat" {{ $data->penyelenggara_kegiatan == 'Senat' ? 'selected':''}}>Senat</option>
                                  <option value="UPK" id="upk" {{ $data->penyelenggara_kegiatan == 'UPK' ? 'selected':''}}>UPK</option>
                                  <option value="Himpunan" id="hmj" {{ $data->penyelenggara_kegiatan == 'Himpunan' ? 'selected':''}}>Himpunan</option>
                              </select>
                            </div>
	                        <p class="text-danger">{{ $errors->first('penyelenggara_kegiatan') }}</p>
	                      </div>
	                      <div class="form-group row" id="UKM" style="display: none">
                        <label class="col-sm-4 control-label">Unit Kegiatan UPK *</label>
                            <div class="col-sm-8">
                              <select name="unit_kegiatan_upk"  class="form-control" >
                                  <option value="" id="kintil" >Pilih</option>
                                  <option value="PRMK" id="prmk" {{ $data->unit_kegiatan == 'PRMK' ? 'selected':''}}>PRMK</option>
                                  <option value="PMK" id="pmk" {{ $data->unit_kegiatan == 'PMK' ? 'selected':''}}>PMK</option>
                                  <option value="IZZATI" id="izzati" {{ $data->unit_kegiatan == 'IZZATI' ? 'selected':''}}>IZZATI </option>
                                  <option value="FST" id="fst" {{ $data->unit_kegiatan == 'FST' ? 'selected':''}}>FST</option>
                                  <option value="MOMENTUM" id="momentum" {{ $data->unit_kegiatan == 'MOMENTUM' ? 'selected':''}}>MOMENTUM</option>
                                  <option value="PSMT" id="psmt" {{ $data->unit_kegiatan == 'PSMT' ? 'selected':''}}>PSMT</option>
                              </select>
                            </div>
                      </div>
                      <div class="form-group row" id="HM" style="display: none">
                        <label class="col-sm-4 control-label">Unit Kegiatan Himpunan *</label>
                            <div class="col-sm-8">
                              <select name="unit_kegiatan_hmj"  class="form-control" >
                                  <option value="" id="pilih">Pilih</option>
                                  <option value="HMTK" {{ $data->unit_kegiatan == 'HMTK' ? 'selected':''}}>HMTK</option>
                                  <option value="HMTI"  {{ $data->unit_kegiatan == 'HMTI' ? 'selected':''}}>HMTI</option>
                                  <option value="HMTP"  {{ $data->unit_kegiatan == 'HMTP' ? 'selected':''}}>HMTP </option>
                                  <option value="HME"  {{ $data->unit_kegiatan == 'HME' ? 'selected':''}}>HME</option>
                                  <option value="HMM"  {{ $data->unit_kegiatan == 'HMM' ? 'selected':''}}>HMM</option>
                                  <option value="HIMASPAL" {{ $data->unit_kegiatan == 'HIMASPAL' ? 'selected':''}} >HIMASPAL</option>
                                  <option value="HM Teknik Geodesi" {{ $data->unit_kegiatan == 'HM Teknik Geodesi' ? 'selected':''}} >HM Teknik Geodesi</option>
                                  <option value="HMA Amogasida" {{ $data->unit_kegiatan == 'HMA Amogasida' ? 'selected':''}} >HMA Amogasida</option>
                                  <option value="HMTG Mamgadipa" {{ $data->unit_kegiatan == 'HMTG Mamgadipa' ? 'selected':''}} >HMTG Mamgadipa</option>
                                  <option value="HMS" {{ $data->unit_kegiatan == 'HMS' ? 'selected':''}} >HMS</option>
                                  <option value="HIMASKOM" {{ $data->unit_kegiatan == 'HIMASKOM' ? 'selected':''}} >HIMASKOM</option>
                                  <option value="HMTL" {{ $data->unit_kegiatan == 'HMTL' ? 'selected':''}} >HMTL</option>
                              </select>
                            </div>
                      </div>
	                      <div class="form-group row">
	                          <label  class="col-sm-4 control-label">Jenis Kegiatan *</label>
	                          <div class="col-sm-2">
	                              <input type="radio" onclick="Check();" name="jenis_kegiatan" id="lomba" value="lomba" {{ $data->jenis_kegiatan == 'lomba' ? 'checked':''}} > Lomba <br>
	                          </div>    

	                          <div class="col-sm-3">
	                              <input type="radio"  onclick="Check();" id="softskill" name="jenis_kegiatan" value="softskill" {{ $data->jenis_kegiatan == 'softskill' ? 'checked':''}}> Softskill<br>
	                          </div>
	                          <div class="col-sm-2">
	                          <input type="radio"  onclick="Check();" id="ukm" name="jenis_kegiatan" value="lainnya" {{ $data->jenis_kegiatan == 'lainnya' ? 'checked':''}}>Lainnya<br>
	                          </div>
	                          <div class="col-sm-2"></div>
	                        <p class="text-danger">{{ $errors->first('jenis_kegiatan') }}</p> 
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Nama Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="input" name="nama_kegiatan" class="form-control"  placeholder="Nama Kegiatan" value="{{ $data->nama_kegiatan }}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('nama_kegiatan') }}</p>
	                      </div>
	                      <div class="form-group row" id="tingkat" style="display: none">
                        <label  class="col-sm-4 control-label">Tingkat *</label>
                            <div class="col-sm-8">
                              <select name="tingkat" class="form-control">
	                              <option >Pilih</option>
	                                  <option value="Regional" {{ $data->tingkat == 'Regional' ? 'selected':'' }}>Regional</option>
	                                  <option value="Nasional" {{ $data->tingkat == 'Nasional' ? 'selected':'' }}>Nasional</option>
	                                  <option value="Internasional" {{ $data->tingkat == 'Internaional' ? 'selected':'' }}>Internasional</option>
	                              </select>
                            </div>
                        <p class="text-danger">{{ $errors->first('tingkat') }}</p>    
                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Bentuk Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="input" class="form-control" name="bentuk_kegiatan" placeholder="Bentuk Kegiatan" value="{{ $data->bentuk_kegiatan }}">
	                        </div>
	                         <p class="text-danger">{{ $errors->first('bentuk_kegiatan') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">Sasaran Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="input" class="form-control" name="sasaran_kegiatan" placeholder="Sasaran Kegiatan" value="{{ $data->sasaran_kegiatan }}">
	                        </div>
	                         <p class="text-danger">{{ $errors->first('sasaran_kegiatan') }}</p>
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
	                        <label  class="col-sm-4 control-label">Lokasi Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="input" class="form-control" name="lokasi_kegiatan" placeholder="Lokasi Kegiatan" value="{{ $data->lokasi_kegiatan }}">
	                        </div>
	                         <p class="text-danger">{{ $errors->first('lokasi_kegiatan') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label class="col-sm-4 control-label">Link / Url Kegiatan *</label>
	                        <div class="col-sm-8">
	                          <input type="url" name="url" class="form-control" value="{{ $data->url}}" placeholder="Contoh : https://example.com">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('url') }}</p>
	                      </div> 
	                      <div class="form-group row">
	                        <label class="col-sm-4 control-label">No. HP *</label>
	                        <div class="col-sm-8">
	                          <input type="input" name="nohp" class="form-control" value="{{ $data->nohp}}" placeholder="contoh : 081234567890">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('nohp') }}</p>
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
	                        <label  class="col-sm-4 control-label">Jumlah dana yang diajukan *</label>
	                        <div class="col-sm-8">
	                          <input type="number" name="jumlah_dana" class="form-control" value="{{ $data->ajuandana }}">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('jumlah_dana') }}</p>
	                    </div>
	                     <div class="form-group row">
	                        <label class="col-sm-4 control-label">Sumber Dana Lain <sup class="label label-success">(optional)</sup></label>
	                        <div class="col-sm-8">
	                              <select name="sumberdana1"  class="form-control" onchange="dana();" id="sumberdana1">
	                                  <option value="" id="pilih" >Pilih</option>
	                                  <option value="1" id="univ" {{ $data->sumberdana1 == '1' ? 'selected':'' }}>Universitas</option>
	                                  <option value="2" id="lain" {{ $data->sumberdana1 == '2' ? 'selected':'' }}>Lainnya</option>
	                              </select>
	                        </div>
	                      </div>
	                      <div class="form-group row" id="danalainnya" style="display:none">
	                        <label  class="col-sm-4 control-label">Jumlah dana lainnya *</label>
	                        <div class="col-sm-8">
	                          <input type="number" name="danalain" class="form-control" value="{{ $data->danalainnya }}" id="danalain">
	                        </div>
	                        <p class="text-danger">{{ $errors->first('danalain') }}</p>
	                      </div>
	                      <div class="form-group row">
	                        <label  class="col-sm-4 control-label">File Proposal * <sup class="label label-success">(.pdf max 2mb)</sup></label>
	                        <div class="col-sm-8">
	                          <input type="file" name="file_proposal" class="form-control">
	                          @if (!empty($data->file_proposal))
                                      
                                        <p>File yang diunggah : <a href="{{ asset('storage/uploads/Proposal/'. $data->file_proposal) }}">{{$data->file_proposal}}</a> </p> 
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
	             	 <!-- <button type="button" class="btn btn-block bg-gradient-info btn-sm col-1" data-toggle="modal" data-target="#modal-lg">Add</button> -->
	                <fieldset>
	             	 <form action="{{ route('penyelenggara.addAnggota', $data->id) }}" method="post">
	             	 	@csrf
					      <table>
					        <tr>
					          <td>NIM</td>
					          <td>:</td>
					          <td>
					            <input class="form-control" type="text" name="nim" value="" readonly=""  />
					          </td>
					          <td>
					            <button class="btn btn-success btn-sm" type="button" id="lookup1"><i class="fas fa-search"></i></button>
					          </td>
					        </tr>
					        <tr>
					          <td>Nama</td>
					          <td>:</td>
					          <td><input class="form-control" type="text" name="nama" value="" readonly="" /></td>
					        </tr>
					        <tr>
					          <td>Jurusan</td>
					          <td>:</td>
					          <td><input class="form-control" type="text" name="jur" value="" readonly="" />
					          <input class="form-control" type="text" name="jurusan" value="" hidden /></td>
					        </tr>
		                    <tr>
					          <td>Jabatan</td>
					          <td>:</td>
					          <td><select class="form-control" name="jabatan">
		                          <option>Pilih</option>
		                          <option value="bendahara">Bendahara</option>
		                          <option value="anggota">Anggota</option>
		                        </select></td>
					        </tr>
					      </table>
					      <br/>
					      <input type="submit"  class="btn btn-primary" value="add" />
					    </form>
	                </fieldset>

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
                             <form action="{{ route('penyelenggara.hapusAnggota', encrypt($row->id)) }}" method="POST">
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
	    <!-- <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true" data-backdrop="static">
	        <div class="modal-dialog modal-lg">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h4 class="modal-title">Tambah Anggota</h4>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	              </button>
	            </div>
	            <div class="modal-body">
				          <form role="form" action="{{ route('penyelenggara.addAnggota', $data->id) }}" method="POST">
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
		                          <option value="bendahara">Bendahara</option>
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
	        </div>
	    </div> -->

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script src="{{ asset('plugins/lookup/js/jquery.lookupbox.js') }}"></script>
<script type="text/javascript">

function Check() {
    if (document.getElementById('lomba').checked) {
        document.getElementById('tingkat').style.display = '';
    } 
    else if (document.getElementById('softskill').checked) {
        document.getElementById('tingkat').style.display = 'none';
   }
   else if (document.getElementById('ukm').checked) {
        document.getElementById('tingkat').style.display = 'none';
   }
}
function back(){
    window.history.back();
  }
  
function selek() {
    if (document.getElementById('fak').selected) {
        document.getElementById('depart').style.display = 'none';
    } 
    else if (document.getElementById('dep').selected) {
        document.getElementById('depart').style.display = '';
   }
}
function dana() {
    if (document.getElementById('pilih').selected) {
        document.getElementById('danalainnya').style.display = 'none';
        document.getElementById("danalain").value = "";
    } 
    else if (document.getElementById('univ').selected) {
        document.getElementById('danalainnya').style.display = '';
   }else if (document.getElementById('lain').selected) {
        document.getElementById('danalainnya').style.display = '';
   }
}

function tes() {
    if (document.getElementById('upk').selected) {
        document.getElementById('UKM').style.display = '';
        document.getElementById('HM').style.display = 'none';
    } else if (document.getElementById('hmj').selected) {
        document.getElementById('HM').style.display = '';
        document.getElementById('UKM').style.display = 'none';
    }
    else if (document.getElementById('bem').selected) {
        document.getElementById('HM').style.display = 'none';
        document.getElementById('UKM').style.display = 'none';
   }
   else if (document.getElementById('senat').selected) {
        document.getElementById('HM').style.display = 'none';
        document.getElementById('UKM').style.display = 'none';
   }
   else if (document.getElementById('pil').selected) {
        document.getElementById('HM').style.display = 'none';
        document.getElementById('UKM').style.display = 'none';
   }
}

if(document.getElementById('hmj').selected == true){
 	document.getElementById('HM').style.display = '';
}
if(document.getElementById('upk').selected == true){
 	document.getElementById('UKM').style.display = '';
}
 if(document.getElementById('dep').selected == true){
 	document.getElementById('depart').style.display = '';
}
if(document.getElementById('univ').selected == true){
 	document.getElementById('danalainnya').style.display = '';
 }
 if(document.getElementById('lain').selected == true){
 	document.getElementById('danalainnya').style.display = '';
 }
 if(document.getElementById('lomba').checked == true){
 	document.getElementById('tingkat').style.display = '';
}

 $(document).ready(function () {
      $("#lookup1").lookupbox({
        title: 'Cari mahasiswa',
        url: '{{route('ambil')}}?input=',
        imgLoader: 'Loading...',
        width: 500,
        onItemSelected: function(data){
          $('input[name=nim]').val(data.NIM);
          $('input[name=nama]').val(data.nama_mhs);
          $('input[name=jur]').val(data.program+' '+data.jurusan);
          $('input[name=jurusan]').val(data.jurusan);
        },
        tableHeader: ['NIM', 'Nama Mahasiswa', ,'Program','Jurusan']
      });
    });
</script>
@endsection

  