
<?php /*API listázás csináld meg ez alapján
        Ha valami adat kell hogy mit kell írni a ['title'] helyére
        <?=var_dump($newmovies)?> Ezzel az összes filmet megkapod ami van az API 1. oldalán (21 film)*/

$allItems = array_merge($newmovies, $newseries);
shuffle($allItems);?>

<div class="container-fluid movie-container">
    <div class="container">
        <div class="row">
            <!-- Szűrők oszlopa -->
            <div class="col-md-3 filter-sidebar">
                <form method="GET" action="<?= base_url() ?>">
                    <div class="form-group">
                        <label for="platform">Szűrés Streaming Szolgáltató szerint:</label>
                        <div>
                            <?php foreach ($hungarianPlatforms as $platformOption): ?>
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        name="platforms[]" 
                                        value="<?= $platformOption ?>" 
                                        class="form-check-input" 
                                        id="platform-<?= $platformOption ?>"
                                        <?= isset($_GET['platforms']) && in_array($platformOption, $_GET['platforms']) ? 'checked' : '' ?>
                                    >
                                    <label class="form-check-label" for="platform-<?= $platformOption ?>">
                                        <?= $platformOption ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="genres">Szűrés műfajok szerint:</label>
                        <div>
                            <?php foreach ($genres as $genre): ?>
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        name="genres[]" 
                                        value="<?= $genre['id'] ?>" 
                                        class="form-check-input" 
                                        id="genre-<?= $genre['id'] ?>"
                                        <?= isset($_GET['genres']) && in_array($genre['id'], $_GET['genres']) ? 'checked' : '' ?>
                                    >
                                    <label class="form-check-label" for="genre-<?= $genre['id'] ?>">
                                        <?= $genre['name'] ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="released_from">Megjelenés (Tól):</label>
                        <input type="date" id="released_from" name="released_from" class="form-control"
                               value="<?= isset($_GET['released_from']) ? htmlspecialchars($_GET['released_from']) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="released_to">Megjelenés (Ig):</label>
                        <input type="date" id="released_to" name="released_to" class="form-control"
                               value="<?= isset($_GET['released_to']) ? htmlspecialchars($_GET['released_to']) : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="type">Típus:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="" <?= !isset($_GET['type']) || $_GET['type'] === '' ? 'selected' : '' ?>>Mindkettő</option>
                            <option value="movie" <?= isset($_GET['type']) && $_GET['type'] === 'movie' ? 'selected' : '' ?>>Film</option>
                            <option value="tv" <?= isset($_GET['type']) && $_GET['type'] === 'tv' ? 'selected' : '' ?>>Sorozat</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Szűrés</button>
                </form>
            </div>

            <!-- Média oszlopa -->
            <div class="col-md-9">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php foreach ($allItems as $item): ?>
                            <?php
                            $itemType = isset($item['title']) ? 'movie' : 'tv';
                            $test = getWheretoWatch($itemType . '-' . $item['id']);
                            $platform = 'N/A';

                            foreach ($test as $provider) {
                                if (in_array($provider['name'], $hungarianPlatforms)) {
                                    $platform = $provider['name'];
                                    break;
                                }
                            }
                            ?>
                            <div class="movie-card">
                                <div class="movie-image">
                                    <img src="<?= $item['poster_path'] === null ? base_url('assets/images/npera.png') : 'https://image.tmdb.org/t/p/w500' . $item['poster_path'] ?>"
                                         alt="<?= isset($item['title']) ? $item['title'] : $item['name'] ?>">
                                </div>
                                <div class="movie-info">
                                    <div class="movie-heading">
                                        <?= isset($item['title']) ? $item['title'] : $item['name'] ?>
                                    </div>
                                    <div class="movie-release">
                                        <?= $itemType === 'movie' ? ($item['release_date'] ?? 'N/A') : ($item['first_air_date'] ?? 'N/A') ?>
                                    </div>
                                    <div class="movie-type">
                                        <?= $itemType === 'movie' ? 'Film' : 'Sorozat' ?>
                                    </div>
                                    <div class="movie-genres">
                                        <strong>Műfajok: </strong>
                                        <?= $item['genres'] ?? 'N/A' ?>
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

                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($page > $limitStart): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= base_url("/") . ($page - 1) ?>">Previous</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="<?= base_url("/") . ($page - 1) ?>" hidden>Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = $limitStart; $i <= $limitEnd; $i++): ?>
                            <li class="page-item <?= $i == $page ? "active" : "" ?>">
                                <a class="page-link" href="<?= base_url("/") . $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $limitEnd): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= base_url("/") . ($page + 1) ?>">Next</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="<?= base_url("/") . ($page + 1) ?>" hidden>Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
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
