<button class="return-btn" onclick="goBack()">Vissza</button>

<div class="detail-container">
    <!-- Fenti Box: Kép és részletek -->
    <div class="movie-detail-card">
        <div class="detail-image">
            <img src="<?= base_url('assets/images/') . esc($movie["Img_path"]) ?>" alt="Movie Image">
        </div>
        <div class="movie-info">
            <div class="movie-title"><?= esc($movie["Title"]) ?></div>
            <div class="movie-release-date">
                <span class="details-list">Megjelenés dátuma:</span> <?= esc($movie["Released"]) ?>
            </div>
            <div class="movie-streaming-provider">
                <span class="details-list">Streaming szolgáltató:</span> <?= esc($movie["StreamingProvider"]) ?>
            </div>
            <div class="movie-price">
                <span class="details-list">Legolcsóbb csomag ára:</span> <?= esc($movie["Price"]) ?> Ft
            </div>
        </div>
    </div>

    <!-- Lenti Box: Leírás -->
    <div class="movie-description-box">
        <div class="movie-description-title">Film leírás</div>
        <div class="detail-description">
            <div class="description-text"><?= esc($movie["Description"]) ?></div>
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
