<!-- Bootstrap core JavaScript
      ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./tes_files/jquery-3.3.1.slim.min.js.download" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="./tes_files/popper.min.js.download"></script>
<script src="./tes_files/bootstrap.min.js.download"></script>

<!-- Icons -->
<script src="./tes_files/feather.min.js.download"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    feather.replace()

    $(document).ready(function() {
        var url = window.location;
        // alert(url);
        $('.nav-link').find('.active').removeClass('active');
        $('.nav-link').each(function() {
            if (this.href == url) {
                $(this).addClass('active');
            }
        });
    });
</script>

</body>

</html>