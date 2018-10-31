<?php

namespace App\Http\Controllers;
/**
 * Trait used to generate password.
 * in order to write [CLEAN CODE]!
 */

 trait PasswordGenerator{

  /**
   * generatePassword() used to generate password
   * for newly created user.
   *
   * @return str : the string password randomly created.
   */
  public function generatePassword()
  {
      $length = 10;
      $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
      $str = '';
      $max = mb_strlen($keyspace, '8bit') - 1;

      for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
      }

      return $str;
  }
 }