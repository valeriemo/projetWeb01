{{ include('snippet/header.php', {title: 'Bienvenue'}) }}

<main class="dashboard">
    <h1>Bienvenue {{membre[0].prenom}}</h1>
    <section class="carte_profil">

    </section>

    <div class="dashboard_table">
        <section class="dashboard_action">
            <a class="button-1" href="{{path}}timbre/create">Créer un timbre</a>
            <a class="button-1" href="{{path}}membre/timbre">Voir vos timbres</a>
            <a class="button-1" href="{{path}}membre/enchere">Vos enchères en cours</a>
        </section>
    </div>


</main>




{{ include('snippet/footer.php') }}