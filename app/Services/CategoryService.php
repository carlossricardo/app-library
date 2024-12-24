<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\DataBase\QueryException;
use App\Models\Category;
use App\Exceptions\BookException;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalServerErrorException;

use Illuminate\Support\Facades\DB;

class CategoryService {

    public function create ( $request ){

        try {            
            $newBookCategory = Category::create([
                'name' => $request['name'],
                'description' => $request['description']
            ]);            

            return response()->json([
                'status' => true,
                'message' => 'Data successful',
                'data' => $newBookCategory
            ], 201);

        } catch (QueryException $e) {                         
            if ($e->getCode() === '2002' || strpos($e->getMessage(), 'No connection') !== false) {
                throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $e->getMessage());
            }            
            throw new InternalServerErrorException('Error al guardar en la base de datos: ' . $e->getMessage());
    
        }  catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        } catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }
                
    }



    public function findAll(){

        try {

            $categories = Category::orderBy('created_at', 'desc')                   
            ->get();


            return response()->json([
                'status' => true,
                'message' => 'Data successful',
                'data' => $categories
            ], 200);

        } catch (QueryException $e) {                              
            throw new InternalServerErrorException('Error en los query de la base de datos: ' . $e->getMessage());
    
        }  catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        } catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }

    }






    
}
