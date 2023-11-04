{{ include('snippet/header.php', {title: 'Éditer un timbre'}) }}


<section>
    <!-- Step 1: remplir le formulaire et ensuite ajouter des images -->
    <h2>Remplir les champs à corriger</h2>

    <form action="{{path}}timbre/store" method="POST" class="formulaire" enctype="multipart/form-data">
        {% if errors %}
        <div class="show-errors">
            <ul>
                {% for error in errors %}
                <li class="error">{{error}}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
        
        <label>Nom :<input value="{{timbre.nomTimbre}}" name="nomTimbre" type="text" min="3" max="45" /></label>
        <label>Couleurs :<input value="{{timbre.couleurs}}"  name="couleurs" type="text" max="150" /></label>
        <label>Pays d'origine :<input value="{{timbre.paysOrigine}}"  name="paysOrigine" type="text" min="2" max="25" /></label>
        <label>Année d'émission :<input value="{{timbre.anneeEmission}}"  name="anneeEmission" type="text" min="4" max="4" /></label>
        <label>Tirage :<input value="{{timbre.tirage}}"  name="tirage" type="text" /></label>
        <label>Dimension :<input value="{{timbre.dimension}}"  name="dimension" type="text" placeholder="Longueur x Largeur x Hauteur (cm)" /></label>

        <label>Certification :
            <select id="Certification" name="certification">
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </label>

        <label>Condition :
            <select id="Condition du timbre" name="condition_idCondition">
                {% for condition in conditions %}
                <option value="{{condition.idCondition}}">{{condition.nomCondition}}</option>
                {% endfor %}
            </select>
        </label>

        <input name="membre_idMembre" type="hidden" value="{{session.idMembre}}">

        <label id="Images du timbre">Images (maximum de 2 images):
            <input type="file" name="fileToUpload[]" multiple="multiple">
            <input type="file" name="fileToUpload[]" multiple="multiple">
        </label>

        <input class="button-1" type="submit" value="Ajouter">
    </form>


</section>


{{ include('snippet/footer.php') }}