<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myfunction
{
    var $CI;

    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('encryption');
    }

    public function changeNumToThaiNum($num)
    {
        $number = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $thaiNumber = array('๐', '๑', '๒', '๓', '๔', '๕', '๖', '๗', '๘', '๙');

        return str_replace($number, $thaiNumber, $num);
    }

    public function encode($data)
    {
        $encrypt = base64_encode($this->CI->encryption->encrypt($data));
        return str_replace('=', '', $encrypt);
    }

    public function decode($encString)
    {
        return $this->CI->encryption->decrypt(base64_decode($encString));
    }

    public function dmy_to_thai($ddmmyyyy, $type = 0)
    {
        $d = substr($ddmmyyyy, 0, 2);
        $m = $this->mm_to_thai(substr($ddmmyyyy, 2, 2));

        if ($type == 0) {
            $y = substr($ddmmyyyy, 4, 4);
            return "{$d} {$m[0]} {$y}";
        } else {
            $y = substr($ddmmyyyy, 6, 2);
            return "{$d} {$m[1]}{$y}";
        }
    }

    public function mm_to_thai($mm)
    {
        switch ($mm) {
            case '01':
                $month[0] = 'มกราคม';
                $month[1] = 'ม.ค.';
                return $month;
                break;
            case '02':
                $month[0] = 'กุมภาพันธ์';
                $month[1] = 'ก.พ.';
                return $month;
                break;
            case '03':
                $month[0] = 'มีนาคม';
                $month[1] = 'มี.ค.';
                return $month;
                break;
            case '04':
                $month[0] = 'เมษายน';
                $month[1] = 'เม.ย.';
                return $month;
                break;
            case '05':
                $month[0] = 'พฤษภาคม';
                $month[1] = 'พ.ค.';
                return $month;
                break;
            case '06':
                $month[0] = 'มิถุนายน';
                $month[1] = 'มิ.ย.';
                return $month;
                break;
            case '07':
                $month[0] = 'กรกฎาคม';
                $month[1] = 'ก.ค.';
                return $month;
                break;
            case '08':
                $month[0] = 'สิงหาคม';
                $month[1] = 'ส.ค.';
                return $month;
                break;
            case '09':
                $month[0] = 'กันยายน';
                $month[1] = 'ก.ย.';
                return $month;
                break;
            case '10':
                $month[0] = 'ตุลาคม';
                $month[1] = 'ต.ค.';
                return $month;
                break;
            case '11':
                $month[0] = 'พฤศจิกายน';
                $month[1] = 'พ.ย.';
                return $month;
                break;
            case '12':
                $month[0] = 'ธันวาคม';
                $month[1] = 'ธ.ค.';
                return $month;
                break;

            default:
                $month[0] = 'Invalid';
                $month[1] = 'Invalid';
                return $month;
                break;
        }
    }
}
