{{ include('snippet/header.php', {title: 'Nouveau membre'}) }}

<main class="membre-main">
    <section>
        <h1 class="titre-section">Se connecter</h1>

        <form action="{{path}}membre/auth" method="POST" class="formulaire">
            {% if errors %}
            <div class="show-errors">
                <ul>
                    {% for error in errors %}
                    <li class="error">{{error}}</li>
                    {% endfor %}
                </ul>
            </div>
            {% endif %}
            <label>Courriel :<input name="courriel" type="text" min="3" max="30" /></label>

            <!-- <label>Courriel :<input name="courriel" type="email" /></label> -->
            <label>Mot de passe :<input name="password" type="password" min="6" max="20" /></label>
            <input class="button-1" type="submit" value="Connexion">
        </form>

    </section>
</main>


{{ include('snippet/footer.php') }}