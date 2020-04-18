<body>
	<?php echo form_open('user/ubah_password',array('onSubmit'=>'return validatePass()'));?>
	<h1><strong>Ganti Password</strong></h1><hr/>
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="form-group">
				<label><h3>Password baru</h3></label><input name="passBaru1" id="passBaru1" class="form-control" type="password" placeholder="Password Baru"></input>
			</div>
			<div class="form-group">
				<label><h3>Konfirmasi password baru</h3></label><input name="passBaru2" id="passBaru2" class="form-control" type="password" placeholder="Konfirmasi Password Baru" onkeydown="delay(500)"></input>
			</div>
			<div class="form-group" id="konfirmasi">
			</div>
			<hr/>
			<button class="btn btn-primary" type="submit" name="submit">Daftar</button>
		</div>
	</div>
	</form>
</body>

<script type="text/javascript">
	var time=0;
	var cekPass=0;
	
	function delay(num){
		if(time)
			window.clearTimeout(time);

		time=window.setTimeout(function(){
			cekPassBaru();
		},500);
	}

	function cekPassBaru(){
		var pass1 = $("#passBaru1").val();
		var pass2 = $("#passBaru2").val();

		if(pass1==pass2){
			$("#konfirmasi").empty();
			$("#konfirmasi").append("<p><strong>Berhasil</strong></p>");
			cekPass=1;
		}else{
			$("#konfirmasi").empty();
			$("#konfirmasi").append('<p style="color:red"><strong>Password tidak sama</strong></p>');
			cekPass=0;
		}

	}

	function validatePass(){
		if(cekPass==0){
			alert('Password tidak sama');
			return false;
		}
	}	
</script>