<?php

class PasswordReset
{
  use Model;

  protected $table = 'password_resets';
  protected $allowedColumns = ['email', 'token', 'expiration_time'];

  public function generateToken()
  {
    return bin2hex(random_bytes(32));
  }

  public function saveResetToken($email, $token, $expirationTime)
  {
    $data = [
      'email' => $email,
      'token' => $token,
      'expiration_time' => date('Y-m-d H:i:s', $expirationTime)
    ];

    $this->insert($data);
  }

  public function deleteExistingToken($email)
  {
    return $this->where(['email' => $email])->delete();
  }

  public function findEmailByToken($token)
  {
    $result = $this->where(['token' => $token]);
    if (!empty($result)) {
      return $result[0]->email;
    }
    return null;
  }

  public function validateToken($email, $token)
{
    $result = $this->where(['email' => $email, 'token' => $token]);

    if (!empty($result)) {
        $expirationTime = strtotime($result[0]->expiration_time);

        if ($expirationTime > time()) {
            return true;
        }
    }

    return false;
}




}