<?php

class User
{
	use Model;

	protected $table = 'users';
	protected $allowedColumns = ['first_name', 'last_name', 'email', 'password'];
	public $errors = [];

	public function validate($data)
	{
		$email = $data['email'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$password = $data['password'];
		$password_confirmation = $data['password_confirmation'];

		$this->validateEmail($email);
		$this->validateRequired($first_name, 'first_name');
		$this->validateRequired($last_name, 'last_name');
		$this->validatePassword($password);
		$this->validatePasswordConfirmation($password, $password_confirmation);

		// Return true if there are no errors
		return empty($this->errors);
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function emailExists($email)
	{
		$result = $this->where(['email' => $email]);
		return !empty($result);
	}

	public function validatePassword($password)
	{
		if (empty($password)) {
			$this->addError('password', 'Password is required.');
		} elseif (strlen($password) < 8) {
			$this->addError('password', 'Password must be at least 8 characters long.');
		} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password)) {
			$this->addError('password', 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character');
		}
	}

	private function validateEmail($email)
	{
		if (empty($email)) {
			$this->addError('email', 'Email is required.');
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->addError('email', 'Invalid email format.');
		} elseif ($this->emailExists($email)) {
			$this->addError('email', 'Email is already taken.');
		}
	}

	private function validateRequired($value, $field)
	{
		if (empty($value)) {
			$this->addError($field, ucfirst($field) . ' is required.');
		}
	}

	private function validatePasswordConfirmation($password, $password_confirmation)
	{
		if ($password !== $password_confirmation) {
			$this->addError('password_confirmation', 'Passwords do not match.');
		}
	}

	private function addError($field, $message)
	{
		$this->errors[$field] = $message;
	}
}