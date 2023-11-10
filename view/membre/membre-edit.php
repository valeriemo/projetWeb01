{{ include('snippet/header.php', {title: 'Nouveau membre'}) }}

<main class="membre-main">
    <section>
        <div class="edit-profil">
        <h2>Éditer le compte</h2>
            <div>
                {% if message %}
                <p class="msg">{{message}}</p>
                {% endif %}
                {% if errors %}
                <div class="show-errors">
                    <ul>
                        {% for error in errors %}
                        <li class="error">{{error}}</li>
                        {% endfor %}
                    </ul>
                </div>
                {% endif %}
                <form action="{{path}}membre/update" method="POST">
                    <label>Courriel :<input name="courriel" type="email" value="{{membre[0].courriel}}" /></label>
                    <input class="button-1" type="submit" value="Sauvegarder">
                </form>

                <form action="{{path}}membre/update" method="POST">
                    <label>Prénom :<input name="prenom" type="text" value="{{membre[0].prenom}}"></label>
                    <input class="button-1" type="submit" value="Sauvegarder">
                </form>

                <form action="{{path}}membre/update" method="POST">
                    <label>Nom :<input name="nom" type="text" value="{{membre[0].nom}}"></label>
                    <input class="button-1" type="submit" value="Sauvegarder">
                </form>
            </div>
            <a class="button-1" href="{{path}}membre/delete/{{membre.idMembre}}">Supprimer votre compte</a>
        </div>
    </section>

</main>

{{ include('snippet/footer.php') }}