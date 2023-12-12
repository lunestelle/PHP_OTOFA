<?php

class PasswordReset
{
  use Model;

  protected $table = 'password_resets';
  protected $allowedColumns = ['password_reset_id', 'email', 'token', 'expiration_time'];
  protected $order_column = 'password_reset_id';

  public function generateToken()
  {
    return bin2hex(random_bytes(32));
  }

  public function saveResetToken($email, $token, $expiration_time)
  {
    $data = [
      'email' => $email,
      'token' => $token,
      'expiration_time' => date('Y-m-d H:i:s', $expiration_time),
    ];

    $existingToken = $this->getResetToken($email);

    if ($existingToken) {
      $this->update(['email' => $email], $data);
    } else {
      $this->insert($data);
    }
  }

  public function getResetToken($email)
  {
    $data = [
      'email' => $email,
    ];

    $result = $this->first($data);

    return $result ? $result->token : null;
  }

  public function findEmailByToken($token)
  {
    $result = $this->where(['token' => $token]);
    if (!empty($result)) {
      return $result[0]->email;
    }
    return null;
  }
  
  public function validateToken($email, $token, $expiration_time)
  {
    $data = [
      'email' => $email,
      'token' => $token
    ];

    $result = $this->first($data);

    if ($result !== false) {
      $expiration_timeToken = strtotime($result->expiration_time);
      if ($expiration_timeToken >= $expiration_time) {
        return true; // Token is valid and not expired
      }
    }

    return false; // Token is invalid or expired
  }

  public function deleteToken($email)
  {
    $data = [
      'email' => $email,
    ];

    $this->delete($data, 'email');
  }
}