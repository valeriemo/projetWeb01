{{ include('snippet/header.php', {title: 'Créer un enchère'}) }}


<section>

    <form action="{{path}}enchere/update" method="POST" class="formulaire">
        {% if errors %}
        <div class="show-errors">
            <ul>
                {% for error in errors %}
                <li class="error">{{error}}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
        <h2>Modification d'une enchère</h2>
        <input name="idEnchere" type="hidden" value="{{enchere.idEnchere}}">

        {% if enchere.status == 'enCours' %}
        <p>Vous pouvez seulement changer la date de fin.</p>
        <label>Date de fin :<input name="dateFin" type="date" value="{{enchere.dateFin}}" required /></label>
        <input name="dateDebut" value="{{enchere.dateDebut}}" type="hidden" value="{{enchere.dateDebut}}" />
        <input name="prixPlancher" value="{{enchere.prixPlancher}}" type="hidden" placeholder="{{enchere.prixPlancher}}"/>
        {% elseif enchere.status == 'futur' %}
        <p>Vous pouvez changer la date de début, la date de fin et le prix plancher.</p>
        <label>{{id}}Date début :<input name="dateDebut" value="{{enchere.dateDebut}}" type="date" value="{{enchere.dateDebut}}" /></label>
        <label>Date de fin :<input name="dateFin" type="date" value="{{enchere.dateFin}}"required /></label>
        <label>Prix plancher :<input name="prixPlancher" value="{{enchere.prixPlancher}}" type="text" placeholder="{{enchere.prixPlancher}}" required /></label>
        {% endif %}
        {% if session.privilege == 2 %}
        <label>Coup de coeur :
            <select name="coupDeCoeur">
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </label>
        {% endif %}

        <input name="timbre_idTimbre" type="hidden" value="{{enchere.idTimbre}}">
        <input name="membre_idMembre" type="hidden" value="{{session.idMembre}}">

        <input class="button-1" type="submit" value="Enregistrer le changement">
    </form>




</section>


{{ include('snippet/footer.php') }}