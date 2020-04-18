<?php echo form_open($this->session->userdata('role').'/unit/edit');?>
<input type="text" name="id_unit" hidden="hidden" value="<?php echo $this->uri->segment(4);?>"></input>
<div class="form-group">
    <div class="row">
    <label class="col-sm-2 control-label">Kode Unit :</label>
        <div class="col-sm-3">
            <input type="text" name="kode_unit" class="form-control" id="kode_unit" value="<?php echo $record['kode_unit']?>" />
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 control-label">Nama Unit :</label>
            <div class="col-sm-7">
                <input type="text" name="nama_unit" class="form-control" id="nama_unit" value="<?php echo $record['nama_unit']?>" />
            </div>
    </div>
    <div class="row">
        <label class="col-sm-2 control-label">Alamat Unit :</label>
            <div class="col-sm-7">
                <input type="text" name="alamat_unit" class="form-control" id="alamat_unit" value="<?php echo $record['alamat_unit']?>"  />
            </div>
    </div>
</div>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
</form>