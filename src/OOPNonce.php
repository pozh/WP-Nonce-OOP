<?php
/**
 * WordPress Nonces' OOP wrapper
 *
 * @version 1.0
 * @author  Sergey Pozhilov
 * @license MIT
 */

namespace Pozh;

class OOPNonce {


  /**
   * Retrieve URL with nonce added to URL query.
   *
   * @since 1.0
   *
   * @param string     $actionurl URL to add nonce action.
   * @param int|string $action    Optional. Nonce action name. Default -1.
   * @param string     $name      Optional. Nonce name. Default '_wpnonce'.
   * @return string Escaped URL with nonce action added.
   */
  public function url( $actionurl, $action = -1, $name = '_wpnonce' )
  {
    return wp_nonce_url( $actionurl, $action, $name );
  }


  /**
   * Retrieve or display nonce hidden field for forms.
   *
   * The $action and $name are optional, but if you want to have better security,
   * it is strongly suggested to set those two parameters. It is easier to just
   * call the function without any parameters, because validation of the nonce
   * doesn't require any parameters, but since crackers know what the default is
   * it won't be difficult for them to find a way around your nonce and cause
   * damage.
   *
   * The input name will be whatever $name value you gave. The input value will be
   * the nonce creation value.
   *
   * @since 1.0
   *
   * @param int|string $action  Optional. Action name. Default -1.
   * @param string     $name    Optional. Nonce name. Default '_wpnonce'.
   * @param bool       $referer Optional. Whether to set the referer field for validation. Default true.
   * @param bool       $echo    Optional. Whether to display or return hidden form field. Default true.
   * @return string Nonce field HTML markup.
   */
  public function field( $action = -1, $name = "_wpnonce", $referer = true , $echo = true )
  {
    return wp_nonce_field( $action, $name, $referer, $echo );
  }


  /**
   * Creates a cryptographic token tied to a specific action, user, user session,
   * and window of time.
   *
   * @since 1.0
   *
   * @param string|int $action Scalar value to add context to the nonce.
   * @return string The token.
   */
  public function create( $action = -1 )
  {
    return wp_create_nonce( $action );
  }


  /**
   * Makes sure that a user was referred from another admin page.
   *
   * @since 1.0
   *
   * @param int|string $action    Action nonce.
   * @param string     $query_arg Optional. Key to check for nonce in `$_REQUEST` (since 2.5).
   *                              Default '_wpnonce'.
   * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
   *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
   */
  public function check_admin_referer( $action = -1, $query_arg = '_wpnonce' )
  {
    return check_admin_referer( $action, $query_arg );
  }


  /**
   * Verifies the Ajax request to prevent processing requests external of the blog.
   *
   * @since 1.0
   *
   * @param int|string   $action    Action nonce.
   * @param false|string $query_arg Optional. Key to check for the nonce in `$_REQUEST` (since 2.5). If false,
   *                                `$_REQUEST` values will be evaluated for '_ajax_nonce', and '_wpnonce'
   *                                (in that order). Default false.
   * @param bool         $die       Optional. Whether to die early when the nonce cannot be verified.
   *                                Default true.
   * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
   *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
   */
  public function check_ajax_referer( $action = -1, $query_arg = false, $die = true )
  {
    return check_ajax_referer( $action, $query_arg, $die );
  }


  /**
   * Verify that correct nonce was used with time limit.
   *
   * The user is given an amount of time to use the token, so therefore, since the
   * UID and $action remain the same, the independent variable is the time.
   *
   * @since 1.0
   *
   * @param string     $nonce  Nonce that was used in the form to verify
   * @param string|int $action Should give context to what is taking place and be the same when nonce was created.
   * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
   *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
   */
  public function verify( $nonce, $action = -1 )
  {
    return wp_verify_nonce( $nonce, $action );
  }


  /**
   * Set nonce lifetime, in seconds
   *
   * Note, the actual lifetime is a variable between 12 and 24 hours. So, the life = 4hours will
   * give you nonces that are valid for 2-4 hours.
   *
   * @since 1.0
   *
   * @param int $seconds The lifetime of a nonce in seconds.
   * @return true
   */
  public function set_life( $seconds = 24 * HOUR_IN_SECONDS )
  {
    return add_filter( 'nonce_life', function () use ($seconds) { return $seconds; } );
  }



  /**
   * Display "Are You Sure" message to confirm the action being taken.
   *
   * If the action has the nonce explain message, then it will be displayed
   * along with the "Are you sure?" message.
   *
   * @since 1.0
   *
   * @param string $action The nonce action.
   */
  public function ays( $action )
  {
    return wp_nonce_ays( $action );
  }
}
