<?php

class User
{
	use Model;

	protected $table = 'users';
	protected $allowedColumns = [
		'user_id',
		'first_name',
		'last_name',
		'phone_number',
		'email',
		'address',
		'password',
		'uploaded_profile_photo_path',
		'generated_profile_photo_path',
		'verification_token',
		'verification_status',
		'token_expiration',
		'phone_verification_code',
		'phone_number_status',
		'role',
		'permissions',
	];
	protected $order_column = 'user_id';
	public $errors = [];

	public function validate($data)
	{
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$address = $data['address'];
		$email = $data['email'];
		$phone_number = $data['phone_number'];
		$password = $data['password'];
		$password_confirmation = $data['password_confirmation'];
		$verification_token = $data['verification_token'];

		$this->validateEmail($email);
		$this->validatePhoneNumber($phone_number);
		$this->validatePassword($password, $password_confirmation);

		if (empty($first_name) && empty($last_name)) {
			$this->addError('first_name', 'First name and last name are required.');
		} else {
			$this->validateRequired($first_name, 'first_name');
			$this->validateRequired($last_name, 'last_name');
		}

		if (empty($address)) {
			$this->addError('address', 'Address is required.');
		}

		if (empty($verification_token)) {
			$this->addError('verification_token', 'Verification token is required.');
		} elseif ($this->isVerificationTokenUsed($verification_token)) {
			$this->addError('verification_token', 'Verification token has already been used.');
		}

		// Return false if there are any errors
		if (!empty($this->errors)) {
			return false;
		}

		return true;
	}

	public function adminUserValidate($data)
	{
		$errors = [];

		$requiredFields = [
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'address' => 'Address',
			'phone_number' => 'Phone Number',
			'role' => 'Role'
		];
	
		foreach ($requiredFields as $field => $fieldName) {
			if (empty($data[$field])) {
				$errors[] = "{$fieldName} is required.";
			}
		}

		if (empty($data['phone_number'])) {
			$errors[] = "Phone Number is required.";
		} else {
			$phoneNumber = $data['phone_number'];
		
			if (strlen($phoneNumber) !== 10) {
				$errors[] = "Invalid phone number. Please enter a valid 10-digit number after '+63'.";
			}  elseif (!is_numeric(substr($phoneNumber, 3))) {
        $errors[] = "Invalid phone number. Please enter only numeric digits (0-9) after '+63'.";
			} else {
				$existingUserWithPhoneNumber = $this->first(['phone_number' => $phoneNumber]);
				$existingUserId = isset($existingUserWithEmail->user_id) ? intval($existingUserWithEmail->user_id) : null;
				$userId = isset($data['user_id']) ? intval($data['user_id']) : null;

				if ($existingUserWithPhoneNumber) {
					if ($userId !== null) {
						if ($existingUserId !== $userId) {
							$errors[] = "The phone number '$phoneNumber' has already been taken.";
						}
					} else {
						$errors[] = "The phone number '$phoneNumber' has already been taken.";
					}
				}
			}
		}
	
		$email = $data['email'];
		$password = $data['password'];
		$passwordConfirmation = $data['password_confirmation'];

		if (!empty($email)) {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Invalid email format.';
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Invalid email format.';
			} else {
				$existingUserWithEmail = $this->first(['email' => $email]);
				$existingUserId = isset($existingUserWithEmail->user_id) ? intval($existingUserWithEmail->user_id) : null;
				$userId = isset($data['user_id']) ? intval($data['user_id']) : null;

				if ($existingUserWithEmail) {
					if ($userId !== null) {
						if ($existingUserId !== $userId) {
							$errors[] = "The email address '$email' has already been taken.";
						}
					} else {
						$errors[] = "The email address '$email' has already been taken.";
					}
				}
			}
		}
	
		if (!empty($password) && !empty($passwordConfirmation)) {
			if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password) || strlen($password) < 8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $passwordConfirmation) || strlen($passwordConfirmation) < 8) {
				$errors[] = 'Passwords need to be at least 8 characters long, contain 1 upper and 1 <br>  lower-case letter, 1 number, and at least 1 special character (e.g. !"#$%&).';
			} elseif ($password !== $passwordConfirmation) {
				$errors[] = 'Passwords do not match. Please try again.';
			}
		}

		return $errors;
	}
  
	public function isVerificationTokenUsed($verification_token)
	{
    // Check if the token has already been used by verifying the verification_status
    $result = $this->where(['verification_token' => $verification_token, 'verification_status' => 'verified']);
    return !empty($result);
	}
	
	public function validateEmailOrPhone($emailOrPhone)
	{
		if (empty($emailOrPhone)) {
			$this->addError('email_or_phone', 'Email or phone number is required.');
		} elseif (!filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL) && !preg_match('/^(?:\+639[0-9]{9}|09[0-9]{9})$/', $emailOrPhone)) {
			$this->addError('email_or_phone', 'Invalid email or phone number format.');
		} elseif (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL) && !empty($this->where(['email' => $emailOrPhone]))) {
			$this->addError('email_or_phone', "The email address '$emailOrPhone' has already been taken.");
		} elseif (preg_match('/^(?:\+639[0-9]{9}|09[0-9]{9})$/', $emailOrPhone) && !empty($this->where(['phone_number' => $emailOrPhone]))) {
			$this->addError('email_or_phone', "The phone number '$emailOrPhone' has already been taken.");
		}
	}

	private function validatePhoneNumber($phone_number)
	{
		// Check if the phone number is empty
		if (empty($phone_number)) {
			$this->addError('phone_number', 'Phone number is required.');
		} 
		// Check if the phone number matches the valid formats
		elseif (!preg_match('/^(?:\+639[0-9]{9}|09[0-9]{9})$/', $phone_number)) {
			$this->addError('phone_number', 'Invalid phone number format.');
		} 
		// Check if the phone number is already taken
		elseif (!empty($this->where(['phone_number' => $phone_number]))) {
			$this->addError('phone_number', "The phone number '$phone_number' has already been taken.");
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

	public function formatPhoneNumber($emailOrPhone)
	{
		$numericPhoneNumber = preg_replace('/[^0-9]/', '', $emailOrPhone);

		if (substr($numericPhoneNumber, 0, 2) === '09') {
			$formattedPhoneNumber = '+639' . substr($numericPhoneNumber, 2);
		} else {
			$formattedPhoneNumber = $numericPhoneNumber;
		}

		return $formattedPhoneNumber;
	}

	public function validate_profile_info($data)
	{
		$sessionEmail = $_SESSION['USER']->email;
		$sessionPhone = $_SESSION['USER']->phone_number;
		$email = $data['email'];
		$phone_number = $data['phone_number'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$address = $data['address'];

		if (empty($address)) {
			$this->addError('address', 'Address is required.');
		} elseif (empty($first_name) && empty($last_name)) {
			$this->addError('first_name', 'First name and last name are required.');
		} else {
			$this->validateRequired($first_name, 'first_name');
			$this->validateRequired($last_name, 'last_name');
		}
	
		if (empty($this->errors)) {
			if (!empty($email)) {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$this->addError('email', 'Invalid email format.');
				} elseif ($sessionEmail !== $email) {
					$existingUser = $this->where(['email' => $email]);
					if (!empty($existingUser)) {
						$this->addError('email', 'This email is already in use by another user.');
					}
				}
			} else {
				$this->addError('email', 'Email is required.');
			}
		}
	
		if (empty($this->errors)) {
			if (!empty($phone_number)) {
				if (!preg_match('/^(?:\+639[0-9]{9}|09[0-9]{9})$/', $phone_number)) {
					$this->addError('phone_number', "Invalid phone number format. Please make sure <br> to enter a valid 10-digit number after '+63'.");
				} elseif ($sessionPhone !== $phone_number) {
					$existingUser = $this->first(['phone_number' => $phone_number]); // Use first() to get a single result

					// Check if the phone number is in use by another user
					if (!empty($existingUser) && $existingUser->user_id !== $_SESSION['USER']->user_id) {
						$this->addError('phone_number', 'This phone number is already in use by another user.');
					}
				}
			} else {
				$this->addError('phone_number', 'Phone number is required.');
			}
		}

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
		} elseif (empty($password_confirmation)) {
			$this->addError('password_confirmation', 'Password confirmation is required.');
			return false;
		} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password) && (strlen($password) < 8) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password_confirmation) && (strlen($password_confirmation) < 8)) {
			$this->addError('password', 'Passwords need to be at least 8 characters long, <br>contains  1 upper and 1 lower-case letter, 1 number <br>and at least 1 special character (e.g. !"#$%&).');
			return false;
		} elseif ($password !== $password_confirmation) {
			$this->addError('password_confirmation', 'Passwords do not match. Please try again.');
			return false;
		}

		return true;
	}

	public function accountValidatePassword($password)
	{
		if (empty($password)) {
			$this->addError('password', 'Password is required.');
			return false;
		} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $password)) {
			$this->addError('password', 'Passwords need to be at least 8 characters long, <br>contains  1 upper and 1 lower-case letter, 1 number <br>and at least 1 special character (e.g. !"#$%&).');
			return false;
		}

		return true;
	}

	public function countOperatorsWithActiveOrDroppedTricycleStatus()
	{
		$query = "SELECT COUNT(DISTINCT u.user_id) AS count
							FROM users u
							INNER JOIN tricycles t ON u.user_id = t.user_id
							INNER JOIN tricycle_statuses ts ON t.tricycle_id = ts.tricycle_id
							WHERE u.role = 'operator'
							AND ts.status IN ('Active', 'Dropped')";

		$result = $this->query($query);

		$count = 0;

		if ($result && isset($result[0]->count)) {
			$count = $result[0]->count;
		}

		return $count;
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

  public function getFilteredUsers($selectedFilter, $selectedRoleFilter, $whereConditions = [])
  {
    $whereClause = '';
    $queryParams = [];

    if (!empty($whereConditions)) {
        foreach ($whereConditions as $column => $value) {
            $whereClause .= " AND $column = ?";
            $queryParams[] = $value;
        }
    }

    if ($selectedFilter !== 'all') {
        $whereClause .= " AND CONCAT(first_name, ' ', last_name) = ?";
        $queryParams[] = $selectedFilter;
    }

    if ($selectedRoleFilter !== 'all') {
        $whereClause .= " AND role = ?";
        $queryParams[] = $selectedRoleFilter;
    }

    $query = "SELECT * FROM {$this->table} WHERE 1 $whereClause ORDER BY user_id DESC";
    return $this->query($query, $queryParams);
  }
}