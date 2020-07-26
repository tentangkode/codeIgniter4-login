<?php

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $data = [];
        for($i = 1; $i <= 10; $i ++) {
            $data[] = [
                'first_name' => $faker->firstNameMale,
                'last_name' => $faker->lastName,
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => password_hash('123456', PASSWORD_DEFAULT)
            ];
        }

        $this->db->table('users')->insertBatch($data);
    }
}