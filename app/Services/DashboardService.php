<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\DataBase\QueryException;
use App\Models\{Loan,Book, User};
use App\Exceptions\BookException;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalServerErrorException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService {

    public function findAll (  ){

        try {    
            
            
            
            $startOfWeek = Carbon::now()->startOfWeek(); 
            $endOfWeek = Carbon::now()->endOfWeek();

            
            $loans = Loan::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->with('details') 
                        ->get();

             
            $totalBooksLoaned = 0;

            foreach ($loans as $loan) {
                foreach ($loan->details as $detail) {
                    $totalBooksLoaned += $detail->quantity; 
                }
            }

             
             $totalStudents = User::whereHas('profiles', function ($query) {
                $query->where('name', 'STUDENT'); 
            })->count();
             $totalTeachers = User::whereHas('profiles', function ($query) {
                $query->where('name', 'TEACHER'); 
            })->count();
            

            
            $totalAvailableBooks = Book::where('status', true)->count();


            $dashboard = [
                [
                    'name' => 'Prestamos por semana',
                    'icon' => 'pi pi-cart-arrow-down',
                    'value' => $totalBooksLoaned,
                    'color' => 'bg-blue-100'
                ],
                [
                    'name' => 'Cantidad de estudiantes',
                    'icon' => 'pi pi-users',
                    'value' => $totalStudents,
                    'color' => 'bg-orange-100'
                ],
                [
                    'name' => 'Libros disponibles',
                    'icon' => 'pi pi-book',
                    'value' => $totalAvailableBooks,
                    'color' => 'bg-cyan-100'
                ],
                [
                    'name' => 'Cantidad de docentes',
                    'icon' => 'pi pi-graduation-cap',
                    'value' => $totalTeachers,
                    'color' => 'bg-green-100'
                ],
         
            ];


            return response()->json([
                'status' => true,
                'message' => 'Data successful',
                'data' => $dashboard,
               
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
