<?php include('server.php') ?>

<style type="text/css">

  *{
  	text-align:center;
  }

  .results tr[visible='false'],
  .no-result{
    display:none;
  }

  .results tr[visible='true']{
    display:table-row;
  }

  .counter{
    padding:8px; 
    color:#ccc;
  }
  hr.star-light:after {
    color: #fff;
    background-color: #e64398!important;

</style>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Layanan AJS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
   <!--  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

  </head>

  <body id="page-top">

    <!-- Navigation -->
        <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="" style="background-color: #27064C!important;">
      <div class="container" style="color: #F65E4A !important;">
        <a class="navbar-brand js-scroll-trigger" href="index.php" style="color: #F65E4A !important; font-size: 1.5em;"><strong>BERANDA</strong></a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" >
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <?php  if (isset($_SESSION['username'])) : ?>
                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger">Hi <strong><?php echo $_SESSION['username']; ?>!</strong></a>
                <?php endif ?>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="profile.php" style="color: #FFB85C !important;"><strong>Profil</strong></a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php" style="color: #FFB85C !important;"><strong>Informasi</strong></a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <?php  if (isset($_SESSION['username'])) : ?>
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?logout='1'" style="color: #FFB85C !important;"><strong>Keluar</strong></a>
              <?php endif ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead text-white text-center" style="padding-top: 120px; background-color: #e64398; max-height: 100vh;">
      <div class="container">
        <h1 class="text-uppercase mb-0" style="font-size: 50px;">Penumpang</h1><br>
        <div class="w3-row" style="font-size: 1.5em;">
          <a href="javascript:void(0)" onclick="openCity(event, 'London');">
             <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"  style="display: inline-block;padding: 2em;"><img src="https://image.flaticon.com/icons/svg/206/206853.svg" style="width: 200px"><p style="color: #fff;">Tabel Penumpang</p></div>
          </a>
          <a href="javascript:void(0)" onclick="openCity(event, 'Paris');">
             <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"  style="display: inline-block;padding: 2em;"><img src="http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Student-3-icon.png" style="width: 200px"><p style="color: #fff;">Daftar Penumpang Tiap Sekolah</p></div>
          </a>
        </div>
      </div>
    </header>

    <div class="w3-container">

  <div id="London" class="w3-container city" style="display:none">
    <div class="container">
      <br>

      <table class="table table-hover table-bordered results">
         <?php
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $result = mysqli_query($db,"SELECT p_id, p_nama, p_gender, tj_daerah, p_telp, tt_deskripsi
       FROM penumpang JOIN titik_jemput USING (tj_id) 
       JOIN titik_tujuan USING (tt_id)
       ORDER BY p_id");
          ?>

        <span class="counter pull-right"></span>
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Telp</th>
            <th scope="col">Gender</th>
            <th scope="col">Daerah</th>
            <th scope="col">Sekolah</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              while($row = mysqli_fetch_array($result))
              {
                $idd=$row['p_id'];
                $_SESSION['hm']=$idd;
                echo "<tr>";
                echo "<td>" . $row['p_id'] . "</td>";
                echo "<td>" . $row['p_nama'] . "</td>";
                echo "<td>" . $row['p_telp'] . "</td>";
                echo "<td>" . $row['p_gender'] . "</td>";
                echo "<td>" . $row['tj_daerah'] . "</td>";
                echo "<td>" . $row['tt_deskripsi'] . "</td>";
                echo"<td><a href='updatepenumpang.php?id=". $idd ."'><button class='btn btn-success' data-id='$idd'>Update</button></a></td>";
                echo"<td><a href='server.php?iddelete=". $idd ."'><button class='btn btn-danger' data-id='$idd'>Delete</button></a></td>";
                echo "</tr>";
              }
              // mysqli_close($db);
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>


  <div id="Paris" class="w3-container city" style="display:none">
    <div class="container">
      <br><br>
      <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="GET">
        <div class="input-group" style="display: flex; justify-content: center;">
          <input id="user" type="text" placeholder="Daftar Sekolah" disabled>
          <select name="sekolah">
          <option selected hidden>SMA Negeri 1</option>
          <?php
            $categorylist_sql1="SELECT DISTINCT tt_deskripsi FROM titik_tujuan";
            $categorylist_query1=mysqli_query($db, $categorylist_sql1);
            $categorylist_rs1=mysqli_fetch_assoc($categorylist_query1);
            do{ 
          ?>
          <option>
          <?php
            echo $categorylist_rs1['tt_deskripsi'];
          ?>
          </option>
            <?php
          } while($categorylist_rs1=mysqli_fetch_assoc($categorylist_query1));
          ?>
          </select>
        </div>
        <br><br>
        <div class="form-group">
          <div class="col-sm-12 controls" style="display: flex; justify-content: center;">
            <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i>Lihat Daftar Siswa</button>
          </div>
        </div>
      </form>

      <table class="table table-hover table-bordered results">
         <?php
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $sekolah = mysqli_real_escape_string($db, $_GET['sekolah']);
          $result = mysqli_query($db,"SELECT p_nama, tt_deskripsi FROM penumpang JOIN titik_tujuan USING (tt_id) WHERE tt_deskripsi = '$sekolah'");
          ?>

        <span class="counter pull-right"></span>
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Sekolah</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $i = 1;
              while($row = mysqli_fetch_array($result))
              {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['p_nama'] . "</td>";
                echo "<td>" . $row['tt_deskripsi'] . "</td>";
                echo "</tr>";
                $i++;
              }
              // mysqli_close($db);
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


    <!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Lokasi</h4>
            <p class="lead mb-0">Arief Rahman Hakim 48B
              <br>Surabaya, 60111</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Hubungi Kami</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-google-plus"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-twitter"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">Tentang Kami</h4>
            <p class="lead mb-0">Layanan jasa antar jemput sekolah-sekolah di daerah Surabaya.</p>
          </div>
        </div>
      </div>
    </footer>


    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Nufaroza 2018</small>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
      });
});

  function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}
</script>