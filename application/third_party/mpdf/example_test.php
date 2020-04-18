<?php


//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================
set_time_limit(600);
ini_set("memory_limit","256M");
//
$timeo_start = microtime(true);
//

//==============================================================
define('_MPDF_URI','./'); 	// must be  a relative or absolute URI - not a file system path
define('_MPDF_PATH', './');

//==============================================================
define("_JPGRAPH_PATH", '../../jpgraph_5/jpgraph/'); // must define this before including mpdf.php file

define("_TTF_FONT_NORMAL", 'arial.ttf');
define("_TTF_FONT_BOLD", 'arialbd.ttf');

//==============================================================
include("./mpdf.php");
//
$timeo_start = microtime(true);
//
//==============================================================
//==============================================================
$mpdf=new mPDF('c'); 
$lorem = 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec mattis lacus ac purus feugiat semper. Donec aliquet nunc odio, vitae pellentesque diam. Pellentesque sed velit lacus. Duis quis dui quis sem consectetur sollicitudin. Cras dolor quam, dapibus et pretium sit amet, elementum vel arcu. Duis rhoncus facilisis erat nec mattis. In hac habitasse platea dictumst. Vivamus hendrerit sem in justo aliquet a pellentesque lorem scelerisque. Suspendisse a augue sed urna rhoncus elementum. Aliquam erat volutpat. Sed et orci non massa venenatis venenatis sit amet non nulla. Fusce condimentum velit urna, sed convallis ligula. Aenean vehicula purus ac dui imperdiet varius. Curabitur justo lorem, vehicula in suscipit sit amet, pharetra ut mi. Ut nunc mauris, dapibus vitae elementum faucibus, posuere sed nisl. Vestibulum et turpis eu enim tempor iaculis. Ut venenatis mattis dolor, nec iaculis tellus malesuada vel. Curabitur eu nibh sit amet sem eleifend interdum ac eu lorem. Sed feugiat, nibh tempus porta pulvinar, nisl sem aliquet odio, idluctus augue eros eget lacus. ';
$mpdf->WriteHTML($lorem);
#$mpdf->Output(); exit;
$mpdf->Output('haha.pdf','F'); 
exit;
?>