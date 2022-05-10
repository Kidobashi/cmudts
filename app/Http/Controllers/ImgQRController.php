<?php 

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;

class ImgQRController extends Controller{

    public function _construct(QrCode $qrCode){
        $this->qrCode = $qrCode;
    }

    public function makeQrCode($text){
       return $this->qrCode
       ->setText($text)
       ->setSize(300)
       ->setPadding(10)
       ->setErrorCorrection('high')
       ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
       ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
       ->setLabel('My label')
       ->setLabelFontSize(16)
       ->render();
    }
}