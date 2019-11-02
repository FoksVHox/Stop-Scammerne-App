<?php

// This class contains all the things we're gonna be using in our HTML more than once. Basic things like the header, navbar and footer.

// You can, of course, remove any of these, if you do not need them



class Layout

{

    use Singleton;



    public function header()

    {

        ?>

        <head>

            <link rel="stylesheet" type="text/css" href="/vendor/bootstrap-4.3.1/bootstrap.min.css">

        

            <!-- Adding the Config::i()->getVersion() thing makes caching way easier to deal with. In development mode, the version will be a randomized string on each visit, to completely bypass the cache -->

            <link rel="stylesheet" type="text/css" href="/assets/css/app.css?v=<?=Config::i()->getVersion()?>">
            <link href="https://fonts.googleapis.com/css?Barlow+Condensed&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        </head>

        <?php

    }



    public function nav()

    {

        ?>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">

            <a class="navbar-brand" href="/"><?=Config::i()->getAppName()?></a>



            <ul class="navbar-nav mr-auto">

                <a class="nav-link active" href="../blacklist.php">Blacklist</a>

                <?php

                  if(User::i()->getStatus(User::i()->getSteamID()) < 1){?>

                <a class="nav-link active" href="../developer/request.php">Bliv udvikler</a>

                <?php

                  }

                ?>

            </ul>



            <a href="notifications.php" class="nav-item mr-2"> <span class="badge badge-success">52</span> </a>



            <div class="nav-item dropdown">

                <a class="dropdown-toggle mr-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color: white; text-decoration: none;"> Logget ind som: <?=User::i()->getName()?></a>

                <div class="dropdown-menu">



                    <!-- Profil -->

                    <a class="dropdown-item" href="../profile.php?id=<?=User::i()->getSteamID()?>">Min profil</a>

                    <!-- Admin tjek -->

                    <a class="dropdown-item" href="../user.php"></i> Mine Licenser</a>

                    <a class="dropdown-item" href="../settings.php"></i> Indstillinger</a>

                    <?php 

                        if(User::i()->getStatus(User::i()->getSteamID()) >= 1){?>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item"href="../developer/dashboard.php"></i> Dashboard</a>

                    <?php

                        }

                    ?>

                    

                    <?php

                        if(User::i()->getStatus(User::i()->getSteamID()) >= 2){?>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="../admin/moderator.php" style="color: green;"> Moderator</a>

                    <?php

                        } 

                        if (User::i()->getStatus(User::i()->getSteamID()) >= 3) { ?>

                            <a class="dropdown-item" href="../admin/admin.php" style="color: blue;"> Admin</a>

                    <?php

                        }

                    ?>

                </div>

            </div>

        </nav>

        <?php

    }



    public function footer()

    {

        ?>

            <footer class="mb-auto text-center text-muted">

                <!-- Didn't know what to add in this footer so whatever -->

                <p class="ml-4">© Stop Scammerne - <a href="../roadmap.php">Version: <?=Config::i()->getRealVer()?></a></p>

            </footer>

            <script src="/vendor/jquery-3.4.1/jquery.min.js"></script>

            <script src="/vendor/popper-1.14.7/popper.min.js"></script>

            <script src="/vendor/bootstrap-4.3.1/bootstrap.min.js"></script>

        <?php

    }



    public function error($Title, $Message = null)

    {

        echo '<head></head>';

        echo '<body style="text-align: center;">';



        echo '<h1>'.$Title.'</h1>';

        echo '<p>'.(isset($Message) ? $Message : 'No message provided').'</p>';



        echo '</body>';

    }



    public function AdminNav()
    { ?>

        <ul class="nav nav-pills nav-fill">

<!-- Index -->

<li class="nav-item">

  <a class="<?php

  if (stripos($_SERVER['REQUEST_URI'], 'moderator.php')){

    echo 'nav-link text-white bg-dark';

  }else{

    echo 'nav-link text-dark';

  }?>"

  href="../admin/moderator.php">Forside</a>

</li>



<!-- Anmodninger -->

<li class="nav-item dropdown">

 <a class="dropdown-toggle <?php



 if (stripos($_SERVER['REQUEST_URI'], 'admin.php') || stripos($_SERVER['REQUEST_URI'], 'developer.php') || stripos($_SERVER['REQUEST_URI'], 'requests.php') || stripos($_SERVER['REQUEST_URI'], 'blacklist.php') || stripos($_SERVER['REQUEST_URI'], 'blacklistinfo.php')){

   echo 'nav-link text-white bg-dark';

 }else{

   echo 'nav-link text-dark';

 }?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Anmodninger</a>

 <div class="dropdown-menu">

   <a class="dropdown-item" href="../admin/admin.php">Køb af produkter</a>

   <a class="dropdown-item" href="../admin/requests.php">Produkt anmodninger</a>

   <a class="dropdown-item" href="../admin/blacklist.php">Blacklist anmodninger</a>

   <a class="dropdown-item" href="../admin/developer.php">Udvikler anmodninger</a>

 </div>

</li>



<!-- Produkt Håndtering -->

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle <?php



if (stripos($_SERVER['REQUEST_URI'], 'addproduct.php') || stripos($_SERVER['REQUEST_URI'], 'editproducts.php')){

  echo 'nav-link text-white bg-dark';

}else{

  echo 'nav-link text-dark';

}?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produkter</a>

<div class="dropdown-menu">

  <a class="dropdown-item" href="../admin/addproduct.php">Tilføj produkt</a>

  <a class="dropdown-item" href="../admin/editproducts.php">Rediger produkter</a>

</div>

</li>



<!-- Bruger håndtering -->

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle <?php



if (stripos($_SERVER['REQUEST_URI'], 'users.php') || stripos($_SERVER['REQUEST_URI'], 'whitelist.php')){

  echo 'nav-link text-white bg-dark';

}else{

  echo 'nav-link text-dark';

}?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Brugere</a>

<div class="dropdown-menu">

  <a class="dropdown-item" href="../admin/users.php">Brugere</a>

</div>

</li>



<!-- Side Administrering -->

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle <?php



if (stripos($_SERVER['REQUEST_URI'], 'msg.php') || stripos($_SERVER['REQUEST_URI'], 'editfaq.php')){

 echo 'nav-link text-white bg-dark';

}else{

 echo 'nav-link text-dark';

}?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Side Administrering</a>

<div class="dropdown-menu">

 <a class="dropdown-item" href="../admin/msg.php">Beskeder</a>

 <a class="dropdown-item" href="..k/admin/editfaq.php">Rediger FAQ</a>

</div>

</li>

        </ul>

    <?php

    }

    public function DeveloperNav($id)
    { 
        $idm = $id;
      ?>

        <ul class="nav nav-pills nav-fill">

          <!-- Index -->

          <li class="nav-item">

            <a class="<?php

            if (stripos($_SERVER['REQUEST_URI'], 'dashboard.php')){

              echo 'nav-link text-white bg-dark';

            }else{

              echo 'nav-link text-dark';

            }?>"

            href="dashboard.php?id=<?=$idm?>">Forside</a>

          </li>



          <!-- Anmodninger -->

          <li class="nav-item">

            <a class="<?php

            if (stripos($_SERVER['REQUEST_URI'], 'members.php')){

              echo 'nav-link text-white bg-dark';

            }else{

              echo 'nav-link text-dark';

            }?>"

            href="members.php?id=<?=$idm?>">Medlemmer</a>

          </li>



          <!-- Produkt Håndtering -->

          <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle <?php



          if (stripos($_SERVER['REQUEST_URI'], 'addproduct.php') || stripos($_SERVER['REQUEST_URI'], 'editproducts.php')){

            echo 'nav-link text-white bg-dark';

          }else{

            echo 'nav-link text-dark';

          }?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produkter</a>

          <div class="dropdown-menu">

            <a class="dropdown-item" href="../admin/addproduct.php">Tilføj produkt</a>

            <a class="dropdown-item" href="../admin/editproducts.php">Rediger produkter</a>

          </div>

          </li>



          <!-- Bruger håndtering -->

          <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle <?php



          if (stripos($_SERVER['REQUEST_URI'], 'users.php') || stripos($_SERVER['REQUEST_URI'], 'whitelist.php')){

            echo 'nav-link text-white bg-dark';

          }else{

            echo 'nav-link text-dark';

          }?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Brugere</a>

          <div class="dropdown-menu">

            <a class="dropdown-item" href="../admin/users.php">Brugere</a>

          </div>

          </li>



          <!-- Side Administrering -->

          <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle <?php



          if (stripos($_SERVER['REQUEST_URI'], 'msg.php') || stripos($_SERVER['REQUEST_URI'], 'editfaq.php')){

          echo 'nav-link text-white bg-dark';

          }else{

          echo 'nav-link text-dark';

          }?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Side Administrering</a>

          <div class="dropdown-menu">

          <a class="dropdown-item" href="../admin/msg.php">Beskeder</a>

          <a class="dropdown-item" href="..k/admin/editfaq.php">Rediger FAQ</a>

          </div>

          </li>

        </ul>

    <?php

    }

}