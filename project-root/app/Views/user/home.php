<div class="container-fluid movie-container">
    <div class="row justify-content-center">
        <div class="col-10">
            <?php foreach($movies as $item):?>
                <?=var_dump($item)  ?>
                <div class="movie-card">
                <div class="movie-image">
                <img src="<?=base_url('assets/images/').$item["Img_path"] ?>" alt="Movie pic">
                </div>
                <div class="movie-info">
                    <div class="movie-heading">
                        <?=$item["Title"] ?>
                    </div>
                    <div class="movie-release">
                        <?=$item["Released"] ?>
                    </div>
                    <div class="movie-ss">
                        <?=$item["StreamingProvider"] ?>
                    </div>
                    <div class="movie-summary">
                        <div class="movie-desc">
                            <?=$item["Description"] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
