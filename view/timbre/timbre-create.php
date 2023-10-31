{{ include('snippet/header.php', {title: 'Bienvenue'}) }}


<section>
    <form action="{{path}}timbre/store" method="POST" class="formulaire">

        <label>Nom :<input name="username" type="text" min="3" max="30" /></label>
        <label>Couleurs :<input name="couleurs" type="text" /></label>
        <label>Pays d'origine :<input name="password" type="password" min="6" max="20" /></label>
        <label>Année d'émission :<input name="anneeEmission" type="text" min="4" max="4" /></label>
        <label>Tirage :<input name="tirage" type="text" /></label>
        <label>Dimension :<input name="dimension" type="text" /></label>

        <label>Certification :
            <select name="certification">
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>
        </label>

        <label>Condition :
            <select name="condition_idCondition">
                {% for condition in conditions %}
                <option value="{{condition.idCondition}}">{{condition.nomCondition}}</option>
                {% endfor %}
            </select>

        </label>


        <input name="membre_idMembre" type="hidden" value="{{session.idMembre}}">



        <input class="button-1" type="submit" value="Ajouter">
    </form>

    <!-- 
    Formulaire d'envoi : Sur la page où vous saisissez les informations du timbre et les images, créez un formulaire qui permet aux utilisateurs de télécharger plusieurs images à la fois. Utilisez l'élément HTML <input type="file"> pour permettre à l'utilisateur de sélectionner les fichiers image.

Traitement de la requête POST : Lorsque le formulaire est soumis, traitez la requête POST côté serveur. Vous pouvez accéder aux fichiers téléchargés en utilisant la variable $_FILES en PHP. Vous devrez boucler à travers les fichiers téléchargés et les stocker en base de données. -->

</section>


{{ include('snippet/footer.php') }}