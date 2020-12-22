@extends('layouts.master')

@section('title')
    <title>Manajemen Departemen</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid" >
                <div class="row mb-2" style="margin-left: 20px">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Departemen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Departemen</li>
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
                          <div class="card-header" style="background-color:#31708f;border-color: #bce8f1;">
                              <p><h4 align="center" style="color: white">Halaman ini untuk pengaturan Departemen</h4></p>
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
                                  <th>Nama Departemen</th>
                                  <th>Ketua Departemen</th>
                                  <th>NIP</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @php $no = 1; @endphp
                              @forelse ($departemen as $row)
                                <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $row->nama_departemen}}</td>
                                  <td>{{ $row->kadep}}</td>
                                  <td>{{ $row->nip}}</td>
                                  <td>  <a href="#"  data-toggle="modal" data-target="#edit{{$row->id}}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                  </td>
                                  <!-- modal-edit -->
                                        <div class="modal fade" id="edit{{$row->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
                                              <div class="modal-content" style="width: 500px">
                                                <div class="modal-header" style="background-color: #007bff">
                                                  <h4 class="modal-title" style="color: #f8f9fa">Edit Departemen</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <form role="form" method="POST" action="{{ route('departemen.update', $row->id) }}">
                                                  @csrf
                                                  <input type="hidden" name="_method" value="PUT">
                                                    <div class="card-body">
                                                      <div class="form-group">
                                                        <label >Nama Departemen</label>
                                                        <input type="text" class="form-control" name="nama" value="{{$row->nama_departemen}}">
                                                      </div>
                                                      <div class="form-group">
                                                        <label >Ketua Departemen</label>
                                                        <input type="text" class="form-control" name="kadep" value="{{$row->kadep}}">
                                                      </div>
                                                      <div class="form-group">
                                                        <label>NIP</label>
                                                        <input type="text" class="form-control" id="test"  name="nip" value="{{$row->nip}}">
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