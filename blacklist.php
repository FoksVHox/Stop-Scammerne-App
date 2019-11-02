<?php
// This is another page. This one shows details about the player, mainly the players gang

// Requires our autoloading and classes
require_once '__init.php';

// Handle user sign-in
User::i()->login();

// Echo the <head> into our document
Layout::i()->header();

// Echo our navbar
Layout::i()->nav();
?>

<div class="text-center">
    <h1 class="display-4">Blacklist</h1>   
</div>


<div class="container mt-5">
    <div class="container-fluid">
				<div class="input-group mb-3">
				 	<input type="text" class="form-control" id = "search" placeholder="SteamID" aria-label="Produktnavn" aria-describedby="btn-search">
				  	<div class="input-group-append">
				    	<button class="btn btn-primary" type="button" id="btn-search" onclick = "search(1);">Søg</button>
				  	</div>
				</div>
        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#addCocksucker" role="button" aria-expanded="false" aria-controls="collapseExample">Tilføj spiller til blacklist</a>
        </p>
        <div class="collapse mb-3" id="addCocksucker">
            <div class="card card-body">
                <form action="actions/blacklist.php" method="post" class="needs-validation" novalidate>
                <p class="card-text">Udfyld venlist alle felterne</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">SteamID</span>
                        </div>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="SteamID" aria-label="Username" name="ScamID" aria-describedby="basic-addon1" required>
                        <div class="valid-feedback">
                            Nice!
                        </div>
                        <div class="invalid-feedback">
                            Indtast venligst et SteamID!
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Beviser</span>
                        </div>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Beviser" aria-label="Username" name="Proff" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Reason" placeholder="Skriv grunden til, at personen skal blacklistes" required></textarea>
                        <div class="valid-feedback">
                            Nice!
                        </div>
                        <div class="invalid-feedback">
                            Indtast venligst en begrundelse!
                        </div>
                    </div>
                    <button type="submit" name="Request" class="btn btn-block btn-outline-dark">Anmod om blacklist</button>
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 25%;">Navn</th>
                    <th style="width: 25%;">SteamID</th>
                    <th style="width: 25%;">Grund</th>
                    <th style="width: 25%;">Dato</th>
                </tr>
            </thead>
            <tbody id="live">
            <?php
                    $res = Blacklist::i()->getBlacklisted();
                    if(!$res < 0){
                        echo '
                        <tr class="text-center">
                            <td colspan="4">Ingen blacklistede spillere!</td>
                        </tr>';
                    } else {
                        foreach ($res as $k => $v) {
                            echo '            
                            <tr>
                                <td>'.$v['Nick'].'</td>
                                <td>'.$v['ScammerID'].'</td>
                                <td>'.$v['Reason'].'</td>
                                <td>'.$v['Created'].'</td>
                            </tr>';
                        }
                    }
                ?>
            </tbody>
        </table> 

    </div>
</div>

<?php
// Echo our footer and scripts
Layout::i()->footer();
?>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

function search(num){
    $("#live").empty();
    $("#loadingbar").show();

    //var cat = $("#SortByCat").val();
    //var valu = $("#SortByValue").val();
    var search = $("#search").val();
   // var page = num;

    $.ajax({
        type: 'POST',
        url: 'bSearch.php',
        data: {
            //cat: cat,
            //valu: valu,
            term: search,
            //page: page
        },
        success: function(result){
                $("#live").html(result);
                $("#loadingbar").hide();                
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Ikke forbundet til internettet.\n Tjek internetforbindelse.';
            } else if (jqXHR.status == 404) {
                msg = 'Siden blev ikke fundet. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Server fejl, kontakt ZeNoxXi [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Timeout, prøv igen';
            } else if (exception === 'abort') {
                msg = 'Afbrudt, prøv igen.';
            } else {
                msg = 'Ukendt fejl: .\n' + jqXHR.responseText;
            }
            $("#loadingbar").hide();
        },
    });
}

</script>