<?php

class User
{
	use Model;

	protected $table = 'users';
	public $errors = [];

	public function validate($data)
	{
		$email = $data['email'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$password = $data['password'];
		$password_confirmation = $data['password_confirmation'];

		if (empty($email)) {
			$this->addError('email', 'Email is required.');
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->addError('email', 'Invalid email format.');
		} elseif ($this->isEmailTaken($email)) {
			$this->addError('email', 'Email is already taken.');
		}

		if (empty($first_name)) {
			$this->addError('first_name', 'First name is required.');
		}

		if (empty($last_name)) {
			$this->addError('last_name', 'Last name is required.');
		}

		if (empty($password)) {
			$this->addError('password', 'Password is required.');
		} elseif (strlen($password) < 8) {
			$this->addError('password', 'Password must be at least 8 characters long.');
		} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password)) {
			$this->addError('password', 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character');
		}

		if ($password !== $password_confirmation) {
			$this->addError('password_confirmation', 'Passwords do not match.');
		}

		// Return true if there are no errors
		return empty($this->errors);
	}

	public function getErrors()
	{
		return $this->errors;
	}

	private function isEmailTaken($email)
	{
		$query = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
		$result = $this->query($query, ['email' => $email]);

		return !empty($result);
	}

	private function addError($field, $message)
	{
		$this->errors[$field] = $message;
	}
}