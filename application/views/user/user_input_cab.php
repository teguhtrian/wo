<h1>Input Data User</h1><hr/>
<?php echo form_open($this->session->userdata('role').'/user/tambah_user_unit/'.$this->uri->segment(4));?>
<div class="row">
    <label class="col-sm-2 control-label">NIPP :</label>
    <div class="col-sm-5">
        <input type="text" name="nipp" class="form-control" placeholder="NIPP"></input>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Nama Depan :</label>
    <div class="col-sm-5">
        <input type="text" name="nama_dpn" class="form-control" placeholder="Nama Depan"></input>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Nama Belakang :</label>
    <div class="col-sm-5">
        <input type="text" name="nama_blkg" class="form-control" placeholder="Nama Belakang"></input>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Departemen :</label>
    <div class="col-sm-5">
        <select class="form-control" name="id_departemen">
            <option>-- Pilih Departemen --</option>
            <?php
                foreach($departemen as $b){
                    echo '<option value="'.$b->id_departemen.'">'.$b->nama_departemen.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row top-buffer">
 <label class="col-sm-2 control-label">Role :</label>
    <div class="radio">
        <label class="radio-inline"><input type="radio" name="kode_role" value="kcab">Kepala Cabang</label>
        <label class="radio-inline"><input type="radio" name="kode_role" value="kbag">Kepala Bagian</label>
        <label class="radio-inline"><input type="radio" name="kode_role" value="cs">Customer Service</label>
        <label class="radio-inline"><input type="radio" name="kode_role" value="staf">Staf</label>
    </div> 
</div>
<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
<?php echo form_close()?>