<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/slideshow.css">
        <title>SOnline</title>
    </head>
    <body>
        <?php 
            $navbar = array(1, 0, 0, 0);
            require 'componente/navbar.php';
            if(isset($_GET['logout'])){
                session_destroy ();
                header("Location: index.php");
                die();
            }
        ?>
        <div id="pageContent" class="contentBox">
            <?php require 'componente/slideshowRecente.php';?>
            <section class="containerStiri">
                <h3 class="titluStire">Ultimele noutati:</h3>
                <article class="boxStire">
                    <h3 class="titluStire">Lorem ipsum dolor sit amet.</h3>
                    <div class="dataStire">
                        <span>26</span><br>
                        <label>DECEMBRIE</label>
                    </div>
                    <div class="textStire">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam dolorum minima incidunt. Praesentium tenetur reiciendis magni repudiandae aliquam repellat esse earum atque exercitationem nostrum dolorem cupiditate quo eligendi id unde harum vitae obcaecati dolore beatae nulla, consectetur minima assumenda. Minus rem doloremque eligendi asperiores! Cum qui ipsam omnis, dicta doloribus vel dolores autem tempora cupiditate consequuntur laudantium. Voluptatum eum tempore sapiente accusantium id ullam tenetur voluptates molestias exercitationem voluptas ex veritatis incidunt, pariatur qui et consectetur dolorem odio perferendis quaerat reiciendis fugiat rem harum. Similique excepturi fuga laboriosam facere, voluptas accusantium illo facilis? Nihil tenetur eos, quidem in impedit nulla.</p>
                    </div>
                </article>
                <article class="boxStire">
                    <h3 class="titluStire">Lorem ipsum dolor sit amet.</h3>
                    <div class="dataStire">
                        <span>18</span><br>
                        <label>NOIEMBRIE</label>
                    </div>
                    <div class="textStire">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam dolorum minima incidunt. Praesentium tenetur reiciendis magni repudiandae aliquam repellat esse earum atque exercitationem nostrum dolorem cupiditate quo eligendi id unde harum vitae obcaecati dolore beatae nulla, consectetur minima assumenda. Minus rem doloremque eligendi asperiores! Cum qui ipsam omnis, dicta doloribus vel dolores autem tempora cupiditate consequuntur laudantium. Voluptatum eum tempore sapiente accusantium id ullam tenetur voluptates molestias exercitationem voluptas ex veritatis incidunt, pariatur qui et consectetur dolorem odio perferendis quaerat reiciendis fugiat rem harum. Similique excepturi fuga laboriosam facere, voluptas accusantium illo facilis? Nihil tenetur eos, quidem in impedit nulla.</p>
                    </div>
                </article>
                <article class="boxStire">
                    <h3 class="titluStire">Lorem ipsum dolor sit amet.</h3>
                    <div class="dataStire">
                        <span>8</span><br>
                        <label>OCTOMBIRE</label>
                    </div>
                    <div class="textStire">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam dolorum minima incidunt. Praesentium tenetur reiciendis magni repudiandae aliquam repellat esse earum atque exercitationem nostrum dolorem cupiditate quo eligendi id unde harum vitae obcaecati dolore beatae nulla, consectetur minima assumenda. Minus rem doloremque eligendi asperiores! Cum qui ipsam omnis, dicta doloribus vel dolores autem tempora cupiditate consequuntur laudantium. Voluptatum eum tempore sapiente accusantium id ullam tenetur voluptates molestias exercitationem voluptas ex veritatis incidunt, pariatur qui et consectetur dolorem odio perferendis quaerat reiciendis fugiat rem harum. Similique excepturi fuga laboriosam facere, voluptas accusantium illo facilis? Nihil tenetur eos, quidem in impedit nulla.</p>
                    </div>
                </article>
                <article class="boxStire">
                    <h3 class="titluStire">Lorem ipsum dolor sit amet.</h3>
                    <div class="dataStire">
                        <span>12</span><br>
                        <label>SEPTEMBRIE</label>
                    </div>
                    <div class="textStire">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam dolorum minima incidunt. Praesentium tenetur reiciendis magni repudiandae aliquam repellat esse earum atque exercitationem nostrum dolorem cupiditate quo eligendi id unde harum vitae obcaecati dolore beatae nulla, consectetur minima assumenda. Minus rem doloremque eligendi asperiores! Cum qui ipsam omnis, dicta doloribus vel dolores autem tempora cupiditate consequuntur laudantium. Voluptatum eum tempore sapiente accusantium id ullam tenetur voluptates molestias exercitationem voluptas ex veritatis incidunt, pariatur qui et consectetur dolorem odio perferendis quaerat reiciendis fugiat rem harum. Similique excepturi fuga laboriosam facere, voluptas accusantium illo facilis? Nihil tenetur eos, quidem in impedit nulla.</p>
                    </div>
                </article>
            </section>
        </div>
    </body>
</html>