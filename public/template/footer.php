</div>
</div>
<!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="<?php echo SITE_URL; ?>assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/bootstrap/js/popper.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo SITE_URL; ?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo SITE_URL; ?>assets/js/app.js"></script>
<script>
	$(document).ready(function() {
		App.init();
	});
</script>
<script src="<?php echo SITE_URL; ?>assets/js/custom.js"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->

<?php // Add Scripts For Login Page
if (check_current_page('admin/login')) : ?>
	<script src="<?php echo SITE_URL; ?>assets/js/authentication/form-1.js"></script>
<?php // Add Scripts For Main Dashboard
elseif (check_current_page('admin/home')) : ?>
	<script src="<?php echo SITE_URL; ?>plugins/apex/apexcharts.min.js"></script>
	<script src="<?php echo SITE_URL; ?>assets/js/dashboard/dash_1.js"></script>
<?php // Add Scripts For Datatable Lists
elseif (check_current_method_similar('list')) : 	?>
	<script src="<?php echo SITE_URL; ?>plugins/table/datatable/datatables.js"></script>
	<script>
		$('#multi-column-ordering').DataTable({
			"oLanguage": {
				"oPaginate": {
					"sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
					"sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
				},
				"sInfo": "Showing page _PAGE_ of _PAGES_",
				"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
				"sSearchPlaceholder": "Search...",
				"sLengthMenu": "Results :  _MENU_",
			},
			"stripeClasses": [],
			"lengthMenu": [7, 10, 20, 50],
			"pageLength": 7,
			columnDefs: [{
				targets: [0],
				orderData: [0, 1]
			}, {
				targets: [1],
				orderData: [1, 0]
			}, {
				targets: [4],
				orderData: [4, 0]
			}]
		});
	</script>
	<script async src="https://guteurls.de/guteurls.js" selector=".linkPreview"></script>
	<script>
		window.onload = () => {
			$('.guteurlsBox > div.guteurlsImg201610').addClass('bg-transparent');
			$('.linkPreview').addClass('w-50');
			$('.guteurlsGU').remove();
		}
	</script>

<?php // Add Scripts For Form Pages
elseif (check_current_method_similar('add') or check_current_method_similar('edit')) : ?>
	<script src="<?php echo SITE_URL; ?>plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="<?php echo SITE_URL; ?>assets/js/scrollspyNav.js"></script>
	<script src="<?php echo SITE_URL; ?>plugins/flatpickr/flatpickr.js"></script>
	<script src="<?php echo SITE_URL; ?>assets/js/components/ui-accordions.js"></script>
	<script src="<?php echo SITE_URL; ?>plugins/select2/select2.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

	<script>
		//Init CKeditor
		if ($('#editor1').length) {
			CKEDITOR.replace('editor1');
		}

		if ($('.tagging').length || $('.withoutTagging').length) {
			$(".tagging").select2({
				tags: true,
				placeholder: "Make a Selection"
			});
			$(".withoutTagging").select2({
				placeholder: "Make a Selection"
			});
		}

		// Property Add Show Hide Possession Date
		if ($('#pdate').length) {
			$('#rtmo').click(function(e) {
				$('#pdate').slideUp();
			});
			$('#uc').click(function(e) {
				$('#pdate').slideDown();
			});
		}

		// Add FlatPickr on FollowDate
		if ($('#myFlatDate').length) {
			var f2 = flatpickr(document.querySelector('#myFlatDate'), {
				enableTime: true,
				dateFormat: "Y-m-d H:i:s",
			});
		}
	</script>
<?php endif; ?>
</body>

</html>
