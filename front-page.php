<?php get_header(); ?>


<div class="about-container">
    <div class="about-contact">
        <div class="contact-item">
            <p>Monday to Saturday, from 0900 to 1700</p>
        </div>
        <div class="contact-item">
            <p>Lemon Street Market, Lemon Street, Truro, TR1 2QD</p>
        </div>
        <div class="contact-item">
            <a href="https://www.instagram.com/lilleyfield.cheese/" target="_blank">
                <p><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/instagram-brands-solid.svg" id="insta-svg" alt="Social button"> Follow us</p>
            </a>
        </div>
    </div>
    <div class="about-info">
        <div class="about-item">
            <p>Memories of family gatherings where cheese brought people together inspired us to create a space where customers could explore diverse cheese varieties from around the world, each with its own unique story and flavor profile.</p>
        </div>
        <div class="about-item">
            <p>While grocery stores offered basic cheese selections, we envisioned a speciality shop where cheese enthusiasts could discover unique products often unavailable elsewhere, creating a dedicated space for cheese appreciation.</p>
        </div>
        <div class="about-item">
            <p>Supporting local dairies and small-scale producers was a key motivation. By sourcing from nearby suppliers, we ensure quality and freshness while promoting sustainable practices. Our partnerships with local cheesemakers allow us to offer unique items and help preserve the art of cheese-making in our County.</p>
        </div>
    </div>
    <div class="about-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2032.5117667968798!2d-5.054693623453872!3d50.26199857155689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x486b17005facb545%3A0xf76f4923181b6a9a!2sLilleyfield%20Cheese%20Co.!5e1!3m2!1sen!2suk!4v1738686011136!5m2!1sen!2suk" width="" height="" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

</div>

<?php
$image_id = 111;
echo wp_get_attachment_image(
    $image_id,
    'full',
    false,
    array('class' => 'about-img')
); // Use size: thumbnail, medium, large, full
?>





<?php get_footer(); ?>