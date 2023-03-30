<script src="<?= base_url('AdminLTE/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('AdminLTE/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('AdminLTE/dist/js/adminlte.min.js'); ?>"></script>
<script src="<?= base_url('AdminLTE/dist/js/demo.js'); ?>"></script>
<?php
if (isset($scripts)) {
    foreach ($scripts as $value) {
        $src = base_url('js') . '/' . $value;
        echo '<script src="' . $src . '"></script>';
    }
}
?>
</body>
</html>
