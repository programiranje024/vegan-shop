<?php

require_once('db.php');
require_once('mail.php');

function passwords_match($password, $confirm_password) {
  return $password === $confirm_password;
}

function create_user($email, $password) {
  $user = find_user_by_email($email);
  if ($user) {
    return false;
  } else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user = insert_user($email, $hashed_password);
    return $user;
  }
}

function find_user_by_email($email) {
  $db = get_db();
  $query = "SELECT * FROM users WHERE email = :email";
  $statement = $db->prepare($query);
  $statement->bindValue(':email', $email);
  $statement->execute();
  $user = $statement->fetch();
  $statement->closeCursor();
  return $user;
}

function insert_user($email, $password) {
  $db = get_db();
  $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
  $statement = $db->prepare($query);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':password', $password);
  $statement->execute();
  $statement->closeCursor();

  // send verification email
  send_mail($email, 'Verify your account', 'Click here to verify your account: http://localhost/user/verify.php?id=' . $db->lastInsertId());

  return find_user_by_email($email);
}

function login($email, $password) {
  $user = find_user_by_email($email);
  if ($user) {
    if (password_verify($password, $user['password']) && $user['verified']) {
      return $user;
    }
  }
  return false;
}

function verify_user($user_id) {
  $db = get_db();
  $query = "UPDATE users SET verified = 1 WHERE id = :user_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $statement->closeCursor();
}

function find_user_by_id($user_id) {
  $db = get_db();
  $query = "SELECT * FROM users WHERE id = :user_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $user = $statement->fetch();
  $statement->closeCursor();
  return $user;
}

function change_password($user_id, $password, $old_password) {
  $user = find_user_by_id($user_id);

  if (password_verify($old_password, $user['password'])) {
    update_password($user_id, $password);
    return true;
  } else {
    return false;
  }
}

function update_password($user_id, $password) {
  $db = get_db();
  $query = "UPDATE users SET password = :password WHERE id = :user_id";
  $statement = $db->prepare($query);
  $statement->bindValue(':user_id', $user_id);
  $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
  $statement->execute();
  $statement->closeCursor();
}

function generate_password() {
  $length = 8;
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $characters_length = strlen($characters);
  $random_string = '';
  for ($i = 0; $i < $length; $i++) {
    $random_string .= $characters[rand(0, $characters_length - 1)];
  }
  return $random_string;
}
