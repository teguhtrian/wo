<h1>Edit Data WO</h1><hr/>
<?php echo form_open('wo/edit');?>
<input type="text" name="id_wo" hidden="hidden" value="<?php echo $this->uri->segment(3);?>"></input>
<div class="row">
    <label class="col-sm-2 control-label">Unit :</label>
    <div class="col-sm-5">
        <select class="form-control" name="kode_unit">
            <option>-- Pilih Unit --</option>
            <?php
                foreach($unit as $b){
                    echo '<option value="'.$b->kode_unit.'" ';
                    echo $record['kode_unit']==$b->kode_unit?'selected':'';
                    echo '>'.$b->nama_unit.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Departemen :</label>
    <div class="col-sm-5">
        <select class="form-control" name="id_departemen">
            <option>-- Pilih Departemen --</option>
            <?php
                foreach($departemen as $b){
                    echo '<option value="'.$b->id_departemen.'" ';
                    echo $record['id_departemen']==$b->id_departemen?'selected':'';
                    echo '>'.$b->nama_departemen.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">SOP :</label>
    <div class="col-sm-5">
        <select class="form-control" name="id_sop">
            <option>-- Pilih SOP --</option>
            <?php
                foreach($sop as $b){
                    echo '<option value="'.$b->id_sop.'" ';
                    echo $record['id_sop']==$b->id_sop?'selected':'';
                    echo '>'.$b->nama_sop.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Nama Work Order :</label>
    <div class="col-sm-5">
        <input type="text" name="nama_wo" class="form-control" placeholder="Nama Work Order" value="<?php echo $record['nama_wo'] ;?>"></input>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Lama Waktu :</label>
    <div class="col-sm-5">
        <select class="form-control" name="id_sla">
            <option>-- Pilih Waktu --</option>
            <?php
                foreach($sla as $b){
                    echo '<option value="'.$b->id_sla.'" ';
                    echo $record['id_sla']==$b->id_sla?'selected':'';
                    echo '>'.$b->nama_sla.'</option>';
                }
            ?>
        </select>
    </div>
</div>

<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
</form>