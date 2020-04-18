<div class="col-sm-12">
<h1>Edit Data SOP</h1><hr/>
<?php echo form_open('sop/edit');?>
<input type="text" name="id" hidden value="<?php echo $record['id'];?>"></input>
<div class="row">
    <label class="col-sm-2 control-label">Nama SOP :</label>
    <div class="col-sm-5">
        <input type="text" name="namaSop" class="form-control" placeholder="Nama SOP" value="<?php echo $record['namaSop'] ;?>"></input>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Unit :</label>
    <div class="col-sm-5">
        <select class="form-control" name="kodeUnit2" <?php echo $this->session->userdata('role')=='sa'?'':'disabled';?>>
            <option>-- Pilih Unit --</option>
            <?php
                foreach($unit as $b){
                    echo '<option value="'.$b->kodeUnit.'" ';
                    echo $record['kodeUnit']===$b->kodeUnit?'selected':'';
                    echo '>'.$b->namaUnit.'</option>';
                }
            ?>
        </select>
        <?php
                if($this->session->userdata('kodeRole')!='sa'){
                    echo '<input name="kodeUnit" value="'.$record['kodeUnit'].'"" hidden></input>';
                }
            ?>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Departemen :</label>
    <div class="col-sm-5">
        <select class="form-control" name="idDepartemen">
            <option>-- Pilih Departemen --</option>
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
<br/>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
</form>
</div>