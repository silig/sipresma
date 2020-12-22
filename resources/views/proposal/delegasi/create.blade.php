@extends('layouts.master')

@section('title')
    <title>Form Proposal Delegasi</title>
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

              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item">Delegasi</li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
        <hr>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-left: 20px;margin-right: 10px">

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
              <form role="form" class="form-horizontal" files="true" action="{{ route('delegasi.simpan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                    <div class="card-body">
                      <div class="form-group row">
                          <label  class="col-sm-4 control-label">Jenis Kegiatan *</label>
                          <div class="col-sm-2">
                              <input type="radio" onclick="Check();" name="jenis_kegiatan" id="lomba" value="lomba" checked> Lomba <br>
                          </div>    
                          <div class="col-sm-2">
                              <input type="radio" onclick="Check();" id="non_lomba" name="jenis_kegiatan" value="nonlomba"> Non Lomba<br>
                          </div>
                          <div class="col-sm-2">
                          </div>
                          <div class="col-sm-2"></div>
                        <p class="text-danger">{{ $errors->first('jenis_kegiatan') }}</p> 
                      </div>
                      <div class="form-group row" id="jenisrekognisi" style="display: none;">
                        <label class="col-sm-4 control-label">Jenis Rekognisi *</label>
                        <div class="col-sm-8">
                          <input type="input" name="jenis_rekognisi" value="{{ old('jenis_rekognisi')}}" class="form-control"  placeholder="Jenis Rekognisi" >
                        </div>
                        <p class="text-danger">{{ $errors->first('jenis_rekognisi') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Nama Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="input" name="nama_kegiatan" value="{{ old('nama_kegiatan')}}" class="form-control"  placeholder="Nama Kegiatan" >
                        </div>
                        <p class="text-danger">{{ $errors->first('nama_kegiatan') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Bentuk Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" name="bentuk_kegiatan" value="{{ old('bentuk_kegiatan')}}" placeholder="Bentuk Kegiatan">
                        </div>
                         <p class="text-danger">{{ $errors->first('bentuk_kegiatan') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Lokasi Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" value="{{ old('lokasi_kegiatan')}}" name="lokasi_kegiatan" placeholder="Contoh: Udinus, Semarang">
                        </div>
                         <p class="text-danger">{{ $errors->first('lokasi_kegiatan') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Tanggal Mulai *</label>
                        <div class="col-sm-8">
                           
                          <input type="date" name="tglmulai" value="{{ old('tglmulai')}}" class="form-control" onchange="minimal()" id="tglmulai" min="{{$minim}}">
                        </div>
                        <p class="text-danger">{{ $errors->first('tglmulai') }}</p>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Tanggal Selesai *</label>
                        <div class="col-sm-8">
                          <input type="date" name="tglselesai" value="{{ old('tglselesai')}}" class="form-control" id="tglselesai">
                        </div>
                        <p class="text-danger">{{ $errors->first('tglselesai') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Tingkat *</label>
                            <div class="col-sm-8">
                              <select required name="tingkat" class="form-control"  value="{{ old('tingkat')}}">
                              <option value="">Pilih</option>
                                  <option value="Regional">Regional</option>
                                  <option value="Nasional">Nasional</option>
                                  <option value="Internasional">Internasional</option>
                              </select>
                            </div>
                        <p class="text-danger">{{ $errors->first('tingkat') }}</p>    
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Link / Url Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="url" name="url" value="{{ old('url')}}" class="form-control" placeholder="Contoh : https://example.com">
                        </div>
                        <p class="text-danger">{{ $errors->first('url') }}</p>
                      </div> 
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">No. HP *</label>
                        <div class="col-sm-8">
                          <input type="input" name="nohp" class="form-control" value="{{ old('nohp')}}" placeholder="contoh : 081234567890">
                        </div>
                        <p class="text-danger">{{ $errors->first('nohp') }}</p>
                      </div>   
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Sumber Dana *</label>
                            <div class="col-sm-8">
                              <select name="sumberdana"  onchange="selek();" class="form-control" id="sumberdana">
                                  <option value="" id="fak">Pilih</option>
                                  <option value="1" id="fak" >Fakultas</option>
                                  <option value="2" id="dep" >Departemen</option>
                              </select>
                            </div>
                      </div>
                      <div class="form-group row" id="depart" class="colors"  style="display:none">
                        <label class="col-sm-4 control-label">Departemen *</label>
                            <div class="col-sm-8">
                              <select name="departemen"  class="form-control ">
                                  <option value="">Pilih</option>
                                  @foreach ($departemen as $row)
                                            <option value="{{ encrypt($row->id) }}">{{ ucfirst($row->nama_departemen) }}</option>
                                  @endforeach
                              </select>
                            </div>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Jumlah dana yang diajukan *</label>
                        <div class="col-sm-8">
                          <input type="number" name="jumlah_dana" value="{{ old('jumlah_dana')}}" class="form-control">
                        </div>
                        <p class="text-danger">{{ $errors->first('jumlah_dana') }}</p>
                      </div>  
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Sumber Dana Lain <sup class="label label-success">(optional)</sup></label>
                        <div class="col-sm-8">
                              <select name="sumberdana1" onchange="dana();" class="form-control" id="sumberdana1">
                                  <option value="" id="pilih">Pilih</option>
                                  <option value="1" id="univ">Universitas</option>
                                  <option value="2" id="lain">Lainnya</option>
                              </select>
                        </div>
                      </div>
                      <div class="form-group row" id="danalainnya" style="display:none">
                        <label  class="col-sm-4 control-label">Jumlah dana lainnya *</label>
                        <div class="col-sm-8">
                          <input type="number" name="danalain" class="form-control" id="danalain" value="">
                        </div>
                        <p class="text-danger">{{ $errors->first('danalain') }}</p>
                      </div>  
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Surat Undangan * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_surat_undangan" accept=".pdf">
                            
                          </div>
                        </div>
                        <p class="text-danger">{{ $errors->first('file_surat_undangan') }}</p>
                      </div> 
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">File Proposal * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_proposal" accept=".pdf">
                            
                          </div>
                        </div>
                         <p class="text-danger">{{ $errors->first('file_proposal') }}</p>
                      </div> 
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <div class="col-sm-6">
                      <button type="submit" class="btn btn-info float-right">Ajukan</button>
                      </div>
                    </div>
                <!-- /.card-footer -->
              </form>
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

function pilih() {
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

function minimal(){
  var min = document.getElementById('tglmulai').value;
  console.log(min);
  document.getElementById("tglselesai").min = min;
}
</script>
@endsection

  