<?php
  //koneksi Database
  $server  = "localhost";
  $user = "root";
  $password = "";
  $database = "crudstefani";

  $koneksi = mysqli_connect($server, $user, $password, $database) or die (mysqli_error($koneksi));

  //jika tombol simpan di klik
  if(isset($_POST['bsimpan']))
  {
    //pengujian apakah data dapat diedit atau disimpan baru
    if($_GET['hal'] == "edit")
    {
      //Data akan diedit
      $edit = mysqli_query($koneksi, "UPDATE crud2021 Set 
                                        nim = '$_POST[tnim]',
                                        nama = '$_POST[tnama]',
                                        alamat = '$_POST[talamat]',
                                        prodi = '$_POST[tprodi]',
                                        jk = '$_POST[tjeniskelamin]',
                                        umur = '$_POST[tumur]'
                                      WHERE no = '$_GET[id]'
                                     ");
    if ($edit) // jika edit sukses
      {echo "<script>
              alert('edit Data Sukses!');
              document.location = 'index.php';
            </script>";
      }
      else
      {
        echo "<script>
              alert('edit Data Gagal!');
              document.location = 'index.php';
            </script>";
      }
    }else
    {
      //Data akan disimpan baru
      $simpan = mysqli_query($koneksi, "INSERT INTO crud2021 (nim, nama, alamat, prodi, jk, umur)
                                     VALUES ('$_POST[tnim]', 
                                            '$_POST[tnama]', 
                                            '$_POST[talamat]', 
                                            '$_POST[tprodi]', 
                                            '$_POST[tjeniskelamin]', 
                                            '$_POST[tumur]')
                                     ");
    if ($simpan) // jika simpan sukses
      {echo "<script>
              alert('simpan Data Sukses!');
              document.location = 'index.php';
            </script>";
      }
      else
      {
        echo "<script>
              alert('simpan Data Gagal!');
              document.location = 'index.php';
            </script>";
      }
    }

  }
  //Pengujian jika tombol edit / hapus di klik
  if(isset($_GET['hal']))
  {
    //pengujian data yang akan di edit
    if($_GET['hal'] == "edit")
    {
      // Tampilkan data yang akan di edit
      $tampil = mysqli_query($koneksi, "SELECT * FROM crud2021 WHERE no = '$_GET[id]' ");
      $data = mysqli_fetch_array($tampil);
      if($data)
      {
        //jika data ditemukan maka data ditampung dulu di variabel
        $vnim = $data['nim'];
        $vnama = $data['nama'];
        $valamat = $data['alamat'];
        $vprodi = $data['prodi'];
        $vjeniskelamin = $data['jk'];
        $vumur = $data['umur'];
      }
    }
    if($_GET['hal'] == "hapus")
    {
      //Persiapan Hapus Data
      $hapus = mysqli_query($koneksi, "DELETE FROM crud2021 WHERE no = '$_GET[id]' ");
      if($hapus)
      {
        echo "<script>
              alert('hapus Data Sukses!');
              document.location = 'index.php';
            </script>";
      }
      }
    }


?>


<!DOCTYPE html>
<html>
<head>
  <title>CRUD 2022 STEFANI KABANGUNANG</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

<h1 class="text-center">WEB STEFANI</h1>
<h2 class="text-center">STEFANI KABANGUNANG</h2>

<!-- Awal Ca Form -->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    Form Input Data Mahasiswa
  </div>
  <div class="card-body">
   <form method="post" action="">
    <div class="form-group">
        <label>Nim</label>
        <input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="Input Nim Anda Di Sini!" required>
      </div>


  <div class="form-group">
        <label>Nama</label>
        <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama Anda Di Sini!" required>
      </div>


  <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" name="talamat" placeholder=" Input Alamat Anda Di Sini!"><?=@$valamat?></textarea>
      </div>

    <div class="form-group">
        <label>Program Studi</label>
        <select class="form-control" name="tprodi"> 
          <option value="<?=@$vprodi?>"><?=@$vprodi?></option>
          <option value="D3-Sistem Informasi">Sistem Informasi</option>
          <option value="D3-Perikanan">Perikanan dan Kebaharian</option>
          <option value="D3-Keperawatan">Keperawatan</option>
        </select>

  <div class="form-group">
        <label>Jenis Kelamin</label>
        <select class="form-control" name="tjeniskelamin">
          <option value="<?=@$vjeniskelamin?>"><?=@$vjeniskelamin?></option>
          <option value="Pria">Pria</option>
          <option value="Wanita">Wanita</option>
        </select>

  <div class="form-group">
        <label>Umur</label>
        <input type="text" name="tumur" value="<?=@$vumur?>" class="form-control" placeholder="Input Umur Anda Di Sini!" required>
      </div>

      </div>

      <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
      <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>
   </form>
  </div>
</div>
<!-- Akhir Card Form -->
</div>
<!-- Awal Card Tabel -->
<div class="card mt-3">
  <div class="card-header bg-success text-white ">
    Daftar Mahasiswa
  </div>
  <div class="card-body">

    <table class="table table-bordered table-striped">
      <tr>
        <th>No.</th>
        <th>Nim</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Program Studi</th>
        <th>Jenis Kelamin</th>
        <th>Umur</th>
        <th>Aksi</th>
      </tr>
      <?php
          $no=1;
          $tampil = mysqli_query($koneksi, "select * from crud2021 order by no asc");
          while ($data = mysqli_fetch_array($tampil)):

      ?>
      <tr>
        <td><?=$no++?></td>
        <td><?=$data['nim']?></td>
        <td><?=$data['nama']?></td>
        <td><?=$data['alamat']?></td>
        <td><?=$data['prodi']?></td>
        <td><?=$data['jk']?></td>
        <td><?=$data['umur']?></td>
        <td>
          <a href="index.php?hal=edit&id=<?=$data['no']?>" class="btn btn-success"> Edit </a>
          <a href="index.php?hal=hapus&id=<?=$data['no']?>" 
            onclick ="return confirm('Apakah Yakin Data ini akan dihapus?')" class="btn btn-danger"> Hapus </a>
        </td>

      </tr>
    <?php endwhile; // penutup perulangan while?>
    </table>

  </div>
</div>
<!-- Akhir Card Tabel -->

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>