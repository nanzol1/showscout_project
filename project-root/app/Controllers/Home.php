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

        $type = $this->request->getGet('type');
        $newMovies = getMovies($page,"popularity.desc");
        $newSeries = getSeries($page);
        $genres = getGenres();
        $tvGenres = getTvGenres();


        $releasedFrom = $this->request->getGet('released_from'); // "Tól" dátum
        $releasedTo = $this->request->getGet('released_to'); // "Ig" dátum


        $selectedGenres = $this->request->getGet('genres');
            if ($selectedGenres) {
                $selectedGenres = is_array($selectedGenres) ? $selectedGenres : [$selectedGenres];

                // Szűrés filmekre
                $newMovies = array_filter($newMovies, function ($item) use ($selectedGenres) {
                    if (!isset($item['genre_ids'])) return false;
                    return count(array_intersect($selectedGenres, $item['genre_ids'])) === count($selectedGenres);
                });

                // Szűrés sorozatokra
                $newSeries = array_filter($newSeries, function ($item) use ($selectedGenres) {
                    if (!isset($item['genre_ids'])) return false;
                    return count(array_intersect($selectedGenres, $item['genre_ids'])) === count($selectedGenres);
                });
            }

        if ($releasedFrom || $releasedTo) {
            $newMovies = array_filter($newMovies, function($item) use ($releasedFrom, $releasedTo) {
                $releaseDate = $item['release_date'] ?? null;
                if (!$releaseDate) return false; // Ha nincs dátum, kizárjuk
    
                // Ha csak "tól" van megadva
                if ($releasedFrom && !$releasedTo) {
                    return $releaseDate >= $releasedFrom;
                }
    
                // Ha csak "ig" van megadva
                if ($releasedTo && !$releasedFrom) {
                    return $releaseDate <= $releasedTo;
                }
    
                // Ha mindkettő meg van adva
                return $releaseDate >= $releasedFrom && $releaseDate <= $releasedTo;
            });
    
            $newSeries = array_filter($newSeries, function($item) use ($releasedFrom, $releasedTo) {
                $releaseDate = $item['first_air_date'] ?? null;
                if (!$releaseDate) return false;
    
                if ($releasedFrom && !$releasedTo) {
                    return $releaseDate >= $releasedFrom;
                }
    
                if ($releasedTo && !$releasedFrom) {
                    return $releaseDate <= $releasedTo;
                }
    
                return $releaseDate >= $releasedFrom && $releaseDate <= $releasedTo;
            });
        }

        // A platform szűrés hozzáadása
        $selectedPlatforms = $this->request->getGet('platforms'); // Több platform esetén

        // Szűrés a platformok alapján, ha a platformok paraméter léteznek
        if ($selectedPlatforms) {
            $selectedPlatforms = is_array($selectedPlatforms) ? $selectedPlatforms : [$selectedPlatforms]; // Tömbre alakítjuk

            // Szűrjük a filmeket a platformok alapján
            $newMovies = array_filter($newMovies, function($item) use ($selectedPlatforms) {
                $test = getWheretoWatch('movie-' . $item['id']);
                $platform = 'N/A';

                foreach ($test as $provider) {
                    if (in_array($provider['name'], $selectedPlatforms)) {
                        $platform = $provider['name'];
                        break;
                    }
                }

                return in_array($platform, $selectedPlatforms); // Csak azokat adjuk vissza, amelyek megfelelnek a kiválasztott platformoknak
            });

            $newSeries = array_filter($newSeries, function($item) use ($selectedPlatforms) {
                $test = getWheretoWatch('tv-' . $item['id']);
                $platform = 'N/A';

                foreach ($test as $provider) {
                    if (in_array($provider['name'], $selectedPlatforms)) {
                        $platform = $provider['name'];
                        break;
                    }
                }

                return in_array($platform, $selectedPlatforms);
            });
        }
        if ($type === 'movie') {
            $newseries = [];
            $newmovies = array_slice($newMovies, 0, 8);
        } elseif ($type === 'tv') {
            $newmovies = [];
            $newseries = array_slice($newSeries, 0, 8);
        }else{
            $newmovies = array_slice($newMovies, 0, 4);
            $newseries = array_slice($newSeries, 0, 4);
        }

        $hungarianPlatforms = [
            'Amazon', 
            'AppleTV', 
            'VUDU', 
            'Windows Store', 
            'Netflix', 
            'HBO Max', 
            'Disney+', 
            'YouTube', 
            'Rakuten TV', 
            'Sky Store', 
            'FilmBox', 
            'Google Play Movies', 
            'Tubi TV', 
            'Epix Now', 
            'Hulu'
        ];

        foreach ($newmovies as &$movie) {
            $movieGenres = [];
            foreach ($movie['genre_ids'] as $genreId) {
                foreach ($genres as $genre) {
                    if ($genre['id'] == $genreId) {
                        $movieGenres[] = $genre['name'];
                    }
                }
            }
            $movie['genres'] = implode(', ', $movieGenres);
        }

        foreach ($newSeries as &$series) {
            $seriesGenres = [];
            foreach ($series['genre_ids'] as $genreId) {
                foreach ($tvGenres as $genre) {
                    if ($genre['id'] == $genreId) {
                        $seriesGenres[] = $genre['name'];
                    }
                }
            }
            $series['genres'] = implode(', ', $seriesGenres);
        }

        $data['genres'] = $genres;
        $data['newmovies'] = $newmovies;
        $data['newseries'] = $newseries;
        $data['page'] = $page;
        $data['hungarianPlatforms'] = $hungarianPlatforms;
        $total_page = 4;
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
        $movie = getMovie($id);
        $casts = getCastByMovie($id);
        $teaser = getMovieTeaser($id);
        $providers = getWatchProviders($id);
        $streaming = getWhereToWatch('movie-'.$id);

        $movie['casts'] = $casts;
        $movie['teaser'] = $teaser;
        $movie['providers'] = $providers;
        $movie['streaming'] = $streaming;

        if (!$movie) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Movie not found");
        }

        return $this->loadPage('user/movie_details', ['movie' => $movie]);
    }

    public function loadPage($page = 0, $data = [])
    {
        return view('templates/header') . view($page, $data) . view('templates/footer');
    }
}