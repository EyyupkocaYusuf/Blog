</div>

</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Çıkış yapmak istediğinize emin misiniz?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{route('admin.logout')}}">Logout</a>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('/backend')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('/backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/backend')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="{{asset('/backend')}}/js/sb-admin-2.min.js"></script>
<script src="{{asset('/backend')}}/vendor/chart.js/Chart.min.js"></script>
<script src="{{asset('/backend')}}/js/demo/chart-area-demo.js"></script>
<script src="{{asset('/backend')}}/js/demo/chart-pie-demo.js"></script>

<script src="{{asset('/backend')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/backend')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/backend')}}/js/demo/datatables-demo.js"></script>
@yield('js')
</body>

</html>
