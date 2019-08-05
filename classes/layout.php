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
            <a class="navbar-brand" href="/"><?=Config::i()->getAppName()?></a>

            <ul class="navbar-nav mr-auto">
                <a class="nav-link active" href="../">Hjem</a>
                <a class="nav-link active" href="../blacklist.php">Blacklist</a>
            </ul>
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
                            <a class="dropdown-item" href="../developer/devreq.php"> Udviker</a>
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
                <p class="ml-4">© Stop Scammerne - Version: <?=Config::i()->getRealVer()?></p>
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

    public function Sidebar()
    { ?>
      <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
            </div>
        </div>
    </div>
    <?php
    }
}