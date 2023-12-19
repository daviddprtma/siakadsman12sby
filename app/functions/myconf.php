<?php
	function getRoles($roles){
		if ($roles != "") {
			if ($roles == 'Admin') {
				$status_user = 'Admin';
			}elseif($roles == 'Guru'){
				$status_user = 'Guru';
			}else{
				$status_user = 'Siswa';
			}
		}else{
			$status_user = 'Invalid';
		}
		return $status_user;
	}
	function getJenisSoal($tu){
		if ($tu != "") {
			if ($tu == 'UH1') {
				$tipe_ulangan = 'Soal Ulangan Harian 1';
			}
            else if ($tu == 'UH2') {
				$tipe_ulangan = 'Soal Ulangan Harian 2';
			}
            else if ($tu == 'UH3') {
				$tipe_ulangan = 'Soal Ulangan Harian 3';
			}
            else if($tu == 'UTS'){
				$tipe_ulangan = 'Soal Ulangan Tengah Semester';
			}
            else if($tu == 'UAS'){
                $tipe_ulangan = 'Soal Ulangan Akhir Semester';
            }
		}else{
			$tipe_ulangan = 'Invalid';
		}
		return $tipe_ulangan;
	}
	function timeStampIndo($tgl) {
		if ($tgl != "") {
			$exp_tgl = explode(" ", $tgl);
			$tgl_exp = explode("-", $exp_tgl[0]);
			$waktu_exp = explode(":", $exp_tgl[1]);
			$tanggal = $tgl_exp[2].'-'.$tgl_exp[1].'-'.$tgl_exp[0].' '.$waktu_exp[0].':'.$waktu_exp[1].':'.$waktu_exp[2];

		}else{
			$tanggal = 'error';
		}
		return $tanggal;
	}
	function timeStampIndoOnly($tgl) {
		if ($tgl != "") {
			$exp_tgl = explode(" ", $tgl);
			$tgl_exp = explode("-", $exp_tgl[0]);
			$waktu_exp = explode(":", $exp_tgl[1]);
			$tanggal = $tgl_exp[2].'-'.$tgl_exp[1].'-'.$tgl_exp[0];

		}else{
			$tanggal = 'error';
		}
		return $tanggal;
	}
	function jenisSoal($tu) {
        if ($tu != "") {
			if ($tu == 'UH') {
				$tipe_ulangan = 'Soal Ulangan Harian';
			}else if($tu == 'UTS'){
				$tipe_ulangan = 'Soal Ulangan Tengah Semester';
			}
            else if($tu == 'UAS'){
                $tipe_ulangan = 'Soal Ulangan Akhir Semester';
            }
		}else{
			$tipe_ulangan = 'Invalid';
		}
		return $tipe_ulangan;
	}
?>
