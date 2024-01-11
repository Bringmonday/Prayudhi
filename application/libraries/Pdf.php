<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ubah lokasi require_once sesuai dengan lokasi file TCPDF yang benar
require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
