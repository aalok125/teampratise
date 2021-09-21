<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('backend/assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('backend/assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<!-- <script src="{{asset('backend/plugins/apex/apexcharts.min.js')}}"></script> -->
<script src="{{asset('backend/assets/js/dashboard/dash_2.js')}}"></script>
<script src="{{ asset('backend/plugins/table/datatable/datatables.js') }}"></script>
<script src="{{asset('backend/plugins/notification/snackbar/snackbar.min.js')}}"></script>


    @if (Session::has ('success'))
    <script type="text/javascript">
    Snackbar.show({
        text: '{{Session::get('success')}}',
        pos: 'top-right'
    });
    </script>
    @endif

    @if (Session::has('delete.msg'))
      <script type="text/javascript">
       Snackbar.show({
            text: '{{Session::get('delete.msg')}}',
            pos: 'top-right'
        });
    </script>
    @endif

@stack('backend-scripts')
