<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
if ( ! function_exists('do_hash'))
  {
      function do_hash($str, $type = 'sha1')
      {
          if ($type == 'sha1')
          {
              return sha1($str);
          }
          else
          {
              return md5($str);
          }
      }
 }
function encrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */        
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);

    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}



function decrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */

    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);

    //do the decryption given text/string/number

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

if (!function_exists('generate_random_string')) {
  /**
   * Generate a random string of 32 characters
   *
   * @return string
   */
  function generate_random_string()
  {
      return bin2hex(random_bytes(16));
  }
}

if (!function_exists('generate_random_string_every_second')) {
  /**
   * Generate and output a random string of 32 characters every second
   *
   * @param int $duration Duration in seconds (0 for infinite)
   * @return void
   */
  function generate_random_string_every_second($duration = 0)
  {
      $start_time = time();
      while (true) {
          echo generate_random_string() . "\n";
          flush();
          ob_flush();
          sleep(1);

          if ($duration > 0 && (time() - $start_time) >= $duration) {
              break;
          }
      }
  }
}

if ( ! function_exists('cek_session'))
  {
      function cek_session()
      {
          $ci = get_instance();
          if($ci->session->userdata('user_id') == '' || !$ci->session->csrf_token):
            redirect(base_url('console'));
          endif;
      }
 }

if ( ! function_exists('privileges'))
  {
      function privileges($priv_name = false)
      {
          $ci = get_instance();
          $user_id = $ci->session->userdata('user_id');
          $priv = $ci->users->get_privileges($user_id);
          $priv_name = isset($priv[$priv_name]) ? $priv[$priv_name] : "N"; 
          if(($priv != 0) && ($priv_name == 'Y')) {
            $p = true;
          } else {
            $p = false;
          }
          return $p;
      }
 }

 if ( ! function_exists('sub_privilege'))
  {
      function sub_privilege($col,$key)
      {
          $ci = get_instance();
          $r = $ci->users->get_privileges_sub($ci->session->userdata('user_id'), $col);
          $search = array_search($key, $r);
          if($search === false) {
            $result = false;
          } else {
            $result = true;
          }
          return $result;
      }
 }
