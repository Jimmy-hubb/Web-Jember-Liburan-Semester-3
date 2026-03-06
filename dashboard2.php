<?php
include 'header.php';
include 'db.php';
?>
<<<<<<< HEAD
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar User
=======
<?php if (isset($_GET['status']) && isset($_GET['message'])): ?>
    <div class="notification <?php echo $_GET['status']; ?>">
        <?php echo htmlspecialchars($_GET['message']); ?>
    </div>
<?php endif; ?>

<style>
  .notification {
    padding: 15px;
    margin: 20px 0;
    border-radius: 5px;
    color: #fff;
    text-align: center;
    font-size: 16px;
    transition: opacity 0.5s ease;
}

.notification.success {
    background-color: #4CAF50; /* Warna hijau untuk sukses */
}

.notification.error {
    background-color: #f44336; /* Warna merah untuk error */
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar User Admin
>>>>>>> a6d1d7fb59b49c614209c67b9cee60e1e520f41d
        <small>user list</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
<<<<<<< HEAD
      <?php if(isset($_GET['status']) && isset($_GET['message'])): ?>
          <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?> alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo htmlspecialchars($_GET['message']); ?>
          </div>
      <?php endif; ?>
    	<div class="row">
	        <div class="col-lg-6 col-md-12 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3>
                <?php 
                  $result = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role='admin'");
                  echo $result->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
              </h3>
	              <p>TOTAL USER ADMIN</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-user"></i>
	            </div>
	            <a href="#" class="small-box-footer">
	              More info <i class="fa fa-arrow-circle-right"></i>
	            </a>
	          </div>
	        </div>
	    </div>
    	
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-users"></i>
          <h3 class="box-title">Tabel User Admin</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>

            <span class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Admin</span>
          </div>
        </div>
        <div id="modal-edit" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="form_edit">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Form Edit User Admin</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="edit_id">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="edit_email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="edit_password" placeholder="Password">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                  </div>
                  <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="edit_role" required>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="button" value="Update" name="update" class="btn btn-success" onclick="update_data()" />
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="proses.php?aksi=add" method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Form Tambah User Admin</h4>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                          <label for="role">Role</label>
                          <select class="form-control" name="role" id="role" required>
                            <option value="admin">Admin</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <input type="submit" value="Daftar" name="daftar" class="btn btn-success"/>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $stmt = $pdo->query("SELECT * FROM users WHERE role='admin' ORDER BY created_at DESC");
              $id = 0;
              while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $id++;
                  echo "<tr>";
                  echo "<td>".$id."</td>";
                  echo "<td>".$user['email']."</td>";
                  echo "<td>".$user['role']."</td>";
                  echo "<td>".date('d M Y H:i', strtotime($user['created_at']))."</td>";
                  echo "<td>";
                  echo "<a href='proses.php?id=".$user['id']."&aksi=delete' onclick='javascript: return confirm(\"Yakin hapus data ini ?\")' class='btn btn-danger'><i class='fa fa-trash'></i></a> | ";
                  echo "<a href='#' class='btn btn-info edit' onclick='edit(".$user['id'].")'><i class='fa fa-edit'></i></a>";
                  echo "</td></tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    function edit(id){
      $.ajax({
        url : 'proses.php?aksi=edit&id='+id,
        dataType : 'JSON',
        success : function(result){
          $("#modal-edit").modal('show');
          $("#edit_id").val(result.id);
          $("#edit_email").val(result.email);
          $("#edit_role").val(result.role);
        },
        error : function(data){
          alert("Ada yang error");
        }
      });
    }

    function update_data(){
      $.ajax({
        url : 'proses.php?aksi=update',
        type : 'POST',
        data : $("#form_edit").serialize(),
        success : function(data){
          location.reload(true);
        },
        error : function(data){
          alert("Gagal update");
        } 
      });
    }
  </script>

<?php 
include 'footer.php';
?>
=======
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php 
                                $result = $pdo->query("SELECT COUNT(*) as total FROM users WHERE role='admin'");
                                echo $result->fetch(PDO::FETCH_ASSOC)['total'];
                            ?>
                        </h3>
                        <p>TOTAL USER ADMIN</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <i class="fa fa-users"></i>
                <h3 class="box-title">Tabel User Admin</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                    <span class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Admin</span>
                </div>
            </div>
            <div id="modal-edit" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="form_edit">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Form Edit User Admin</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id" id="edit_id">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="edit_email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_username">Username</label>
                                    <input type="text" class="form-control" name="username" id="edit_username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="edit_password" placeholder="Password">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role" id="edit_role" required>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" value="Update" name="update" class="btn btn-success" onclick="update_data()" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="proses.php?aksi=add" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Form Tambah User Admin</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-control" name="role" id="role" required>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="Daftar" name="daftar" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM users WHERE role='admin' ORDER BY created_at DESC");
                        $id = 0;
                        while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $id++;
                            echo "<tr>";
                            echo "<td>" . $id . "</td>";
                            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($user['role']) . "</td>";
                            echo "<td>" . date('d M Y H:i', strtotime($user['created_at'])) . "</td>";
                            echo "<td>";
                            echo "<a href='proses.php?id=" . $user['id'] . "&aksi=delete' onclick='javascript: return confirm(\"Yakin hapus data ini ?\")' class='btn btn-danger'><i class='fa fa-trash'></i></a> | ";
                            echo "<a href='#' class='btn btn-info edit' onclick='edit(" . $user['id'] . ")'><i class='fa fa-edit'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    function edit(id) {
        $.ajax({
            url: 'proses.php?aksi=edit&id=' + id,
            dataType: 'JSON',
            success: function(result) {
                $("#modal-edit").modal('show');
                $("#edit_id").val(result.id);
                $("#edit_email").val(result.email);
                $("#edit_username").val(result.username);
                $("#edit_role").val(result.role);
            },
            error: function(data) {
                alert("Ada yang error");
            }
        });
    }

    function update_data() {
        $.ajax({
            url: 'proses.php?aksi=update',
            type: 'POST',
            data: $("#form_edit").serialize(),
            success: function(data) {
                location.reload(true);
            },
            error: function(data) {
                alert("Gagal update");
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const notification = document.querySelector('.notification');
        if (notification) {
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease';
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 5000);
        }
    });
</script>

<?php include 'footer.php';
?>
>>>>>>> a6d1d7fb59b49c614209c67b9cee60e1e520f41d
