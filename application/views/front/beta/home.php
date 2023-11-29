<?php if (setting('home-banner') == 'yes') { ?>
<?php include(VIEW_ROOT.'/front/beta/partials/home-banner-absolute.php'); ?>
<?php } ?>

<?php if (setting('before-how')) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php echo setting('before-how'); ?>
        </div>
    </div>
</div>
<?php } ?>

<?php if (setting('how-it-works') == 'yes') { ?>
<?php include(VIEW_ROOT.'/front/beta/partials/home-steps.php'); ?>
<?php } ?>

<?php if (setting('after-how')) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php echo setting('after-how'); ?>
        </div>
    </div>
</div>
<?php } ?>

<?php if (setting('department-section') == 'yes') { ?>
<?php include(VIEW_ROOT.'/front/beta/partials/home-departments-section.php'); ?>
<?php } ?>

<?php if (setting('before-news')) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php echo setting('before-news'); ?>
        </div>
    </div>
</div>
<?php } ?>

<?php if (setting('news-section') == 'yes') { ?>
<?php include(VIEW_ROOT.'/front/beta/partials/home-blogs-section.php'); ?>
<?php } ?>

<?php if (setting('after-news')) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php echo setting('after-news'); ?>
        </div>
    </div>
</div>
<?php } ?>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>