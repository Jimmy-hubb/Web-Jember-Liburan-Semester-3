

<?php
include 'header.php';
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulir Edit Guru</title>
</head>

<body>
    <header>
        <h3>Formulir Edit Guru</h3>
    </header>
     <div class="box">
        <div class="box-header with-border">

    <div class="content-wrapper">
	  	<div class="box-body">

    <form action="" method="POST">


        
        <div class="row"></div>
        <div class="col-lg-6">
            <label for="nama">Nama: </label>
            <input type="text" name="nama" class="form-control" placeholder="nama lengkap"><br>
        </div>
        </div>
        
        
        
        <div class="row"></div>
        <div class="col-lg-6">
            <label for="jenis_kelamin">Jenis Kelamin: </label>
            <label><input type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki</label>
            <label><input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan</label><br>
        </div>
        </div>
       
        
        <div class="row"></div>
        <div class="col-lg-6">
            <label for="alamat">Alamat: </label>
            <textarea name="alamat" class="form-control"></textarea><br>
        </div>
        </div>
        
         
        <div class="row"></div>
        <div class="col-lg-6">
            <label for="tgl_masuk">Tgl Masuk: </label>
            <input type="date" name="tgl_masuk" class="form-control"><br>
        </div>
        </div>
        
        <br>
       
          <input type="submit" value="Simpan" name="simpan" class="btn btn-success"/>
        

        


    </form>
</div>
</div>


    </body>
</html>

<!-- if(isset($_POST['simpan'])){

		    // ambil data dari formulir
		    // $nama = $_POST['nama'];
		    // $alamat = $_POST['alamat'];
		    // $jk = $_POST['jenis_kelamin'];
		    // $agama = $_POST['agama'];
		    // $sekolah = $_POST['sekolah_asal'];
		    // $getId=mysqli_fetch_row(mysqli_query($this->koneksi,"select max(id) from siswa"));

				$id = $_POST['id'];
			    $nama = $_POST['nama'];
			    $jenis_kelamin = $_POST['jenis_kelamin'];
			    $alamat = $_POST['alamat'];
			    $tgl_masuk = $_POST['tgl_masuk'];
				    

		    // buat query
			$sql = "UPDATE siswa SET nama='$nama', jenis_kelamin='$jenis', alamat='$alamat', tgl_masuk='$tgl_masuk' WHERE id=$id";
		    // $sql = "INSERT INTO siswa (nim, nama, gender, tgl_lahir, alamat) VALUE ('$nim', '$nama', '$gender', '$tgl_lahir', '$alamat')";
		    $query = mysqli_query($this->koneksi, $sql);

		    // apakah query simpan berhasil?
		    if( $query ) {
		        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
		        header('Location: user.php?status=sukses');
		    } else {
		        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
		        die("Gagal menyimpan perubahan...");
		    }


		}else {
		    die("Akses dilarang...");
		}
	
?> -->