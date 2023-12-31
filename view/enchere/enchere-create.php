{{ include('snippet/header.php', {title: 'Créer un enchère'}) }}

<main class="membre-main">
    <section>

        <form action="{{path}}enchere/store" method="POST" class="formulaire">
            <h2>Remplir le formulaire</h2>

            {% if errors %}
            <div class="show-errors">
                <ul>
                    {% for error in errors %}
                    <li class="error">{{error}}</li>
                    {% endfor %}
                </ul>
            </div>
            {% endif %}

            <label>{{id}}Date début :<input name="dateDebut" type="date" required /></label>
            <label>Date de fin :<input name="dateFin" type="date" required /></label>
            <label>Prix plancher :<input name="prixPlancher" type="text" placeholder="00.00" required /></label>
            {% if session.privilege == 2 %}
            <label>Coup de coeur :
                <select name="coupDeCoeur">
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </label>
            {% endif %}

            <!-- Par défaut le statut est en cours, lorsque Terminé, le status est update pour archive -->
            <input name="status_idStatus" type="hidden" value="1">

            <input name="timbre_idTimbre" type="hidden" value="{{timbre_idTimbre}}">
            <input name="membre_idMembre" type="hidden" value="{{session.idMembre}}">

            <input class="button-1" type="submit" value="Enregistrer l'enchère">
        </form>




    </section>
</main>



{{ include('snippet/footer.php') }}