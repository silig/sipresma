@extends('layouts.master')

@section('title')
    <title>Laporan</title>
    
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

    <!-- Main content -->
	    <section class="content " style="margin-left: 15px;margin-right: 15px">
		    <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#dana" data-toggle="tab">Dana</a></li>
                  <li class="nav-item"><a class="nav-link" href="#proposal" data-toggle="tab">Proposal</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="dana">
                    	<div class="row">
    				          <div class="col-12">
    				            <div class="card card-primary ">
    				              <div class="card-header">
    				                <h3 class="card-title">Rincian Dana {{ $data->dana }} Tahun {{$data->tahun}}</h3>

    				                <div class="card-tools">
    				                  
    				                </div>
    				              </div>
    				              <!-- /.card-header -->
    				              <div class="card-body table-responsive p-0">
    				                <table class="table table-hover" border="1" bordercolor="#007bff">
    				                  <thead>
    				                    
    				                  </thead>
    				                  <tbody>
		                                <tr>
		                                  <td width=" 300px">Jumlah Dana Tahun {{$data->tahun}}</td>
		                                  <td align="left" width=" 30px">:</td>
		                                  <td>Rp. {{ number_format($data->jumlahdana,0,",",".") }}</td>
		                                </tr>
    				                 	<tr>
    				                      <td width=" 300px">Alokasi Dana Delegasi Lomba</td>
    				                      <td align="left" width=" 30px">:</td>
    				                     <td>Rp. {{ number_format($data->danadl,0,",",".") }}</td>
    				                    </tr>
    				                            <tr>
                                          <td width=" 300px">Alokasi Dana Delegasi Non Lomba</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danadn,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                          <td width=" 300px">Alokasi Dana Penyelenggara Lomba</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danapo,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                          <td width=" 300px">Alokasi Dana Penyelenggara Softskill</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danaps,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                          <td width=" 300px">Alokasi Dana Penyelenggara Lainnya</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danapu,0,",",".") }}</td>
                                        </tr>
                                    <tr>
                                      <td>Dana Belum Teralokasikan</td>
                                      <td align="left">:</td>
                                      <td>Rp. {{ number_format($data->blmdialokasi,0,",",".") }}</td>
                                    </tr>
		                                <tr>
		                                  <td>Jumlah Penggunaan Dana</td>
		                                  <td align="left">:</td>
		                                  <td>Rp. {{ number_format($data->jumlahterpakai,0,",",".") }}</td>
		                                </tr>
		                                <tr>
		                                  <td>Sisa Dana</td>
		                                  <td align="left">:</td>
		                                  <td>Rp. {{ number_format($data->sisa,0,",",".") }}</td>
		                                </tr>
    				                  </tbody>
    				                </table>
    				              </div>
    				              <!-- /.card-body -->
    				            </div>
    				            <!-- /.card -->
    				          </div>
    				    </div>

                        <!-- Delegasi Lomba -->
    				    <div class="row">
    				          <div class="col-12">
    				            <div class="card card-primary ">
    				              <div class="card-header">
    				                <h3 class="card-title">Rincian Dana Delegasi Lomba</h3>

    				                <div class="card-tools">
    				                  
    				                </div>
    				              </div>
    				              <!-- /.card-header -->
    				              <div class="card-body table-responsive p-0">
    				                <table class="table table-hover" border="1" bordercolor="#007bff">
    				                  <thead>
    				                    
    				                  </thead>
    				                  <tbody>
		                                <tr>
		                                  <td width=" 300px">Anggaran Dana</td>
		                                  <td align="left" width=" 30px">:</td>
		                                 <td>Rp. {{ number_format($data->danadl,0,",",".") }}</td>
		                                </tr>
    				                 	 <tr>
    				                      <td width=" 300px">Jumlah Penggunaan dana</td>
    				                      <td align="left" width=" 30px">:</td>
    				                       <td>Rp. {{ number_format($data->jumlahdl,0,",",".") }}</td>
    				                    </tr>
    				                    <tr>
    				                      <td width=" 300px">Sisa Dana</td>
    				                      <td align="left" width=" 30px">:</td>
    				                       <td>Rp. {{ number_format($data->sisadl,0,",",".") }}</td>
    				                    </tr>
    				                  </tbody>
    				                </table>
    				              </div>
    				              <!-- /.card-body -->
    				            </div>
    				            <!-- /.card -->
    				          </div>
    				    </div>
                        <!-- Delegasi Lomba -->

    				    <!-- Delegasi Non Lomba -->
                        <div class="row">
                              <div class="col-12">
                                <div class="card card-primary ">
                                  <div class="card-header">
                                    <h3 class="card-title">Rincian Dana Delegasi Non Lomba</h3>

                                    <div class="card-tools">
                                      
                                    </div>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body table-responsive p-0">
                                    <table class="table table-hover" border="1" bordercolor="#007bff">
                                      <thead>
                                        
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td width=" 300px">Anggaran Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danadn,0,",",".") }}</td>
                                        </tr>
                                         <tr>
                                          <td width=" 300px">Jumlah Penggunaan dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->jumlahdn,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                          <td width=" 300px">Sisa Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->sisadn,0,",",".") }}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                        </div>
                        <!-- Delegasi Non Lomba -->

                        <!-- Ormawa -->
                        <div class="row">
                              <div class="col-12">
                                <div class="card card-primary ">
                                  <div class="card-header">
                                    <h3 class="card-title">Rincian Dana Penyelenggara Lomba</h3>

                                    <div class="card-tools">
                                      
                                    </div>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body table-responsive p-0">
                                    <table class="table table-hover" border="1" bordercolor="#007bff">
                                      <thead>
                                        
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td width=" 300px">Anggaran Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danapo,0,",",".") }}</td>
                                        </tr>
                                         <tr>
                                          <td width=" 300px">Jumlah Penggunaan dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->jumlahpo,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                          <td width=" 300px">Sisa Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->sisapo,0,",",".") }}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                        </div>
                        <!-- End Ormawa -->

                        <!-- Softskill -->
                        <div class="row">
                              <div class="col-12">
                                <div class="card card-primary ">
                                  <div class="card-header">
                                    <h3 class="card-title">Rincian Dana Penyelenggara Softskill</h3>

                                    <div class="card-tools">
                                      
                                    </div>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body table-responsive p-0">
                                    <table class="table table-hover" border="1" bordercolor="#007bff">
                                      <thead>
                                        
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td width=" 300px">Anggaran Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danaps,0,",",".") }}</td>
                                        </tr>
                                         <tr>
                                          <td width=" 300px">Jumlah Penggunaan dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->jumlahps,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                          <td width=" 300px">Sisa Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->sisaps,0,",",".") }}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                        </div>
                        <!-- End softSkill -->

                        <!-- UKM -->
                        <div class="row">
                              <div class="col-12">
                                <div class="card card-primary ">
                                  <div class="card-header">
                                    <h3 class="card-title">Rincian Dana Penyelenggara Lainnya</h3>

                                    <div class="card-tools">
                                      
                                    </div>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body table-responsive p-0">
                                    <table class="table table-hover" border="1" bordercolor="#007bff">
                                      <thead>
                                        
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td width=" 300px">Anggaran Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                         <td>Rp. {{ number_format($data->danapu,0,",",".") }}</td>
                                        </tr>
                                         <tr>
                                          <td width=" 300px">Jumlah Penggunaan dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->jumlahpu,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                          <td width=" 300px">Sisa Dana</td>
                                          <td align="left" width=" 30px">:</td>
                                           <td>Rp. {{ number_format($data->sisapu,0,",",".") }}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                        </div>
                        <!-- End UKM -->
                  </div>

                  <!-- Daftar Proposal -->
                  <div class="tab-pane" id="proposal">
                    <div class="row">
    				          <div class="col-12">
    				            <div class="card card-primary ">
    				              <div class="card-header">
    				                <h3 class="card-title">Daftar Proposal {{ $data->dana }} Tahun {{$data->tahun}}</h3>

    				                <div class="card-tools">
    				                  
    				                </div>
    				              </div>
    				              <!-- /.card-header -->
    				              <div class="card-body table-responsive p-0">
    				                <table class="table table-hover" border="1" bordercolor="#007bff">
    				                  <thead>
    				                    	<tr>

                                    <th style="text-align: center;">No</th>
    				                    		<th style="text-align: center;">Proposal</th>
    				                    		<th style="text-align: center;">Anggota</th>
    				                    		<th style="text-align: center;">LPJ</th>
    				                    	</tr>
    				                  </thead>
    				                  <tbody>
                              @php
                              $ni=1
                              @endphp
    				                  @forelse($proposal as $cilupba => $row)
		                                <tr>
                                      <td>{{$ni++}}</td>
		                                  <td width="33%">
		                                  <b>	Nomor Proposal&nbsp;&nbsp;&nbsp;: </b> {{$row->nomor_proposal}}<br/> 
		                                  <b>	Nama Kegiatan &emsp;: </b> {{$row->nama_kegiatan}}<br/>
		                                  <b>	Tgl Mulai&emsp;&emsp;&emsp;&emsp;: </b> {{Tanggal::indo($row->tglmulai)}}<br/>
                                      <b> Tgl Selesai &emsp;&emsp;&emsp;: </b> {{Tanggal::indo($row->tglselesai)}}<br/> 
		                                  	<b>	Dana Disetujui&emsp;&nbsp;&nbsp;: </b> {{$row->danadisetujui}}<br/>

		                                  	<b>	Berkas Proposal&nbsp;&nbsp;: </b> <a href="{{ asset('storage/uploads/Proposal/'. $row->file_proposal) }}">{{$row->file_proposal}}</a><br>
		                                  </td>
		                                  <td width="33%">
		                                  		@php
		                                  			$anggota= DB::select(DB::raw
                   									("SELECT a.id,NIM, Nama, jabatan, nama_departemen, id_proposal FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal= $row->id 
                   									order by jabatan desc" ));

                   									$no = 1;
		                                  		@endphp
		                                  		@foreach($anggota as $comel => $ngah)
		                                  		  
		                                  		{{$no++}}. {{ucwords($ngah->Nama)}} - {{ucfirst($ngah->NIM)}} ({{ucfirst($ngah->jabatan)}})<br>
		                                  		@endforeach
		                                  		
		                                  </td>
		                                  <td width="33%">
		                                  	<b>	Terlaksana	 	: </b> {{$row->terlaksana}}<br>
		                                  	<b>	Capaian    		: </b> {{$row->capaian}}<br>
		                                  	<b>	Berkas Reportase : </b> <a href="{{ asset('storage/uploads/Reportase/'. $row->file_reportase) }}">{{$row->file_reportase}}</a><br>
		                                  	<b>	Berkas LPJ	: </b> <a href="{{ asset('storage/uploads/LPJ/'. $row->file_lpj) }}">{{$row->file_lpj}}</a><br>
                                        <b> Berkas Dokumentasi  : </b> <a href="{{ asset('storage/uploads/Dokumentasi/'. $row->file_dokumentasi) }}">{{$row->file_dokumentasi}}</a><br>
                                        <b> Berkas Surat Tugas  : </b> <a href="{{ asset('storage/uploads/SuratTugas/'. $row->file_surat_tugas) }}">{{$row->file_surat_tugas}}</a><br>
		                                  </td>
		                                </tr>
		                                	@empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
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
                  <!-- End Daftar Proposal -->

                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>

	    </section>
    <!-- /.content -->
 
  </div>
@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection

