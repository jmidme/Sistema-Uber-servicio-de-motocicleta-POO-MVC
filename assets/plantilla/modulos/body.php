  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= URL::to("assets/plantilla/plugins/jquery/jquery.min.js")?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= URL::to("assets/plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
<!-- DataTables -->
<script src="<?= URL::to("assets/plantilla/plugins/datatables/jquery.dataTables.js")?>"></script>
<script src="<?= URL::to("assets/plantilla/plugins/datatables-bs4/js/dataTables.bootstrap4.js")?>"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<!-- Toastr -->
<script src="<?= URL::to("assets/plantilla/plugins/toastr/toastr.min.js")?>"></script>
<!-- overlayScrollbars -->
<script src="<?= URL::to("assets/plantilla/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")?>"></script>
<!-- AdminLTE App -->
<script src="<?= URL::to("assets/plantilla/dist/js/adminlte.min.js")?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= URL::to("assets/plantilla/dist/js/demo.js")?>"></script>
<script>
    message = `<?= (URL::getMessages()[1])?>`,
    codigo = `<?= (URL::getMessages()[0])?>`
</script>
<script src="<?= URL::to("assets/js/script.js")?>"></script>
</body>
</html>
