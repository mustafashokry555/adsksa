		<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
		<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- Feather Icon JS -->
    	<script src="{{ asset('assets/libs/feather/feather.min.js')}}"></script>
    	<!-- Swiper JS -->
		<script src="{{ asset('assets/libs/swiper/js/swiper.min.js')}}"></script>
    	 <!-- Slick -->
	    <script src="{{ asset('assets/js/slick.js')}}"></script>
	    <script src="{{ asset('assets/js/pages/slick.init.js')}}"></script>
	     <!-- sticky-sidebar -->
	    <script src="{{ asset('assets/libs/theia-sticky-sidebar/dist/ResizeSensor.js')}}"></script>
	    <script src="{{ asset('assets/libs/theia-sticky-sidebar/dist/theia-sticky-sidebar.js')}}"></script>
	     <!-- Select2 JS-->
	    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
	    <script src="{{ asset('assets/js/pages/select.init.js')}}"></script>
    	<!-- Daterangepicker js -->
	    <script src="{{ asset('assets/js/moment.min.js')}}"></script>
	    <script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js')}}"></script>
	    <script src="{{ asset('assets/js/pages/daterangepicker.init.js')}}"></script>
		    <!-- Datatables js -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	    <!-- Daterangepicker js -->
	    <script src="{{ asset('assets/js/moment.min.js')}}"></script>
	    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
	    <script src="{{ asset('assets/js/pages/datetimepicker.init.js')}}"></script>
	    <!-- Apecharts js -->
    	<script src="{{ asset('assets/libs/apex/apexcharts.min.js')}}"></script>
	     <!-- Jquery-ui -->
   		 <script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>
	    <!-- Full Calendar js -->
	    <script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>
	    <script src="{{ asset('assets/libs/fullcalendar/fullcalendar.min.js')}}"></script>
	    <script src="{{ asset('assets/js/pages/fullcalendar.init.js')}}"></script>
	    <!-- Fancybox  js -->
   		 <script src="{{ asset('assets/libs/fancybox/jquery.fancybox.min.js')}}"></script>
   		 <!-- Circle Progress JS -->
	    <script src="{{ asset('assets/js/circle-progress.min.js')}}"></script>
	    <script src="{{ asset('assets/js/pages/progress-bar.init.js')}}"></script>
	    <!-- Bootstrap Tagsinput JS -->
	    <script src="{{ asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
	    <!-- Dropzone JS -->
	    <script src="{{ asset('assets/js/pages/dropzone.init.js')}}"></script>
	    <script src="{{ asset('assets/js/pages/profile-settings.init.js')}}"></script>
    	<!-- Owl carousel JS -->
     	<script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
		@if(Route::is(['onboarding-phone','patient-phone']))
     	<!-- IntlTelInput JS -->
		<script src="{{ asset('assets/js/intlTelInput.js')}}"></script>
		<script src="{{ asset('assets/js/intlTelInput.min.js')}}"></script>
		@endif
	    <!-- Animation js -->
    	<script src="{{ asset('assets/libs/aos/aos.js')}}"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
		<!-- Custom JS -->
		<script src="{{ asset('assets/js/app.js')}}"></script>
		@if(Route::is(['map-grid','map-list','map-list-1']))
	    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
    	<script src="{{ asset('assets/js/map.js')}}"></script>
    	@endif
		@if(Route::is(['onboarding-phone','patient-phone']))
		<script>
			
			var input = document.querySelector("#phone");
			window.intlTelInput(input, {
				autoHideDialCode: true,
				autoPlaceholder: "polite",
				formatOnDisplay: true,
				placeholderNumberType: "MOBILE",
				separateDialCode: true,
				utilsScript: "assets/js/utils.js",
			});
				

			
		</script>

		@endif
		<script>
			// alert("adjhfdakj");
new DataTable('#datatable1', {
    order: [
        [0, 'desc'] // Use the appropriate column index (0 is the first column) and 'desc' for descending order
    ]
});

new DataTable('#datatable2', {
    order: [
        [0, 'desc'] // Use the appropriate column index (0 is the first column) and 'desc' for descending order
    ]
});

	
     $('.best-doctors-slider').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
 });
 $('.slider-nav').slick({
   slidesToShow: 3,
   slidesToScroll: 1,
   dots: true,
   focusOnSelect: true
 });
    </script>
