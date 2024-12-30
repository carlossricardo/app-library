<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\DataBase\QueryException;
use App\Models\Category;
use App\Models\Profile;
use App\Models\{User,Person};
use App\Exceptions\BookException;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalServerErrorException;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationService {



    public function login( $email, $password ) {
        
        
        try {
            $user = User::where( 'email', $email )->first();
    
            if( !$user ){
               throw new NotFoundException("Usuario no encontrado");
            }
            
            $isPasswordCorrect = Hash::check( $password, $user->password );
            if( !$isPasswordCorrect ){
                throw new NotFoundException("La contraseña es incorrecta");
            }
    
    
            $payload = [ 'user_id' => $user->id ];
            $token = JWTAuth::claims($payload)->fromSubject($user);
            // return response()->json($token, 200);
            return response()->json([
                'status' => true,
                'message' => 'Acceso al sistema.',
                'token' => $token
            ], 200);
            
        }   catch (QueryException $e) {                         
            if ($e->getCode() === '2002' || strpos($e->getMessage(), 'No connection') !== false) {
                throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $e->getMessage());
            }            
            throw new InternalServerErrorException('Error al guardar en la base de datos: ' . $e->getMessage());
    
        }   catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        }   catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }

    }


    public function registerClient ( Request $request ){

        $userData = collect($request)->all();
        try {
            

            $person = Person::create([                
                'identification' => $userData['identification'],
                'names' => $userData['names'],
                'surnames' => $userData['surnames'],
                'image' => $userData['image'],
                'phone' => $userData['phone'],
                'status' => true,
            ]);

            $user = User::create([                
                'person_id' => $person->id, 
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);

            $profileIds = Profile::whereIn('name', $userData['profiles'])->pluck('id');
            $user->profiles()->attach($profileIds);

            $payload = [ 'user_id' => $user->id ];
            $token = JWTAuth::claims($payload)->fromSubject($user);

            return response()->json([
                'status' => true,
                'message' => 'Registro realizado con éxito.',
                'token' => $token
            ], 200);




        }   catch (QueryException $e) {                         
            if ($e->getCode() === '2002' || strpos($e->getMessage(), 'No connection') !== false) {
                throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $e->getMessage());
            }            
            throw new InternalServerErrorException('Error al guardar en la base de datos: ' . $e->getMessage());
    
        }   catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        }   catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }

    }

    public function register( Request $request ) {
        $data_user = collect($request)->all();

        try {           
            
            $profilesUuids = [
                // '21fc40ee-5d6d-43ae-957a-4e061d6054c2',
                '61454a64-4299-43ed-a472-ff511c4a562f'
            ];

            $profiles = Profile::whereIn('id', $profilesUuids)->get();

            $missingProfiles = array_diff($profilesUuids, $profiles->pluck('id')->toArray());
            if (!empty($missingProfiles)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Algunas categorías no existen.',
                    'missing_categories' => $missingProfiles,
                ], 404);
            }
            
            $newUser = User::create([
                'name' => $data_user['name'],
                'email' => $data_user['email'],
                'password' => Hash::make($data_user['password']),
            ]);   
            
            $newUser->profiles()->attach($profiles->pluck('id')->toArray());
    
            return response()->json([
                'status' => true,
                'message' => 'Acceso al sistema.',
                'data' => $newUser
            ], 200);

        }   catch (QueryException $e) {
            throw new InternalServerErrorException('Error al interactuar con la base de datos. ' . $e->getMessage());

        }   catch (\PDOException $e) {
            throw new InternalServerErrorException('Error de conexión con la base de datos. ' . $e->getMessage());
            
        }   catch (\Exception $e) {            
            throw new InternalServerErrorException('Ocurrió un error inesperado. ' . $e->getMessage());
            
        }


    }






    
}
