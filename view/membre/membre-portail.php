{{ include('snippet/header.php', {title: 'Bienvenue'}) }}

<main class="dashboard">
    <h1>Bienvenue {{session.username}}</h1>

    <div class="dashboard_table">
        <section class="dashboard_profil">
            {% if profil == false %}
            <a class="button-1" href="{{path}}profil/create">Créer votre profil</a>
            {% else %}
            <h2>Profil</h2>
            {% endif %}
        </section>
        <section class="dashboard_action">
            <a class="button-1" href="{{path}}timbre/create">Créer un timbre</a>
            <a class="button-1" href="{{path}}timbre/show">Voir vos timbres</a>
            <a class="button-1" href="{{path}}enchere/show">Vos enchères en cours</a>
        </section>
    </div>


</main>




{{ include('snippet/footer.php') }}