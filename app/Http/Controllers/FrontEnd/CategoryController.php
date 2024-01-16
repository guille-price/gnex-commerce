<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function repite()
    {
        //$salida = "";
        $capture = "kjlsdlkhgsdhf";

        $num_letters = strlen($capture) - 1;

        $sig_letra = substr($capture, -$num_letters, 1);

        //return $rest;
        $array = str_split($capture);
        $cont = strlen($capture);

        $concatenar = "";

        // $string = 'The lazy fox jumped over the fence';


        // if (str_contains($string, 'Lazy')) {
        //     echo 'The string "Lazy" was found in the string';
        // } else {
        //     echo '"Lazy" was not found because the case does not match';
        // }

        //dd($concatenar, $sig_letra);
        

        foreach ($array as $val) {
            //$concatenar = $val;
            $cont = $cont - 1;
            //dd($rest, $val);
            

            if (str_contains($concatenar, $sig_letra)) {
                $salida = strlen($concatenar);

                //dd('Igual');
            } else {
                $concatenar = $concatenar . $val;

                
                $sig_letra = substr($capture, -$cont, 1);

            }
        }

        //dd($salida, $concatenar, $val, $sig_letra, $num_letters, $cont);

        //dd($concatenar, $num_letters, $sig_letra);
        //dd($concatenar, $salida);
        //$result = strlen($salida);
        return "Numero de Caracteres antes de repetirse " .$salida .", y el caracter que se repite es: " .$sig_letra . " en la cadena: " .$capture;
    }

    function lengthOfLongestSubstring($s) {
        $capture = "abcabcbb";

        $num_letters = strlen($capture) - 1;

        $sig_letra = substr($capture, -$num_letters, 1);
        $array = str_split($capture);
        $cont = strlen($capture);
        $concatenar = "";

        foreach ($array as $val) {
            $cont = $cont - 1;
            
            if (str_contains($concatenar, $sig_letra)) {
                $salida = strlen($concatenar);
            } else {
                $concatenar = $concatenar . $val;
                $sig_letra = substr($capture, -$cont, 1);
            }
        }

        return $salida;
        
    }
}
