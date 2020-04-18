<?php echo form_open('unit/tambah_unit');?>
<h1>Input Unit</h1>
<div class="form-group">
    <div class="row top-buffer">
    <label class="col-sm-2 control-label">Kode Unit :</label>
        <div class="col-sm-3">
            <input type="text" name="kodeUnit" class="form-control" id="kode_unit" />
        </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Nama Unit :</label>
            <div class="col-sm-5">
                <input type="text" name="namaUnit" class="form-control" id="nama_unit" />
            </div>
    </div>
    <div class="row top-buffer">
        <label class="col-sm-2 control-label">Alamat Unit :</label>
            <div class="col-sm-5">
                <input type="text" name="alamatUnit" class="form-control" id="alamat_unit" />
            </div>
    </div>
</div>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
</form>