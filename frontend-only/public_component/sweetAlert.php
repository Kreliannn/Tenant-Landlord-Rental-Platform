<style>
    .layer{
        z-index: 9999;
    }

 

</style>


<script>

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
        customClass: { container: 'layer' },
        timerProgressBar: true,
    });


    function alertSuccess(text)
    {
        Toast.fire({
            icon: "success",
            title: text
        });
    }

    function alertError(text)
    {
        Toast.fire({
            icon: "error",
            title: text,
        });
    }


    function alertConfirm(text, func)
    {
        Swal.fire({
            title: "Are you sure?",
            text: text,
            showCancelButton: true,
            confirmButtonColor: "green",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
        }).then((result) => {
            if (result.isConfirmed) {
                func();
            }
        });
    }

    
    function alertNormal(icon, title, func)
    {
        Swal.fire({
            title: title,
            icon: icon
        }).then(()=>{
            func()
        });
    }
    

</script>