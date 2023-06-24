

		<!-- Vendor -->

		<script src="assets/vendor/jquery/jquery.js"></script>
        
        <script src="assets/vendor/jquery-ui/jquery-ui.js"></script>

        <script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>

		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>

		<script src="assets/vendor/jquery-cookie/jquery-cookie.js"></script>

		<script src="assets/vendor/style-switcher/style.switcher.js"></script>

		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>

		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>

		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

		<script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>

		<script src="assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>

		<script src="assets/vendor/summernote/summernote.js"></script>

        <!-- Specific Page Vendor -->		

		<script src="assets/vendor/select2/js/select2.js"></script>		

		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>		

		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>		

		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		
        <script src="assets/vendor/summernote/summernote.js"></script>

		<!-- Theme Base, Components and Settings -->

		<script src="assets/javascripts/theme.js"></script>
		
		<script src="assets/javascripts/theme.custom.js"></script>
        
		<!-- Theme Custom -->

		<script src="assets/javascripts/edit_inline.js"></script>
		

		<!-- Theme Initialization Files -->

		<script src="assets/javascripts/theme.init.js"></script>

        <script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('input[type=radio][name=dressed_clean]').change(function() {
				if (this.value == 'Y') {
					$("#showCleanType").show();
				}
				else if (this.value == 'N') {
				   $("#showCleanType").hide();
				}
			});
		});
	</script>
   
   
   
   <?php if($cnf->curPageName('','') =="edit_order.php"){?>
        <link rel="stylesheet" href="assets/stylesheets/styles.css">
        <script src="assets/javascripts/moment.js"></script>        
        <script src="assets/javascripts/bootstrap.datetime.js"></script>
        <script src="assets/javascripts/bootstrap.password.js"></script>
        <script src="assets/javascripts/scripts.js"></script>
		<?php } ?>
	</body>



</html>