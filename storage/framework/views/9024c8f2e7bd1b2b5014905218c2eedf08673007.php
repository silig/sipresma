<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo e(asset('dist/img/logo_undip-1.gif')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8" height="128px" width="128px">
      <span class="brand-text font-weight-light"><img src="<?php echo e(asset('dist/img/sipresma.png')); ?>" alt="AdminLTE Logo" 
           style="opacity: .8" height="30px" width="175px"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('dist/img/ava.png')); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php if(isset(UserHelp::datauser()[0]->nama_mhs)): ?>
          <a href="<?php echo e(route('gantipassword', encrypt(Auth::user()->id))); ?>" class="d-block"><?php echo e(UserHelp::datauser()[0]->nama_mhs); ?></a>
          <?php endif; ?>
          <?php if(isset(UserHelp::datauser()->username)): ?>
          <a href="<?php echo e(route('gantipassword', encrypt(Auth::user()->id))); ?>" class="d-block"><?php echo e(UserHelp::datauser()->username); ?></a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-header">DASHBOARD</li>
          <li class="nav-item">
            <a href="<?php echo e(route('home')); ?>" class="nav-link">
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
                      <a href="<?php echo e(route('delegasi')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Delegasi</p>
                          <span class="badge badge-info right"></span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('penyelenggara')); ?>" class="nav-link">
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

        <?php if(auth()->check() && auth()->user()->hasRole('mahasiswa')): ?>
          <!-- PENGAJUAN SAYA -->
          <li class="nav-header">PENGAJUAN SAYA</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"> <?php echo e(ProposalMasuk::mahasiswaDel(UserHelp::datauser()[0]->NIM) + ProposalMasuk::mahasiswaPen(UserHelp::datauser()[0]->NIM)); ?></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo e(route('pengajuanku.delegasi')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Delegasi</p>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::mahasiswaDel(UserHelp::datauser()[0]->NIM)); ?></span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('pengajuanku.penyelenggara')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Penyelenggaraan</p>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::mahasiswaPen(UserHelp::datauser()[0]->NIM)); ?></span>
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
                      <a href="<?php echo e(route('prestasi.index')); ?>" class="nav-link">
                          <i class="nav-icon fa fa-file"></i>
                          <p>Prestasi</p>
                          <span class="badge badge-info right"></span>
                      </a>
                  </li>
          <!-- END PENGAJUAN SAYA-->
        <?php endif; ?>

        <?php if(auth()->check() && auth()->user()->hasRole('fakultas')): ?>
          <!-- Menu untuk approval -->
          <li class="nav-header">DAFTAR PENGAJUAN</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"><?php echo e(ProposalMasuk::fakultas()+ProposalMasuk::proposaldisetujuifk()); ?></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo e(route('DaftarMasuk.fakultas')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Masuk</p>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::fakultas()); ?></span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('proposaldisetujui.fakultas')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal disetujui</p>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::proposaldisetujuifk()); ?></span>
                         
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('proposalditolak.fakultas')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal ditolak</p>
                          <span class="badge badge-danger right"><?php echo e(ProposalMasuk::TolakFakultas()); ?></span>
                         
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
                      <span class="badge badge-info right"><?php echo e(ProposalMasuk::daftarlpjfk()+ProposalMasuk::lpjcairfk()); ?></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo e(route('lpjmasuk.fakultas')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Masuk</p>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::daftarlpjfk()); ?></span>
                         
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('lpjdisetujui.fakultas')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ disetujui</p>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::lpjcairfk()); ?></span>
                         
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('lpjditolak.fakultas')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ ditolak</p>
                          <span class="badge badge-info right"></span>
                         
                      </a>
                  </li>
              </ul>
          </li>
          <!-- <li class="nav-item">
                    <a href="<?php echo e(route('dps.fak')); ?>" class="nav-link">
                      <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                      <p>
                        dirubah 
                      </p>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::setujuiFak()); ?></span>
                    </a>
          </li> -->
          <li class="nav-item">
            <a href="<?php echo e(route('aturdana.fakultas')); ?>" class="nav-link">
              <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
              <p>
                Atur Dana 
              </p>
            </a>
          </li>
          <!-- END approval-->
        <?php endif; ?>

        <?php if(auth()->check() && auth()->user()->hasRole('departemen')): ?>
          <!-- Menu untuk approval -->
          <li class="nav-header">DAFTAR PENGAJUAN</li>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      Proposal Masuk
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"><?php echo e(ProposalMasuk::departemen(UserHelp::datauser()->id_departemen)+ProposalMasuk::proposaldisetujui(UserHelp::datauser()->id_departemen)); ?></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo e(route('DaftarMasuk.departemen')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Masuk</p>
                          <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::departemen(UserHelp::datauser()->id_departemen)); ?></span>
                          <?php endif; ?>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('proposaldisetujui.departemen')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Disetujui</p>
                          <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::proposaldisetujui(UserHelp::datauser()->id_departemen)); ?></span>
                          <?php endif; ?>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('proposalditolak.departemen')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Ditolak</p>
                          <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-danger right"><?php echo e(ProposalMasuk::TolakDepartemen(UserHelp::datauser()->id_departemen)); ?></span>
                          <?php endif; ?>
                      </a>
                  </li>
              </ul>
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                      LPJ 
                      <i class="right fa fa-angle-left"></i>
                      <span class="badge badge-info right"><?php echo e(ProposalMasuk::daftarlpj(UserHelp::datauser()->id_departemen)+ProposalMasuk::lpjcairdept(UserHelp::datauser()->id_departemen)); ?></span>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo e(route('DaftarMasuk.departemen')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Masuk</p>
                          <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::daftarlpj(UserHelp::datauser()->id_departemen)); ?></span>
                          <?php endif; ?>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('lpjdisetujui.departemen')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Disetujui</p>
                          <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::lpjcairdept(UserHelp::datauser()->id_departemen)); ?></span>
                          <?php endif; ?>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('lpjditolak.departemen')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Ditolak</p>
                          <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-info right"></span>
                          <?php endif; ?>
                      </a>
                  </li>
              </ul>
              
          <!-- <li class="nav-item" >
                    <a href="<?php echo e(route('dps.dept')); ?>" class="nav-link">
                      <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                      <p>
                        berubah 
                      </p>
                      <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::setujuiDept(UserHelp::datauser()->id_departemen)); ?></span>
                      <?php endif; ?>
                    </a>
          </li> -->
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('aturdana.departemen')); ?>" class="nav-link">
              <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
              <p>
                Atur Dana 
              </p>
            </a>
          </li>
          <!-- END approval-->
        <?php endif; ?>

        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
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
                      <a href="<?php echo e(route('role.index')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Role</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('users.index')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Users</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('users.roles_permission')); ?>" class="nav-link">
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
                      <a href="<?php echo e(route('dana.index')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dana</p>
                      </a>
                  </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('departemen.index')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Departemen 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('formsetting')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Form Setting 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('mahasiswa.index')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Manajemen Mahasiswa 
                </p>
              </a>
            </li>
        <?php endif; ?>

        <?php if(auth()->check() && auth()->user()->hasRole('admin|fakultas|departemen')): ?>
            <li class="nav-item">
              <a href="<?php echo e(route('laporan')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Laporan 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('report.delegasi')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report delegasi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('report.penyelenggara')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report penyelenggaraan
                </p>
              </a>
          </li>
        <?php endif; ?>  
        
        <?php if(auth()->check() && auth()->user()->hasRole('senat')): ?>
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
                      <a href="<?php echo e(route('senat.proposalbaru')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Masuk</p>
                          <span class="badge badge-info right"></span>
                          
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('senat.proposaldisetujui')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Proposal Disetujui</p>
                          <span class="badge badge-info right"></span>
                          
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('senat.proposalditolak')); ?>" class="nav-link">
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
                      <a href="<?php echo e(route('senat.lpj')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Masuk</p>
                         
                          <span class="badge badge-info right"></span>
                          
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo e(route('senat.lpjselesai')); ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>LPJ Disetujui</p>
                          
                          <span class="badge badge-info right"></span>
                         
                      </a>
                  </li>
              </ul>
          <!-- <li class="nav-item" >
                    <a href="<?php echo e(route('dps.dept')); ?>" class="nav-link">
                      <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                      <p>
                        berubah 
                      </p>
                      <?php if(isset(UserHelp::datauser()->id_departemen)): ?>
                          <span class="badge badge-info right"><?php echo e(ProposalMasuk::setujuiDept(UserHelp::datauser()->id_departemen)); ?></span>
                      <?php endif; ?>
                    </a>
          </li> -->
          </li>
          <!-- END approval-->
          <li class="nav-header">MANAJEMEN</li>
          <li class="nav-item">
              <a href="<?php echo e(route('laporan')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  Laporan 
                </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="<?php echo e(route('report.delegasi')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report delegasi
                </p>
              </a>
            </li>
          <li class="nav-item">
              <a href="<?php echo e(route('report.penyelenggara')); ?>" class="nav-link">
                <i class="nav-icon far fa-file" style="color: black" aria-hidden="true"></i>
                <p>
                  report penyelenggaraan
                </p>
              </a>
          </li>
        <?php endif; ?>

          <li class="nav-header"></li>
          <li class="nav-item has-treeview">
              <a class="nav-link" href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><span class="fi-account-logout"></span>
                  <i class="fas fa-sign-out-alt nav-icon" style="color: red"></i>
                  <p style="color: red">
                      Logout
                  </p>
              </a>
          ​
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                  <?php echo csrf_field(); ?>
              </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/layouts/module/sidebar.blade.php ENDPATH**/ ?>