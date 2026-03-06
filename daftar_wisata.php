<?php
include 'header.php';
include 'db.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <i class="fa fa-map-marker"></i>
        <h3 class="box-title">Tabel Wisata</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i>
          </button>
          <span class="btn btn-success" data-toggle="modal" data-target="#addModal">Tambah Wisata</span>
        </div>
      </div>

      <!-- Modal for Add Wisata -->
      <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
          <form action="proses2.php?aksi=tambah_wisata" method="post" enctype="multipart/form-data">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah Wisata</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="nama_wisata">Nama Wisata</label>
                  <input type="text" class="form-control" name="nama_wisata" id="nama_wisata" placeholder="Nama Wisata" required>
                </div>
                <div class="form-group">
                  <label for="alamat_wisata">Alamat Wisata</label>
                  <input type="text" class="form-control" name="alamat_wisata" id="alamat_wisata" placeholder="Alamat Wisata" required>
                </div>
                <div class="form-group">
                  <label for="deskripsi_wisata">Deskripsi Wisata</label>
                  <textarea class="form-control" name="deskripsi_wisata" id="deskripsi_wisata" placeholder="Deskripsi Wisata" required></textarea>
                </div>
                <div class="form-group">
                  <label for="operasional">Jam Operasional</label>
                  <input type="text" class="form-control" name="operasional" id="operasional" placeholder="Jam Operasional" required>
                </div>
                <div class="form-group">
                  <label for="harga_tiket">Harga Tiket</label>
                  <input type="number" class="form-control" name="harga_tiket" id="harga_tiket" placeholder="Harga Tiket" required>
                </div>
                <div class="form-group">
                  <label for="gambar">Gambar Wisata</label>
                  <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" required>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" value="Daftar" name="daftar" class="btn btn-success"/>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal for Edit Wisata -->
      <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="form_edit">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Edit Wisata</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" class="form-control" name="id" id="edit_id">
                <div class="form-group">
                  <label for="nama_wisata">Nama Wisata</label>
                  <input type="text" class="form-control" name="nama_wisata" id="edit_nama_wisata" placeholder="Nama Wisata">
                </div>
                <div class="form-group">
                  <label for="alamat_wisata">Alamat Wisata</label>
                  <input type="text" class="form-control" name="alamat_wisata" id="edit_alamat_wisata" placeholder="Alamat Wisata">
                </div>
                <div class="form-group">
                  <label for="deskripsi_wisata">Deskripsi Wisata</label>
                  <textarea class="form-control" name="deskripsi_wisata" id="edit_deskripsi_wisata" placeholder="Deskripsi Wisata"></textarea>
                </div>
                <div class="form-group">
                  <label for="operasional">Jam Operasional</label>
                  <input type="text" class="form-control" name="operasional" id="edit_operasional" placeholder="Jam Operasional">
                </div>
                <div class="form-group">
                  <label for="harga_tiket">Harga Tiket</label>
                  <input type="number" class="form-control" name="harga_tiket" id="edit_harga_tiket" placeholder="Harga Tiket">
                </div>
                <div class="form-group">
                  <label for="edit_gambar">Gambar Wisata</label>
                  <input type="file" class="form-control" name="gambar" id="edit_gambar" accept="image/*">
                </div>
                <div class="form-group">
                  <label>Gambar Saat Ini</label>
                  <img id="current_image" src="" alt="Current Image" style="width: 100px; display: none;">
                </div>
              </div>
              <div class="modal-footer">
                <input type="button" value="Update" class="btn btn-success" onclick="update_wisata()" />
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nama Wisata</th>
                <th>Alamat Wisata</th>
                <th>Deskripsi</th>
                <th>Jam Operasional</th>
                <th>Harga Tiket</th>
                <th>Gambar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
                // Fetch data using PDO
                $query = "SELECT * FROM wisata";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $wisataData = $stmt->fetchAll();

                foreach ($wisataData as $wisata) {
                  echo "<tr>";
                  echo "<td>" . $wisata['id'] . "</td>";
                  echo "<td>" . $wisata['nama_wisata'] . "</td>";
                  echo "<td>" . $wisata['alamat_wisata'] . "</td>";
                  echo "<td>" . $wisata['deskripsi_wisata'] . "</td>";
                  echo "<td>" . $wisata['operasional'] . "</td>";
                  echo "<td>" . $wisata['harga_tiket'] . "</td>";
                  
                  // Display the image, if available
                  if ($wisata['gambar']) {
                    echo "<td><img src='uploads/" . $wisata['gambar'] . "' alt='Gambar Wisata' style='width: 100px;'></td>";
                  } else {
                    echo "<td>No Image</td>";
                  }

                  echo "<td>
                          <a href='#' class='btn btn-info edit' onclick='edit_wisata(" . $wisata['id'] . ")'><i class='fa fa-edit'></i></a> |
                          <a href='proses2.php?aksi=delete_wisata&id=" . $wisata['id'] . "' class='btn btn-danger' onclick='return confirm(\"Yakin hapus data ini?\")'><i class='fa fa-trash'></i></a>
                        </td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  function edit_wisata(id) {
    $.ajax({
      url: 'proses2.php?aksi=edit_data_wisata&id=' + id,
      dataType: 'JSON',
      success: function(result) {
        $("#editModal").modal('show');
        $("#edit_id").val(result.id);
        $("#edit_nama_wisata").val(result.nama_wisata);
        $("#edit_alamat_wisata").val(result.alamat_wisata);
        $("#edit_deskripsi_wisata").val(result.deskripsi_wisata);
        $("#edit_operasional").val(result.operasional);
        $("#edit_harga_tiket").val(result.harga_tiket);
        if (result.gambar) {
          $("#current_image").attr("src", "uploads/" + result.gambar).show();
        }
      },
      error: function() {
        alert("Error fetching data");
      }
    });
}

function update_wisata() {
    // Menggunakan FormData untuk mendukung pengiriman file
    var formData = new FormData($("#form_edit")[0]);

    $.ajax({
      url: 'proses2.php?aksi=update_wisata',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(res) {
        if (res.trim() == "1") { // Pastikan untuk menghilangkan whitespace tambahan
          location.reload(true);
        } else {
          alert("Failed to update data");
        }
      },
      error: function() {
        alert("Failed to update data");
      }
    });
  }
</script>


<?php
include 'footer.php';
?>
