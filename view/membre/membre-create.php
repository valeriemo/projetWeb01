{{ include('snippet/header.php', {title: 'Nouveau membre'}) }}

<main class="membre-main marge">
  <section>
  <h2 class="titre-section">Création de compte</h2>

    <form action="{{path}}membre/store" method="POST" class="formulaire">
      {% if errors %}
      <div class="show-errors">
        <ul>
          {% for error in errors %}
          <li class="error">{{error}}</li>
          {% endfor %}
        </ul>
      </div>
      {% endif %}
      <label>Courriel :<input name="courriel" type="email" /></label>
      <label>Mot de passe :<input name="password" type="password" min="6" max="20" /></label>
      <input name="dateInscription" type="hidden" value="{{ 'now'|date('Y-m-d') }}" />
      <input name="privilege_idPrivilege" type="hidden" value="1">
      <label>Prénom :<input name="prenom" type="text"></label>
      <label>Nom :<input name="nom" type="text"></label>
      <input class="button-1" type="submit" value="Ajouter">
    </form>
  </section>
</main>

{{ include('snippet/footer.php') }}