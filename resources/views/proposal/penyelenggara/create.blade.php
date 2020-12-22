@extends('layouts.master')

@section('title')
    <title>Create proposal penyelenggara</title>
@endsection


@section('content')
<div class="content-wrapper" style="margin-bottom: 20px">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-left: 20px;margin-right: 10px">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proposal Penyelenggara</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Penyelenggara</li>
            </ol>
          </div>
        </div>
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
              <form role="form" class="form-horizontal" files="true" action="{{ route('penyelenggara.simpan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Penyelenggara Kegiatan *</label>
                            <div class="col-sm-8">
                              <select name="penyelenggara_kegiatan"  onchange="tes()" class="form-control" >
                                  <option value="" id="pil">Pilih</option>
                                  <option value="BEM" id="bem" >BEM</option>
                                  <option value="Senat" id="senat" >Senat</option>
                                  <option value="UPK" id="upk" >UPK</option>
                                  <option value="Himpunan" id="hmj" >Himpunan</option>
                              </select>
                            </div>
                      </div>
                      <div class="form-group row" id="UKM" style="display: none">
                        <label class="col-sm-4 control-label">Unit Kegiatan UPK *</label>
                            <div class="col-sm-8">
                              <select name="unit_kegiatan_upk"  class="form-control" >
                                  <option value="" id="kintil">Pilih</option>
                                  <option value="PRMK" id="prmk" >PRMK</option>
                                  <option value="PMK" id="pmk" >PMK</option>
                                  <option value="IZZATI" id="izzati" >IZZATI </option>
                                  <option value="FST" id="fst" >FST</option>
                                  <option value="MOMENTUM" id="momentum" >MOMENTUM</option>
                                  <option value="PSMT" id="psmt" >PSMT</option>
                              </select>
                            </div>
                      </div>
                      <div class="form-group row" id="HM" style="display: none">
                        <label class="col-sm-4 control-label">Unit Kegiatan Himpunan *</label>
                            <div class="col-sm-8">
                              <select name="unit_kegiatan_hmj"  class="form-control" >
                                  <option value="" id="pilih">Pilih</option>
                                  <option value="HMTK" >HMTK</option>
                                  <option value="HMTI"  >HMTI</option>
                                  <option value="HMTP"  >HMTP </option>
                                  <option value="HME"  >HME</option>
                                  <option value="HMM"  >HMM</option>
                                  <option value="HIMASPAL"  >HIMASPAL</option>
                                  <option value="HM Teknik Geodesi"  >HM Teknik Geodesi</option>
                                  <option value="HMA Amogasida"  >HMA Amogasida</option>
                                  <option value="HMTG Mamgadipa"  >HMTG Mamgadipa</option>
                                  <option value="HMS"  >HMS</option>
                                  <option value="HIMASKOM"  >HIMASKOM</option>
                                  <option value="HMTL"  >HMTL</option>
                              </select>
                            </div>
                      </div>
                      <div class="form-group row">
                          <label  class="col-sm-4 control-label">Jenis Kegiatan *</label>
                          <div class="col-sm-2">
                              <input type="radio" onclick="Check();"  name="jenis_kegiatan" id="lomba" value="lomba" > Lomba <br>
                          </div>    
                          <div class="col-sm-3">
                              <input type="radio" onclick="Check();"  name="jenis_kegiatan" id="softskill" value="softskill"> Softskill<br>
                          </div>
                          <div class="col-sm-2">
                              <input type="radio" onclick="Check();" name="jenis_kegiatan" id="lainnya" value="lainnya"> Lainnya<br>
                          </div>
                          <div class="col-sm-2"></div>
                        <p class="text-danger">{{ $errors->first('jenis_kegiatan') }}</p> 
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Nama Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="input" name="nama_kegiatan" value="{{ old('nama_kegiatan')}}" class="form-control"  placeholder="Nama Kegiatan" >
                        </div>
                        <p class="text-danger">{{ $errors->first('nama_kegiatan') }}</p>
                      </div>
                      <div class="form-group row" id="tingkat" style="display: none">
                        <label  class="col-sm-4 control-label">Tingkat *</label>
                            <div class="col-sm-8">
                              <select name="tingkat" class="form-control" required="">
                              <option >Pilih</option>
                                  <option value="Regional">Regional</option>
                                  <option value="Nasional">Nasional</option>
                                  <option value="Internasional">Internasional</option>
                              </select>
                            </div>
                        <p class="text-danger">{{ $errors->first('tingkat') }}</p>    
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Bentuk Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" name="bentuk_kegiatan" value="{{ old('bentuk_kegiatan')}}" placeholder="Bentuk Kegiatan" >
                        </div>
                         <p class="text-danger">{{ $errors->first('bentuk_kegiatan') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Sasaran Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" name="sasaran_kegiatan" value="{{ old('sasaran_kegiatan')}}" placeholder="Sasaran Kegiatan" >
                        </div>
                         <p class="text-danger">{{ $errors->first('sasaran_kegiatan') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Tanggal Mulai *</label>
                        <div class="col-sm-8">
                          <input type="date" name="tglmulai" value="{{ old('tglmulai')}}" class="form-control" id="tglmulai" onchange="minimal()">
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
                        <label  class="col-sm-4 control-label">Lokasi Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" name="lokasi_kegiatan" value="{{ old('lokasi_kegiatan')}}" placeholder="Contoh : Universitas Diponergoro, Semarang" >
                        </div>
                         <p class="text-danger">{{ $errors->first('lokasi_kegiatan') }}</p>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Link / Url Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="url" name="url" class="form-control" placeholder="Contoh : https://example.com" value="{{ old('url')}}">
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
                                  <option value="" id="pil">Pilih</option>
                                  <option value="1" id="fak" >Fakultas</option>
                                  <option value="2" id="dep" >Departemen</option>
                              </select>
                            </div>
                      </div>
                      <div class="form-group row" id="depart" class="colors"  style="display:none">
                        <label class="col-sm-4 control-label">Departemen *</label>
                            <div class="col-sm-8">
                              <select name="departemen"  class="form-control">
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
                        <label  class="col-sm-4 control-label">File Proposal * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <input type="file" name="file_proposal" >
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

  function selek() {
    if (document.getElementById('fak').selected) {
        document.getElementById('depart').style.display = 'none';
    } else if (document.getElementById('pil').selected) {
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
        document.getElementById('pilih').selected = true;
    } else if (document.getElementById('hmj').selected) {
        document.getElementById('HM').style.display = '';
        document.getElementById('UKM').style.display = 'none';
        document.getElementById('kintil').selected = true;
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

function minimal(){
  var min = document.getElementById('tglmulai').value;
  console.log(min);
  document.getElementById("tglselesai").min = min;
}
</script>

@endsection

  