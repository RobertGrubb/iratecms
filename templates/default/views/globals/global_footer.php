    				<div class="clear"></div>
    			</div>
    		</div>
        </div>
        <!-- Pre-Footer -->
        <div class="pre-foot">
            <div class="container">
                <div class="row-fluid">
                    <div class="col-lg-12 well">
                        <div class="row-fluid">
                            <div class="col-lg-2 small_logo_container">
                                <img src="<?php static_url(); ?>images/logo/small_logo.png" alt="Small Logo" />
                                <span class="text-center">
                                    <?php if(settings('facebook') != ""): ?>
                                    <a href="<?php echo settings('facebook'); ?>" id="facebook"><i class="fa fa-facebook iconRounded img-circle"></i></a>
                                    <?php endif; ?>
                                    <?php if(settings('twitter') != ""): ?>
                                    <a href="https://twitter.com/<?php echo settings('twitter'); ?>" id="twitter"><i class="fa fa-twitter iconRounded img-circle"></i></a>
                                    <?php endif; ?>
                                    <?php if(settings('youtube') != ""): ?>
                                    <a href="<?php echo settings('youtube'); ?>" id="youtube"><i class="fa fa-youtube iconRounded img-circle"></i></a>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="col-lg-6 visible-lg">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Site Map</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->navigation->footer_links(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">About Us</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo settings('footer_about_us'); ?>
                                     </div>
                                 </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
		<div id="footer-area">
			<div class="container">
				<div class="pull-left">
					<?php echo settings('site_footer'); ?>
				</div>
				<div class="pull-right">
					Powered by <a href="http://www.iratedesigns.com">Irate CMS</a>
				</div>
			</div>
		</div>
        <!-- JQuery Includes -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="<?php echo base_url(); ?>plugins/js/libs/jquery-ui-1.9.1.custom.min.js"></script>
        <script src="<?php static_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>plugins/jquery.cycle.js"></script>
        <script src="<?php echo base_url(); ?>plugins/lightbox/jquery.magnific-popup.min.js"></script> 
        <script src="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5.js"></script> 
        <script src="<?php static_url(); ?>js/global.js"></script>
	</body>
</html>