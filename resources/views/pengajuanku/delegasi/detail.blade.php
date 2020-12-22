@extends('layouts.master')

@section('title')
    <title>Manajemen Kategori</title>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ back() }}">Proposal</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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
				                      <td>Bentuk Kegiatan</td>
				                      <td align="left">:</td>
				                      <td>{{ $data->bentuk_kegiatan }}</td>
				                    </tr>
				                    <tr>
				                      <td>Tanggal mulai</td>
				                      <td align="left">:</td>
				                      <td>{{ $data->tglmulai }}</td>
				                    </tr>
				                    <tr>
				                      <td>Tanggal selesai</td>
				                      <td align="left">:</td>
				                      <td>{{ $data->tglselesai }}</td>
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
				                      <td>Sumber Dana</td>
				                      <td align="left">:</td>
				                      @if ($data->sumberdana == 1)
				                      <td>Fakultas</td>
				                      @endif
				                      @if ($data->sumberdana == 2)
				                      <td>Departemen</td>
				                      @endif
				                    </tr>
				                    <tr>
				                      <td>Dana Diajukan</td>
				                      <td align="left">:</td>
				                      <td>Rp. {{number_format($data->ajuandana,0,",",".") }}</td>
				                    </tr>
				                    <tr>
				                      <td>Dana disetujui</td>
				                      <td align="left">:</td>
				                      @if (empty($data->danadisetujui))
				                      <td><a style="background-color:red;"> Belum disetujui</a></td>
				                      @else 
				                      <td> {{number_format($data->danadisetujui,0,",",".") }} </td>
				                      @endif
				                    </tr>
				                    <tr>
				                      <td>File Surat Undangan</td>
				                      <td align="left">:</td>
				                      <td><a href="{{ asset('storage/uploads/SuratUndangan/'. $data->file_surat_undangan) }}">Surat Undangan.pdf</a></td>
				                    </tr>
				                    <tr>
				                      <td>File Proposal</td>
				                      <td align="left">:</td>
				                      <td><a href="{{ asset('storage/uploads/Proposal/'. $data->file_proposal) }}">Proposal.pdf</a></td>
				                    </tr>
				                    <tr>
				                      <td>Form LPJ</td>
				                      <td align="left">:</td>
				                      <td>testing</td>
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
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="status">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">status iki</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
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

  