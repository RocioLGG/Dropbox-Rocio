<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dropbox Chooser Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .modal-content img {
            width: auto;
            height: auto;
        }
        #carousel-container {
            margin-top: 40px;
            height: 300px;
        }
        #carousel-container .carousel-item {
            text-align: center;
            min-height: 300px;
        }
        #carousel-container .carousel-item img {
            width: auto;
            height: auto;
            margin: auto;
        }
        .form-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .form-container form {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="b42p5ml3wa3f03m"></script>
</head>
<body>
<div class="container form-container">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h2 class="text-center">Subir archivo</h2>
        <div class="form-group">
            <input type="file" class="form-control-file" name="file" id="file">
        </div>
        <div class="text-center">
            <input type="submit" name="btnenviar" id="btnenviar" class="btn btn-primary">
        </div>
    </form>
</div>

<br/>
<br/>
<div class="container">
    <h1 class="text-center">Dropbox Chooser Demo Rocio</h1>
    <div class="text-center" id="dropbox-container"></div>
    <hr>
</div>

<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" class="img-responsive" id="modalImage">
            </div>
        </div>
    </div>
</div>

<div class="container" id="carousel-container">
    <div id="carousel-inner" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        </div>
        <a class="carousel-control-prev" href="#carousel-inner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-inner" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>



<script>
    options = {
        success: function(files) {
            files.forEach(function(file, index) {
                add_img_to_carousel(file, index === 0);
            });
            startAutoSlide();
        },
        cancel: function() {

        },
        linkType: "direct",
        multiselect: true,
        extensions: ['.png', '.jpg'],
    };

    var button = Dropbox.createChooseButton(options);
    document.getElementById("dropbox-container").appendChild(button);

    var currentIndex = 0;
    var images = [];

    function add_img_to_carousel(file, isActive) {
        var carouselInner = document.querySelector('.carousel-inner');
        var carouselItem = document.createElement('div');
        carouselItem.classList.add('carousel-item');
        if (isActive) {
            carouselItem.classList.add('active');
        }
        var img = document.createElement('img');
        img.src = file.link;
        img.alt = 'Imagen';
        img.classList.add('d-block', 'w-100');
        carouselItem.appendChild(img);
        carouselInner.appendChild(carouselItem);
    }

    function startAutoSlide() {
        setInterval(function() {
            showNextImage();
        }, 3000);
    }

    function showNextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        document.getElementById("modalImage").src = images[currentIndex].link;
    }
</script>


</body>
</html>
