@extends('layouts.master')

@section('title')
    <title>Detail Proposal Delegasi</title>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-interaction/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-daygrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-timegrid/main.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-bootstrap/main.min.css') }}">
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Proposal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ redirect()->back() }}">Delegasi</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
        <hr>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-left: 20px;margin-right: 10px">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                
              @if (!empty($ketua))
                <h3 class="profile-username text-center">{{ $ketua[0]->Nama }}</h3>

                <p class="text-muted text-center">Ketua Proposal</p>

                <ul class="list-group list-group-unbordered mb-4">
                  <li class="list-group-item">
                    <b>NIM</b> <a class="float-right">{{ $ketua[0]->NIM }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Departemen</b> <a class="float-right">{{ $ketua[0]->nama_departemen }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Jabatan</b> <a class="float-right">{{ $ketua[0]->jabatan }}</a>
                  </li>
                </ul>
                @endif
               @if(empty($ketua)) 
               <h3 class="profile-username text-center"></h3>

                <p class="text-muted text-center">Ketua Proposal</p>

                <ul class="list-group list-group-unbordered mb-4">
                  <li class="list-group-item">
                    <b>NIM</b> <a class="float-right" style="background-color: red">Tidak ada</a>
                  </li>
                  <li class="list-group-item">
                    <b>Departemen</b> <a class="float-right"style="background-color: red">Tidak ada</a>
                  </li>
                  <li class="list-group-item">
                    <b>Jabatan</b> <a class="float-right"style="background-color: red">Tidak ada</a>
                  </li>
                </ul>
               @endif
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#detail" data-toggle="tab">Detail Proposal</a></li>
                  <li class="nav-item"><a class="nav-link" href="#anggota" data-toggle="tab">Anggota</a></li>
                  <li class="nav-item"><a class="nav-link" href="#lpj" data-toggle="tab">LPJ</a></li>
                  <li class="nav-item"><a class="nav-link" href="#status" data-toggle="tab">Status</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="detail">
                      <!-- Detail -->
                      <div class="row">
    				          <div class="col-12">
    				            <div class="card card-primary ">
    				              <div class="card-header">
    				                <h3 class="card-title">Detail proposal</h3>

    				                <div class="card-tools">
    				                  
    				                </div>
    				              </div>
    				              <!-- /.card-header -->
    				              <div class="card-body table-responsive p-0">
    				                <table class="table table-hover" border=1 bordercolor="#007bff">
    				                  <thead>
    				                    
    				                  </thead>
    				                  <tbody>
                               <tr>
                                  <td width=" 300px">Nomor Proposal</td>
                                  <td align="left" width=" 30px">:</td>
                                  <td>{{ $data->nomor_proposal }}</td>
                                </tr>
    				                 	 <tr>
    				                      <td width=" 300px">Jenis Proposal</td>
    				                      <td align="left" width=" 30px">:</td>
    				                      <td>{{ $data->jenis_proposal }}</td>
    				                    </tr>
    				                    <tr>
    				                      <td width=" 300px">Nama Kegiatan</td>
    				                      <td align="left" width=" 30px">:</td>
    				                      <td>{{ $data->nama_kegiatan }}</td>
    				                    </tr>
                                <tr>
                                  <td>Jenis Kegiatan</td>
                                  <td align="left">:</td>
                                  <td>{{ $data->jenis_kegiatan }}</td>
                                </tr>
                                @if ($data->jenis_kegiatan == 'nonlomba')
                                <tr>
                                  <td>Jenis Rekognisi</td>
                                  <td align="left">:</td>
                                  <td>{{ $data->jenis_rekognisi }}</td>
                                </tr>
                                @endif
    				                    <tr>
    				                      <td>Bentuk Kegiatan</td>
    				                      <td align="left">:</td>
    				                      <td>{{ $data->bentuk_kegiatan }}</td>
    				                    </tr>
                                <tr>
                                  <td>Lokasi Kegiatan</td>
                                  <td align="left">:</td>
                                  <td>{{ $data->lokasi_kegiatan }}</td>
                                </tr>
    				                    <tr>
    				                      <td>Tanggal mulai</td>
    				                      <td align="left">:</td>
    				                      <td>{{ Tanggal::indo($data->tglmulai) }}</td>
    				                    </tr>
    				                    <tr>
    				                      <td>Tanggal selesai</td>
    				                      <td align="left">:</td>
    				                      <td>{{ Tanggal::indo($data->tglselesai) }}</td>
    				                    </tr>
    				                    <tr>
    				                      <td>Tingkat</td>
    				                      <td align="left">:</td>
    				                      <td>{{ $data->tingkat }}</td>
    				                    </tr>
    				                    <tr>
    				                      <td>Url / Link kegiatan</td>
    				                      <td align="left">:</td>
    				                      <td> <a href="{{ $data->url }}">{{ $data->url }}</a></td>
    				                    </tr>
                                <tr>
                                  <td>No. HP</td>
                                  <td align="left">:</td>
                                  <td>{{ isset($data->nohp) ? $data->nohp:'-'  }}</td>
                                </tr>
    				                    <tr>
    				                      <td>Sumber Dana</td>
    				                      <td align="left">:</td>
    				                      @if ($data->sumberdana == 1)
    				                      <td>Fakultas</td>
    				                      @endif
    				                      @if ($data->sumberdana == 2)
    				                      <td>Departemen</td>
    				                      @endif
    				                    </tr>
                                @if ($data->sumberdana == 2)
                                <tr>
                                  <td>Departemen</td>
                                  <td align="left">:</td>
                                  <td>
                                    @php 
                                          foreach ($departemen as $dept) {
                                          if($dept->id == $data->departemen ) {echo e($dept->nama_departemen);}
                                          }
                                    @endphp
                                  </td>
                                </tr>
                                @endif
    				                    <tr>
    				                      <td>Dana Diajukan</td>
    				                      <td align="left">:</td>
    				                      <td>Rp. {{number_format($data->ajuandana,0,",",".") }}</td>
    				                    </tr>
    				                    <tr>
    				                      <td>Dana disetujui</td>
    				                      <td align="left">:</td>
    				                      @if (!isset($data->danadisetujui))
    				                      <td><a style="background-color:red;"> Belum disetujui</a></td>
    				                      @else 
    				                      <td>Rp. {{number_format($data->danadisetujui,0,",",".") }}</td>
    				                      @endif
    				                    </tr>
    				                    <tr>
    				                      <td>File Surat Undangan</td>
    				                      <td align="left">:</td>
    				                      <td><a href="{{ asset('storage/uploads/SuratUndangan/'. $data->file_surat_undangan) }}" target="_blank">{{$data->file_surat_undangan}}</a></td>
    				                    </tr>
    				                    <tr>
    				                      <td>File Proposal</td>
    				                      <td align="left">:</td>
    				                      <td><a href="{{ asset('storage/uploads/Proposal/'. $data->file_proposal) }}" target="_blank">{{$data->file_proposal}}</a></td>
    				                    </tr>
    				                    <tr>
    				                      <td>Form Lembar Pengesahan</td>
    				                      <td align="left">:</td>
                                  @if ($data->status == 1)
    				                      <td><a href="{{route('cetak', encrypt($data->id))}}" target="_blank">download lembar pengesahan</a></td>
                                  @endif
                                  @if ($data->status == 0)
                                  <td>-</td>
                                  @endif
    				                    </tr>
                                <tr>
                                  <td>Form Surat Tugas</td>
                                  <td align="left">:</td>
                                  @if ($data->status == 1)
                                  <td><a href="{{route('cetak.st', encrypt($data->id))}}" target="_blank">download surat tugas</a></td>
                                  @endif
                                  @if ($data->status == 0)
                                  <td>-</td>
                                  @endif
                                </tr>
    				                  </tbody>
    				                </table>
    				              </div>
    				              <!-- /.card-body -->
    				            </div>
    				            <!-- /.card -->
    				          </div>
    				          </div>
                    <!-- /.Detail -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="anggota">
                    <!-- The timeline -->
                    <div class="row">
				          <div class="col-12">
				            <div class="card">
				              
				              <!-- /.card-header -->
				              <div class="card-body table-responsive p-0">
				                <table class="table table-hover">
				                  <thead>
				                    <tr>
				                      <th>NIM</th>
				                      <th>Nama</th>
				                      <th>Departemen</th>
				                      <th>Jabatan</th>
				                    </tr>
				                  </thead>
				                  <tbody>
				                   @forelse ($anggota as $rew => $row)
				                    <tr>
				                      <td>{{$row->NIM}}</td>
				                      <td>{{$row->Nama}}</td>
				                      <td>{{$row->nama_departemen}}</td>
				                      <td>{{$row->jabatan}}</td>
				                      
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
        <!-- /.timeline -->
                  </div>
                  <!-- /.tab-pane -->

                
                  <div class="tab-pane" id="lpj">
                      <!-- Detail -->
                      <div class="row">
                      <div class="col-12">
                        <div class="card card-warning ">
                          <div class="card-header">
                            <h3 class="card-title">Detail LPJ</h3>

                            <div class="card-tools">
                              
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover" border=1 bordercolor="#ffc107">
                              <thead>
                                
                              </thead>
                              <tbody>
                               <tr>
                                  <td width=" 300px">Nomor Proposal</td>
                                  <td align="left" width=" 30px">:</td>
                                  @if (isset($lpj->nomorproposal))
                                  <td>{{ $lpj->nomorproposal }}</td>
                                  @endif
                                  @if (!isset($lpj->nomorproposal))
                                  <td> - </td>
                                  @endif
                                </tr>
                                <tr>
                                  <td width=" 300px">Kegiatan sudah terlaksana?</td>
                                  <td align="left" width=" 30px">:</td>
                                  
                                  @if (isset($lpj->terlaksana))
                                  <td>{{ $lpj->terlaksana }}</td>
                                  @endif
                                  @if (!isset($lpj->terlaksana))
                                  <td> - </td>
                                  @endif
                                  
                                </tr>
                                <tr>
                                  <td>Capaian</td>
                                  <td align="left">:</td>
                                  
                                  @if (isset($lpj->capaian))
                                  <td>{{ $lpj->capaian }}</td>
                                  @endif
                                  @if (!isset($lpj->capaian))
                                  <td> - </td>
                                  @endif
                                </tr>
                                <tr>
                                  <td>Catatan Capaian</td>
                                  <td align="left">:</td>
                                  
                                  @if (isset($lpj->catatancapaian))
                                  <td>{{ $lpj->catatancapaian }}</td>
                                  @endif
                                  @if (!isset($lpj->catatancapaian))
                                  <td> - </td>
                                  @endif
                                </tr>
                                <tr>
                                  <td>Url / Link kegiatan</td>
                                  <td align="left">:</td>
                                  
                                  @if (isset($lpj->url))
                                  <td> <a href="{{ $data->url }}">{{ $data->url }}</a></td>
                                  @endif
                                  @if (!isset($lpj->url))
                                  <td> - </td>
                                  @endif
                                </tr>
                                <tr>
                                  <td>File Dokumentasi</td>
                                  <td align="left">:</td>
                                  @if (isset($lpj->file_dokumentasi))
                                  <td><a href="{{ asset('storage/uploads/Dokumentasi/'. $lpj->file_dokumentasi) }}" target="_blank">{{$lpj->file_dokumentasi}}</a></td>
                                  @endif
                                  @if (!isset($lpj->file_dokumentasi))
                                  <td> - </td>
                                  @endif
                                  
                                </tr>
                                <tr>
                                  <td>File Surat Tugas</td>
                                  <td align="left">:</td>
                                  @if (isset($lpj->file_surat_tugas))
                                  <td><a href="{{ asset('storage/uploads/SuratTugas/'. $lpj->file_surat_tugas) }}" target="_blank">{{$lpj->file_surat_tugas}}</a></td>
                                  @endif
                                  @if (!isset($lpj->file_surat_tugas))
                                  <td> - </td>
                                  @endif
                                  
                                </tr>
                                <tr>
                                  <td>File Sertifikat</td>
                                  <td align="left">:</td>
                                  @if (isset($lpj->file_sertifikat))
                                  <td><a href="{{ asset('storage/uploads/Sertifikat/'. $lpj->file_sertifikat) }}" target="_blank">{{$lpj->file_sertifikat}}</a></td>
                                  @endif
                                  @if (!isset($lpj->file_sertifikat))
                                  <td> - </td>
                                  @endif
                                  
                                </tr>
                                <tr>
                                  <td>File Reportase</td>
                                  <td align="left">:</td>
                                  @if (isset($lpj->file_reportase))
                                 <td><a href="{{ asset('storage/uploads/Reportase/'. $lpj->file_reportase) }}" target="_blank">{{$lpj->file_reportase}}</a></td>
                                  @endif
                                  @if (!isset($lpj->file_reportase))
                                  <td> - </td>
                                  @endif
                                  
                                </tr>
                                <tr>
                                  <td>File LPJ</td>
                                  <td align="left">:</td>
                                  @if (isset($lpj->file_lpj))
                                  <td><a href="{{ asset('storage/uploads/LPJ/'. $lpj->file_lpj) }}" target="_blank">{{$lpj->file_lpj}}</a></td>
                                  @endif
                                  @if (!isset($lpj->file_lpj))
                                  <td> - </td>
                                  @endif
                                  
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      </div>
                    <!-- /.Detail -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="status">
                    @if($status->proposaldiajukan == true && $status->proposaldisetujui == 0 && $status->berkaslengkap == false && $status->danacair == false)
                      <table style="width:80%">
                        <tr>
                          <td bgcolor="#ff8c00" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>1</a></td>
                          <td width="300">Proposal Diajukan</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#3d9970" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>2</a></td>
                          <td>Proposal Disetujui</td>
                          <td align="center">-</td>
                        </tr>
                        <tr>
                          <td bgcolor="#17a2b8" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>3</a></td>
                          <td>Berkas LPJ Lengkap</td>
                          <td align="center">-</td>
                        </tr>
                        <tr>
                          <td bgcolor="#dc3545" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>4</a></td>
                          <td>LPJ disetujui</td>
                          <td align="center">-</td>
                        </tr>
                      </table>
                    @endif 
                    @if($status->proposaldiajukan == true && $status->proposaldisetujui == 1 && $status->berkaslengkap == false && $status->danacair == false)
                      <table style="width:80%">
                        <tr>
                          <td bgcolor="#ff8c00" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>1</a></td>
                          <td width="300">Proposal Diajukan</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#3d9970" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>2</a></td>
                          <td>Proposal Disetujui</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#17a2b8" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>3</a></td>
                          <td>Berkas LPJ Lengkap</td>
                          <td align="center">-</td>
                        </tr>
                        <tr>
                          <td bgcolor="#dc3545" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>4</a></td>
                          <td>LPJ disetujui</td>
                          <td align="center">-</td>
                        </tr>
                      </table>
                    @endif  
                    @if($status->proposaldiajukan == true && $status->proposaldisetujui == 1 && $status->berkaslengkap == true && $status->danacair == false)
                      <table style="width:80%">
                        <tr>
                          <td bgcolor="#ff8c00" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>1</a></td>
                          <td width="300">Proposal Diajukan</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#3d9970" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>2</a></td>
                          <td>Proposal Disetujui</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#17a2b8" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>3</a></td>
                          <td>Berkas LPJ Lengkap</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#dc3545" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>4</a></td>
                          <td>LPJ disetujui</td>
                          <td align="center">-</td>
                        </tr>
                      </table>
                    @endif  
                    @if($status->proposaldiajukan == true && $status->proposaldisetujui == 1 && $status->berkaslengkap == true && $status->danacair == true)
                      <table style="width:80%" >
                        <tr>
                          <td bgcolor="#ff8c00" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>1</a></td>
                          <td width="300">Proposal Diajukan</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#3d9970" style="border-radius: 50%;text-align: center;margin: 20;cellpadding:2" height="35" width="35"><a>2</a></td>
                          <td>Proposal Disetujui</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#17a2b8" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>3</a></td>
                          <td>Berkas LPJ Lengkap</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                          <td bgcolor="#dc3545" style="border-radius: 50%;text-align: center;" height="35" width="35"><a>4</a></td>
                          <td>LPJ disetujui</td>
                          <td align="center"><i class="nav-icon far fa-check-circle" style="color: green" aria-hidden="true"></i></td>
                        </tr>
                      </table>
                    @endif 
                    @if($data->status == 2)
                      <p ><font size="4" style="background-color: red"> Proposal ditolak </font></p>
                    @endif
                    @if($data->status == 1 && $lpj->status == 2)
                      <p ><font size="4" style="background-color: red"> LPJ ditolak </font></p>
                    @endif
                    @if($data->status == 1 && $lpj->status == 3)
                      <p ><font size="4" style="background-color: red"> LPJ tidak terlaksana </font></p>
                    @endif
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

  