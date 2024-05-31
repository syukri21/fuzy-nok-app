<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */


function generateRandomCode()
{
  $code = '';
  for ($i = 0; $i < 10; $i++) {
    if ($i == 0) {
      // first character is always a letter
      $randomchar = chr(mt_rand(65, 90)); // ascii values for a-z
    } else {
      // following characters can be letters or numbers
      if (mt_rand(0, 1) == 0) {
        $randomchar = chr(mt_rand(65, 90)); // ascii values for a-z
      } else {
        $randomchar = chr(mt_rand(48, 57)); // ascii values for 0-9
      }
    }
    $code .= $randomchar;
  }
  return $code;
}
