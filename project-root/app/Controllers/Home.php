<?php

namespace App\Controllers;

use App\Models\Media_model;
use App\Models\Streamingservice_model;
use CodeIgniter\Files\File;

class Home extends BaseController
{
    protected $helpers = ['form'];

    public function index($page = 1)
    {
        return $this->loadMovies($page);
    }

    public function filter()
    {
        $type = $this->request->getGet('type');
        $genre = $this->request->getGet('genre');
        $providers = $this->request->getGet('providers');
        $released_from = $this->request->getGet('released_from');
        $released_to = $this->request->getGet('released_to');
    
        $moviesModel = new Media_model();
        $query = $moviesModel->select('media.*, streamingservices.Name as StreamingProvider') // Lekérjük a StreamingProvider-t
                             ->distinct()
                             ->join('mediaxgenre', 'mediaxgenre.MediaID = media.ID', 'left')
                             ->join('genres', 'genres.ID = mediaxgenre.GenreID', 'left')
                             ->join('streamingservices', 'streamingservices.ID = media.Ss_id', 'left'); // Csak akkor jelenik meg, ha van Ss_id
    
        if ($type) {
            $query->where('Type', $type);
        }
    
        if ($genre) {
            $query->where('genres.Genre', $genre); // A genres tábla 'Name' oszlopára szűrni
        }
    
        if ($providers) {
            $query->whereIn('streamingservices.Name', $providers); // A streamingservices.Name alapján szűrés
        }
    
        if ($released_from) {
            $query->where('Released >=', $released_from);
        }
    
        if ($released_to) {
            $query->where('Released <=', $released_to);
        }
    
        $data['movies'] = $query->get()->getResult(); // Lekérdezett adatok
        $data['type'] = $type;
        $data['genre'] = $genre;
        $data['providers'] = $providers;
        $data['released_from'] = $released_from ?? '';
        $data['released_to'] = $released_to ?? '';
    
        // Szolgáltatók listája
        $providersModel = new Streamingservice_model();
        $data['providers_list'] = $providersModel->getAllProviders();
    
        return $this->loadPage('user/home', $data);
    }
    


    public function loadMovies($page = 1)
    {
        $moviesModel = new Media_model();
        $movies = $moviesModel->getStreaming();
        $newMovies = getMovies($page,"popularity.desc");
        $newSeries = getSeries($page);
        $data['newmovies'] = array_slice($newMovies,0,4);
        $data['newseries'] = $newSeries;
        $data['page'] = $page;
        $total_page = 2;
        $limitStart = max(1,$page - 1);
        $limitEnd = min($total_page,$limitStart + 5);
        $data['total_page'] = $total_page;
        $data['limitStart'] = $limitStart;
        $data['limitEnd'] = $limitEnd;
        if($limitEnd - $limitStart < 3){
            $limitStart = max(1,$limitEnd - 5);
        }

        // Szolgáltatók listája
        $providersModel = new Streamingservice_model();
        $data['providers_list'] = $providersModel->getAllProviders();

        return $this->loadPage('user/home', $data);
    }

    public function reszletek($id)
    {
        $movies = getMovies();
        $casts = getCastByMovie($id);
        $teaser = getMovieTeaser($id);
        $providers = getWatchProviders($id);
        foreach($movies as $item){
            if(in_array($id,$item)){
                $movie = $item;
            }
        }
        $movie['casts'] = $casts;
        $movie['teaser'] = $teaser;
        $movie['providers'] = $providers;
        //$movieModel = new Media_model();
        /*$movie = $movieModel->select('media.*, streamingservices.Name as StreamingProvider, streamingservices.Lowest_price_plan as Price, streamingservices.Link')
            ->join('streamingservices', 'streamingservices.ID = media.Ss_id')
            ->where('media.ID', $id)
            ->first();*/

        if (!$movies) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Movie not found");
        }

        return $this->loadPage('user/movie_details', ['movie' => $movie]);
    }

    public function loadPage($page = 0, $data = [])
    {
        return view('templates/header') . view($page, $data) . view('templates/footer');
    }
}