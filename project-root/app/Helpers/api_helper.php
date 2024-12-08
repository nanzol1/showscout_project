<?php
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . '../vendor/autoload.php');

if(!function_exists('getMovies')){
    function getMovies($page = 1,$sort_by = "popularity.desc"){
        
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=hu-HU&page='.$page.'&sort_by='.$sort_by.'', [
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
                    'genre_ids' => $movie['genre_ids'] ?? "N/A",
                ];
            },$movies);
        }else{
            $cleanedMovies = [];
        }
        
        return $cleanedMovies;
    }
}
//getSeries(1,2000-01-01,2024-12-30,"first_air_date.desc","en")
          //int,dátum formátum/string,dátum formátum/string,string,"string",
if(!function_exists("getSeries")){
    function getSeries($page = 1,$date_start = false,$date_end = false,$sort_by = "first_air_date.desc",$with_original_language = "en"){
       
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/tv?first_air_date.gte='.$date_start.'&first_air_date.lte='.$date_end.'&include_adult=false&include_null_first_air_dates=false&language=en-US&page='.$page.'&sort_by='.$sort_by.'&watch_region=hu-HU&with_original_language='.$with_original_language.'', [
            'headers' => [
              'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4NWRkZGVlOTk4NzRlZWRlOTk5OTRmN2FhZGY4MTc4MyIsIm5iZiI6MTczMjU0MzIzNi44MzIsInN1YiI6IjY3NDQ4MzA0YzI0NzY1ZmEyZjJkZTkyMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.4FnhuK1gogYTP6GH27OW8xPfD7g5GJf_BWH6HKFF7fc',
              'accept' => 'application/json',
            ],
          ]);

        $responseBody = json_decode($response->getBody(),true);

        if(isset($responseBody['results'])){
            $series = $responseBody['results'];

            $cleanedSeries = array_map(function($serie){
                return [
                    'id' => $serie['id'] ?? "N/A",
                    'name' => $serie['name'] ?? "N/A",
                    'overview' => $serie['overview'] ?? "N/A",
                    'first_air_date' => $serie['first_air_date'] ?? "N/A",
                    'poster_path' => isset($serie['poster_path']) ?
                                'https://image.tmdb.org/t/p/w500' . $serie['poster_path']
                                : "Nincs",
                    'vote_average' => $serie['vote_average'] ?? 0,
                    'genre_ids' => $serie['genre_ids'] ?? "N/A",
                ];
            },$series);
        }else{
            $cleanedSeries = [];
        }
        
        return $cleanedSeries;
    }
}
if(!function_exists("convertMoney")){
    function convertMoney($price){
        $huf = 420;
        return round($price * $huf);
    }
}

//getWhereToWatch("tv-"."1396"); Használni a getMovies Film ID-vel kell csak kell elé tv-filmid
if(!function_exists("getWhereToWatch")){
    function getWhereToWatch($id){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.watchmode.com/v1/title/'.$id.'/sources/?apiKey=FLPBIhKYk3xWRN3wc7VsggYyutL2aVeyTZ0nmfwh');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response,true);
        $cleanedData = array_map(function($datas){
            return [
                'web_url' => $datas['web_url'] ?? "N/A",
                'name' => $datas['name'] ?? "N/A",
            ];
        },$json);
        return $cleanedData;
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