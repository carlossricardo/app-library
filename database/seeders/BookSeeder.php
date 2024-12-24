<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        
        $books = [
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 1',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE001', 'CATE002'], 
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 2',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE003', 'CATE006', 'CATE007'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 3',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE003', 'CATE006', 'CATE007'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 4',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE003', 'CATE006', 'CATE007'], 
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 5',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE007'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 6',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE003'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 7',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE006'], 
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 8',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE002'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 9',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE001', 'CATE007'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 10',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE003', 'CATE006', 'CATE007'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 11',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE002', 'CATE001'],
            ],
            [
                'id' => (string) \Str::uuid(),
                'title' => 'Tecnologías de la Información Vol. 12',
                'description' => 'Las TI son las Tecnologías de la Información, un conjunto de herramientas, recursos y estrategias que se utilizan para crear, gestionar, mantener y mejorar sistemas informáticos, redes virtuales y plataformas digitales.',
                'image' => '53336135-f0fe-4fd2-9fb8-7730a5900a45_20241219_215014.jpg',
                'autor' => 'Linda Green',
                'emission' => '2020-05-01',
                'units' => 8,
                'status' => true,
                'categories' => ['CATE002', 'CATE001'],
            ],
        ];



        foreach ($books as $bookData) {
        // Crear el libro
        $book = Book::create([
            'id' => $bookData['id'],
            'title' => $bookData['title'],
            'description' => $bookData['description'],
            'image' => $bookData['image'],
            'autor' => $bookData['autor'],
            'emission' => $bookData['emission'],
            'units' => $bookData['units'],
            'status' => $bookData['status'],
        ]);
            


        
        $categoryIds = Category::whereIn('code', $bookData['categories'])->pluck('id');

        
        $book->categories()->attach($categoryIds);
        }
            



    }
    
}

