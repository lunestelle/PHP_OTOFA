<?php

class User
{
	use Model;

	protected $table = 'users';
	protected $allowedColumns = ['user_id', 'first_name', 'last_name', 'email', 'password'];
	protected $order_column = 'user_id';
	public $errors = [];

	public function validate($data)
	{
		$email = $data['email'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$password = $data['password'];
		$password_confirmation = $data['password_confirmation'];

		$this->validateEmail($email);
		$this->validatePassword($password, $password_confirmation);

		if (empty($first_name) && empty($last_name)) {
			$this->addError('first_name', 'First name and last name are required.');
		} else {
			$this->validateRequired($first_name, 'first_name');
			$this->validateRequired($last_name, 'last_name');
		}

		// Return false if there are any errors
		if (!empty($this->errors)) {
			return false;
		}

		return true;
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


	public function validatePassword($password, $password_confirmation)
	{
		if (empty($password)) {
			$this->addError('password', 'Password is required.');
			return false;
		} elseif (strlen($password) < 8) {
			$this->addError('password', 'Password must be at least 8 characters long.');
			return false;
		} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password)) {
			$this->addError('password', 'Passwords need to be at least 8 characters long, <br>contains  1 upper and 1 lower-case letter, 1 number <br>and at least 1 special character (e.g. !"#$%&).');
			return false;
		} elseif ($password !== $password_confirmation) {
			$this->addError('password_confirmation', 'Passwords do not match. Please try again.');
			return false;
		}

		return true;
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
			$fieldName = str_replace('_', ' ', $field);
			$this->addError($field, ucfirst($fieldName) . ' is required.');
    }
	}

	private function addError($field, $message)
	{
		$this->errors[$field] = $message;
	}
}
