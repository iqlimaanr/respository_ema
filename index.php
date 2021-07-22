<?php
include("config.php");
session_start();
if (!isset($_SESSION['username'])){
header ("location:login.php");
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Buku Tamu</title>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    <link href="css/bootstrap.css" rel="stylesheet">

</head>
<body style="background-image: url(img/bg3.jpg); background-size: cover; no-repeat; background-attachment:fixed;">
<header class="container-fluid">
        <div class="row">
        <div class="col-12 py-3 text-left" style="background-color: #add8e6">
            <a href="#"><img src="img/logo.png" alt="judul" height="80px" width="500px">
        </div>
</header>    
<font face="Century Gothic">    
    <nav class="navbar navbar-default navbar-light bg-primary">
    <div class="container">
          <div class="col-12 py-3">
            <a class="navbar-brand" href="index.php">Halaman utama</a>
            </div>
            <div>
            <ul class="nav navbar-nav">
                    <li><a href="data_terakhir.php">Data Terakhir</a></li>
                    <li><a href="data1.php">Data Buku Tamu</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="daftar.php"><span class="glyphicon glyphicon-user"></span>  Tambah User</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
            </ul>
            </div>
    </div>
    </nav>
     
<div class="container">
    <main class="container border">
        <div class="row">
        <div class="col-md-8 py-5">
        <div id="card">
        <div id="card-content">  
        <h3>Form Buku Tamu</h3>
        <br>
        <form class="form-horizontal" method="post" action="index.php" >
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" required>
                </div>
            </div>    
            <div class="form-group">
                <label class="col-sm-3 control-label">Instansi</label>
                <div class="col-sm-9">
                    <input type="text" name="instansi" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Nomor Telp</label>
                <div class="col-sm-9">
                    <input type="text" name="notelp" class="form-control" required>
                </div>
            </div>
			<div class="form-group">
                <label class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-9">
                    <input type="text" name="alamat" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Kepentingan</label>
                <div class="col-sm-9">
                <input type="text" name="kepentingan" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Jam masuk</label>
                <div class="col-sm-3">
                    <input type="time" name="jam_masuk" class="form-control">
                </div>
                <label class="col-sm-3 control-label">Jam keluar</label>
                <div class="col-sm-3">
                    <input type="time" name="jam_keluar" class="form-control">
                </div>   
            </div>
            <div class="col-sm-12 text-center">
                    <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="SIMPAN" onClick="simpan()">
            </form>
            </div>
            </div>
</div>
         </div> <!-- tutup md -->
        <div class="col-md-4 py-5">
           <center>
            <div id="my_camera"></div>
            <br>
            <div id="webcam" >
            <input type=button class="btn btn-warning" value="Take Snapshot" onClick="preview()">
            </div>
            <div id="simpan" style="display:none">
             <input type=button class="btn btn-danger" value="Remove" onClick="batal()">
            </div>
           </center>
        </div>
        </div>
    </main>
</div>


<style>
#my_camera{
 width: 320px;
 height: 240px;
 border: 2px solid black;
 border-radius: 8px;
 box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
}

#card {
        background: #fbfbfb;
        border-radius: 8px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 455px;
        width: 590px;
}

#card-content {
      padding: 5px 30px 12px 30px;
}      
</style>

<script type="text/javascript" src="webcam.js"></script>
<script language="JavaScript">
 Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90
 });
 Webcam.attach( '#my_camera' );

 function preview() {
            Webcam.freeze();
            document.getElementById('webcam').style.display = 'none';
            document.getElementById('simpan').style.display = '';
        }
        
function batal() {
            Webcam.unfreeze();
            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
        }

function simpan() {
Webcam.snap( function(data_uri) {
    Webcam.upload( data_uri, 'index.php', function(code, text,Name) {
                document.getElementById('preview').innerHTML = 
                    '' + 
			'<img src="' + data_uri + '"style=" width: 320px;">';
 } );
  
  
 } );
}
</script>
    <?php
        $nama       = $koneksi->real_escape_string($_POST['nama']);
        $instansi     = $koneksi->real_escape_string($_POST['instansi']);
        $notelp        = $koneksi->real_escape_string($_POST['notelp']);
        $alamat       = $koneksi->real_escape_string($_POST['alamat']);
        $kepentingan   = $koneksi->real_escape_string($_POST['kepentingan']);
        $tanggal    = date('Y-m-d');
        $jam_masuk  = date('H:i:sa');
        $jam_keluar  = $koneksi->real_escape_string($_POST['jam_keluar']);
        $filename =  time() . '.jpg';
        $filepath = 'images/';
        
        if(!is_dir($filepath))
	    mkdir($filepath);
        if(isset($_FILES['webcam'])){	
	    move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$filename);
 	    echo $filepath.$filename;
            }

        if($_POST['submit']){
			$input = $koneksi->query("INSERT INTO buku_tamu(tanggal, nama,instansi,notelp,alamat,kepentingan, camera, jam_masuk, jam_keluar) VALUES('$tanggal','$nama','$instansi','$notelp','$alamat','$kepentingan','$filename','$jam_masuk','$jam_keluar')") or die($koneksi->error);
			if($input){
				echo "<script>alert('Data berhasil disimpan')</script>";
                echo "<meta http-equiv='refresh' content='1 url=index.php'>";
			}
            else{
				echo "<script>alert('Gagal menyimpan data')</script>";
                echo "<meta http-equiv='refresh' content='1 url=index.php'>";
			}
		}
    ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>