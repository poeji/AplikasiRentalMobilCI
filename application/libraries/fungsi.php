<?php
class fungsi {

	function hariini() {
		return date('Y-m-d H:i:s');
	}

	function tanggalsekarang() {
		return date('Y-m-d');
	}

	function strip_tags_teks($text) {

	    /*return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);*/
	    return strip_tags($text, "<span><em><sub><b><img>");

	 }

	//fungsi tanggal indonesia ==============================================================================================
	function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
	   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
	    $BulanIndo = array("Jan", "Feb", "Mar",
	               "Apr", "Mei", "Jun",
	               "Jul", "Agu", "Sep",
	               "Okt", "Nov", "Des");
	    /*
	    $BulanIndo = array("Januari", "Februari", "Maret",
	               "April", "Mei", "Juni",
	               "Juli", "Agustus", "September",
	               "Oktober", "November", "Desember");
	               */
	  
	    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
	    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
	    $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
	    
	    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
	    return($result);
	}

	//fungsi menghapus spesial karakter
	function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	//fungsi tanggal indonesia ==============================================================================================
	function DateTimeToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
	   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
	    $BulanIndo = array("Januari", "Februari", "Maret",
	               "April", "Mei", "Juni",
	               "Juli", "Agustus", "September",
	               "Oktober", "November", "Desember");
	  
	    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
	    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
	    $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
	    $jam   = substr($date, 10, 9); // memisahkan format tanggal menggunakan substring
	    
	    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun . " / " . $jam;
	    return($result);
	}


	function seo_title($s) {
	    $c = array (' ');
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

	    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	    
	    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $s;
	}

	function status($s) {
	  if($s==1) {
	    $a = "Active";
	  } else {
	    $a = "Not Active";
	  }

	  return $a;
	}

	function cekhari($CheckIn,$CheckOut){
		$CheckInX = explode("-", $CheckIn);
		$CheckOutX =  explode("-", $CheckOut);
		$date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
		$date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
		$interval =($date2 - $date1)/(3600*24);
		// returns numberofdays
		return  $interval+1 ;
	}


	    //fungsi  ucapan
		function salam() {
		  $jamnya = date('H');
	      
	      $greet = "";
	      
	      if($jamnya<10)
	      {
	        $greet = "Selamat pagi, ";
	      }
	      else if($jamnya > 10 && $jamnya < 18)
	      {
	        $greet = "Selamat siang, ";
	      }
	      else
	      {
	        $greet = "Selamat malam, ";
	      }
	  }

 }
?>