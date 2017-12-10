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


  /**
   * Make sure instance of OOPNonce exists
   */
  public function test_nonce()
  {
    $this->assertNotNull( self::$nonce );
  }


  /**
   * Make sure nonce code is generated
   */
  public function test_create_nonce()
  {
    $nonceCode = self::$nonce->create();
    $this->assertNotNull( $nonceCode );
  }


  /**
   * Make sure the "nonced" url is correct and contains nonce parameter
   */
  public function test_nonce_url()
  {
    $testUrl = 'http://pozhilov.com';
    $nonceKey = '_wpnonce';
    $url = self::$nonce->url( $testUrl, $name = $nonceKey );
    $this->assertStringStartsWith( $testUrl, $url );

    $urlParts = parse_url( $url );
    parse_str( $urlParts['query'], $queryParts);
    $this->assertTrue( array_key_exists( $nonceKey, $queryParts ), 'No nonce key in result URL' );
  }


  /**
   * Make sure field HTML code is generated... i.e. at least starts with "<input"
   */
  public function test_field()
  {
    $fieldHtml = self::$nonce->field( $echo = true );
    $this->assertStringStartsWith( '<input', $fieldHtml );
  }
}
