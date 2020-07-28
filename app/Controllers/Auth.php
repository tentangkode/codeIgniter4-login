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

	public function register()
	{
		if ($this->request->getMethod() === 'post') {
			$rules = [
				'first_name' => [
					'label' => 'First Name',
					'rules' => 'required|min_length[2]'
				],
				'last_name' => [
					'label' => 'Last Name',
					'rules' => 'required'
				],
				'username' => [
					'label' => 'Username',
					'rules' => 'required|alpha_numeric|is_unique[users.username]'
				],
				'email' => [
					'label' => 'E-Mail',
					'rules' => 'required|valid_email|is_unique[users.email]'
				],
				'password' => [
					'label' => 'Password',
					'rules' => 'required|min_length[6]'
				],
				'cpassword' => [
					'label' => 'Password Confirmation',
					'rules' => 'required|matches[password]'
				]
			];
			$validate = $this->validate($rules);
			if ($validate) {
				$newUser = [
					'first_name' => $this->request->getPost('first_name'),
					'last_name' => $this->request->getPost('last_name'),
					'username' => $this->request->getPost('username'),
					'email' => $this->request->getPost('email'),
					'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
				];

				$userModel = new \App\Models\UserModel;
				$userModel->insert($newUser);

				session()->set([
					'fullName' => $newUser['first_name'] . ' ' . $newUser['last_name'],
					'username'  => $newUser['username'],
					'email'     => $newUser['email'],
					'logged_in' => TRUE
				]);

				return redirect('/');

			} else {
				return redirect('auth/register')->withInput()->with('validation', $this->validator);
			}
		} else {
			return view('auth/register', ['validation' => null]);
		}
	}

	public function logout()
	{
		session()->destroy();

		return redirect('/');
	}
}
