{{ include('snippet/header.php', {title: 'Vos timbres'}) }}

<!-- Page qui affiche les timbres d'un membre qui ne sont pas encore mis en enchere -->

<main class="membre-main">
    <section class="dashboard">
        <header class="titre-section">
            <h2>
                <span class="scribe">V</span>os timbres
            </h2>
            <div></div>
        </header>
        {% if timbres == '' %}
        <h3>Vous n'avez pas encore de timbre enregistré</h3>
        <a class="button-1" href="{{path}}timbre/create">Créer un timbre</a>
        {% endif %}
        <div class="grille-simple">

            {% for timbre in timbres %}
            {% if timbre.idEnchere is empty %}

            <article class="boite-timbre membre">
                <div class="timbre-info">
                    <h4>{{ timbre.nomTimbre }}</h4>
                    <p>{{ timbre.paysOrigine }}, {{ timbre.anneeEmission }}</p>
                </div>
                <a href="{{path}}enchere/create/{{timbre.idTimbre}}" class="button-1">Mettre ce timbre en enchère</a>
                <a href="{{path}}timbre/edit/{{timbre.idTimbre}}" class="button-1">Éditer ce timbre</a>
                <a href="{{path}}timbre/delete/{{timbre.idTimbre}}" class="button-1">Supprimer ce timbre</a>


            </article>
            {% else %}
            <div>
                <p>{{ timbre.nomTimbre }} : Mis en enchère !</p>
            </div>
            {% endif %}
            {% endfor %}

        </div>

    </section>



</main>

{{ include('snippet/footer.php') }}