<h1>Input Data Work Order</h1><hr/>
<?php echo form_open('wo/tambah_wo',array('onSubmit'=>'return validasi()'));?>

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
                <option value="0">-- Pilih Departemen --</option>';
                foreach($departemen as $b){
                        echo '<option value="'.$b->id.'">'.$b->namaDepartemen.'</option>';
                    };
echo '      </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">SOP :</label>
        <div class="col-sm-7">
            <select class="form-control" id="sop" name="idSop" onChange="tampilSla()">
                <option value="0">-- Pilih SOP --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">Lama Waktu (SLA) :</label>
        <div class="col-sm-5">
            <select class="form-control" id="sla" name="idSla">
                <option value="0">-- Pilih Waktu --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Nama Work Order :</label>
        <div class="col-sm-5">
            <input type="text" id="wo" name="namaWo" class="form-control" placeholder="Nama Work Order"></input>
        </div>
    </div>';
}else{
echo '<div class="row top-buffer">
    <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
        <select class="form-control" id="unit" name="kodeUnit" onChange="tampilDept()">
            <option value="0">-- Pilih Unit --</option>';
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
                <option value="0">-- Pilih Departemen --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">SOP :</label>
        <div class="col-sm-7">
            <select class="form-control" id="sop" name="idSop" onChange="tampilSla()">
                <option value="0">-- Pilih SOP --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">Lama Waktu (SLA) :</label>
        <div class="col-sm-5">
            <select class="form-control" id="sla" name="idSla">
                <option value="0">-- Pilih Waktu --</option>
            </select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Nama Work Order :</label>
        <div class="col-sm-5">
            <input type="text" id="wo" name="namaWo" class="form-control" placeholder="Nama Work Order"></input>
        </div>
    </div>';
}

?>

<div class="row top-buffer">
    <label class="col-sm-2 control-label">Jenis Pekerjaan :</label>
    <div class="col-sm-5">
        <div class="radio">
            <label><input type="radio" value="umum-0" id="jenper" name="jenper">Umum</label>
        </div>
        <div class="radio">
            <label><input type="radio" value="rutin-1" id="jenper" name="jenper">Rutinitas (Menggunakan Volume)</label>
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

function validasi(){
    var unit=$("#unit").val();
    var sop=$("#sop").val();
    var dept=$("#dept").val();
    var wo=$("#wo").val();
    var jenper=$("#jenper:checked").val();
    //alert(jenper);return false;

    if(unit == null || unit == 0 || sop == 0 || dept == 0 || sop == null || dept == null || wo == 0 || wo == null || jenper == null){
        alert('Lengkapi Data Work Order');
        return false;
    }
}
</script>