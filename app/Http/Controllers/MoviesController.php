<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    
    public function index(){
        return view('movie/index');
    } 


    public function search(Request $request, $search = null, $page = null){

        if ($request->page == null) {
            $searchName = $request->title;
            $movies = Http::get('https://omdbapi.com?apikey=69f42943&s='.$searchName);
            if ($movies['Response'] == 'True') {
                $halaman = ceil(intval($movies['totalResults'])/10);
                $current = 1;
            } else {
                $halaman = 0;
                $current = 0;
            }
        } else {
            $searchName = $request->title;
            $movie = Http::get('https://omdbapi.com?apikey=69f42943&s='.$searchName);
            if ($movie['Response'] == 'True') {
                $halaman = ceil(intval($movie['totalResults'])/10);

                $movies = Http::get('https://omdbapi.com?apikey=69f42943&s='.$searchName.'&page='.$request->page);
                $current = $request->page;
            
            } else {
                $halaman = 0;
                $current = 0;
            }
        }

 
        return view('movie/search', [
            'movies' => $movies, 
            'title' => $searchName, 
            'page' => $halaman,
            'current' => $current
        ]);
    }

}