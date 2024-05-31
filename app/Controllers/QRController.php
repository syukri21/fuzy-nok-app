<?php

namespace App\Controllers;

use App\Models\MachineModel;
use chillerlan\QRCode\QRCode;

class QRController extends BaseController
{
  public function acquireQRCode(): string
  {
    $machineModel = new MachineModel();
    $qrcode = "";
    while (true) {
      $qrcode = $this->generateRandomCode();
      $isExist = $machineModel->where('qr', $qrcode)->first();
      if (!$isExist) {
        break;
      }
    }
    $machineModel->save([
      'qr' => $qrcode,
    ]);
    $result = [
      'qr' => $qrcode,
      'id' => $machineModel->getInsertID()
    ];
    return json_encode($result);
  }

  public function generate(): string
  {
    $post = $this->request->getPost(['text']);
    $qrCode = new QRCode();
    return $qrCode->render($post);
  }

  function generateRandomCode()
  {
    $code = '';
    for ($i = 0; $i < 10; $i++) {
      if ($i == 0) {
        // First character is always a letter
        $randomChar = chr(mt_rand(65, 90)); // ASCII values for A-Z
      } else {
        // Following characters can be letters or numbers
        if (mt_rand(0, 1) == 0) {
          $randomChar = chr(mt_rand(65, 90)); // ASCII values for A-Z
        } else {
          $randomChar = chr(mt_rand(48, 57)); // ASCII values for 0-9
        }
      }
      $code .= $randomChar;
    }
    return $code;
  }
}
