@extends('layouts.master')

@section('title')
    <title>SIPRESMA</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5>{{Random::jam()}}</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <hr>
        </div>

        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row justify-content-center align-items-center">
              <div class="col-lg-10 col-6">
              <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Tahun {{ date('Y') }}</h3>
                    </div>
              </div>
              </div>
            </div>
            <div class="row justify-content-center align-items-center">
              <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ ProposalMasuk::thisyearDelegasiLomba() }}</h3>

                    <p>Lomba</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Delegasi</i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ ProposalMasuk::thisyearDelegasiNonLomba() }}</h3>

                    <p>Non Lomba</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Delegasi</a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ ProposalMasuk::thisyearPenyelenggaraLomba() }}</h3>

                    <p>Lomba</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Penyelenggaraan </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-danger" >
                  <div class="inner">
                    <h3>{{ ProposalMasuk::thisyearPenyelenggaraSoftskill() }}</h3>

                    <p>Softskill</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Penyelenggaraan </a>
                </div>
              </div>
              <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>{{ ProposalMasuk::thisyearPenyelenggaraPengabdian() }}</h3>

                    <p>lainnya </p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Penyelenggaraan </a>
                </div>
              </div>

              <div class="col-md-10">
                <div class="card">
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item">
                          <img class="d-block w-100" src="https://i.ibb.co/L9hDYR3/silder-1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="https://i.ibb.co/z2GDDpq/cover-1.jpg" alt="Second slide">
                        </div>                        
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
            @if (isset(UserHelp::datauser()[0]->nama_mhs))
            @if ($ada == true)
            <!-- Modal -->
            <div class="modal fade" id="modal-primary" aria-modal="true" style="padding-right: 17px; display: block;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                  <div class="modal-header bg-warning">
                    <h4 class="modal-title"><b>Peringatan !!</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body bg-warning">
                  
                    <table class="table">
                      @foreach($u as $data => $row)
                        @foreach ($row as $kepet => $jos)
                      <tr>
                        <p>Harap segera isi LPJ pada proposal dengan nomor {{$jos->nomor_proposal}} maksimal tanggal <font color="red">{{Tanggal::indo($jos->tglakhir)}}</font></p>
                      </tr>
                        @endforeach
                      @endforeach
                    </table>
                  
                  </div>
                  <div class="modal-footer bg-warning"> Apabila setelah 2 bulan dari tanggal kegiatan tidak mengisi LPJ, maka otomatis proposal akan ditolak oleh sistem</div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            @endif
            @endif
          </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('javascript')
<script>
  window.setTimeout("waktu()", 1000);
 
  function waktu() {
    var waktu = new Date();
    setTimeout("waktu()", 1000);
    document.getElementById("jam").innerHTML = waktu.getHours();
    document.getElementById("menit").innerHTML = waktu.getMinutes();
    document.getElementById("detik").innerHTML = waktu.getSeconds();
  }
</script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#modal-primary').modal('show');
    });
</script>
@endsection