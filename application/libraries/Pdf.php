<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pdf
{

    function pdf()
    {
        $CI = &get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($param = NULL)
    {
        include_once APPPATH . 'third_party/mpdf/mpdf.php';

        if ($param == NULL) {
            // $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
            return new mPDF('utf-8', 'A4', 0, '', 5, 5, 30, 10, 8, 8, 'P');
        } else {

            return new mPDF('utf-8', $param);
        }

        //return new mPDF($param);
        //$mode='',$format='A4',$default_font_size=0,$default_font='',$mgl=15,$mgr=15,$mgt=16,$mgb=16,$mgh=9,$mgf=9, $orientation='P'
        // return new mPDF('utf-8', 'A4', 0, '', 5, 5, 5, 5, 8, 8, 'P');
    }

    function load2($param = NULL)
    {
        include_once APPPATH . 'third_party/mpdf/mpdf.php';

        if ($params == NULL) {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
        }

        //return new mPDF($param);
        //$mode='',$format='A4',$default_font_size=0,$default_font='',$mgl=15,$mgr=15,$mgt=16,$mgb=16,$mgh=9,$mgf=9, $orientation='P'
        // return new mPDF('utf-8', 'A4', 0, '', 5, 5, 5, 5, 8, 8, 'P');
        return new mPDF('utf-8', 'A4', 0, '', 5, 5, 5, 5, 8, 8, 'P');
    }
}