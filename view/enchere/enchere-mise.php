{{ include('snippet/header.php', {title: 'Miser'}) }}

<main>

    <section class="boite-mise">
        <h2>Miser</h2>
        <div>
            <h3>{{enchere[0].nomTimbre}}</h3>
        </div>
        <div>
            <p>Prix d'enchère : {{enchere[0].prixPlancher}} $</p>
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
            <input type="hidden" name="enchere_idEnchere" value="{{enchere[0].idEnchere}}">
            <input type="hidden" name="membre_idMembre" value="{{session.idMembre}}">
            <label>Inscrire votre mise :
                <input type="text" name="prixOffre" placeholder="derniere mise">
            </label>
            <input type="hidden" name="dateHeure" value="{{ "now"|date("Y-m-d H:i:s") }}">
            <input class="button-1" type="submit" value="Miser">
        </form>

    </section>


</main>



{{ include('snippet/footer.php') }}