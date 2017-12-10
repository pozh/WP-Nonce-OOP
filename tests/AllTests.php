<?php

use Pozh\OOPNonce;

// The path to wp-load depends on where you put your copy of the package.
// Assuming it's inside a theme's or plugin's folder
require( '../../../../wp-load.php' );

class OOPNonceTests extends \PHPUnit_Framework_TestCase
{

  private static $nonce;

  public static function setUpBeforeClass()
  {
    self::$nonce = new Pozh\OOPNonce();
  }

  public function test_create_nonce() {
    $nonceCode = self::$nonce->create();
    $this->assertNotNull( $nonceCode );
  }
}

