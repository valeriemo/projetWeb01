{{ include('snippet/header.php', {title: 'Miser'}) }}

<main>

    <section class="boite-mise">
        <h2>Miser</h2>
        <div>
            <h3>{{enchere.nomTimbre}}</h3>
        </div>
        <div>
            {% if enchere.prixMax == null %}
            <p>Prix d'enchère : {{enchere.prixPlancher}} $</p>
            {% else %}
            <p>Prix d'enchère : {{enchere.prixMax}} $</p>
            {% endif %}
        </div>
        {% if errors %}
            <div class="show-errors">
                <ul>
                    {% for error in errors %}
                    <li class="error">{{error}}</li>
                    {% endfor %}
                </ul>
            </div>
            {% endif %}
        <form action="{{path}}enchere/addmise" method="POST">
            <input type="hidden" name="enchere_idEnchere" value="{{enchere.idEnchere}}">
            <input type="hidden" name="membre_idMembre" value="{{session.idMembre}}">
            <label>Inscrire votre mise :
                <input type="text" name="prixOffre" placeholder="{{enchere.prixSuggerer}} $">
            </label>
            <input type="hidden" name="dateHeure" value="{{ "now"|date("Y-m-d H:i:s") }}">
            <input class="button-1" type="submit" value="Miser">
        </form>

        <div>
            <p>Cette enchère se termine dans {{enchere.tempsRestant.d}} jours et {{enchere.tempsRestant.h}} heures !</p>
        </div>
    </section>


</main>



{{ include('snippet/footer.php') }}