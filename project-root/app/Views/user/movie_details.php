<button class="return-btn" onclick="goBack()">Vissza</button>

<div class="detail-container">
    <div class="movie-detail-card">
        <div class="detail-image">
            <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" 
                alt="<?= isset($movie['title']) ? $movie['title'] : $movie['name'] ?>">
        </div>
        <div class="movie-info">
            <div class="movie-title"><?= esc($movie["title"]) ?></div>
            <div class="movie-release-date">
                <span class="details-list">Megjelenés dátuma:</span> <?= esc($movie["release_date"]) ?>
            </div>
            <div class="moviedetails-type">
                <?= isset($movie['title']) ? 'Film' : 'Sorozat' ?>
            </div>
            <div class="movie-streaming-provider">
                <span class="details-list">Streaming szolgáltató:</span>
                <?php
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

                $platform = 'N/A'; // Alapértelmezett érték, ha nem találunk magyar szolgáltatót

                if (!empty($movie["providers"])) {
                    foreach ($movie["providers"] as $provider) {
                        if (in_array($provider['name'], $hungarianPlatforms)) {
                            $platform = $provider['name'];
                            break;
                        }
                    }
                }
                ?>
                <div><?= esc($platform) ?></div>
            </div>
        </div>
    </div>

    <!-- Lenti Box: Leírás -->
    <div class="movie-description-box">
        <div class="movie-description-title">Film leírás</div>
        <div class="detail-description">
            <div class="description-text"><?= esc($movie["overview"]) ?></div>
        </div>
    </div>
</div>

<script>
    function goBack() {
        // Tároljuk a visszatérési helyet a localStorage-ban
        localStorage.setItem("cameFromDetails", "true"); // Jelzi, hogy a részletek oldalról jövünk

        // Visszavezetjük a home oldalra
        window.location.href = "<?= base_url('') ?>";
    }
</script>
