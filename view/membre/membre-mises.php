{{ include('snippet/header.php', {title: 'Vos enchère'}) }}


<main>
    <!-- ON VA VOULOIR PRÉSENTÉ UNE LISTE DE SES ENCHÈRES EN COURS AVEC LE DERNIER PRIX OFFERT ET LE TEMPS QU'IL RESTE A L'ENCHERE -->
    <section class="dashboard">

        <header class="titre-section">
            <h2>
                <span class="scribe">V</span>os mises
            </h2>
            <div></div>
        </header>
    {% if mises %}
        <ul>
            {% for mise in mises %}
            {% if mise.enchere.status == 'enCours'%}
            <li class="mises-liste">{{ mise.prixOffre }} $ sur <a href="{{path}}enchere/timbre/{{mise.enchere_idEnchere}}">{{mise.enchere.nomTimbre}}</a> le {{mise.dateHeure|date('d/m/Y') }} à {{mise.dateHeure|date('H:i') }} <span> Cette enchère est toujours en cours !</span></li>
            {% else %}
            <li class="mises-liste">{{ mise.prixOffre }} $ sur <a href="{{path}}enchere/timbre/{{mise.enchere_idEnchere}}">{{mise.enchere.nomTimbre}}</a> le {{mise.dateHeure|date('d/m/Y') }} à {{mise.dateHeure|date('H:i') }} <span> Cette enchère est terminé !</span></li>
            {% endif %}
            {% endfor %}
        </ul>
    {% else %}
        <p>Vous n'avez pas encore fait de mise.</p>
    {% endif %}
    </section>

</main>


{{ include('snippet/footer.php') }}