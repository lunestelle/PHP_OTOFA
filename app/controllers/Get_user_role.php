<?php 

class Get_user_role
{
	use Controller;

	public function index()
	{
		if (isset($_SESSION['USER']) && isset($_SESSION['USER']->role)) {
      // Echo the user's role
      echo $_SESSION['USER']->role;
    } else {
        // If the user role is not set or the user is not logged in, return null or handle the case accordingly
        echo "guest"; // or any default value
    }
	}
}