<body>
    <div class="col-sm-12">
    <h1>Edit Data Departemen</h1><hr/>
<?php 
echo form_open('departemen/edit/'.$this->uri->segment(3), array('onSubmit'=>'return validasi()'));
?>
<input type="text" name="id_departemen" hidden value="<?php echo $this->uri->segment(3);?>"></input>
<div class="form-group">
    <div class="row">
        <label class="col-sm-2 control-label">Nama Departemen :</label>
            <div class="col-sm-7">
                <input type="text" name="namaDepartemen" name="nama" id="nama" class="form-control" value="<?php echo $departemen['namaDepartemen']?>" />
            </div>
    </div>
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">Unit :</label>
        <div class="col-sm-5">
                <input type="text" name="kodeUnit" id="unit" hidden value="<?php echo $departemen['kodeUnit']?>">
                <select class="form-control" name="unit" id="unit"
                <?php echo $this->session->userdata('role')!='sa'?'disabled':''?>>
                <option>-- Pilih Unit --</option>
                <?php
                    foreach($unit as $b){
                        echo '<option value="'.$b->kodeUnit.'" ';
                        echo $departemen['kodeUnit']===$b->kodeUnit?'selected':'';
                        echo '>'.$b->namaUnit.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
</form>
</div>
</body>

<script type="text/javascript">

function validasi(){
    var nama = $('#nama').val();
    var unit = $('#unit').val();
    //alert(unit);return false;

    if(nama==null || nama==0 || unit==null){
        alert('Lengkapi Data Departemen !');
        return false;
    }
}
    
</script>