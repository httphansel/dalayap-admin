<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/sweetalert.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../ph-address-selector.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    /* table */
    new DataTable('#myTable');
</script>

    <?php
        if(isset($_SESSION['message']) && $_SESSION['icon'] != ''){
    ?>
    <script>
        swal({
            title: '<?php echo $_SESSION['message']?>',
            icon: '<?php echo $_SESSION['icon']?>',
            button: "OKAY",
        });
    </script>
    <?php
        unset($_SESSION['message']);
        }
    ?>