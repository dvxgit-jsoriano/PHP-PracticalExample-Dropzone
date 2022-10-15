<!DOCTYPE html>

<head>
    <title>PHP - Dropzone File Upload</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        /** This hides the progress */
        .dz-progress {
            display: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP Dropzone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">File Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="ajax.php">AJAX Upload</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="container">
            <h6 class="mt-4 mb-4 fst-italic">This example shows how to upload file using ajax instead of dropzone processQueue().</h6>
        </div>
    </header>

    <section>
        <div class="container mt-2">
            <form action="upload.php" class="dropzone" id="dropzoneFrom"></form>

            <div class="d-grid gap-2 mt-4">
                <button id="btnUpload" class="btn btn-primary" type="button" onclick="uploadNow()">Upload</button>
            </div>
        </div>
    </section>
</body>

<script>
    Dropzone.options.dropzoneFrom = {
        autoProcessQueue: false, // Prevent auto processing of queue
        maxFilesize: 2, // MB
        maxFiles: 1,
        //createImageThumbnails: false,
        headers: {
            "Authorization": "Bearer 823v75n827n059vn720571nv0571v" // Pass an authorzation code.
        },
        init: function() {
            var dz = this;

            /** This code will limit the file previews to one */
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }
    };

    /** Once button upload is click, it will process the uploading of file */
    function uploadNow() {
        /** Since this process has a file upload, you shall pass a FormData to ajax. */
        var formData = new FormData();
        formData.append('file', $("#dropzoneFrom")[0].dropzone.getAcceptedFiles()[0]);

        /** Call the ajax */
        $.ajax({
            type: "POST",
            url: "upload.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                console.log(response);
                $("#dropzoneFrom")[0].dropzone.removeAllFiles(); // Successful ajax response, remove the files inside the dropzone
            }
        });
    }
</script>

</html>