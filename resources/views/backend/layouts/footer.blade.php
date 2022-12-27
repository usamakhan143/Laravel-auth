<footer class="main-footer">
	<div class="row">
		<div class="col-sm-10">
			Powered by VISECH | &copy; {{date('Y')}} <a> HRM</a>. All Rights Reserved.
		</div>
		<div class="col-sm-2">
			{{-- <a target="_blank">Developed by USAMA</a> --}}
		</div>
	</div>
</footer>






	<!-- jQuery 3 -->
	<script src="{{ asset('backend/assets/vendor_components/jquery/dist/jquery.js') }}"></script>
	<script src="{{ asset('backend/assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>

	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('backend/assets/vendor_components/jquery-ui/jquery-ui.js') }}"></script>

	<!-- popper -->
	<script src="{{ asset('backend/assets/vendor_components/popper/dist/popper.min.js') }}"></script>

	<!-- Bootstrap 4.0-->
	<script src="{{ asset('backend/assets/vendor_components/bootstrap/dist/js/bootstrap.js') }}"></script>

	<script src="{{ asset('backend/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

	<!-- Morris.js charts -->
	<script src="{{ asset('backend/assets/vendor_components/raphael/raphael.min.js') }}"></script>
	<script src="{{ asset('backend/assets/vendor_components/morris.js/morris.min.js') }}"></script>

	<!-- FLOT CHARTS -->
	<script src="{{ asset('backend/assets/vendor_components/Flot/jquery.flot.js') }}"></script>

	<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
	<script src="{{ asset('backend/assets/vendor_components/Flot/jquery.flot.resize.js') }}"></script>

	<!-- ChartJS -->
	<script src="{{ asset('backend/assets/vendor_components/chart-js/chart.js') }}"></script>
	<script src="{{ asset('backend/assets/vendor_components/chart-js/Chart.HorizontalBar.js') }}"></script>

	<!-- Sparkline -->
	<script src="{{ asset('backend/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>

	<!-- Slimscroll -->
	<script src="{{ asset('backend/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

	<!-- FastClick -->
	<script src="{{ asset('backend/assets/vendor_components/fastclick/lib/fastclick.js') }}"></script>

	<!-- peity -->
	<script src="{{ asset('backend/assets/vendor_components/jquery.peity/jquery.peity.js') }}"></script>

	<!-- SlimScroll -->
	<script src="{{ asset('backend/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

	<!-- Unique Admin App -->
	<script src="{{ asset('backend/js/template.js') }}"></script>

	<!-- Unique Admin dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

	<!-- Unique Admin for demo purposes -->
	<script src="{{ asset('backend/js/demo.js') }}"></script>

	<!-- Message -->
	<script type="text/javascript">
	    $(function(){
	        setTimeout(function() {
	            $('.fade-message').slideUp();
	        }, 6000);
	    });


	    document.addEventListener("DOMContentLoaded", () => {

	    	const rows = document.querySelectorAll("tr[data-href]");

	    	rows.forEach(row => {

	    		row.addEventListener("click", () => {

	    			window.location.href = row.dataset.href;

	    		});

	    	});

	    });
    </script>


	@section('scripts')
		@show
{{--  --}}