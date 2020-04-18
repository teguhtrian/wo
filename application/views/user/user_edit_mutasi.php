<body>
<div class="col-sm-12">
<h1>Edit Data User</h1><hr/>
    <?php echo form_open('user/editMutasi');?>
    <input type="text" name="nipp" hidden="hidden" value="<?php echo $this->uri->segment(3);?>"></input>
    <div class="row">
        <label class="col-sm-2 control-label">NIPP :</label>
        <div class="col-sm-5">
            <input type="text" name="nipp" class="form-control" placeholder="NIPP" value="<?php echo $record['nipp']?>" disabled></input>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Nama User :</label>
        <div class="col-sm-5">
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama User" value="<?php echo $record['nama']?>"></input>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
            <select class="form-control" name="kodeUnit" id="kodeUnit" onchange="tampilDept()" <?php echo $this->session->userdata('role')=='sa'?'':'disabled';?>>
                <option>-- Pilih Unit --</option>
                <?php
                    foreach($unit as $b){
                        echo '<option value="'.$b->kodeUnit.'" ';
                        echo $this->session->userdata('kodeUnit')===$b->kodeUnit?'selected':'';
                        echo '>'.$b->namaUnit.'</option>';
                    }
                ?>
            </select>
            <?php
                if($this->session->userdata('kodeRoled')!='sa'){
                    echo '<input name="kodeUnit" value="'.$this->session->userdata('kodeUnit').'"" hidden></input>';
                }
            ?>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Departemen :</label>
        <div class="col-sm-5">
            <select class="form-control" name="idDepartemen" id="idDepartemen">
                <option value="0">-- Pilih Departemen --</option>
                <?php
                    foreach($departemen as $b){
                        echo '<option value="'.$b->id.'" ';
                        echo $record['idDepartemen']==$b->id?'selected':'';
                        echo '>'.$b->namaDepartemen.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="row top-buffer">
     <label class="col-sm-2 control-label">Role :</label>
        <div class="radio">

            <?php
                if($this->session->userdata('role')=='sa'){
                    //disini if cek untuk sa
                    echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="sa-1">Super Admin</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="ac-2">Admin Cabang</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="dir-3">Direksi</label>';
                    echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kdiv-4">Kepala Divisi</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbid-6">Kepala Bidang</label>';
                    echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kcab-5">Kepala Cabang</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbag-7">Kepala Bagian</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
                }else if($this->session->userdata('role')=='ad'){
                    //disini if cek untuk ad
                    echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kdiv-4">Kepala Divisi</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbid-6">Kepala Bidang</label>';
                    echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
                }else if($this->session->userdata('kodeUnit')!='00'){
                    //disini if cek untuk cabang
                    echo $record['kodeRole']=='kcab'?'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kcab-5" checked>Kepala Cabang</label>':'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kcab-5">Kepala Cabang</label>';
                    echo $record['kodeRole']=='kbag'?'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbag-7" checked>Kepala Bagian</label>':'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbag-7">Kepala Bagian</label>';
                    echo $record['kodeRole']=='peg'?'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8" checked>Pegawai</label>':'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
                    echo $record['kodeRole']=='cs'?'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9" checked>Customer Service</label>':'<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>';
                    /*
                    echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kcab-6">Kepala Cabang</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbag-7">Kepala Bagian</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
                    */
                }else{
                    //disini if cek untuk kantor pusat/divisi
                    echo '<label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kdiv-4">Kepala Divisi</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="kbid-6">Kepala Bidang</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="cs-9">Customer Service</label>
                    <label class="radio-inline"><input id="role" type="radio" name="kodeRole" value="peg-8">Pegawai</label>';
                }
            ?>
            <!--Buat if untuk super admin
            <label class="radio-inline"><input type="radio" name="kodeRole" value="sa" 
            <?php echo $record['kodeRole']=='sa'?'checked':'';?>>Super Admin</label>
            <!--sampai disini
            <label class="radio-inline"><input type="radio" name="kodeRole" value="ac"
            <?php echo $record['kodeRole']=='ac'?'checked':'';?>>Admin Cabang</label>
            <label class="radio-inline"><input type="radio" name="kodeRole" value="dir"
            <?php echo $record['kodeRole']=='dir'?'checked':'';?>>Direksi</label>
            <label class="radio-inline"><input type="radio" name="kodeRole" value="kdiv"
            <?php echo $record['kodeRole']=='kdiv'?'checked':'';?>>Kepala Divisi</label>
            <label class="radio-inline"><input type="radio" name="kodeRole" value="kcab"
            <?php echo $record['kodeRole']=='kcab'?'checked':'';?>>Kepala Cabang</label>
            <label class="radio-inline"><input type="radio" name="kodeRole" value="kbid"
            <?php echo $record['kodeRole']=='kbid'?'checked':'';?>>Kepala Bidang</label>
            <label class="radio-inline"><input type="radio" name="kodeRole" value="kbag"
            <?php echo $record['kodeRole']=='kbag'?'checked':'';?>>Kepala Bagian</label>
            <label class="radio-inline"><input type="radio" name="kodeRole" value="cs"
            <?php echo $record['kodeRole']=='cs'?'checked':'';?>>Customer Service</label>
            <label class="radio-inline"><input type="radio" name="kodeRole" value="peg-8"
            <?php echo $record['kodeRole']=='peg'?'checked':'';?>>Pegawai</label>
            -->
        </div> 
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
    <input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
    </form>    
    </div>    
</body>

<script type="text/javascript">
function tampilDept(){
    var unit=$("#kodeUnit").val();
    $.ajax({
        url:"<?php echo base_url();?>departemen/pilih_dept/"+unit+"",
        success: function(html){
            $("#idDepartemen").html(html);
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
</script>