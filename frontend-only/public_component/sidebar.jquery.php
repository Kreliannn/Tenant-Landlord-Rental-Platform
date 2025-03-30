<script>
        $(document).ready(function() {
            $('#dropdown').click(function() {
                $('#side-menu').toggle();
            });
        });


        $('#logout1').click((e) => {
            e.preventDefault();
            $.ajax({
                url: '../backend/user.logout.php',
                success: () => {
                    window.location.href = '../frontend/landing_page.php';
                }
            });
        });

        $('#logout2').click((e) => {
            e.preventDefault();
            $.ajax({
                url: '../backend/user.logout.php',
                success: () => {
                    window.location.href = '../frontend/landing_page.php';
                }
            });
        });
</script>