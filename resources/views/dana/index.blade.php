@extends('layouts.master')

@section('title')
    <title>Manajemen dana</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid" >
                <div class="row mb-2" style="margin-left: 20px">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Dana</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dana</li>
                        </ol>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8" style="margin-left: 200px">
                        <div class="card">
                          <div class="card-header">
                            <a href="#"  data-toggle="modal" data-target="#modalAdd"
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
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
​
                            <table class="table table-bordered">
                              <thead>                  
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Tahun</th>
                                  <th>Departemen</th>
                                  <th>Jumlah Dana</th>
                                  <th width="250">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @php $no = 1; @endphp
                              @forelse ($dana as $row)
                                <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $row->tahun}}</td>
                                  <td>{{ $row->departemen}}</td>
                                  <td>{{ $row->jumlah}}</td>
                                  <td>  <a href="#"  data-toggle="modal" data-target="#edit{{$row->id}}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                         <a href="{{ route('dana.detail', $row->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('dana.hapus', $row->id) }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                  </td>
                                  <!-- modal-edit -->
                                        <div class="modal fade" id="edit{{$row->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
                                              <div class="modal-content" style="width: 500px">
                                                <div class="modal-header" style="background-color: #007bff">
                                                  <h4 class="modal-title" style="color: #f8f9fa">Edit Dana</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <form role="form" method="POST" action="{{ route('dana.update', $row->id) }}">
                                                  @csrf
                                                  <input type="hidden" name="_method" value="PUT">
                                                    <div class="card-body">
                                                      <div class="form-group">
                                                        <label >Tahun</label>
                                                        <select class="form-control" name="tahun">
                                                        <option>Pilih</option>
                                                        @php $tahun = date('Y')-2;
                                                             $jarak = $tahun+5;
                                                        @endphp
                                                        @for ($tahun;$tahun <= $jarak;$tahun++)
                                                              <option value="{{ $tahun }}" {{ $row->tahun == $tahun ? 'selected':'' }}> {{$tahun}} </option>
                                                        @endfor
                                                        </select>
                                                      </div>
                                                      <div class="form-group">
                                                                <label>DEPARTEMEN / FAKULTAS</label>
                                                                <select class="form-control" name="departemen">
                                                                  <option>Pilih</option>
                                                                        <option value="Fakultas" {{ $row->departemen == 'Fakultas' ? 'selected':'' }}> Fakultas</option>
                                                                  @foreach ($departemen as $coy)
                                                                                <option value="{{ $coy->nama_departemen }}" {{ $coy->nama_departemen == $row->departemen ? 'selected':'' }}>{{ ucfirst($coy->nama_departemen) }}</option>
                                                                  @endforeach
                                                                            
                                                                </select>
                                                      </div>
                                                      <div class="form-group">
                                                        <label>Jumlah dana</label>
                                                        <input type="text" class="form-control" id="test" placeholder="masukkan jumlah anggaran" name="dana" value="{{$row->jumlah}}">
                                                      </div>
                                                    </div>
                                                    <!-- /.card-body --> 
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                  </form>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                        </div>
                                        <!-- /.modal-edit -->
                                </tr>
                               @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr> 
                                
                               @endforelse 
                              </tbody>
                            </table>
                                    
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer clearfix">
                            
                          </div>
                        </div>
            <!-- /.card -->
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- modal-dialog -->
        <div class="modal fade" id="modalAdd" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
          <div class="modal-content" style="width: 500px">
            <div class="modal-header" style="background-color: #007bff">
              <h4 class="modal-title" style="color: #f8f9fa">Tambah Dana</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" action="{{ route('dana.store') }}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label >Tahun</label>
                    <select class="form-control" name="tahun">
                        <option>Pilih</option>
                    @php $tahun = date('Y') - 2;
                         $jarak = $tahun+5;
                         for ($tahun;$tahun <= $jarak;$tahun++){
                         echo "<option value= ' ".$tahun." '> ".$tahun." </option>" ;
                         }
                    @endphp
                    </select>
                  </div>
                  <div class="form-group">
                            <label>DEPARTEMEN / FAKULTAS</label>
                            <select class="form-control" name="departemen">
                              <option>Pilih</option>
                                    <option value="Fakultas"> Fakultas</option>
                              @foreach ($departemen as $row)
                                            <option value="{{ $row->nama_departemen }}">{{ ucfirst($row->nama_departemen) }}</option>
                                  @endforeach
                                        
                            </select>
                  </div>
                  <div class="form-group">
                    <label>Jumlah dana</label>
                    <input type="text" class="form-control" id="test" placeholder="masukkan jumlah anggaran" name="dana">
                  </div>
                </div>
                <!-- /.card-body --> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        </div>
        <!-- /.modal-dialog -->

        <!-- modal-edit -->
        <div class="modal fade" id="modalEdit" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
              <div class="modal-content" style="width: 500px">
                <div class="modal-header" style="background-color: #007bff">
                  <h4 class="modal-title" style="color: #f8f9fa">Tambah Dana</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form role="form" method="POST" action="{{ route('dana.store') }}">
                  @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label >Tahun</label>
                        <select class="form-control" name="tahun">
                            <option>Pilih</option>
                        @php $tahun = date('Y');
                             $jarak = $tahun+5;
                             for ($tahun;$tahun <= $jarak;$tahun++){
                             echo "<option value= ' ".$tahun." '> ".$tahun." </option>" ;
                             }
                        @endphp
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Jumlah dana</label>
                        <input type="text" class="form-control" id="test" placeholder="masukkan jumlah anggaran" name="dana">
                      </div>
                    </div>
                    <!-- /.card-body --> 
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                  </form>
              </div>
              <!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal-edit -->

    </div>
  @endsection

  @section('javascript')
  <script type="text/javascript">
  	  // function validate(evt){
     //    var theEvent = evt || window.event;

     //    if(theEvent.type === 'paste'){
     //        key = event.clipboardData.getData('text/plain');
     //    } else {
     //        var key = theEvent.keyCode ||theEvent.which;
     //        key = String.fromCharCode(key);
     //    }
     //    var regex= /[0-9]|\./;
     //    if(!regex.test.(key) ){
     //        theEvent.returnValue = false;
     //        if(theEvent.preventDefault) theEvent.preventDefault();
     //    }
     //  }

      function setInputFilter(textbox, inputFilter) {
          ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
              if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
              } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
              }
            });
          });
        }

        setInputFilter(document.getElementById("test"), function(value) {
        return /^\d*$/.test(value); });
  </script>
  @endsection