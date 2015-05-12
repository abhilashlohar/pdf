<?php
require_once('database.php');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
ini_set('max_execution_time', 100000);

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('hello');
$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$fontname=$pdf->addTTFfont('OpenSans-Regular.ttf', '', '', 32);
$pdf->SetFont($fontname, 'BI', 10, '', 'false');
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set font
//$pdf->SetFont('times', '', 9);

// add a page
$pdf->AddPage();
$q=@$_GET["q"];
$sel_tour=mysql_query("SELECT * FROM `tours` where `id`='$q'");
while($result_sel_tour=mysql_fetch_array($sel_tour)){
$no_of_guest=$result_sel_tour["no_of_guest"];
$email_contect=$result_sel_tour["email_contect"];
$no_of_room=$result_sel_tour["no_of_room"];
$date=$result_sel_tour["date"];
$trial_duration=$result_sel_tour["trial_duration"];
$prepared_by=$result_sel_tour["prepared_by"];
$travel_date=$result_sel_tour["travel_date"];
$email_address=$result_sel_tour["email_address"];
$booking_status=$result_sel_tour["booking_status"];
$per_adult=$result_sel_tour["per_adult"];
$total=$result_sel_tour["total"];
$t_c=$result_sel_tour["t_c"];
$last=$result_sel_tour["last"];
$reference_number=$result_sel_tour["reference_number"];
}

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fusion.png';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();



$toolcopy = '<br/><br/><br/><div><span style="font-size:12;color:dimgrey;"><b>Quotation prepared for </b></span><span style="font-size:13;color:#EF6D11;"> <b>Fusion Tours</b></span></div>';	
$toolcopy .= '<br/><br/><br/><br/>';
$toolcopy .= '<table cellpadding="5">';
$toolcopy .= '<tr>
				<td class="qw" style="border:1px solid #ccc;">Reference Number: </td>
				<td class="qw" style="border:1px solid #ccc;">'.$reference_number.'</td>
				<td style="border:1px solid #ccc;">No. of guest: </td>
				<td style="border:1px solid #ccc;">'.$no_of_guest.'</td>
			</tr>';
$toolcopy .= '<tr>
				<td style="border:1px solid #ccc;">Email contact: </td>
				<td style="border:1px solid #ccc;">'.$email_contect.'</td>
				<td style="border:1px solid #ccc;">No. of rooms: </td>
				<td style="border:1px solid #ccc;">'.$no_of_room.'</td>
				</tr>';
$toolcopy .= '<tr>
				<td style="border:1px solid #ccc;">Date: </td>
				<td style="border:1px solid #ccc;">'.$date.'</td>
				<td style="border:1px solid #ccc;">Trip Duration: </td>
				<td style="border:1px solid #ccc;">'.$trial_duration.'</td>
				</tr>';
$toolcopy .= '<tr>
				<td style="border:1px solid #ccc;">Prepared by: </td>
				<td style="border:1px solid #ccc;">'.$prepared_by.'</td>
				<td style="border:1px solid #ccc;">Intended Travel Date: </td>
				<td style="border:1px solid #ccc;">'.$travel_date.'</td>
				</tr>';
$toolcopy .= '<tr>
				<td style="border:1px solid #ccc;">Email address: </td>
				<td style="border:1px solid #ccc;">'.$email_address.'</td>
				<td style="border:1px solid #ccc;">Booking Status: </td>
				<td style="border:1px solid #ccc;">'.$booking_status.'</td>
				</tr>';

$toolcopy .= '</table>';
$pdf->writeHTML($toolcopy, true, false, true, false, '');


$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fusion.png';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();



$toolcopy5 = '<br/><br/><br/><span style="color:#666;font-size:16;"><b>SUGGESTED ITINERARY</b></span>';
$pdf->writeHTML($toolcopy5, true, false, true, false, '');


$sel_tour_infos=mysql_query("SELECT * FROM `tour_infos` where `tour_id`='$q'");
$i=0;
while($result_tour_infos=mysql_fetch_array($sel_tour_infos)){
$i++;
$date_itinary=$result_tour_infos["date_itinary"];
$arrive=$result_tour_infos["arrive"];
$text1=$result_tour_infos["text1"];
$text2=$result_tour_infos["text2"];
$file=$result_tour_infos["file"];
$toolcopy2 = '<table border="0" cellpadding="5" cellspacing="10">';
$toolcopy2 .= '<tr style="background-color:#f08365;color:White;"><th><span style="font-size:12;">'.$date_itinary.'</span></th><th><span style="font-size:12;">'.$arrive.'</span></th></tr>';
if(!empty($file)){
	$toolcopy2 .= '<tr><td><img src="../quotation/app/webroot/tour/'.$file.'" width="300px" height="200px"/></td><td><div style="border-bottom:solid 1px orange;font-size:11;">'.$text1.'</div><br/><b style="color:#494848;font-size:10;">'.$text2.'</b></td></tr>';
}
else{
	$toolcopy2 .= '<tr><td></td><td style="border-bottom:solid 1px orange;font-size:9;">'.$text1.'<br/><b style="color:#494848;font-size:10;">'.$text2.'</b></td></tr>';
}

$toolcopy2 .= '</table>';
$toolcopy2 .= '<div style="height:10px;"></div>';
$pdf->writeHTML($toolcopy2, true, false, true, false, '');
if($i==4 or $i==8 or $i==12){
	//$pdf->AddPage();
}
}



$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fusion.png';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();




$toolcopy6 = '<br/><br/><br/><span style="color:#666;font-size:16;"><b>QUOTATION</b></span><br/>';
$pdf->writeHTML($toolcopy6, true, false, true, false, '');

$toolcopy3 = '<div style="color:blue;font-size:12;"><b>LAND PRICE PER PERSON:</b></div>';
$toolcopy3 .= '<table border="1" cellpadding="5">';
$toolcopy3 .= '<tr><td style="color:blue;font-size:9;">Per adult</td><td>'.$per_adult.'</td></tr>';
$toolcopy3 .= '<tr style="background-color:#EF6D11;color:white;font-size:10;"><td><b>TOTAL COST</b></td><td><b>'.$total.'</b></td></tr>';
$toolcopy3 .= '</table>';

$pdf->writeHTML($toolcopy3, true, false, true, false, '');

$pdf->writeHTML($t_c, true, false, true, false, '');

$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fusion.png';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();



$toolcopy7 = '<br/><br/><br/><span style="color:#666;font-size:16;"><b>HOTEL DESCRIPTIONS</b></span><br/>';
$pdf->writeHTML($toolcopy7, true, false, true, false, '');

$sel_hotels=mysql_query("SELECT * FROM `hotels` where `tour_id`='$q'");
$i=0;
while($result_sel_hotels=mysql_fetch_array($sel_hotels)){
$i++;
$place=$result_sel_hotels["place"];
$place_title=$result_sel_hotels["place_title"];
$place_des=$result_sel_hotels["place_des"];
$place_email=$result_sel_hotels["place_email"];
$file=$result_sel_hotels["file"];

$toolcopy2 = '<table border="0" cellpadding="2" cellspacing="7">';
$toolcopy2 .= '<tr><th style="background-color:#EF6D11;color:White;font-size:13;" align="center">'.$place.'</th></tr>';
$toolcopy2 .= '</table>';
$toolcopy2 .= '<table border="0" cellpadding="5" cellspacing="10">';
if(!empty($file)){
	$toolcopy2 .= '<tr><td><img src="../quotation/app/webroot/hotel/'.$file.'" width="300px" height="200px"/></td><td><span align="left" style="font-size:10;color:blue;"><b>'.$place_title.'</b></span><br><span align="left" style="font-size:10;color:#3F3E3E;">'.$place_des.'</span><br><span align="left" style="font-size:10;color:blue;"><b>'.$place_email.'</b></span></td></tr>';
}
else{
	$toolcopy2 .= '<tr><td></td><td><span align="left" style="font-size:12;color:blue;"><b>'.$place_title.'</b></span><br><span align="left" style="font-size:12;color:#3F3E3E;">'.$place_des.'</span><br><span align="left" style="font-size:12;color:blue;"><b>'.$place_email.'</b></span></td></tr>';
}

$toolcopy2 .= '</table>';
$toolcopy2 .= '<div style="height:10px;"></div>';
$pdf->writeHTML($toolcopy2, true, false, true, false, '');
if($i==4 or $i==8 or $i==12){
	//$pdf->AddPage();
}
}



$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fusion.png';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


$toolcopy8 = '<br/><br/><br/><span style="color:#26a69a;font-size:16;"><b>WHY CHOOSE US</b></span><br/>';
$pdf->writeHTML($toolcopy8, true, false, true, false, '');
$pdf->writeHTML($last, true, false, true, false, '');

$pdf->Output(1, 'D');
unset($_SESSION['app_number']);
?>
