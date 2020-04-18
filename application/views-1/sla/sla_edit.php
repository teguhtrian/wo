<body>
    <div class="col-sm-12">
        <h1>Edit Data SLA</h1><hr/>
        <?php echo form_open('sla/edit');?>
        <input type="text" name="id" hidden value="<?php echo $record['id']?>"></input>
        <div class="row">
            <label class="col-sm-2 control-label">Jumlah Angka :</label>
            <div class="col-sm-5">
                <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Angka" value="<?php $jumlah = explode(" ",$record['namaSla']); echo $jumlah[0];?>"></input>
            </div>
        </div>
        <div class="row top-buffer">
            <label class="col-sm-2 control-label">Satuan :</label>
            <div class="col-sm-5">
                <select class="form-control" name="satuan">
                    <option>-- Pilih Satuan --</option>
                    <?php
                        echo $record['idSatuan']==0?'<option value="0" selected>Detik</option>':'<option value="0">Detik</option>';
                        echo $record['idSatuan']==1?'<option value="1" selected>Menit</option>':'<option value="1">Menit</option>';
                        echo $record['idSatuan']==2?'<option value="2" selected>Jam</option>':'<option value="2">Jam</option>';
                        echo $record['idSatuan']==3?'<option value="3" selected>Hari</option>':'<option value="3">Hari</option>';
                    ?>
                    <!--
                    <option value="1" <?php $satuan=explode(" ",$record['nama_sla']);
                                        echo $satuan[1]=='menit'?'selected':'';?>>Menit</option>
                    <option value="2" <?php $satuan=explode(" ",$record['nama_sla']);
                                        echo $satuan[1]=='jam'?'selected':'';?>>Jam</option>
                    <option value="3" <?php $satuan=explode(" ",$record['nama_sla']);
                                        echo $satuan[1]=='hari'?'selected':'';?>>Hari</option>
                    -->
                </select>
            </div>
        </div>
        <div class="row top-buffer">
            <label class="col-sm-2 control-label">Unit :</label>
            <div class="col-sm-5">
                <select class="form-control" name="kodeUnit" <?php echo $this->session->userdata('role')=='sa'?'':'disabled'?>>
                    <option>-- Pilih Unit --</option>
                    <?php
                        foreach($unit as $b){
                            echo '<option value="'.$b->kodeUnit.'"';
                            echo $record['kodeUnit']==$b->kodeUnit?'selected':'';
                            echo '>'.$b->namaUnit.'</option>';
                        }
                    ?>
                </select>
                <?php echo $this->session->userdata('role')=='sa'?'':'<input name="kodeUnit" value="'.$record['kodeUnit'].'" hidden></input>';?>
            </div>
        </div>
        <div class="row top-buffer">
            <label class="col-sm-2 control-label">Departemen :</label>
            <div class="col-sm-5">
                <select class="form-control" name="idDepartemen">
                    <option>-- Pilih Departemen --</option>
                    <?php
                        foreach($departemen as $b){
                            echo '<option value="'.$b->id.'"';
                            echo $record['idDepartemen']==$b->id?'selected':'';
                            echo '>'.$b->namaDepartemen.'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>

        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
        </form>       
    </div>
</body>