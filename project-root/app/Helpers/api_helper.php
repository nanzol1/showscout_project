<?php
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . '../vendor/autoload.php');

if(!function_exists('getMovies')){
    function getMovies(){
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=hu-HU&page=1&sort_by=popularity.desc', [
          'headers' => [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4NWRkZGVlOTk4NzRlZWRlOTk5OTRmN2FhZGY4MTc4MyIsIm5iZiI6MTczMjU1NjMyNy44OTYwOTE3LCJzdWIiOiI2NzQ0ODMwNGMyNDc2NWZhMmYyZGU5MjAiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.TVNHSYeWGchAa-xMUtm05EF6WpOn7e1of51apjHW9JE',
            'accept' => 'application/json',
          ],
        ]);

        $responseBody = json_decode($response->getBody(),true);

        if(isset($responseBody['results'])){
            $movies = $responseBody['results'];

            $cleanedMovies = array_map(function($movie){
                return [
                    'id' => $movie['id'] ?? "N/A",
                    'title' => $movie['title'] ?? "N/A",
                    'overview' => $movie['overview'] ?? "N/A",
                    'release_date' => $movie['release_date'] ?? "N/A",
                    'poster_path' => isset($movie['poster_path']) ?
                                'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
                                : null,
                    'vote_average' => $movie['vote_average'] ?? "N/A",
                ];
            },$movies);
        }else{
            $cleanedMovies = [];
        }
        
        return $cleanedMovies;
    }
}

if(!function_exists('getCastByMovie')){
    function getCastByMovie($id){
        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/'.$id.'/credits?language=en-US', [
            'headers' => [
              'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4NWRkZGVlOTk4NzRlZWRlOTk5OTRmN2FhZGY4MTc4MyIsIm5iZiI6MTczMjU1NjMyNy44OTYwOTE3LCJzdWIiOiI2NzQ0ODMwNGMyNDc2NWZhMmYyZGU5MjAiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.TVNHSYeWGchAa-xMUtm05EF6WpOn7e1of51apjHW9JE',
              'accept' => 'application/json',
            ],
          ]);
          

        $responseBody = json_decode($response->getBody(),true);

        if(isset($responseBody['cast'])){
            $casts = $responseBody['cast'];

            $cleanedCasts = array_map(function($cast){
                return [
                    'name' => $cast['name'] ?? "N/A",
                ];
            },$casts);
        }else{
            $cleanedCasts = [];
        }
        
        return $cleanedCasts;
    }
}
if(!function_exists('getMovieTeaser')){
    function getMovieTeaser($id){
        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/'.$id.'/videos?language=en-US', [
            'headers' => [
              'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4NWRkZGVlOTk4NzRlZWRlOTk5OTRmN2FhZGY4MTc4MyIsIm5iZiI6MTczMjU1NjMyNy44OTYwOTE3LCJzdWIiOiI2NzQ0ODMwNGMyNDc2NWZhMmYyZGU5MjAiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.TVNHSYeWGchAa-xMUtm05EF6WpOn7e1of51apjHW9JE',
              'accept' => 'application/json',
            ],
          ]);
          

        $responseBody = json_decode($response->getBody(),true);

        if(isset($responseBody['results'])){
            $teasers = $responseBody['results'];
            $selectedTeaser = array_slice($teasers,0,1);

            $youtubeVideos = array_filter($selectedTeaser,function($video){
                return $video['site'] === "YouTube";
            });
            $cleanedTeaser = array_map(function($teaser){
                return [
                    'url' => $teaser['key'],
                ];
            },$youtubeVideos);
        }else{
            $cleanedTeaser = [];
        }
        
        return $cleanedTeaser;
    }
}
if(!function_exists('getWatchProviders')){
    function getWatchProviders($id){
        $client = new \GuzzleHttp\Client();


        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/'.$id.'/watch/providers', [
            'headers' => [
              'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4NWRkZGVlOTk4NzRlZWRlOTk5OTRmN2FhZGY4MTc4MyIsIm5iZiI6MTczMjYxMTIwOS4xNjc0MDYzLCJzdWIiOiI2NzQ0ODMwNGMyNDc2NWZhMmYyZGU5MjAiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.a9s7vmchPl4THISO7HWmT2uJXqHQ076HYcbLSvhPn2w',
              'accept' => 'application/json',
            ],
          ]);
          

        $responseBody = json_decode($response->getBody(),true);
        if(isset($responseBody['results'])){
            $providers_buy = isset($responseBody['results']["HU"]["buy"]) ? $responseBody['results']["HU"]["buy"] : [];
            $providers_rent = isset($responseBody['results']["HU"]["rent"]) ? $responseBody['results']["HU"]["rent"] : [];

            $cleanedProviders["buy"] = array_map(function($provider){
                return [
                    'provider_id' => $provider['provider_id'],
                    'provider_name' => $provider['provider_name'],
                    'logo_path' => isset($provider['logo_path']) ?
                                    'https://image.tmdb.org/t/p/w500'.$provider['logo_path'] 
                                    : null,
                ];
            },$providers_buy);
            $cleanedProviders["rent"] = array_map(function($provider){
                return [
                    'provider_id' => $provider['provider_id'],
                    'provider_name' => $provider['provider_name'],
                    'logo_path' => isset($provider['logo_path']) ?
                                    'https://image.tmdb.org/t/p/w500'.$provider['logo_path'] 
                                    : null,
                ];
            },$providers_rent);
        }else{
            $cleanedProviders = [];
        }
        
        return $cleanedProviders;
    }
}
?>