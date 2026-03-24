<!-- footer start-->
<footer class="footer footer-dark">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 footer-copyright">
        <p class="mb-0">
          Copyright 2021-22 © viho All rights reserved.
        </p>
      </div>
      <div class="col-md-6">
        <p class="pull-right mb-0">
          Hand crafted & made with
          <i class="fa fa-heart font-secondary"></i>
        </p>
      </div>
    </div>
  </div>
</footer>
</div>
</div>
<script>
  const base_URL = "<?= assets('') ?>";
</script>
<!-- latest jquery-->
<script src="<?= assets('assets/js/jquery-3.5.1.min.js') ?>"></script>
<!-- feather icon js-->
<script src="<?= assets('assets/js/icons/feather-icon/feather.min.js') ?>"></script>
<script src="<?= assets('assets/js/icons/feather-icon/feather-icon.js') ?>"></script>
<!-- Sidebar jquery-->
<script src="<?= assets('assets/js/sidebar-menu.js') ?>"></script>
<script src="<?= assets('assets/js/config.js') ?>"></script>
<!-- Bootstrap js-->
<script src="<?= assets('assets/js/bootstrap/popper.min.js') ?>"></script>
<script src="<?= assets('assets/js/bootstrap/bootstrap.min.js') ?>"></script>
<!-- Plugins JS  -->
<script src="<?= assets('assets/js/datepicker/date-picker/datepicker.js') ?>"></script>
<script src="<?= assets('assets/js/datepicker/date-picker/datepicker.en.js') ?>"></script>
<script src="<?= assets('assets/js/datepicker/date-picker/datepicker.custom.js') ?>"></script>
<!-- Plugins JS start-->
<!-- <script src="<?= assets('assets/js/chart/apex-chart/apex-chart.js') ?>"></script> -->
<script src="<?= assets('assets/js/chart/apex-chart/stock-prices.js') ?>"></script>
<!-- <script src="<?= assets('assets/js/chart/apex-chart/chart-custom.js') ?>"></script> -->
<script src="<?= assets('assets/js/rating/jquery.barrating.js') ?>"></script>
<script src="<?= assets('assets/js/rating/rating-script.js') ?>"></script>
<script src="<?= assets('assets/js/notify/bootstrap-notify.min.js') ?>"></script>
<!-- <script src="<?= assets('assets/js/notify/index.js'); ?>"></script> -->

<!-- Theme js-->
<script src="<?= assets('assets/js/script.js') ?>"></script>
<script src="<?= assets('assets/js/theme-customizer/customizer.js') ?>"></script>
<script>
  <?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  if (isset($_SESSION['notification'])):
    $message = $_SESSION['notification']['message'];
    $type = $_SESSION['notification']['type'];
  ?>
    $.notify({
      message: "<?php echo $message; ?>"
    }, {
      type: "<?php echo $type; ?>",
      delay: 2000,
      allow_dismiss: true,
      showProgressbar: true,
      timer: 300
    });
  <?php
    unset($_SESSION['notification']); // Clear the notification after showing it
  endif;
  ?>
</script>
</body>

<!-- Mirrored from vihonet.pixelstrap.com/SamplePage/SamplePage by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 03:48:49 GMT -->

</html>