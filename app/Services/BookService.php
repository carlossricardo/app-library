<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\DataBase\QueryException;
use App\Models\Book;
use App\Models\Category;
use App\Exceptions\BookException;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalServerErrorException;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class BookService {


    public function findAllByBookUuid ( $categoryUuid, int $offset = 0, int $limit = 10 ) {

        try {
            $category = Category::find($categoryUuid);
            
            if( !$category ){
                throw new NotFoundException("Categoria no encontrada");
            }

            $books = $category->books()->skip( $offset )->take( $limit )->get();;
            // $books = $category->books;
            return response()->json([
                'status' => true,
                'message' => 'Data successful',
                'data' => $books
            ], 201);


        } catch (QueryException $e) {                                      
            throw new InternalServerErrorException('Error al guardar en la base de datos: ' . $e->getMessage());
    
        }  catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        } catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }

    }


    public function findAllBooksUuiid(){

     

    }

    public function patch( $book_id, $request )
    {        

        $book = Book::find($book_id);

        if (!$book) {
            return response()->json([
                'status' => false,
                'message' => 'Este libro no existe.',
                'missing_categories' => null
            ], 404);
        }

        
        $categories = Category::whereIn('id', $request['categories'])->get();
        $missingCategories = array_diff($request['categories'], $categories->pluck('id')->toArray());

        if (!empty($missingCategories)) {
            return response()->json([
                'status' => false,
                'message' => 'Algunas categorías no existen.',
                'missing_categories' => $missingCategories,
            ], 404);
        }


        $book->update([
            'title' => $request['title'] ?? $book->title, 
            'description' => $request['description'] ?? $book->description,
            'image' => $request['image'] ?? $book->image,
            'autor' => $request['autor'] ?? $book->autor,
            'status' => $request['status'] ?? $book->status,            
            'emission' => isset($request['emission']) ? Carbon::parse($request['emission'])->toDateString() : $book->emission,
            'units' => $request['units'] ?? $book->units,
        ]);

        
        $book->categories()->sync($categories->pluck('id')->toArray());

        
        $response = $book->toArray();
        $response['categories'] = $book->categories()->pluck('id')->toArray();



        return response()->json([
            'status' => true,
            'message' => 'Libro actualizado con éxito.',
            'data' => $response,
        ], 200);




        try {
            //code...
        }  catch (QueryException $e) {                              
            throw new InternalServerErrorException('Error en los query de la base de datos: ' . $e->getMessage());
    
        }  catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        } catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }
    }

    public function create($request)
    {
        try {

            $categories = Category::whereIn('id', $request['categories'])->get();
            
            $missingCategories = array_diff( $request['categories'], $categories->pluck('id')->toArray());
            if (!empty($missingCategories)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Algunas categorías no existen.',
                    'missing_categories' => $missingCategories,
                ], 404);
            }
            
            $newBook = Book::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'image' => $request['image'],
                'autor' => $request['autor'],
                'status' => $request['status'],
                'emission' => $request['emission'],
                'units' => $request['units'],
            ]);
            
            $newBook->categories()->attach($categories->pluck('id')->toArray());

            return response()->json([
                'status' => true,
                'message' => 'Libro creado y categorías asociadas con éxito.',
                'data' => $newBook,
            ], 201);

        }  catch (QueryException $e) {                              
            throw new InternalServerErrorException('Error en los query de la base de datos: ' . $e->getMessage());
    
        }  catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        } catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }
    }



    public function findAll( int $offset = 0, int $limit = 10 ) {


        try {
            $books = Book::orderBy('updated_at', 'desc')
            ->offset($offset * $limit)           
            ->limit($limit)                      
            ->get()
            ->map( function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'description' => $book->description,
                    'created_at' => $book->created_at,
                    'updated_at' => $book->updated_at,
                    'image' => $book->image,
                    'autor' => $book->autor,
                    'emission' => $book->emission,
                    'units' => $book->units,
                    'status' => $book->status,
                    'categories' => $book->categories->pluck('id')->toArray()
                ];
            });

            
            return response()->json([
                'status' => true,
                'message' => 'Data successful',
                'data' => $books
            ], 200);

        } catch (QueryException $e) {                              
            throw new InternalServerErrorException('Error en los query de la base de datos: ' . $e->getMessage());
    
        }  catch (\PDOException $th) {            
            throw new InternalServerErrorException('Error de conexión en la base de datos: ' . $th->getMessage());
            
        } catch (Exception $e) {            
            throw new InternalServerErrorException('Error no controlado: ' . $e->getMessage());
        }
    }


    public function findAllClient( int $offset = 0, int $limit = 10 ) {


        try {
            $books = Book::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->offset($offset * $limit)           
                ->limit($limit)                      
                ->get()
                ->map( function ($book) {
                    return [
                        'id' => $book->id,
                        'title' => $book->title,
                        'description' => $book->description,
                        'image' => $book->image,
                        'autor' => $book->autor,
                        'emission' => $book->emission,
                        'units' => $book->units,
                        'status' => $book->status,
                        'categories' => $book->categories->pluck('name')->toArray()
                    ];
                });
            
            return response()->json([
                'status' => true,
                'message' => 'Data successful',
                'data' => $books
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
