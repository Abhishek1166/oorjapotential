<?php
/* echo '<pre>';
print_r($data);
die();
echo '</pre>'; */
?>
<!-- end: Header -->
<!-- Page Content -->
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <?php
            if (!empty($data['service'])) {


            ?>
                <!-- content -->

                <div class="content col-lg-9" style="margin:auto;">
                    <!-- Blog -->
                    <div id="blog" class="single-post">
                        <!-- Post item-->
                        <div class="post-item">
                            <div class="post-item-wrap">
                                <div class="post-image">
                                    <a href="#">
                                        <center> <img src="<?php echo $data['service']['post_image'] ?>" </center> </a> </div> <div class="post-item-description">
                                            <h2><?= strtoupper($data['service']['title']) ?></h2>

                                </div>
                                <p><?= $data['service']['description'] ?>
                                </p>
                                <!-- <div class="blockquote">
                                    <p>The world is a dangerous place to live; not because of the people who are evil,
                                        but because of the people who don't do anything about it.</p>
                                    <small>by <cite>Albert Einstein</cite></small>
                                </div> -->
                                <!-- <p> The most happiest time of the day!. Praesent id dolor dui, dapibus gravida elit.
                                    Donec consequat laoreet sagittis. Suspendisse ultricies ultrices viverra. Morbi
                                    rhoncus laoreet tincidunt. Mauris interdum convallis metus. Suspendisse vel lacus
                                    est, sit amet tincidunt erat. Etiam purus sem, euismod eu vulputate eget, porta quis
                                    sapien. Donec tellus est, rhoncus vel scelerisque id, iaculis eu nibh.</p>
                                <p>Donec posuere bibendum metus. Quisque gravida luctus volutpat. Mauris interdum,
                                    lectus in dapibus molestie, quam felis sollicitudin mauris, sit amet tempus velit
                                    lectus nec lorem. Nullam vel mollis neque. The most happiest time of the day!.
                                    Nullam vel enim dui. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Sed tincidunt accumsan massa id viverra. Sed sagittis, nisl
                                    sit amet imperdiet convallis, nunc tortor consequat tellus, vel molestie neque nulla
                                    non ligula. Proin tincidunt tellus ac porta volutpat. Cras mattis congue lacus id
                                    bibendum. Mauris ut sodales libero. Maecenas feugiat sit amet enim in accumsan.</p>
                                <p>Duis vestibulum quis quam vel accumsan. Nunc a vulputate lectus. Vestibulum eleifend
                                    nisl sed massa sagittis vestibulum. Vestibulum pretium blandit tellus, sodales
                                    volutpat sapien varius vel. Phasellus tristique cursus erat, a placerat tellus
                                    laoreet eget. Fusce vitae dui sit amet lacus rutrum convallis. Vivamus sit amet
                                    lectus venenatis est rhoncus interdum a vitae velit.</p> -->
                            </div>

                        </div>
                    <?php
                }
                    ?>
                    </div>
</section>
<!-- end: Page Content -->
<!-- Footer -->

</body>

</html>