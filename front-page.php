<?php get_header(); ?>


<section class="about-container">

    <div class="about-item">
        <p>Memories of family gatherings where cheese brought people together inspired us to create a space where customers could explore diverse cheese varieties from around the world, each with its own unique story and flavor profile.</p>
    </div>
    <div class="about-item">
        <?php
        $image_id = 111;
        $size = 'thumbnail'; // Options: thumbnail, medium, large, full or custom size
        $attr = array(
            'class' => 'about-img',
            'alt'   => 'Custom alt text',
            'title' => 'Custom title'
        );
        echo wp_get_attachment_image($image_id, $size, false, $attr);
        ?>
    </div>

    <div class="about-item ">
        <p>While grocery stores offered basic cheese selections, we envisioned a speciality shop where cheese enthusiasts could discover unique products often unavailable elsewhere, creating a dedicated space for cheese appreciation.</p>
    </div>
    <div class="about-item ">
        <?php
        $image_id = 112;
        $size = 'thumbnail';
        $attr = array(
            'class' => 'about-img',
            'alt'   => 'Custom alt text',
            'title' => 'Custom title'
        );
        echo wp_get_attachment_image($image_id, $size, false, $attr);
        ?>
    </div>
    <div class="about-item ">
        <p>Supporting local dairies and small-scale producers was a key motivation. By sourcing from nearby suppliers, we ensure quality and freshness while promoting sustainable practices. Our partnerships with local cheesemakers allow us to offer unique items and help preserve the art of cheese-making in our County.</p>
    </div>

    </div>
</section>


<?php get_footer(); ?>