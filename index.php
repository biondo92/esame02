<?php
$jsonString = file_get_contents("data.json");
$jsonData = json_decode($jsonString, true);

$email_inviata = false;
$result = "";
if (isset($_GET["result"])) {
    $result = $_GET["result"];
    $email_inviata = true;
}
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $messaggio = $_POST["messaggio"];
    $email_inviata = true;
}
*/
?>
<!DOCTYPE html>
<html>

<head>
    <title>AEZMA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style.css">
</head>

<body id="top">

    <header>
        <nav class="main-navbar">
            <div class="logo-wrapper">
                <a class="link-logo" href="#top">
                    <img class="logo" src="img/logo.png" alt="aezma">
                </a>
            </div>
            <ul class="navbar">
                <li><a href="#top">Home</a></li>
                <li><a href="#about">Chi Siamo</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#contact">Contatti</a></li>
            </ul>
        </nav>
    </header>

    <section id="home">
        <div class="wrapper">
            <h1 class="title">AEZMA</h1>
            <h3 class="subtitle">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</h3>
        </div>
    </section>

    <section id="about">
        <div class="wrapper">
            <div class="story">
                <div class="image">
                    <img src="img/team2.jpg" alt="">
                </div>
                <div class="text">
                    <h1>Chi Siamo?</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto excepturi est dolores optio
                        numquam necessitatibus praesentium asperiores suscipit, alias at unde quidem ipsam enim atque
                        fuga eaque qui tenetur vitae.
                        Sapiente beatae ullam laboriosam similique maxime consectetur incidunt velit explicabo quis nemo
                        provident vero omnis perferendis eius, modi necessitatibus quia consequuntur! Quasi laudantium
                        distinctio placeat cum error tenetur praesentium atque!
                        Sunt porro maxime laudantium eos eius ut dicta, labore atque aperiam delectus illo dolores
                        sapiente dolorem quidem aspernatur maiores minus a accusantium animi? Perferendis impedit non
                        asperiores quisquam, cum quaerat?
                    </p>

                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <small>Jhon Doe, <cite title="Source Title">AEZMA CEO & Founder</cite></small>
                    </blockquote>
                </div>
            </div>
            <div class="numbers">
                <h1>I Nostri Numeri</h1>
                <div class="blocks">
                    <?php foreach ($jsonData['statistics'] as $stat) { ?>
                        <div class="block">
                            <strong><?php echo $stat['value'] ?></strong>
                            <p><?php echo $stat['title'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio">
        <div class="wrapper">
            <h1>I Nostri Lavori</h1>
            <?php
            $controllo = 0;
            ?>
            <?php foreach ($jsonData['projects'] as $id => $proj) { ?>
                <?php if ($controllo == 0) { ?>
                    <div class="portfolio-row">
                    <?php }
                $controllo++;
                    ?>
                    <div class="portfolio-item" data-project-id="<?php echo $id ?>">
                        <img src="<?php echo $proj['image'] ?>" alt="<?php echo $proj['title'] ?>" />
                        <div class="project-title"><?php echo $proj['title'] ?></div>
                    </div>
                    <?php if ($controllo == 4) {
                        $controllo = 0;
                    ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </section>

    <section id="contact">
        <div class="wrapper">
            <h1>Contattaci</h1>
            <form action="/esercitazione 2 PHP-SCSS/send-email.php" method="post" class="contact-form">
                <?php if ($email_inviata) { ?>
                    <div class="form-input">
                        <strong><?php echo $result ?></strong>
                    </div>
                <?php } ?>
                <div class="form-input">
                    <label for="email">Email</label>
                    <br>
                    <input id="email" type="email" name="email" placeholder="email">
                </div>
                <div class="form-input">
                    <label for="message">Messaggio</label>
                    <br>
                    <textarea id="message" name="message" rows="10" placeholder="messaggio"></textarea>
                </div>
                <div class="form-input">
                    <button type="submit">INVIA</button>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <div class="wrapper">
            <div class="text">
                <a href="#">AEZMA 2023</a> &copy; All Right Reserved
            </div>
            <ul>
                <li><a class="social" href="#"><i class="fa-brands fa-2x fa-square-facebook"></i></a></li>
                <li><a class="social" href="#"><i class="fa-brands fa-2x fa-square-instagram"></i></a></li>
            </ul>
        </div>
    </footer>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="desc"></p>
        </div>

    </div>


    <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        // var data = {};
        fetch('data.json')
            .then((response) => response.json())
            .then(function(json) {

                var projects = document.getElementsByClassName("portfolio-item");
                for (var i = 0; i < projects.length; i++) {
                    var box = projects[i];
                    box.onclick = function() {
                        var id = box.getAttribute("data-project-id");
                        var proj = json.projects[id];
                        modal.style.display = "block";
                        var desc = modal.getElementsByTagName("p");
                        desc[0].innerHTML = proj.description + " " + id;
                        // console.log(json[id]);

                    }
                }


                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on the button, open the modal


                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            });

        // Get the button that opens the modal
        // var projects = document.getElementsByClassName("portfolio-item");
        // console.log(projects);
        // for (var i = 0; i < projects.length; i++) {
        //     var box = projects[i];
        //     box.onclick = function() {
        //         var id = box.getAttribute("data-project-id");
        //         var proj = data[id];
        //         modal.style.display = "block";
        //         var desc = modal.getElementsByTagName("p");
        //         // desc[0].innerHTML = proj.description + " " + id;
        //         console.log(data[id]);

        //     }
        // }


        // // Get the <span> element that closes the modal
        // var span = document.getElementsByClassName("close")[0];

        // // When the user clicks on the button, open the modal


        // // When the user clicks on <span> (x), close the modal
        // span.onclick = function() {
        //     modal.style.display = "none";
        // }

        // // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //     if (event.target == modal) {
        //         modal.style.display = "none";
        //     }
        // }
    </script>
</body>

</html>