        <!-- Alpine -->
        <script src="{{ asset('assets/js/alpine.js') }}"></script>
        <script src="{{ asset('assets/js/alpine.min.js') }}"></script>

        <!-- jQuery -->
		<script src="{{ URL::asset('/assets_admin/libs/jquery/jquery.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{ URL::asset('/assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Slimscroll JS -->
        <script src="{{ URL::asset('/assets_admin/libs/slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- Feather Icon JS -->
    	<script src="{{ URL::asset('/assets_admin/libs/feather/feather.min.js')}}"></script>
        
    	<!-- Daterangepicker js -->
	    <script src="{{ URL::asset('/assets_admin/js/moment.min.js')}}"></script>
	    <script src="{{ URL::asset('/assets_admin/libs/daterangepicker/daterangepicker.js')}}"></script>
	    <script src="{{ URL::asset('/assets_admin/js/pages/daterangepicker.init.js')}}"></script>
	    <!-- Apecharts js -->
	     <script src="{{ URL::asset('/assets_admin/libs/apex/apexcharts.min.js')}}"></script>
	     <!-- <script src="{{ URL::asset('/assets_admin/js/pages/chart-data.init.js')}}"></script> -->
	    <!-- Datatables js -->
	    <script src="{{ URL::asset('/assets_admin/libs/datatables/js/jquery.dataTables.min.js')}}"></script>
	    <script src="{{ URL::asset('/assets_admin/libs/datatables/js/datatables.min.js')}}"></script>
	     <!-- Select2 JS-->
	    <script src="{{ URL::asset('/assets_admin/libs/select2/dist/js/select2.min.js')}}"></script>
	    <script src="{{ URL::asset('/assets_admin/js/pages/select.init.js')}}"></script>
	    <script src="{{ URL::asset('/assets_admin/js/pages/form-validation.init.js')}}"></script>
	    <script src="{{ URL::asset('/assets_admin/js/owl.carousel.min.js')}}"></script>
		<!-- Custom JS -->
		<script src="{{ URL::asset('/assets_admin/js/app.js')}}"></script>
		<script type="text/javascript">

    var url = "{{ route('changeLang', ['lang' => 'ar']) }}";

    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });

</script>


