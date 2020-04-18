<body>
    <div class="col-sm-12">
    <h1>Input Data Departemen</h1><hr/>
    <?php echo form_open('departemen/tambah_departemen',array('onSubmit'=>'return validasi()'));?>
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label">Nama Departemen :</label>
                <div class="col-sm-5">
                    <input type="text" name="namaDepartemen" id="nama" class="form-control" placeholder="Nama Departemen" />
                </div>
        </div>

    <?php
    // print_r($this->session->all_userdata());
    if($this->session->userdata('role')!='sa'){
        echo '<div class="row top-buffer">
            <label class="col-sm-2 control-label">Unit :</label>
            <div class="col-sm-5">
                <select class="form-control" name="kodeUnit" disabled>
                    <option>-- Pilih Unit --</option>';
                    foreach($unit as $b){
                            if($b->kodeUnit === $this->session->userdata('kodeUnit')){
                                // echo "kodeUnit: ".$b->kodeUnit;echo " |session: ".$this->session->userdata('kodeUnit'); echo "<br/>";
                                echo '<option value="'.$b->kodeUnit.'" selected>'.$b->namaUnit.'</option>';
                                echo '<input type="text" value="'.$b->kodeUnit.'" name="kodeUnit" id="kodeUnit" hidden></input>';
                            }
                        }
        echo    '</select>
            </div>
        </div>';
    }else{
        echo '<div class="row top-buffer">
            <label class="col-sm-2 control-label">Unit :</label>
            <div class="col-sm-5">
                <select class="form-control" id="kodeUnit" name="kodeUnit">
                    <option>-- Pilih Unit --</option>';
                    foreach($unit as $b){
                            echo '<option value="'.$b->kodeUnit.'">'.$b->namaUnit.'</option>';
                        }
        echo    '</select>
            </div>
        </div>';
    }
    ?>
    <br>
    <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
    <input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
    </form> 
    </div>
</body>

<script type="text/javascript">

function validasi(){
    var unit = $('#kodeUnit').val();
    var nama = $('#nama').val();
    //alert(unit);return false;

    if (unit==null || nama==null || nama==0){
        alert('Lengkapi data Departemen !');
        return false;
    }
}    

</script>

<!--
<?php echo form_open('departemen/tambah_departemen');?>
<div class="form-group">
    <div class="row">
        <label class="col-sm-2 control-label">Nama Departemen :</label>
            <div class="col-sm-5">
                <input type="text" name="namaDepartemen" class="form-control" placeholder="Nama Departemen" />
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
                            echo '<input value="'.$b->kodeUnit.'" name="kodeUnit" hidden></input>';

                        }
                    }
    echo    '</select>
        </div>
    </div>';
}else{
    echo '<div class="row top-buffer">
        <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
            <select class="form-control" name="kodeUnit">
                <option>-- Pilih Unit --</option>';
                foreach($unit as $b){
                        echo '<option value="'.$b->kodeUnit.'">'.$b->namaUnit.'</option>';
                    }
    echo    '</select>
        </div>
    </div>';
}
?>
<br>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
</form>
-->