<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('dist/img/logo_undip-1.gif') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8" height="128px" width="128px">
      <span class="brand-text font-weight-light"><img src="{{ asset('dist/img/sipresma.png') }}" alt="AdminLTE Logo" 
           style="opacity: .8" height="30px" width="175px"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/ava.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if (isset(UserHelp::datauser()[0]->nama_mhs))
          <a href="{{ route('gantipassword', encrypt(Auth::user()->id)) }}" class="d-block">{{ UserHelp::datauser()[0]->nama_mhs }}</a>
          @endif
          @if (isset(UserHelp::datauser()->username))
          <a href="{{ route('gantipassword', encrypt(Auth::user()->id)) }}" class="d-block">{{ UserHelp::datauser()->username }}</a>
          @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-header">DASHBOARD</li>
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>

          <!-- PENGAJUAN -->
          <li class="nav-header">PENGAJUAN</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('delegasi') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Delegasi</p>
                          <span class="badge badge-info right"></span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('penyelenggara') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Penyelenggaraan</p>
                          <span class="badge badge-info right"></span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lain-lain</p>
                          <span class="badge badge-info right"></span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- END PENGAJUAN -->

        @role('mahasiswa')
          <!-- PENGAJUAN SAYA -->
          <li class="nav-header">PENGAJUAN SAYA</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"> {{ ProposalMasuk::mahasiswaDel(UserHelp::datauser()[0]->NIM) + ProposalMasuk::mahasiswaPen(UserHelp::datauser()[0]->NIM) }}</span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('pengajuanku.delegasi') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Delegasi</p>
                          <span class="badge badge-info right">{{ ProposalMasuk::mahasiswaDel(UserHelp::datauser()[0]->NIM) }}</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('pengajuanku.penyelenggara') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Penyelenggaraan</p>
                          <span class="badge badge-info right">{{ ProposalMasuk::mahasiswaPen(UserHelp::datauser()[0]->NIM) }}</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lain-lain</p>
                          <span class="badge badge-info right"></span>
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
                      <a href="{{route('prestasi.index')}}" class="nav-link">
                          <i class="nav-icon fa fa-file"></i>
                          <p>Prestasi</p>
                          <span class="badge badge-info right"></span>
                      </a>
                  </li>
          <!-- END PENGAJUAN SAYA-->
        @endrole

        @role('fakultas')
          <!-- Menu untuk approval -->
          <li class="nav-header">DAFTAR PENGAJUAN</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right">{{ ProposalMasuk::fakultas()+ProposalMasuk::proposaldisetujuifk() }}</span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('DaftarMasuk.fakultas') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Masuk</p>
                          <span class="badge badge-info right">{{ ProposalMasuk::fakultas() }}</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('proposaldisetujui.fakultas') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal disetujui</p>
                          <span class="badge badge-info right">{{ ProposalMasuk::proposaldisetujuifk() }}</span>
                         
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('proposalditolak.fakultas') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal ditolak</p>
                          <span class="badge badge-danger right">{{ ProposalMasuk::TolakFakultas() }}</span>
                         
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      LPJ
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right">{{ ProposalMasuk::daftarlpjfk()+ProposalMasuk::lpjcairfk() }}</span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('lpjmasuk.fakultas') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Masuk</p>
                          <span class="badge badge-info right">{{ ProposalMasuk::daftarlpjfk() }}</span>
                         
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('lpjdisetujui.fakultas') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ disetujui</p>
                          <span class="badge badge-info right">{{ ProposalMasuk::lpjcairfk() }}</span>
                         
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('lpjditolak.fakultas') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ ditolak</p>
                          <span class="badge badge-info right"></span>
                         
                      </a>
                  </li>
              </ul>
          </li>
          <!-- <li class="nav-item">
                    <a href="{{ route('dps.fak') }}" class="nav-link">
                      <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                      <p>
                        dirubah 
                      </p>
                          <span class="badge badge-info right">{{ ProposalMasuk::setujuiFak() }}</span>
                    </a>
          </li> -->
          <li class="nav-item">
            <a href="{{ route('aturdana.fakultas') }}" class="nav-link">
              <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
              <p>
                Atur Dana 
              </p>
            </a>
          </li>
          <!-- END approval-->
        @endrole

        @role('departemen')
          <!-- Menu untuk approval -->
          <li class="nav-header">DAFTAR PENGAJUAN</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal Masuk
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right">{{ ProposalMasuk::departemen(UserHelp::datauser()->id_departemen)+ProposalMasuk::proposaldisetujui(UserHelp::datauser()->id_departemen) }}</span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('DaftarMasuk.departemen') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Masuk</p>
                          @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-info right">{{ ProposalMasuk::departemen(UserHelp::datauser()->id_departemen) }}</span>
                          @endif
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('proposaldisetujui.departemen') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Disetujui</p>
                          @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-info right">{{ ProposalMasuk::proposaldisetujui(UserHelp::datauser()->id_departemen) }}</span>
                          @endif
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('proposalditolak.departemen') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Ditolak</p>
                          @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-danger right">{{ ProposalMasuk::TolakDepartemen(UserHelp::datauser()->id_departemen) }}</span>
                          @endif
                      </a>
                  </li>
              </ul>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      LPJ 
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right">{{ ProposalMasuk::daftarlpj(UserHelp::datauser()->id_departemen)+ProposalMasuk::lpjcairdept(UserHelp::datauser()->id_departemen) }}</span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('DaftarMasuk.departemen') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Masuk</p>
                          @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-info right">{{ ProposalMasuk::daftarlpj(UserHelp::datauser()->id_departemen) }}</span>
                          @endif
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('lpjdisetujui.departemen') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Disetujui</p>
                          @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-info right">{{ ProposalMasuk::lpjcairdept(UserHelp::datauser()->id_departemen) }}</span>
                          @endif
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('lpjditolak.departemen') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Ditolak</p>
                          @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-info right"></span>
                          @endif
                      </a>
                  </li>
              </ul>
              
          <!-- <li class="nav-item" >
                    <a href="{{ route('dps.dept') }}" class="nav-link">
                      <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                      <p>
                        berubah 
                      </p>
                      @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-info right">{{ ProposalMasuk::setujuiDept(UserHelp::datauser()->id_departemen) }}</span>
                      @endif
                    </a>
          </li> -->
          </li>
          <li class="nav-item">
            <a href="{{ route('aturdana.departemen') }}" class="nav-link">
              <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
              <p>
                Atur Dana 
              </p>
            </a>
          </li>
          <!-- END approval-->
        @endrole

        @role('admin')
          <li class="nav-header">MANAJEMEN</li>
          
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                      Manajemen Users
                      <i class="right fa fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('role.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Role</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('users.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Users</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('users.roles_permission') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Role Permission</p>
                      </a>
                  </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                      Manajemen Dana
                      <i class="right fa fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('dana.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dana</p>
                      </a>
                  </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('departemen.index') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Departemen 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('formsetting') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Form Setting 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('mahasiswa.index') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Manajemen Mahasiswa 
                </p>
              </a>
            </li>
        @endrole

        @role('admin|fakultas|departemen')
            <li class="nav-item">
              <a href="{{ route('laporan') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Laporan 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('report.delegasi') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report delegasi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('report.penyelenggara') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report penyelenggaraan
                </p>
              </a>
          </li>
        @endrole  
        
        @role('senat')
          <!-- Menu untuk approval -->
          <li class="nav-header">DAFTAR PENGAJUAN</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal Masuk
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('senat.proposalbaru') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Masuk</p>
                          <span class="badge badge-info right"></span>
                          
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('senat.proposaldisetujui') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Disetujui</p>
                          <span class="badge badge-info right"></span>
                          
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('senat.proposalditolak') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Ditolak</p>
                          <span class="badge badge-danger right"></span>
                      </a>
                  </li>
              </ul>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      LPJ 
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('senat.lpj') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Masuk</p>
                         
                          <span class="badge badge-info right"></span>
                          
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('senat.lpjselesai') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Disetujui</p>
                          
                          <span class="badge badge-info right"></span>
                         
                      </a>
                  </li>
              </ul>
          <!-- <li class="nav-item" >
                    <a href="{{ route('dps.dept') }}" class="nav-link">
                      <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                      <p>
                        berubah 
                      </p>
                      @if (isset(UserHelp::datauser()->id_departemen))
                          <span class="badge badge-info right">{{ ProposalMasuk::setujuiDept(UserHelp::datauser()->id_departemen) }}</span>
                      @endif
                    </a>
          </li> -->
          </li>
          <!-- END approval-->
          <li class="nav-header">MANAJEMEN</li>
          <li class="nav-item">
              <a href="{{ route('laporan') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Laporan 
                </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('report.delegasi') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report delegasi
                </p>
              </a>
            </li>
          <li class="nav-item">
              <a href="{{ route('report.penyelenggara') }}" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report penyelenggaraan
                </p>
              </a>
          </li>
        @endrole

          <li class="nav-header"></li>
          <li class="nav-item has-treeview">
              <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><span class="fi-account-logout"></span>
                  <i class="fas fa-sign-out-alt nav-icon" style="color: red"></i>
                  <p style="color: red">
                      Logout
                  </p>
              </a>
          ​
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>