<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$CI =& get_instance();

$config['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
//$config['mailpath']         = '/usr/sbin/sendmail';
$config['mailpath']         = 'd:/xampp/sendmail';
$config['smtp_host']        = $CI->config->item('APP_EMAIL_SMTP_HOST');
$config['smtp_user']        = $CI->config->item('APP_EMAIL_SMTP_USER');
$config['smtp_pass']        = $CI->config->item('APP_EMAIL_SMTP_PASS');
//$config['smtp_auth']        = 'true';
$config['smtp_port']        = $CI->config->item('APP_EMAIL_SMTP_PORT');
$config['smtp_timeout']     = 30;                        // (in seconds)
$config['smtp_crypto']      = 'ssl';                   // '' or 'tls' or 'ssl'
$config['smtp_debug']       = 2;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
$config['wordwrap']         = true;
$config['wrapchars']        = 76;
$config['mailtype']         = 'html';                   // 'text' or 'html'
$config['charset']          = 'utf-8';
$config['validate']         = true;
$config['priority']         = 3;                        // 1, 2, 3, 4, 5
$config['crlf']             = "\n";                     // "\r\n" or "\n" or "\r"
$config['newline']          = "\n";                     // "\r\n" or "\n" or "\r"
$config['bcc_batch_mode']   = false;
$config['bcc_batch_size']   = 200;
$config['encoding']         = '8bit';  
