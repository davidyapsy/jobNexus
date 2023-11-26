<!DOCTYPE html>
<html>
    <head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    </head>
<body onload="successMessage()">
    <script>
        function successMessage(){
        Swal.fire({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
        });
    }
    </script>
</body>
</html>