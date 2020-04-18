<?php
   	if($nipp!='OK'){
   		echo '<div id="status" name="status">';
   		echo '<input id="statval" name="statval" value="" hidden>';
   		echo '<font color="red">NIPP <strong>'.$nipp.'</strong> sudah terdaftar.<br/>Jika user telah pindah/mutasi ke cabang Anda <strong><a href="'.base_url('user/editMutasi/'.$nipp.'').'">Silahkan Klik Disini</a></strong></font>';
		echo '</div>';
	}else{
		echo '<div id="status" name="status">';
		echo '<input id="statval" name="statval" value="ok" hidden>';
		echo '<strong>OK</strong>';
		echo '</div>';
	}
?>