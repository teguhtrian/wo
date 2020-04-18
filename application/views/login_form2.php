<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.6">
  <title>Signin Template · Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('asset/bootstrap-4.4.1/css/bootstrap.min.css') ?>" rel="stylesheet">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }

    .form-signin .form-control:focus {
      z-index: 2;
    }

    .form-signin input[type="text"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }

    .form-signin input[name="unit"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[name="divisi"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Bagian JQUERY -->
  <script type="text/javascript" src="<?php echo base_url('asset/js/jquery-1.12.2.min.js'); ?>"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      $("#unit").change(function() {
        var unit = $("#unit").val();
        if (unit == "00") { //jika kantor pusat
          //$("#kepala").prop('selectedIndex',0);
          // alert(unit);
          $("#divisi").show();
          $.ajax({
            url: "<?php echo base_url(); ?>login/pilih_divisi/" + unit + "",
            success: function(html) {
              $("#subUnit").html(html);
            },
            dataType: "html"
          });
        } else {
          $("#divisi").hide();
        };
      });
    });
  </script>

</head>

<body class="text-center">
  <form class="form-signin" method="post" action="<?php echo base_url('login/auth'); ?>">
    <img class="mb-2" src="<?php echo base_url('asset/images/logo-old1.png') ?>" alt="" width="72">
    <h1 class="h3 mb-4 font-weight-light">Work Order Sistem</h1>
    <?php
    echo $this->session->flashdata('pesan');
    ?>
    <label for="inputEmail" class="sr-only">Nipp</label>
    <input type="text" id="nipp" name="nipp" class="form-control" placeholder="NIPP" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <select id="unit" name="unit" class="form-control" required>
      <option>-- Pilih Unit --</option>
      <?php
      foreach ($unit as $b) {
        echo '<option value="' . $b->kodeUnit . '">' . $b->namaUnit . '</option>';
      }
      ?>
    </select>
    <div id="divisi" style="display: none;">
      <select class="form-control" name="subUnit" id="subUnit">
        <option>-- Pilih Divisi --</option>
      </select>
    </div>
    <div class="checkbox mb-3 mt-3">
      <label>
        <input type="checkbox" value="remember-me"> Ingat Saya
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Masuk</button>
    <p class="mt-5 mb-3 text-muted">Copyright &copy; 2016 <br /> PDAM Tirtanadi - WORK ORDER SISTEM by APS</p>
  </form>
</body>

</html>