   <article class="detailed-logo">
        <?php
        $otherProduct       = getOtherProduct($this->uri->segment(3), 1);
        $otherProductImage  = getDataProductImage($otherProduct[0]['product_id'], 1);
        ?>
        <figure>
            <img width="320" height="180" src="<?= base_url().'cms/'.getThumbnailsImage($otherProductImage['file'], $otherProductImage['extention']) ?>" alt="">
        </figure>
        <div class="details">
            <h2 class="box-title"><?= $otherProduct[0]['product_name'] ?></h2>
            <span class="price clearfix">
                <small class="pull-left">Category</small>
                <span class="pull-right"><?= $otherProduct[0]['product_category'] ?></span>
            </span>
            <?= word_limiter($otherProduct[0]['product_desc'], 30) ?>
            <a class="button yellow full-width uppercase btn-small">Booking Now</a>
        </div>
    </article>