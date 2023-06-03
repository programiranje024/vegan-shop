<?php

class Mailer {
  static function sendMail($to, $subject, $message) {
    ini_set('sendmail_path', '/usr/sbin/sendmail -t mailhog:1025');

    $headers = "From: admin@veganshop.dev" . "\r\n" .
      "Reply-To: admin@veganshop.dev" . "\r\n" .
      "X-Mailer: PHP/" . phpversion();
    return mail($to, $subject, $message, $headers);
  }
}
