<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;

class QRController extends BaseController
{
    public function generate(string $data): string
    {
        $QRCode = new QRCode();
        return $QRCode->render($data);
    }
}
