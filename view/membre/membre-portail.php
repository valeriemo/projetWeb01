{{ include('snippet/header.php', {title: 'Bienvenue'}) }}

<main class="dashboard">
    <h1>Bienvenue {{membre[0].prenom|capitalize}}</h1>


    <div class="grille-principale portail">
        <section class="portail-action">
            <img src="{{path}}assets/img/svg/icone/icone-new-timbre.svg" alt="icone timbres">
            <a class="button-1" href="{{path}}timbre/create">Créer un timbre</a>
        </section>
        
        <section class="portail-action">
            <img src="{{path}}assets/img/svg/icone/auction.svg" alt="icone timbres">
            <a class="button-1" href="{{path}}membre/enchere">Vos enchères en cours</a>

        </section>

        <section class="portail-action">
            <img src="{{path}}assets/img/svg/icone/favori.svg" alt="icone timbres">
            <a class="button-1" href="{{path}}membre/favoris">Voir vos favoris</a>

        </section>

        <section class="portail-action">
            <img src="{{path}}assets/img/svg/icone/bid.svg" alt="icone timbres">
            <a class="button-1" href="{{path}}membre/mises">Vos mises</a>
        </section>

        <section class="portail-action">
            <img src="{{path}}assets/img/svg/icone/icone-stamps.svg" alt="icone timbres">
            <a class="button-1" href="{{path}}membre/timbre">Voir vos timbres</a>
        </section>

        <section class="portail-action">
            <img src="{{path}}assets/img/svg/icone/editprofil.svg" alt="icone timbres">
            <a class="button-1" href="{{path}}membre/edit/{{membre.idMembre}}">Éditer votre compte</a>
        </section>
    </div>


</main>




{{ include('snippet/footer.php') }}