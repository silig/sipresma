@extends('layouts.master')

@section('title')
    <title>LPJ Delegasi</title>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LPJ Delegasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('pengajuanku.delegasi')}}">LPJ</a></li>
              <li class="breadcrumb-item active">Delegasi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-left: 20px">

      <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Form LPJ</h3>
               
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
              <form role="form" class="form-horizontal" files="true" action="{{ route('lpj.update',$lpj->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                    <div class="card-body">
                      <div class="form-group row">
                          <label  class="col-sm-4 control-label">Nomor Proposal *</label>
                          <div class="col-sm-8">
                          <input type="input" name="nomorproposal" class="form-control"  value="{{ $lpj->nomorproposal }}"readonly >
                        </div>
                        <p class="text-danger">{{ $errors->first('nomorproposal') }}</p> 
                      </div>
                      <div class="form-group row" >
                        <label class="col-sm-4 control-label">Kegiatan sudah Terlaksana? *</label>
                        <div class="col-sm-2">
                              <input type="radio" onclick="Check();" name="terlaksana" id="yes" value="Ya" {{ $lpj->terlaksana == 'Ya' ? 'checked':''}}> YA <br>
                          </div>    
                          <div class="col-sm-2">
                              <input type="radio" onclick="Check();" name="terlaksana" id="no" value="Tidak" {{ $lpj->terlaksana == 'Tidak' ? 'checked':''}}> TIDAK <br>
                          </div>
                          <div class="col-sm-2">
                          </div>
                          <div class="col-sm-2"></div>
                        <p class="text-danger">{{ $errors->first('terlaksana') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Capaian *</label>
                        <div class="col-sm-8"> 
                          <select name="capaian"  onchange="" class="form-control" id="capaian">
                                  <option value="" id="pil">Pilih</option>
                                  <option value="Juara umum" {{ $lpj->capaian == 'Juara umum' ? 'selected':''}}>Juara Umum</option>
                                  <option value="Juara 1" {{ $lpj->capaian == 'Juara 1' ? 'selected':''}} >Juara 1</option>
                                  <option value="Juara 2" {{ $lpj->capaian == 'Juara 2' ? 'selected':''}} >Juara 2</option>
                                  <option value="Juara 3" {{ $lpj->capaian == 'Juara 3' ? 'selected':''}} >Juara 3</option>
                                  <option value="Harapan 1" {{ $lpj->capaian == 'Harapan 1' ? 'selected':''}} >Harapan 1</option>
                                  <option value="Harapan 2" {{ $lpj->capaian == 'Harapan 2' ? 'selected':''}} >Harapan 2</option>
                                  <option value="Peserta" {{ $lpj->capaian == 'Peserta' ? 'selected':''}} >Peserta</option>
                                  <option value="Apresiasi" {{ $lpj->capaian == 'Apresiasi' ? 'selected':''}} >Apresiasi(Contoh: Best Design)</option>
                                  <option value="lainnya" {{ $lpj->capaian == 'lainnya' ? 'selected':''}} >Lainnya</option>
                              </select>
                        
                        </div>
                        <p class="text-danger">{{ $errors->first('capaian') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Catatan Capaian *</label>
                        <div class="col-sm-8">
                          <input type="input" class="form-control" id="catatan" name="catatancapaian" placeholder="Contoh: best desain, best speaker" value="{{ $lpj->catatancapaian }}">
                        </div>
                         <p class="text-danger">{{ $errors->first('catatancapaian') }}</p>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Link / Url Berita Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="url" name="url" id="link" class="form-control" value="{{ $lpj->url }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('url') }}</p>
                      </div>
                      <!-- dokumentasi -->  
                      <div class="form-group row" id="dokumen">
                        <label  class="col-sm-4 control-label">File dokumentasi * <sup class="label label-success">(.jpg max 2mb)</sup></label>
                        <div class="col-sm-7">
                          <div class="custom-file ">
                            <input type="file" name="file_dokumentasi" id="dokumentasi" class="form-control"></input>
                            
                            @if (!empty($lpj->file_dokumentasi)) 
                            <div class="custom-file">
                                        File yg diunggah : <a href="{{ asset('storage/uploads/Dokumentasi/'. $lpj->file_dokumentasi) }}">{{$lpj->file_dokumentasi}}</a>
                            </div>
                            @endif <br>
                          </div>
                        </div>
                        <div class="col-sm-1 float-sm-right">
                            <a href="#" class="btn btn-warning btn-sm" onclick="tambah1()" disabled> <i class="fa fa-plus"></i></a>
                            
                        </div>
                        <p class="text-danger">{{ $errors->first('file_dokumentasi') }}</p>
                      </div>
                      <div class="form-group row" id="dokumen1" style="display: none">
                        <label  class="col-sm-4 control-label"><sup class="label label-success"></sup></label>
                        <div class="col-sm-7">
                          <div class="custom-file ">
                            <input type="file" name="file_dokumentasi1" id="dokumentasi1" class="form-control"></input>
                            
                            @if (!empty($lpj->file_dokumentasi1)) 
                            <div class="custom-file">
                                        File yg diunggah : <a href="{{ asset('storage/uploads/Dokumentasi/'. $lpj->file_dokumentasi1) }}">{{$lpj->file_dokumentasi1}}</a>
                            </div>
                            @endif <br>
                          </div>
                        </div>
                        <div class="col-sm-1 float-sm-right">
                            <a href="#" class="btn btn-warning btn-sm" onclick="tambah2()"> <i class="fa fa-plus"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="hapus1()"><i class="fa fa-trash"></i></a>
                        </div>
                        <p class="text-danger">{{ $errors->first('file_dokumentasi1') }}</p>
                      </div>  
                      <div class="form-group row" id="dokumen2" style="display: none">
                        <label  class="col-sm-4 control-label"><sup class="label label-success"></sup></label>
                        <div class="col-sm-7">
                          <div class="custom-file ">
                            <input type="file" name="file_dokumentasi2" id="dokumentasi2" class="form-control"></input>
                            
                            @if (!empty($lpj->file_dokumentasi2)) 
                            <div class="custom-file">
                                        File yg diunggah : <a href="{{ asset('storage/uploads/Dokumentasi/'. $lpj->file_dokumentasi2) }}">{{$lpj->file_dokumentasi2}}</a>
                            </div>
                            @endif <br>
                          </div>
                        </div>
                        <div class="col-sm-1 float-sm-right">
                           
                            <a href="#" class="btn btn-danger btn-sm" onclick="hapus2()"><i class="fa fa-trash"></i></a>
                        </div>
                        <p class="text-danger">{{ $errors->first('file_dokumentasi2') }}</p>
                      </div>
                      <!-- end dokumentasi -->
                      <div class="form-group row" >
                        <label  class="col-sm-4 control-label">File Surat Tugas * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_surat_tugas" id="surat" class="form-control"></input>
                            @if (!empty($lpj->file_surat_tugas)) 
                            <div class="custom-file">
                            File yg diunggah : <a href="{{ asset('storage/uploads/SuratTugas/'. $lpj->file_surat_tugas) }}">{{$lpj->file_surat_tugas}}</a>
                            </div>
                            @endif
                          </div>
                        </div>
                         <p class="text-danger">{{ $errors->first('file_surat_tugas') }}</p>
                      </div>
                      <!-- sertifikat --> 
                      <div class="form-group row" id="sertif">
                        <label  class="col-sm-4 control-label">Sertifikat/Piagam * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-7">
                          <div class="custom-file">
                            <input type="file" name="sertifikat" id="sertifikat" class="form-control"></input>
                            @if (!empty($lpj->file_sertifikat))
                                       <div class="custom-file"> File yg diunggah : <a href="{{ asset('storage/uploads/Sertifikat/'. $lpj->file_sertifikat) }}">{{$lpj->file_sertifikat}}</a>
                                       </div>
                            @endif<br>
                          </div>
                        </div>
                        <div class="col-sm-1 float-sm-right">
                            <a href="#" class="btn btn-warning btn-sm" onclick="add1()" > <i class="fa fa-plus"></i></a>
                            
                        </div>
                         <p class="text-danger">{{ $errors->first('sertifikat') }}</p>
                      </div>
                      <div class="form-group row" id="sertif1" style="display: none">
                        <label  class="col-sm-4 control-label"><sup class="label label-success"></sup></label>
                        <div class="col-sm-7">
                          <div class="custom-file">
                            <input type="file" name="sertifikat1" id="sertifikat1" class="form-control"></input>
                            @if (!empty($lpj->file_sertifikat))
                                       <div class="custom-file"> File yg diunggah : <a href="{{ asset('storage/uploads/Sertifikat/'. $lpj->file_sertifikat1) }}">{{$lpj->file_sertifikat1}}</a>
                                       </div>
                            @endif<br>
                          </div>
                        </div>
                        <div class="col-sm-1 float-sm-right">
                            <a href="#" class="btn btn-warning btn-sm" onclick="add2()" > <i class="fa fa-plus"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="del1()"><i class="fa fa-trash"></i></a>
                        </div>
                         <p class="text-danger">{{ $errors->first('sertifikat1') }}</p>
                      </div>
                      <div class="form-group row" id="sertif2" style="display: none">
                        <label  class="col-sm-4 control-label"><sup class="label label-success"></sup></label>
                        <div class="col-sm-7">
                          <div class="custom-file">
                            <input type="file" name="sertifikat2" id="sertifikat2" class="form-control"></input>
                            @if (!empty($lpj->file_sertifikat))
                                       <div class="custom-file"> File yg diunggah : <a href="{{ asset('storage/uploads/Sertifikat/'. $lpj->file_sertifikat2) }}">{{$lpj->file_sertifikat2}}</a>
                                       </div>
                            @endif<br>
                          </div>
                        </div>
                        <div class="col-sm-1 float-sm-right">
                            <a href="#" class="btn btn-danger btn-sm" onclick="del2()"><i class="fa fa-trash"></i></a>
                            
                        </div>
                         <p class="text-danger">{{ $errors->first('sertifikat2') }}</p>
                      </div>
                      <!-- end sertifikat -->
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Reportase * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="reportase" id="reportase" class="form-control"></input>
                            @if (!empty($lpj->file_reportase)) 
                            <div class="custom-file">
                            File yg diunggah : <a href="{{ asset('storage/uploads/Reportase/'. $lpj->file_reportase) }}">{{$lpj->file_reportase}}</a>
                            </div>
                            @endif
                          </div>
                        </div>
                         <p class="text-danger">{{ $errors->first('reportase') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">File LPJ * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_lpj" id="lpj" class="form-control"></input>
                            @if (!empty($lpj->file_lpj)) 
                            <div class="custom-file">
                            File yg diunggah : <a href="{{ asset('storage/uploads/LPJ/'. $lpj->file_lpj) }}">{{$lpj->file_lpj}}</a>
                            </div>
                            @endif
                          </div>
                        </div>
                         <p class="text-danger">{{ $errors->first('file_lpj') }}</p>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <div class="col-sm-6">
                      <button type="submit" class="btn btn-info float-right">Submit</button>
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
    if (document.getElementById('yes').checked) {
        document.getElementById('capaian').disabled = false;
        document.getElementById('catatan').disabled = false;
        document.getElementById('link').disabled = false;
        document.getElementById('dokumentasi').disabled = false;
        document.getElementById('dokumentasi1').disabled = false;
        document.getElementById('dokumentasi2').disabled = false;
        document.getElementById('surat').disabled = false;
        document.getElementById('reportase').disabled = false;
        document.getElementById('sertifikat').disabled = false;
        document.getElementById('sertifikat1').disabled = false;
        document.getElementById('sertifikat2').disabled = false;
        document.getElementById('lpj').disabled = false;
    } 
    else if (document.getElementById('no').checked) {
        document.getElementById('capaian').disabled = true;
        document.getElementById('catatan').disabled = true;
        document.getElementById('link').disabled = true;
        document.getElementById('dokumentasi').disabled = true;
        document.getElementById('dokumentasi1').disabled = true;
        document.getElementById('dokumentasi2').disabled = true;
        document.getElementById('surat').disabled = true;
        document.getElementById('reportase').disabled = true;
        document.getElementById('sertifikat').disabled = true;
        document.getElementById('sertifikat1').disabled = true;
        document.getElementById('sertifikat2').disabled = true;
        document.getElementById('lpj').disabled = true;
   }
}

function tambah1(){
  document.getElementById('dokumen1').style.display = '';
}
function tambah2(){
  document.getElementById('dokumen2').style.display = '';
}
function hapus1(){
  document.getElementById('dokumen1').style.display = 'none';
}
function hapus2(){
  document.getElementById('dokumen2').style.display = 'none';
}

function add1(){
  document.getElementById('sertif1').style.display = '';
}
function add2(){
  document.getElementById('sertif2').style.display = '';
}
function del1(){
  document.getElementById('sertif1').style.display = 'none';
}
function del2(){
  document.getElementById('sertif2').style.display = 'none';
}

 if (document.getElementById('no').checked == true) {
        document.getElementById('capaian').disabled = true;
        document.getElementById('catatan').disabled = true;
        document.getElementById('link').disabled = true;
        document.getElementById('dokumentasi').disabled = true;
        document.getElementById('dokumentasi1').disabled = true;
        document.getElementById('dokumentasi2').disabled = true;
        document.getElementById('surat').disabled = true;
        document.getElementById('reportase').disabled = true;
        document.getElementById('sertifikat').disabled = true;
        document.getElementById('sertifikat1').disabled = true;
        document.getElementById('sertifikat2').disabled = true;
        document.getElementById('lpj').disabled = true;
   }
</script>
@endsection

  