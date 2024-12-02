<?php /*API listázás csináld meg ez alapján
        Ha valami adat kell hogy mit kell írni a ['title'] helyére
        <?=var_dump($newmovies)?> Ezzel az összes filmet megkapod ami van az API 1. oldalán (21 film)*/?>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-10">
            <?php foreach($newmovies as $item): ?>
                <div class="regular-title">
                    <?=$item['title']?>
                </div>
            <?php endforeach;?>
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
<div class="container-fluid movie-container">
    <div class="row justify-content-center">
        <div class="col-10">
            <?php foreach($movies as $item): ?>
                <div class="movie-card">
                    <div class="movie-image">
                        <img src="<?= base_url('assets/images/').(is_object($item) ? $item->Img_path : $item['Img_path']) ?>" alt="Movie pic">
                    </div>
                    <div class="movie-info">
                        <div class="movie-heading">
                            <?= is_object($item) ? $item->Title : $item['Title'] ?>
                        </div>
                        <div class="movie-release">
                            <?= is_object($item) ? $item->Released : $item['Released'] ?>
                        </div>
                        <div class="movie-ss">
                            <?= is_object($item) ? $item->StreamingProvider : $item['StreamingProvider'] ?>
                        </div>
                        <div class="movie-summary">
                            <div class="movie-desc">
                                <?= substr(is_object($item) ? $item->Description : $item['Description'], 0, 400) ?>...
                            </div>
                            <a href="<?= base_url('film/reszletek/'.(is_object($item) ? $item->ID : $item['ID'])) ?>" class="read-more-link">Tovább</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
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