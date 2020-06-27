<!-- Footer -->
<footer id="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="icon-box effect small clean">
                        <div class="icon">
                            <a href="#"><i class="icon-clock"></i></a>
                        </div>
                        <h3>Working Days</h3>
                        <p><strong>Monday - Friday</strong>
                            <br>10:00 AM - 11:00 PM</p>
                        <p><strong>Saturday - Sunday</strong>
                            <br>10:00 AM - 04:00 PM</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-box effect small clean">
                        <div class="icon">
                            <a href="#"><i class="fas fa-map-marker-alt"></i></a>
                        </div>
                        <h3>Caffe Location</h3>
                        <p><strong>Caffe Address:</strong>
                            <br> 795 Folsom Ave, Suite 600
                            <br> San Francisco, CA 94107
                            <br>
                            <br>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-box effect small clean">
                        <div class="icon">
                            <a href="#"><i class="icon-phone"></i></a>
                        </div>
                        <h3>Caffe Contact</h3>
                        <p><strong>Phone:</strong>
                            <br> (123) 456-7890
                            <br> (987) 654-3210
                            <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Social icons -->
                    <div class="social-icons social-icons-colored float-left">
                        <ul>
                            <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="social-vimeo"><a href="#"><i class="fab fa-vimeo"></i></a></li>
                            <li class="social-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <li class="social-pinterest"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                            <li class="social-gplus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                    <!-- end: Social icons -->
                </div>
                <div class="col-lg-6">
                    <div class="copyright-text text-center">&copy;<a href="https://www.twstechnology.com/"></a> 2019 TWS Technology</a>. All Rights Reserved.<a href="//www.inspiro-media.com" target="_blank">INSPIRO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end: Footer -->
</div>

<!-- Modal -->
<div class="modal fade" id="loginModalDiv" role="dialog">
    <div class="modal-dialog">
        <br><br>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="">Join Us for more features</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Scroll top -->
<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
<!--Plugins-->
<script src="<?php echo SITE_URL ?>assets/js/fe/oorja/jquery.js"></script>
<script src="<?php echo SITE_URL ?>assets/js/fe/oorja/plugins.js"></script>
<script src="<?php echo SITE_URL ?>assets/js/fe/oorja/functions.js"></script>
<!-- <script type="text/javascript" src="plugins/gmap3/map-styles.js"></script>
<script type='text/javascript' src='//maps.googleapis.com/maps/api/js?key=YOUR_API_KEY'></script>
<script type="text/javascript" src="plugins/gmap3/gmap3.min.js"></script> -->

<!-- model script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.videoModalTrgr', function() {
            var yt_url = $(this).attr('data-yt-url');
            var title = $(this).attr('data-title');
            $('#videoPlayerIframe').attr('src', yt_url);
            $('#videoPlayerTitle').html(title);

            $('#videoPlayerModalDiv').modal('show');
        })

        $(document).on('click', '#loginModelTrgr', function() {
            //alert();
            $('#loginModalDiv').modal('show');
        })
    })
</script>
</body>

</html>