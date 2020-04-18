<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Work Order | Login</title>
    <link rel="icon" href="<?php echo base_url('asset/images/favicon.png')?>">
    <link href="<?php echo base_url('asset/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url('asset/css/bootstrap.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('asset/js/jquery-1.12.2.min.js');?>"></script>

    <!-- Bagian JQUERY -->
    <script type="text/javascript">

    $(document).ready(function(){

        $("#unit").change(function(){
            var unit = $("#unit").val();
            if(unit == "00"){ //jika kantor pusat
                //$("#kepala").prop('selectedIndex',0);
                // alert(unit);
                $("#divisi").show();
                $.ajax({
                    url:"<?php echo base_url();?>login/pilih_divisi/"+unit+"",
                    success: function(html){
                        $("#subUnit").html(html);
                    },
                    dataType:"html"
                });
            };          
        });       
    });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-5">
            <div class="form-login">
                <!-- <?php //echo form_open('login/auth'); die?> -->
                <form class="form-login" method="post" action="<?php echo base_url('login/auth'); ?>">
                    <b><h2 align="center">Work Order Sistem</h2></b>
                    <center><img src=<?php echo base_url('asset/images/logo.png')?>></center>
                    </br>
                    </br>
                    <input type="username" name="nipp" id="username" class="form-control" placeholder="NIPP" required autofocus/>
                    </br>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required/>
                    </br>
                    <select id="unit" name="unit" class="form-control" required>
                        <option>-- Pilih Unit --</option>
                        <?php
                            foreach($unit as $b){
                                echo '<option value="'.$b->kodeUnit.'">'.$b->namaUnit.'</option>';
                            }
                        ?>
                    </select>
                    <br/>
                    <div id="divisi" hidden>
                        <select class="form-control" name="subUnit" id="subUnit">
                            <option>-- Pilih Divisi --</option>
                        </select>
                    </div>
        			</br>
                    <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Masuk</button>
                </form> 
            </div>
        </div>
    </div>
</div>
</body>