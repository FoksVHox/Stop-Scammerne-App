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
            <script src="https://kit.fontawesome.com/05b497df87.js"></script>
        </head>
        <?php
    }

    public function nav()
    {
        ?>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <a class="navbar-brand" href="/">My cool app</a>

            <ul class="navbar-nav mr-auto">
                <a class="nav-link active" href="/">Hjem</a>
                <a class="nav-link active" href="/blacklist.php">Blacklist</a>
            </ul>
            <div class="nav-item dropdown">
                <a class="dropdown-toggle mr-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color: white; text-decoration: none;"> Logget ind som: <?=User::i()->getName()?></a>
                <div class="dropdown-menu">

                    <!-- Profil -->
                    <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> Min profil</a>

                    <!-- Admin tjek -->
                    <a class="dropdown-item" href="user.php"></i> Mine Licenser</a>
                    <a class="dropdown-item" href="devreq.php"><i class="far fa-file-alt"></i> Udviker</a>
                    <a class="dropdown-item"href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"href="admin.php" style="color: green;"><i class="fas fa-shield-alt"></i> Moderator</a>
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
                <p class="ml-4">© Stop Scammerne</p>
                <p>Version: <?=Config::i()->getRealVer()?></p>
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
}