		
		
		<link href="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url('assets')?>/plugins/footable/css/footable.core.css" rel="stylesheet">

		
		<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.js"></script>

        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/jszip.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.scroller.min.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.colVis.js"></script>
        <script src="<?=base_url('assets')?>/plugins/datatables/dataTables.fixedColumns.min.js"></script>
		<script src="<?=base_url('assets')?>/plugins/footable/js/footable.all.min.js"></script>


        <script src="<?=base_url('assets')?>/pages/datatables.init.js"></script>
		
		
		 <script type="text/javascript">
            $(document).ready(function () {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    ajax: "assets/plugins/datatables/json/scroller-demo.json",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });
            TableManageButtons.init();

        </script>
