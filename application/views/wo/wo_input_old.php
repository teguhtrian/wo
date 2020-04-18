<h1>Input Data Work Order</h1><hr/>
<?php echo form_open('wo/tambah_wo');?>

<?php
if($this->session->userdata('role')!='sa'){
echo '<div class="row top-buffer">
    <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
        <select class="form-control" id="unit" name="kodeUnit" disabled>
            <option>-- Pilih Unit --</option>';
                foreach($unit as $b){
                        if($b->kodeUnit == $this->session->userdata('kodeUnit')){
                            echo '<option name="kodeUnit" value="'.$b->kodeUnit.'" selected>'.$b->namaUnit.'</option>';
                            echo '<input name="kodeUnit" value="'.$b->kodeUnit.'" hidden></input>';
                        }
                    };
echo '  </select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Departemen :</label>
        <div class="col-sm-5">
            <select class="form-control" id="dept" name="idDepartemen" onChange="tampilSOP()">
                <option>-- Pilih Departemen --</option>';
                foreach($departemen as $b){
                        echo '<option value="'.$b->id.'">'.$b->namaDepartemen.'</option>';
                    };
echo '      </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">SOP :</label>
        <div class="col-sm-7">
            <select class="form-control" id="sop" name="id_sop" onChange="tampilSla()">
                <option>-- Pilih SOP --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">Lama Waktu :</label>
        <div class="col-sm-5">
            <select class="form-control" id="sla" name="id_sla">
                <option>-- Pilih Waktu --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Nama Work Order :</label>
        <div class="col-sm-5">
            <input type="text" name="nama_wo" class="form-control" placeholder="Nama Work Order"></input>
        </div>
    </div>';
}else{
echo '<div class="row top-buffer">
    <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
        <select class="form-control" id="unit" name="kodeUnit" onChange="tampilDept()">
            <option>-- Pilih Unit --</option>';
                foreach($unit as $b){
                        echo '<option value="'.$b->kodeUnit.'">'.$b->namaUnit.'</option>';
                    };
echo '  </select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Departemen :</label>
        <div class="col-sm-5">
            <select class="form-control" id="dept" name="idDepartemen" onChange="tampilSOP()">
                <option>-- Pilih Departemen --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">SOP :</label>
        <div class="col-sm-7">
            <select class="form-control" id="sop" name="id_sop" onChange="tampilSla()">
                <option>-- Pilih SOP --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">Lama Waktu :</label>
        <div class="col-sm-5">
            <select class="form-control" id="sla" name="id_sla">
                <option>-- Pilih Waktu --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Nama Work Order :</label>
        <div class="col-sm-5">
            <input type="text" name="nama_wo" class="form-control" placeholder="Nama Work Order"></input>
        </div>
    </div>';
}

?>

<div class="row top-buffer">
    <label class="col-sm-2 control-label">Jenis Pekerjaan :</label>
    <div class="col-sm-5">
        <div class="radio">
            <label><input type="radio" value="umum" name="jenper">Umum</label>
        </div>
        <div class="radio">
            <label><input type="radio" value="rutin" name="jenper">Rutinitas (Menggunakan Volume)</label>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
</form>
<script type="text/javascript">

function tampilDept(){
    $("#dept").prop('selectedIndex',0);
    $("#sop").prop('selectedIndex',0);
    $("#sla").prop('selectedIndex',0);
    var unit=$("#unit").val();
    $.ajax({
         url:"<?php echo base_url();?>departemen/pilih_dept/"+unit+"",
        success: function(html){
            $("#dept").html(html);
        },
        dataType:"html"       
    })
}

function tampilSOP(){
    $("#sla").prop('selectedIndex',0);
    var unit=$("#unit").val();
    var dept=$("#dept").val();
    //alert(dept);
    $.ajax({
        url:"<?php echo base_url();?>sop/pilih_sop/"+unit+"/"+dept+"",
        success: function(html){
            $("#sop").html(html);
        },
        dataType:"html"
    });
}

function tampilSla(){
    var dept=$("#dept").val();
    //var unit=$("#unit").val();
    $.ajax({
        //url:"<?php echo base_url();?>sla/pilih_sla/"+unit+"/"+dept+"",
		url:"<?php echo base_url();?>tiket/pilihSlaByDept/"+dept+"",
        success: function(html){
            $("#sla").html(html);
        },
        dataType:"html"
    });
}
</script>