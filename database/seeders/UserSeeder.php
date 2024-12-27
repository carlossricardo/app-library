<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;
use App\Models\Profile;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            [
                'email' => 'carlos.sricardo@hotmail.com', 
                'password' => bcrypt('C@rloss0622'), 
                'profiles' => ['ADMIN', 'STUDENT'],
                'person' => [
                    'identification' => '2450661760',
                    'names' => 'Carlos',
                    'surnames' => 'Ricardo',
                    'image' => 'a9584a1f-840b-4cb8-966b-79f4692aae37_20241226_124831.jpg',
                    'phone' => '0986757532',
                    'status' => true,
                ]
            ],
            [
                'email' => 'jose.madero@hotmail.com', 
                'password' => bcrypt('Jose0622'), 
                'profiles' => ['STUDENT'],
                'person' => [
                    'identification' => '0987654321',
                    'names' => 'José',
                    'surnames' => 'Madero',
                    'image' => 'a9584a1f-840b-4cb8-966b-79f4692aae37_20241226_124831.jpg',
                    'phone' => '555654321',
                    'status' => true,
                ]
            ],
        ];
        
     

        foreach ($users as $userData) {
            
            $person = Person::create([
                'id' => (string) \Str::uuid(),
                'identification' => $userData['person']['identification'],
                'names' => $userData['person']['names'],
                'surnames' => $userData['person']['surnames'],
                'image' => $userData['person']['image'],
                'phone' => $userData['person']['phone'],
                'status' => $userData['person']['status'],
            ]);

            
            $user = User::create([
                'id' => (string) \Str::uuid(),
                'person_id' => $person->id, 
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            
            $profileIds = Profile::whereIn('name', $userData['profiles'])->pluck('id');
            $user->profiles()->attach($profileIds);
        }
    }
}

