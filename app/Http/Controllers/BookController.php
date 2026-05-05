<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BookController extends Controller
{
    
    public function index()
    {
        
        $books = Book::orderBy('created_at', 'desc')->get();

        
        return view('books.index', compact('books'));
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'titulo'           => 'required|string|max:255',
            'autor'            => 'required|string|max:255',
            'anio_publicacion' => 'required|integer|digits:4|min:1000|max:' . date('Y'),
        ], [
            'titulo.required'           => 'El título es obligatorio.',
            'autor.required'            => 'El autor es obligatorio.',
            'anio_publicacion.required' => 'El año es obligatorio.',
            'anio_publicacion.digits'   => 'El año debe tener exactamente 4 dígitos.',
            'anio_publicacion.max'      => 'El año no puede ser mayor al año actual.',
        ]);

        
        Book::create([
            'titulo'           => $request->titulo,
            'autor'            => $request->autor,
            'anio_publicacion' => $request->anio_publicacion,
        ]);

        
        return redirect()->route('books.index')
                         ->with('success', '¡Libro registrado exitosamente!');
    }
}
