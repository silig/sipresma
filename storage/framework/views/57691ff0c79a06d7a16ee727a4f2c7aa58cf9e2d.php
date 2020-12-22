<?php $__env->startSection('title'); ?>
    <title>SIPRESMA</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5>Manajemen User</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">User</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <hr>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                          <div class="card-header p-2">
                            <ul class="nav nav-pills">
                              <li class="nav-item"><a class="nav-link active" href="#mahasiswa" data-toggle="tab">Mahasiswa</a></li>
                              <li class="nav-item"><a class="nav-link" href="#admin" data-toggle="tab">Admin</a></li>
                              <li class="nav-item"><a class="nav-link " href="#dept" data-toggle="tab">Departemen / Fakultas / Senat</a></li>
                            </ul>
                          </div><!-- /.card-header -->
                          <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="mahasiswa">
                                  <!-- Detail -->
                                  <div class="row">
                                          <div class="col-12">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h3 class="card-title"><a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary btn-sm">Tambah Baru</a></h3>

                                                <div class="card-tools">
                                                  <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" id="searchmhs" class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <!-- /.card-header -->
                                              <div class="card-body table-responsive p-0">
                                                <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>NIM</td>
                                                                <td>Username</td>
                                                                <td>Role</td>
                                                                <td>Status</td>
                                                                <td>Aksi</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tabelmhs">
                                                            <?php $no = 1; ?>
                                                            <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <tr>
                                                                <td><?php echo e($no++); ?></td>
                                                                <td><?php echo e($row->NIM); ?></td>
                                                                <td><?php echo e($row->username); ?></td>
                                                                <td>
                                                                <label for="" class="badge badge-info"><?php echo e($row->name); ?></label>
                                                                </td>
                                                                <td>
                                                                    <?php if($row->status): ?>
                                                                    <label class="badge badge-success">Aktif</label>
                                                                    <?php else: ?>
                                                                    <label for="" class="badge badge-warning">Suspend</label>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <form action="<?php echo e(route('users.destroy', $row->id)); ?>" method="POST">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <a href="<?php echo e(route('users.roles', $row->id)); ?>" class="btn btn-info btn-sm" atl="change role" title="change role"><i class="fa fa-user-secret"></i></a>
                                                                        <a href="<?php echo e(route('users.edit', $row->id)); ?>" class="btn btn-warning btn-sm" alt="ubah password" title="ubah password"><i class="fa fa-edit"></i></a>
                                                                        <button class="btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>
                                                                         <?php if($row->status): ?>
                                                                        <a href="<?php echo e(route('users.nonaktif', $row->id)); ?>" class="btn btn-info btn-sm" title="Nonaktifkan user!"><i class="fa fa-toggle-off"></i></a>
                                                                        <?php else: ?>
                                                                        <a href="<?php echo e(route('users.aktif', $row->id)); ?>" class="btn btn-info btn-sm" title="Aktifkan user!"><i class=" fa fa-toggle-on"></i></a>
                                                                        <?php endif; ?>

                                                                    </form>
                                                                </td>
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                                                </tr>
                                                                <?php endif; ?>
                                                        </tbody>
                                                </table>
                                              </div>
                                              
                    ​                             <div class="float-right">
                                                    <?php echo e($mahasiswa->links()); ?>

                                                </div>
                                            
                                              <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                          </div>
                                          </div>
                                <!-- /.Detail -->
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="admin">
                                <!-- The timeline -->
                                <div class="row">
                                      <div class="col-12">
                                        <div class="card">
                                          <div class="card-header">
                                                <h3 class="card-title"><a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary btn-sm">Tambah Baru</a></h3>

                                                <div class="card-tools">
                                                  <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text"  class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                          <!-- /.card-header -->
                                          <div class="card-body table-responsive p-0">
                                            <table class="table table-hover">
                                              <thead>
                                                <tr>
                                                                <td>#</td>
                                                                <td>Username</td>
                                                                <td>Role</td>
                                                                <td>Status</td>
                                                                <td>Aksi</td>
                                                </tr>
                                              </thead>
                                              <tbody >
                                              <?php $a = 1; ?>
                                               <?php $__empty_1 = true; $__currentLoopData = $admin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <tr>
                                                                <td><?php echo e($a++); ?></td>
                                                                <td><?php echo e($row->username); ?></td>
                                                                <td>
                                                                <label for="" class="badge badge-info"><?php echo e($row->name); ?></label>
                                                                </td>
                                                                <td>
                                                                    <?php if($row->status): ?>
                                                                    <label class="badge badge-success">Aktif</label>
                                                                    <?php else: ?>
                                                                    <label for="" class="badge badge-warning">Suspend</label>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <form action="<?php echo e(route('users.destroy', $row->id)); ?>" method="POST">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <a href="<?php echo e(route('users.roles', $row->id)); ?>" class="btn btn-info btn-sm" atl="change role" title="change role"><i class="fa fa-user-secret"></i></a>
                                                                        <a href="<?php echo e(route('users.edit', $row->id)); ?>" class="btn btn-warning btn-sm" alt="ubah password" title="ubah password"><i class="fa fa-edit"></i></a>
                                                                        <button class="btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>
                                                                         <?php if($row->status): ?>
                                                                        <a href="<?php echo e(route('users.nonaktif', $row->id)); ?>" class="btn btn-info btn-sm" title="Nonaktifkan user!"><i class="fa fa-toggle-off"></i></a>
                                                                        <?php else: ?>
                                                                        <a href="<?php echo e(route('users.aktif', $row->id)); ?>" class="btn btn-info btn-sm" title="Aktifkan user!"><i class=" fa fa-toggle-on"></i></a>
                                                                        <?php endif; ?>

                                                                    </form>
                                                                </td>
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                                                </tr>
                                                                <?php endif; ?>
                                                        </tbody>
                                                </table>
                                              </div>
                                              
                    ​                             <div class="float-right">
                                                    <?php echo e($admin->links()); ?>

                                                </div>
                                          <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                      </div>
                                    </div>
                    <!-- /.timeline -->
                  </div>
                  <!-- /.tab-pane -->

                
                  <div class="tab-pane" id="dept">
                      <!-- Detail -->
                      <div class="row">
                      <div class="col-12">
                        <div class="card card-warning ">
                          <div class="card-header">
                                                <h3 class="card-title"><a href="<?php echo e(route('users.create')); ?>" class="btn btn-sm" style="background-color: red">Tambah Baru</a></h3>

                                                <div class="card-tools">
                                                  <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover" border=1 bordercolor="#ffc107">
                              <thead>
                              <tr>
                                    <td>#</td>
                                    <td>Username</td>
                                    <td>Role</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $b = 1; ?>
                               <?php $__empty_1 = true; $__currentLoopData = $dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <tr>
                                                                <td><?php echo e($b++); ?></td>
                                                                <td><?php echo e($row->username); ?></td>
                                                                <td>
                                                                <label for="" class="badge badge-info"><?php echo e($row->name); ?></label>
                                                                </td>
                                                                <td>
                                                                    <?php if($row->status): ?>
                                                                    <label class="badge badge-success">Aktif</label>
                                                                    <?php else: ?>
                                                                    <label for="" class="badge badge-warning">Suspend</label>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <form action="<?php echo e(route('users.destroy', $row->id)); ?>" method="POST">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <a href="<?php echo e(route('users.roles', $row->id)); ?>" class="btn btn-info btn-sm" atl="change role" title="change role"><i class="fa fa-user-secret"></i></a>
                                                                        <a href="<?php echo e(route('users.edit', $row->id)); ?>" class="btn btn-warning btn-sm" alt="ubah password" title="ubah password"><i class="fa fa-edit"></i></a>
                                                                        <button class="btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>
                                                                         <?php if($row->status): ?>
                                                                        <a href="<?php echo e(route('users.nonaktif', $row->id)); ?>" class="btn btn-info btn-sm" title="Nonaktifkan user!"><i class="fa fa-toggle-off"></i></a>
                                                                        <?php else: ?>
                                                                        <a href="<?php echo e(route('users.aktif', $row->id)); ?>" class="btn btn-info btn-sm" title="Aktifkan user!"><i class=" fa fa-toggle-on"></i></a>
                                                                        <?php endif; ?>

                                                                    </form>
                                                                </td>
                                                                </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                                                </tr>
                                                                <?php endif; ?>
                                                        </tbody>
                                                </table>
                                              </div>
                                              
                    ​                             <div class="float-right">
                                                    <?php echo e($dept->links()); ?>

                                                </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      </div>
                    <!-- /.Detail -->
                  </div>
                  <!-- /.tab-pane -->
                  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
            const search = document.getElementById('searchmhs');
            const tableBody = document.getElementById('tabelmhs');
            function getContent(){
            
            const searchValue = search.value;
            
                const xhr = new XMLHttpRequest();
                xhr.open('GET','<?php echo e(route('searchmhs')); ?>/?search=' + searchValue ,true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onreadystatechange = function() {
                    
                    if(xhr.readyState == 4 && xhr.status == 200)
                    {
                        tableBody.innerHTML = xhr.responseText;
                    }
                }
                xhr.send()
            }
            search.addEventListener('input',getContent);
</script>
<script type="text/javascript">
    $("#role").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: 'users/roles/'+id,
        type: 'get',
        data: {
                "id": id,
            },
        success: function (){
            console.log("it Works");
        }
    });
   
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/users/index.blade.php ENDPATH**/ ?>