@extends('layouts.master')

@section('title')
    <title>LPJ Penyelenggara</title>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LPJ Penyelenggara</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('pengajuanku.penyelenggara')}}">LPJ</a></li>
              <li class="breadcrumb-item active">Penyelenggara</li>
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

              <!-- / JENIS PROPOSAL PENGABDIAN DAN SOFTSKILL-->
              @if (substr($lpj->nomorproposal,0,2) == 'PU' || substr($lpj->nomorproposal,0,2) == 'PS')
              <form role="form" class="form-horizontal" files="true" action="{{ route('lpj.update',$lpj->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                    <div class="card-body">
                      <div class="form-group row">
                          <label  class="col-sm-4 control-label">Nomor Proposal </label>
                          <div class="col-sm-8">
                          <input type="input" name="nomorproposal" class="form-control"  value="{{ $lpj->nomorproposal }}"readonly >
                        </div>
                        <p class="text-danger">{{ $errors->first('nomorproposal') }}</p> 
                      </div>
                      <div class="form-group row" >
                        <label class="col-sm-4 control-label">Kegiatan sudah Terlaksana? </label>
                        <div class="col-sm-2">
                              <input type="radio" onclick="Check('PU');"  name="terlaksana" id="yes"  value="Ya" {{ $lpj->terlaksana == 'Ya' ? 'checked':''}}> YA <br>
                          </div>    
                          <div class="col-sm-2">
                              <input type="radio" onclick="Check('PU');" name="terlaksana" id="no" value="Tidak" {{ $lpj->terlaksana == 'Tidak' ? 'checked':''}}> TIDAK <br>
                          </div>
                          <div class="col-sm-2">
                          </div>
                          <div class="col-sm-2"></div>
                        <p class="text-danger">{{ $errors->first('terlaksana') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Jumlah Peserta Kegiatan </label>
                        <div class="col-sm-8">
                          <input type="input" name="jumlahpeserta" id="jumlahpeserta" class="form-control"  placeholder="jumlah perserta" value="{{ $lpj->jumlahperserta_kegiatan }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('jumlahperserta_kegiatan') }}</p>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Link / Url Berita Kegiatan *</label>
                        <div class="col-sm-8">
                          <input type="url" name="url" id="url" class="form-control" value="{{ $lpj->url }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('url') }}</p>
                      </div>  
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">File dokumentasi  <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_dokumentasi" id="dokumentasi"></input>
                            @if (!empty($lpj->file_dokumentasi)) 
                            <br>
                                        <button type="button" class="btn btn-warning" style="margin-top: 5px;margin-bottom: 15px"><a href="{{ asset('storage/uploads/Dokumentasi/'. $lpj->file_dokumentasi) }}">download</a></button>
                            @endif
                          </div>
                        </div>
                        <p class="text-danger">{{ $errors->first('file_dokumentasi') }}</p>
                      </div> 
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Reportase * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="reportase" id="reportase"></input>
                            @if (!empty($lpj->file_reportase)) 
                            <br>
                                        <button type="button" class="btn btn-warning" style="margin-top: 5px;margin-bottom: 15px"><a href="{{ asset('storage/uploads/Reportase/'. $lpj->file_reportase) }}">download</a></button>
                            @endif
                          </div>
                        </div>
                         <p class="text-danger">{{ $errors->first('reportase') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">File LPJ * <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_lpj" id="lpj"></input>
                            @if (!empty($lpj->file_lpj)) 
                            <br>
                                        <button type="button" class="btn btn-warning" style="margin-top: 5px;margin-bottom: 15px"><a href="{{ asset('storage/uploads/LPJ/'. $lpj->file_LPJ) }}">download</a></button>
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
              @endif

              <!-- / JENIS PROPOSAL LOMBA-->
              @if (substr($lpj->nomorproposal,0,2) == 'PL')
              <form role="form" class="form-horizontal" files="true" action="{{ route('lpj.update',$lpj->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                    <div class="card-body">
                      <div class="form-group row">
                          <label  class="col-sm-4 control-label">Nomor Proposal </label>
                          <div class="col-sm-8">
                          <input type="input" name="nomorproposal" class="form-control"  value="{{ $lpj->nomorproposal }}"readonly >
                        </div>
                        <p class="text-danger">{{ $errors->first('nomorproposal') }}</p> 
                      </div>
                      <div class="form-group row" >
                        <label class="col-sm-4 control-label">Kegiatan sudah Terlaksana? </label>
                        <div class="col-sm-2">
                              <input type="radio"  name="terlaksana" onclick="Check('PL');" id="yes" value="Ya" {{ $lpj->terlaksana == 'Ya' ? 'checked':''}}> YA <br>
                          </div>    
                          <div class="col-sm-2">
                              <input type="radio"  name="terlaksana" onclick="Check('PL');" id="no" value="Tidak" {{ $lpj->terlaksana == 'Tidak' ? 'checked':''}}> TIDAK <br>
                          </div>
                          <div class="col-sm-2">
                          </div>
                          <div class="col-sm-2"></div>
                        <p class="text-danger">{{ $errors->first('terlaksana') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Jumlah Negara Peserta Kegiatan </label>
                        <div class="col-sm-8">
                          <input type="number" name="jmlnegara_peserta_lomba" id="negarapst" class="form-control"  placeholder="jumlah perserta" value="{{ $lpj->jmlnegara_peserta_lomba }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('jmlnegara_peserta_lomba') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Jumlah Perguruan Tinggi Peserta Kegiatan</label>
                        <div class="col-sm-8">
                          <input type="number" name="jmluniv_peserta_lomba" id="univpst" class="form-control"  placeholder="jumlah perserta" value="{{ $lpj->jmluniv_peserta_lomba }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('jmluniv_peserta_lomba') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Jumlah Mahasiswa Peserta Kegiatan</label>
                        <div class="col-sm-8">
                          <input type="number" name="jmlmahasiswa_peserta_lomba" id="mhspst" class="form-control"  placeholder="jumlah perserta" value="{{ $lpj->jmlmahasiswa_peserta_lomba }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('jmlmahasiswa_peserta_lomba') }}</p>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 control-label">Link / Url Berita Kegiatan </label>
                        <div class="col-sm-8">
                          <input type="url" name="url" id="url" class="form-control" value="{{ $lpj->url }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('url') }}</p>
                      </div>  
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">File dokumentasi  <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_dokumentasi" id="dokumentasi"></input>
                            @if (!empty($lpj->file_dokumentasi)) 
                            <br>
                                        <button type="button" class="btn btn-warning" style="margin-top: 5px;margin-bottom: 15px"><a href="{{ asset('storage/uploads/Dokumentasi/'. $lpj->file_dokumentasi) }}">download</a></button>
                            @endif
                          </div>
                        </div>
                        <p class="text-danger">{{ $errors->first('file_dokumentasi') }}</p>
                      </div> 
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">File Daftar Pemenang Kegiatan  <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_daftar_pemenang" id="pemenang"></input>
                            @if (!empty($lpj->file_daftar_pemenang)) 
                            <br>
                                        <button type="button" class="btn btn-warning" style="margin-top: 5px;margin-bottom: 15px"><a href="{{ asset('storage/uploads/Dokumentasi/'. $lpj->file_daftar_pemenang) }}">download</a></button>
                            @endif
                          </div>
                        </div>
                        <p class="text-danger">{{ $errors->first('file_daftar_pemenang') }}</p>
                      </div> 
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">Reportase  <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="reportase" id="reportase"></input>
                            @if (!empty($lpj->file_reportase)) 
                            <br>
                                        <button type="button" class="btn btn-warning" style="margin-top: 5px;margin-bottom: 15px"><a href="{{ asset('storage/uploads/Reportase/'. $lpj->file_reportase) }}">download</a></button>
                            @endif
                          </div>
                        </div>
                         <p class="text-danger">{{ $errors->first('reportase') }}</p>
                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-4 control-label">File LPJ  <sup class="label label-success">(.pdf max 2mb)</sup></label>
                        <div class="col-sm-8">
                          <div class="custom-file">
                            <input type="file" name="file_lpj" id="lpj"></input>
                            @if (!empty($lpj->file_lpj)) 
                            <br>
                                        <button type="button" class="btn btn-warning" style="margin-top: 5px;margin-bottom: 15px"><a href="{{ asset('storage/uploads/LPJ/'. $lpj->file_LPJ) }}">download</a></button>
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
              @endif
      </div>
      
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
function Check(PL) {
    if (document.getElementById('yes').checked) {
        
        document.getElementById('url').disabled = false;
        document.getElementById('dokumentasi').disabled = false;
        document.getElementById('reportase').disabled = false;
        document.getElementById('negarapst').disabled = false;
        document.getElementById('univpst').disabled = false;
        document.getElementById('mhspst').disabled = false;
        document.getElementById('lpj').disabled = false;
        document.getElementById('pemenang').disabled = false;
    } 
    else if (document.getElementById('no').checked) {
        
        document.getElementById('url').disabled = true;
        document.getElementById('dokumentasi').disabled = true;
        document.getElementById('reportase').disabled = true;
        document.getElementById('negarapst').disabled = true;
        document.getElementById('univpst').disabled = true;
        document.getElementById('mhspst').disabled = true;
        document.getElementById('lpj').disabled = true;
        document.getElementById('pemenang').disabled = true;
   }
}

function Check(PU) {
    if (document.getElementById('yes').checked) {
        
        document.getElementById('jumlahpeserta').disabled = false;
        document.getElementById('url').disabled = false;
        document.getElementById('dokumentasi').disabled = false;
        document.getElementById('reportase').disabled = false;
        document.getElementById('lpj').disabled = false;
    } 
    else if (document.getElementById('no').checked) {
        document.getElementById('jumlahpeserta').disabled = true;
        document.getElementById('url').disabled = true;
        document.getElementById('dokumentasi').disabled = true;
        document.getElementById('reportase').disabled = true;
        document.getElementById('lpj').disabled = true;
   }
}
</script>
@endsection

  