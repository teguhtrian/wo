<h1>Edit Data WO</h1><hr/>
<?php echo form_open('wo/edit',array('onSubmit'=>'return validasi()'));?>
<input type="text" name="idWo" hidden="hidden" value="<?php echo $this->uri->segment(3);?>"></input>
<div class="row">
    <label class="col-sm-2 control-label">Unit :</label>
    <div class="col-sm-5">
        <select class="form-control" name="kodeUnit" id="kodeUnit" onchange="tampilDept()" <?php echo $this->session->userdata('role')=='ac'?'disabled':''?>>
            <option value="0">-- Pilih Unit --</option>
            <?php
                foreach($unit as $b){
                    if($record['kodeUnit']==$b->kodeUnit){
                        echo '<option value="'.$b->kodeUnit.'" selected>'.$b->namaUnit.'</option>';
                    }else{
                        echo '';    
                    }
                    /*
                    echo '<option value="'.$b->kodeUnit.'" ';
                    echo $record['kodeUnit']==$b->kodeUnit?'selected':'';
                    echo '>'.$b->namaUnit.'</option>';
                    echo $this->session->userdata('role')=='ac'&&$record['kodeUnit']==$b->kodeUnit?'<input name="kodeUnit" value="'.$b->kodeUnit.'" hidden></input>':'';
                    */
                }
            ?>
        </select>
        <?php echo $this->session->userdata('role')=='ac'?'<input name="kodeUnit" id="unit" value="'.$record['kodeUnit'].'" hidden></input>':''; ?>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Departemen :</label>
    <div class="col-sm-5">
        <select class="form-control" name="idDepartemen" id="dept" onchange="tampilSOP()">
            <option value="0">-- Pilih Departemen --</option>
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
<div class="row top-buffer">
    <label class="col-sm-2 control-label">SOP :</label>
    <div class="col-sm-5">
        <select class="form-control" name="idSop" id="sop" onchange="tampilSla()">
            <option value="0">-- Pilih SOP --</option>
            <?php
                foreach($sop as $b){
                    echo '<option value="'.$b->id.'" ';
                    echo $record['idSop']==$b->id?'selected':'';
                    echo '>'.$b->namaSop.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Lama Waktu (SLA) :</label>
    <div class="col-sm-5">
        <select class="form-control" name="idSla" id="sla">
            <option value="0">-- Pilih SOP --</option>
            <?php
                foreach($sla as $b){
                    echo '<option value="'.$b->id.'" ';
                    echo $record['idSla']==$b->id?'selected':'';
                    echo '>'.$b->namaSla.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Nama Work Order :</label>
    <div class="col-sm-5">
        <input type="text" name="namaWo" id="namaWo" class="form-control" placeholder="Nama Work Order" value="<?php echo $record['namaWo'] ;?>"></input>
    </div>
</div>
<div class="row top-buffer">
    <label class="col-sm-2 control-label">Jenis Pekerjaan :</label>
    <div class="col-sm-5">
        <div class="radio">
            <label><input type="radio" value="umum" name="jenper" id="jenper" name="jenper" <?php echo $record['jenisWo']=='umum'?'checked="checked"':''?>>Umum</label>
        </div>
        <div class="radio">
            <label><input type="radio" value="rutin" name="jenper" id="jenper" name="jenper" <?php echo $record['jenisWo']=='rutin'?'checked="checked"':''?>>Rutinitas (Menggunakan Volume)</label>
        </div>
    </div>
</div>

<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
</form>

<script type="text/javascript">
function tampilDept(){
    $("#dept").prop('selectedIndex',0);
    $("#sop").prop('selectedIndex',0);
    $("#sla").prop('selectedIndex',0);
    var unit=$("#unit").val();
    $.ajax({
         url:"<?php echo base_url();?>departemen/pilih_dept/"+unit+"",
        success: function(html){
            $("#dept").html(html);
        },
        dataType:"html"       
    })
}

function tampilSOP(){
    $("#sla").prop('selectedIndex',0);
    var unit=$("#unit").val();
    var dept=$("#dept").val();
    //alert(dept);
    $.ajax({
        url:"<?php echo base_url();?>sop/pilih_sop/"+unit+"/"+dept+"",
        success: function(html){
            $("#sop").html(html);
        },
        dataType:"html"
    });
}

function tampilSla(){
    var dept=$("#dept").val();
    //var unit=$("#unit").val();
    $.ajax({
        //url:"<?php echo base_url();?>sla/pilih_sla/"+unit+"/"+dept+"",
        url:"<?php echo base_url();?>tiket/pilihSlaByDept/"+dept+"",
        success: function(html){
            $("#sla").html(html);
        },
        dataType:"html"
    });
}

function validasi(){
    var unit=$("#unit").val();
    var sop=$("#sop").val();
    var dept=$("#dept").val();
    var sla=$("#sla").val();
    var wo=$("#namaWo").val();
    var jenper=$("#jenper:checked").val();
    //alert(wo);return false;

    if(unit == null || unit == 0 || sop == 0 || dept == 0 || sop == null || dept == null || wo == 0 || wo == null || sla == null || sla == 0 ||jenper == null){
        alert('Lengkapi Data Work Order');
        return false;
    }
}
</script>