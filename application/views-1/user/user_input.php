<body>
<h1>Input Data User</h1><hr/>
<?php echo form_open('user/tambah_user',array('onSubmit'=>'return validasi()'));?>
<div class="row">
    <label class="col-sm-2 control-label">NIPP :</label>
    <div class="col-sm-5">
        <input type="text" id="nipp" name="nipp" class="form-control" placeholder="NIPP"></input>
        <div id="status" name="status"></div>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Nama User :</label>
    <div class="col-sm-5">
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama User"></input>
    </div>
</div>

<?php
if($this->session->userdata('role')!='sa'){
    echo '<div class="row top-buffer">
        <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
            <select class="form-control" id="kodeUnit" name="kodeUnit" disabled>
                <option>-- Pilih Unit --</option>';
                foreach($unit as $b){
                        if($b->kodeUnit === $this->session->userdata('kodeUnit')){
                            echo '<option value="'.$b->kodeUnit.'" selected>'.$b->namaUnit.'</option>';
                            echo '<input type="hidden" name="kodeUnit" value="'.$b->kodeUnit.'""></input>';
                        }
                    }
    echo    '</select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Departemen :</label>
        <div class="col-sm-5">
            <select class="form-control" id="id_dept" name="idDepartemen">
                <option value="0">-- Pilih Departemen --</option>';
                foreach($departemen as $b){
                            echo '<option value="'.$b->id.'">'.$b->namaDepartemen.'</option>';
                    };
    echo    '</select>
        </div>
    </div>';
}else{
    echo '<div class="row top-buffer">
        <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
            <select class="form-control" id="kodeUnit" name="kodeUnit" id="unit" onChange="tampilDept()">
                <option>-- Pilih Unit --</option>';
                foreach($unit as $b){
                        echo '<option value="'.$b->kodeUnit.'">'.$b->namaUnit.'</option>';
                    }
    echo    '</select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Departemen :</label>
        <div class="col-sm-5">
            <select class="form-control" id="id_dept" name="idDepartemen" id="dept">
                <option>-- Pilih Departemen --</option>
            </select>
        </div>
    </div>';
}
?>

<div class="row top-buffer">
 <label class="col-sm-2 control-label">Role :</label>
    <div class="radio">
    <?php
    if($this->session->userdata('role')=='sa'){
        echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="sa-1">Super Admin</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="ac-2">Admin Cabang</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="dir-3">Direksi</label>';
        echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kdiv-4">Kepala Divisi</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbid-6">Kepala Bidang</label>';
        echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kcab-5">Kepala Cabang</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbag-7">Kepala Bagian</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
    }else if($this->session->userdata('role')=='ac'){
        echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kcab-5">Kepala Cabang</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbag-7">Kepala Bagian</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
    }else{
        echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kdiv-4">Kepala Divisi</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbid-6">Kepala Bidang</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>
        <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
    }
    ?>
    </div> 
</div>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
<?php echo form_close()?>

<script type="text/javascript">

function tampilDept(){
    var unit=$("#kodeUnit").val();
    $.ajax({
        url:"<?php echo base_url();?>departemen/pilih_dept/"+unit+"",
        success: function(html){
            $("#id_dept").html(html);
        },
        dataType:"html"
    })
}

function validasi(){
    if($("#nipp").val()==''||$("#nama").val()==''||$("#kodeUnit").val()==''||$("#id_dept").val()==''||$("#role").val()==''||$('#statval').val()!='ok'){
        alert($('#id_dept').val());
        return false;
    }
}

$(document).ready(function(){
    $('#nipp').change(function(){
        var nipp=$('#nipp').val();
        if(nipp.length>='1'){
            $('#status').html('Memeriksa NIPP...');

            $.ajax({
                type:"POST",
                url:"<?php echo base_url();?>user/ceknipp/"+nipp+"",
                dataType:"html",
                success: function(html){
                    $("#status").html(html);
                }
            });
        }else{
            $("#status").html('<font color="red">'+
                'NIPP harus <strong>8 karakter</strong></font>');
        }
    });
});

/*
$("#nipp").typeahead({
    source: function(query,process){
        data=[];
        map={};
        var source=[];

        $.getJSON('http://localhost/wo/home/test/'+query, function(result){
            source=result;
            $.each(source, function(i,dt){
                map[dt.nama]=dt;
                data.push(dt.nama);
            });
            process(data);
        });
    },
    minlenght:3;
    updater:function(item){
        selectedItem=map[item].id;
        return item;
    }
});
*/
</script>
</body>