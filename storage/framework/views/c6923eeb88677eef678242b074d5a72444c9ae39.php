<?php if(isset($templates['news-letter'][0]) && $news_letter = $templates['news-letter'][0]): ?>
    <section class="newsletter-section" id="subscribe">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h3><?php echo app('translator')->get(optional($news_letter->description)->title); ?></h3>
                        <p>
                            <?php echo app('translator')->get(optional($news_letter->description)->sub_title); ?>
                        </p>
                        <form action="<?php echo e(route('subscribe')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="input-group mt-5">
                                <input type="email" name="email" class="form-control" placeholder="<?php echo app('translator')->get('Enter Email Address'); ?>" aria-label="Subscribe Newsletter" aria-describedby="basic-addon"/>
                                <button type="submit" class="btn-custom"><?php echo app('translator')->get('subscribe'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/news-letter.blade.php ENDPATH**/ ?>