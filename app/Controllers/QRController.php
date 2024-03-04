<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;
use CodeIgniter\HTTP\RedirectResponse;

class QRController extends BaseController
{
    public function generate(): string
    {
        $post = $this->request->getPost(['text']);
        $QRCode = new QRCode();
        return $QRCode->render($post['text']);
    }


}
