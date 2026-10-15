<?php

// foreach ($rss as $item) {
//     echo '<h2><a href="' . $item['link'] . '">' .  $item['title'] . '</a></h2>';
//     echo '<br>';
//     echo $item['description'];
//     echo '<br>';
//     echo $item['category'];
//     echo '<br>';
//     echo $item['pubDate'];
//     echo '<br>';
//     echo '<img src="' . $item['image'] . '" alt="' . $item['title'] . '" style="max-width: 300px; height: auto; display: block; margin-bottom: 10px;">';
//     echo '<hr>';

// 
?>


<div id="carouselArticles" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <?php foreach ($rss as $index => $item) { ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <div class="card mx-auto text-center" style="max-width: 600px;">
                    <img src="<?php echo $item['image']; ?>"
                        class="card-img-top"
                        alt="<?php echo $item['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['title']; ?></h5>
                        <p class="card-text"><?php echo $item['description']; ?></p>
                        <p class="card-text">
                            <small class="text-muted">
                                Publié le <?php echo date('d/m/Y \à H\hi', strtotime($item['pubDate'])); ?>
                            </small>
                        </p>
                        <a href="<?php $item['link']; ?>"
                            class="btn btn-primary" style="color: white">Lire l'article</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <button class="carousel-control-prev" type="button"
        data-bs-target="#carouselArticles" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button"
        data-bs-target="#carouselArticles" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>