<?php

require_once('db.php');
require_once('mail.php');

class User {
  static function passwordsMatch($password, $confirm_password) {
    return $password === $confirm_password;
  }

  static function createUser($email, $password) {
    $user = self::findUserByEmail($email);
    if ($user) {
      return false;
    } else {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $user = self::insertUser($email, $hashed_password);
      $token = self::createVerificationToken($user['id']);

      Mailer::sendMail($email, 'Verify your account', "Click this link to verify your account: http://localhost/user/verify.php?token=$token");

      return $user;
    }
  }

  static function findUserByEmail($email) {
    $db = Db::get();
    $query = "SELECT * FROM users WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
  }

  static function insertUser($email, $password) {
    $db = Db::get();
    $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
    return self::findUserByEmail($email);
  }

  static function verifyUser($id) {
    $db = Db::get();
    $query = "UPDATE users SET verified = 1 WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
  }

  static function createVerificationToken($id) {
    $token = self::generatePassword();
    $db = Db::get();
    $query = "INSERT INTO verification (user_id, token) VALUES (:user_id, :token)";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $id);
    $statement->bindValue(':token', $token);
    $statement->execute();

    return $token;
  }

  static function createResetToken($id) {
    $token = self::generatePassword();
    $db = Db::get();
    $query = "INSERT INTO password_reset (user_id, token) VALUES (:user_id, :token)";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $id);
    $statement->bindValue(':token', $token);
    $statement->execute();

    return $token;
  }

  static function deleteResetToken($token) {
    $db = Db::get();
    $query = "DELETE FROM password_reset WHERE token = :token";
    $statement = $db->prepare($query);
    $statement->bindValue(':token', $token);
    $statement->execute();
  }

  static function deleteVerificationToken($token) {
    $db = Db::get();
    $query = "DELETE FROM verification WHERE token = :token";
    $statement = $db->prepare($query);
    $statement->bindValue(':token', $token);
    $statement->execute();
  }

  static function verifyUserWithToken($token) {
    $db = Db::get();
    $query = "SELECT user_id FROM verification WHERE token = :token";
    $statement = $db->prepare($query);
    $statement->bindValue(':token', $token);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();

    if ($result) {
      $user_id = $result['user_id'];
      self::verifyUser($user_id);
      self::deleteVerificationToken($token);
      return true;
    } else {
      return false;
    }
  }

  static function isAdmin($id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT admin FROM users WHERE id = ?');
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result['admin'];
  }

  static function getAllUsers() {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM users');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  static function deleteUser($id) {
    $db = Db::get();
    $stmt = $db->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$id]);
  }

  static function updateUser($id, $email, $password) {
    $db = Db::get();
    $stmt = $db->prepare('UPDATE users SET email = ?, password = ? WHERE id = ?');
    $stmt->execute([$email, $password, $id]);
  }

  static function findById($id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  static function login($email, $password) {
    $user = self::findUserByEmail($email);
    if ($user) {
      if (password_verify($password, $user['password'])) {
        return $user;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  static function changePassword($id, $password, $old_password) {
    $user = self::findById($id);
    if (password_verify($old_password, $user['password'])) {
      self::updatePassword($id, $password);
      return true;
    } else {
      return false;
    }
  }

  static function requestPasswordChange($email) {
    $user = self::findUserByEmail($email);
    if ($user) {
      $token = self::createResetToken($user['id']);

      Mailer::sendMail($email, 'Reset your password', "Click this link to reset your password: http://localhost/user/reset-password.php?token=$token");

      return true;
    }

    return false;
  }

  static function resetPassword($password, $token) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT user_id FROM password_reset WHERE token = ?');
    $stmt->execute([$token]);
    $result = $stmt->fetch();
    if ($result) {
      $user_id = $result['user_id'];
      self::updatePassword($user_id, $password);
      self::deleteResetToken($token);
      return true;
    } else {
      return false;
    }
  }

  static function updatePassword($id, $password) {
    $db = Db::get();
    $stmt = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
    $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $id]);
  }

  static function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
      $index = rand(0, $count - 1);
      $result .= mb_substr($chars, $index, 1);
    }

    return $result;
  }
}
