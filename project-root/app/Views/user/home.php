<?php /*API listázás csináld meg ez alapján
        Ha valami adat kell hogy mit kell írni a ['title'] helyére
        <?=var_dump($newmovies)?> Ezzel az összes filmet megkapod ami van az API 1. oldalán (21 film)*/?>
<div class="container-fluid movie-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <?php foreach ($newmovies as $item): ?>
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
    
                        // Meghívjuk a getWheretoWatch függvényt
                        $test = getWheretoWatch('movie-' . $item['id']);
                        
                        // Alapértelmezett platform érték, ha nem találunk magyar szolgáltatót
                        $platform = 'N/A';
                        
                        // Végigmegyünk az összes szolgáltatón
                        foreach ($test as $provider) {
                            // Ha a szolgáltató neve szerepel a magyar szolgáltatók listájában
                            if (in_array($provider['name'], $hungarianPlatforms)) {
                                // A platform változónak átadjuk az első magyar szolgáltatót
                                $platform = $provider['name'];
                                break; // Kilépünk a ciklusból, mert megtaláltuk az első megfelelő szolgáltatót
                            }
                        }?>
                    <?=var_dump($test)?>
                    <div class="regular-title">
                        <?=$item['id']?>
                    </div>
                    <div class="movie-card">
                        <div class="movie-image">
                            <img src="https://image.tmdb.org/t/p/w500<?= $item['poster_path'] ?>" 
                                 alt="<?= isset($item['title']) ? $item['title'] : $item['name'] ?>">
                        </div>
                        <div class="movie-info">
                            <div class="movie-heading">
                                <?= isset($item['title']) ? $item['title'] : $item['name'] ?>
                            </div>
                            <div class="movie-release">
                                <?= $item['release_date'] ?? 'N/A' ?>
                            </div>
                            <div class="movie-type">
                                <?= isset($item['title']) ? 'Film' : 'Sorozat' ?>
                            </div>
                            <div class="movie-ss">
                                <?= $platform ?>
                            </div>
                            <div class="movie-summary">
                                <div class="movie-desc">
                                    <?= substr($item['overview'], 0, 400) ?>...
                                </div>
                                <a href="<?= base_url('film/reszletek/' . $item['id']) ?>" class="read-more-link">Tovább</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <?php /*Ez a pagination működik, ezt használd összesen 500 oldal van*/?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php if($page > $limitStart):?>
              <li class="page-item"><a class="page-link" href="<?=base_url("/").$page - 1?>">Previous</a></li>
          <?php else:?>
              <li class="page-item disabled"><a class="page-link" href="<?=base_url("/").$page - 1?>" hidden>Previous</a></li>
          <?php endif;?>

            <?php for($i = $limitStart;$i <= $limitEnd;$i++):?>
                <li class="page-item <?=$i == $page ? "active" : ""?>"><a class="page-link" href="<?=base_url("/").$i?>"><?=$i?></a></li>
            <?php endfor;?>

          <?php if($page < $limitEnd):?>
              <li class="page-item"><a class="page-link" href="<?=base_url("/").$page + 1?>">Next</a></li>
          <?php else:?>
              <li class="page-item disabled"><a class="page-link" href="<?=base_url("/").$page + 1?>" hidden>Next</a></li>
          <?php endif;?>
        </ul>
    </nav>
</div>



<script>
    window.addEventListener("scroll", function() {
        localStorage.setItem("scrollPosition", window.scrollY);
    });

    window.onload = function() {
        const cameFromDetails = localStorage.getItem("cameFromDetails");

        if (cameFromDetails === "true") {
            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition) {
                window.scrollTo(0, scrollPosition);
            }
            localStorage.removeItem("cameFromDetails");
        }
    };
</script>

<form action="<?= base_url('home/filter') ?>" method="GET">
    <div class="filter-container">
        
        <label for="type">Típus:</label>
        <select id="type" name="type">
            <option value="">-- Válassz típust --</option>
            <option value="film" <?= (isset($type) && $type == 'film') ? 'selected' : '' ?>>Film</option>
            <option value="series" <?= (isset($type) && $type == 'series') ? 'selected' : '' ?>>Sorozat</option>
        </select>

        
        <label for="genre">Kategória:</label>
        <select id="genre" name="genre">
            <option value="">-- Válassz kategóriát --</option>
            <option value="Action" <?= (isset($genre) && $genre == 'Action') ? 'selected' : '' ?>>Akció</option>
            <option value="Comedy" <?= (isset($genre) && $genre == 'Comedy') ? 'selected' : '' ?>>Vígjáték</option>
            <option value="Drama" <?= (isset($genre) && $genre == 'Drama') ? 'selected' : '' ?>>Dráma</option>
            <option value="Horror" <?= (isset($genre) && $genre == 'Horror') ? 'selected' : '' ?>>Horror</option>
            <option value="Thriller" <?= (isset($genre) && $genre == 'Thriller') ? 'selected' : '' ?>>Thriller</option>
        </select>

        
        <label for="providers">Szolgáltató:</label>
        <div id="providers">
            <?php if (isset($providers_list)): ?>
                <?php foreach ($providers_list as $provider): ?>
                    <label>
                        <input type="checkbox" name="providers[]" value="<?= $provider['Name'] ?>" <?= (isset($providers) && in_array($provider['Name'], $providers)) ? 'checked' : '' ?>> <?= $provider['Name'] ?>
                    </label><br>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <label for="released_from">Megjelenés dátuma:</label>
        <div class="date-range">
            <input type="date" id="released_from" name="released_from" value="<?= esc($released_from ?? '') ?>" />
            <input type="date" id="released_to" name="released_to" value="<?= esc($released_to ?? '') ?>" />
        </div>

        <button type="submit">Szűrés</button>
    </div>
</form>