<body>
<h1>Input Data SOP</h1><hr/>
<?php echo form_open('sop/tambah_sop');?>
<div class="row">
    <label class="col-sm-2 control-label">Nama SOP :</label>
    <div class="col-sm-5">
        <input type="text" name="namaSop" class="form-control" placeholder="Nama SOP"></input>
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
                        if($b->kodeUnit == $this->session->userdata('kodeUnit')){
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
<br>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
</form>
<script type="text/javascript">

function tampilDept(){
    var unit=$("#unit").val();
    alert(unit);
    $.ajax({
        url:"<?php echo base_url();?>departemen/pilih_dept/"+unit+"",
        success: function(html){
            $("#dept").html(html);
        },
        dataType:"html"
    })
}

</script>
</body>