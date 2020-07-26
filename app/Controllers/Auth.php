<?php namespace App\Controllers;

class Auth extends BaseController
{
	public function login()
	{
		if ($this->request->getMethod() === 'post') {
			$rules = [
				'username' => 'required',
				'password' => 'required'
			];
			$validate = $this->validate($rules);
			if ($validate) {
				$username = $this->request->getPost('username');
				$password = $this->request->getPost('password');

				$userModel = new \App\Models\UserModel;
				$user = $userModel->asObject()->where('username', $username)->orWhere('email', $username)->first();
				if ($user) {
					if (password_verify($password, $user->password)) {

						session()->set([
							'fullName' => $user->first_name . ' ' . $user->last_name,
							'username'  => $user->username,
							'email'     => $user->email,
							'logged_in' => TRUE
						]);

						return redirect('/');
					}
				}

				return view('auth/login', [
					'validation' => null,
					'error' => 'Username atau Password salah!'
				]);

			} else {
				return view('auth/login', [
					'validation' => $this->validator,
					'error' => null
				]);
			}
		} else {
			return view('auth/login', ['validation' => null, 'error' => null]);
		}
	}

	public function logout()
	{
		session()->destroy();

		return redirect('/');
	}
}
