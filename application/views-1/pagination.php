<!DOCTYPE html>
<html lang="en">
<head>
	<title>CARIKODE</title>
</head>
<body>

	<?php 
	echo heading('TUTORIAL PAGING CODEIGNITER | CARIKODE.COM',1);

	echo $this->pagination->create_links();
	
	$this->table->set_heading(array('id', 'Tiket Informasi'));

	foreach($info as $a){	
		$this->table->add_row(array($a->id, $a->no_tiket,));
	}
	
	echo $this->table->generate(); 

	echo $this->pagination->create_links();

	echo '<table>
			<thead>
			<tr>
				<th>No</th>
				<th>No Surat</th>
			</tr>
			</thead>

			<tbody>';
	//$this->table->set_heading(array('id',''))
			$no=1;
	foreach ($surat as $s) {
		echo '<tr>
				<td>'.$no.'</td>
				<td>'.$s->no_surat.'</td>
				</tr>';
				$no++;
	}

	echo '</tbody>
			</table>';
	?>
</body>
</html>