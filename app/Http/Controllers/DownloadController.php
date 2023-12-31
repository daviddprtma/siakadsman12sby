<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    //
    public function download(Request $request)
    {
        $filename = $request->filename;
        if ($filename == "soal") {
            $file = public_path(). "/file/soal.xls";
            $headers = array(
                'Content-Type' => 'application/csv',
                'Content-Disposition' => 'attachment; filename=' . $filename,
              );
            if ( file_exists( $file ) ) {
            // Send Download
            return Response::download($file, 'format_soal.xls', $headers);
            }
            else {
            // Error
            exit( 'File yang diminta tidak dapat diambil dari server!' );
            }
        }

        if ($filename == "soalsiswa") {
            $file = public_path(). "/file/soal.xls";
            $headers = array(
                'Content-Type' => 'application/csv',
                'Content-Disposition' => 'attachment; filename=' . $filename,
              );
            if ( file_exists( $file ) ) {
            // Send Download
            return Response::download($file, 'format_soal.xls', $headers);
            }
            else {
            // Error
            exit( 'File yang diminta tidak dapat diambil dari server!' );
            }
        }

        if ($filename == "siswa") {
        $file = public_path(). "/file/siswa.xls";
        $headers = array(
          'Content-Type' => 'application/csv',
          'Content-Disposition' => 'attachment; filename=' . $filename,
        );
        if ( file_exists( $file ) ) {
          // Send Download
          return Response::download($file, 'format_siswa.xls', $headers);
        } else {
          // Error
          exit( 'File yang diminta tidak dapat diambil dari server' );
        }
      }
    }
}
