<?php


use Phinx\Seed\AbstractSeed;

class ContactSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $stmt = $this->query('SELECT * FROM user');
        $users = $stmt->fetchAll();

        $contacts = [];

        foreach ($users as $key => $value) {
            for ($i = 0; $i < 30; $i++) {
                $contacts[] = [
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'phone_number' => $faker->e164PhoneNumber,
                    'note' => $faker->realText($maxNbChars = 10),
                    'user_id' => $value['id'],
                    'created_at' => date('Y-m-j H:i:s')
                ];
            }
        }

        
        $this->insert("contact", $contacts);
    }
}
