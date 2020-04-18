<h1>Input Data SLA/SPM (Standard Pelayanan Minimum)</h1><hr/>
<?php echo form_open('sla/tambah_sla');?>
<div class="row">
    <label class="col-sm-2 control-label">Jumlah Angka :</label>
    <div class="col-sm-5">
        <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Angka"></input>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Satuan :</label>
    <div class="col-sm-5">
        <select class="form-control" name="satuan">
            <option>-- Pilih Satuan --</option>
            <option value="0">Detik</option>
            <option value="1">Menit</option>
            <option value="2">Jam</option>
            <option value="3">Hari</option>
        </select>
    </div>
</div>

<?php
if($this->session->userdata('role')!='sa'){
    echo '<div class="row top-buffer">
        <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
            <select class="form-control" name="kodeUnit" disabled>
                <option>-- Pilih Unit --</option>';
                foreach($unit as $b){
                        if($b->kodeUnit === $this->session->userdata('kodeUnit')){
                            echo '<option value="'.$b->kodeUnit.'" selected>'.$b->namaUnit.'</option>';
                            echo '<input name="kodeUnit" value="'.$b->kodeUnit.'" hidden></input>';
                        }
                    }
    echo    '</select>
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Departemen :</label>
        <div class="col-sm-5">
            <select class="form-control" name="idDepartemen" >
                <option>-- Pilih Departemen --</option>';
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
            <select class="form-control" name="kodeUnit" id="unit" onChange="tampilDept()">
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
            <select class="form-control" name="idDepartemen" id="dept">
                <option>-- Pilih Departemen --</option>
            </select>
        </div>
    </div>';
}
?>
<br><br>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
</form>

<script type="text/javascript">

function tampilDept(){
    var unit=$("#kodeUnit").val();
    $.ajax({
        url:"<?php echo base_url();?>departemen/pilih_dept/"+unit+"",
        success: function(html){
            $("#dept").html(html);
        },
        dataType:"html"
    })
}

</script>