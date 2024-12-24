<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\DataBase\QueryException;
use App\Models\Loan;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalServerErrorException;

use Illuminate\Support\Facades\DB;

class LoanService {


    public function patch( Request $request ){
        $loan_id = $request->get('loan_id');
        $newRequest = collect($request)->all();  
        try {

            $loan = Loan::find($loan_id);

            if (!$loan) {
                throw new NotFoundException('El prestamo con id ' . ${loan->id} . ' no existe.');
            }

            $loan->update([
                'status' => $newRequest['status'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cambios realizo con éxito.',
                'data' => $loan
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

    public function findAll ( int $offset = 0, int $limit = 10 ){

        try {  
            
            
            $loans = Loan::with(['details.book', 'user']) 
            ->orderBy('updated_at', 'desc')
            ->offset($offset * $limit)
            ->limit($limit)
            ->get()
            ->map(function ($loan) {
                return [
                    'id' => $loan->id,
                    'status' => $loan->status,
                    'created_at' => $loan->created_at,
                    'updated_at' => $loan->updated_at,
                    'user' => [
                        'id' => $loan->user->id,
                        'name' => $loan->user->name,
                        'email' => $loan->user->email,
                        'person' => $loan->user->person
                    ],
                    'details' => $loan->details->map(function ($detail) {
                        return [
                            'id' => $detail->id,
                            'quantity' => $detail->quantity,
                            'book' => $detail->book, 
                        ];
                    }),
                ];
            });


            return response()->json([
                'status' => true,
                'message' => 'Data successful',
                'data' => $loans
            ], 200);

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




    
}
