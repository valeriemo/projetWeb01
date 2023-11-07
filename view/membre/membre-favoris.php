{{ include('snippet/header.php', {title: 'Vos favoris'}) }}

<main>
    <section class="dashboard">
        <header class="titre-section">
            <h2>
                <span class="scribe">V</span>os favoris
            </h2>
            <div></div>
        </header>
        {% if message %}
        {{message[0]}}
        {% endif %}
        <div class="portail-grille-timbre">
            {{ include('snippet/boite-enchere.php') }}
        </div>
    </section>

</main>

{{ include('snippet/footer.php') }}
