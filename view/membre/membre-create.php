{{ include('snippet/header.php', {title: 'Nouveau membre'}) }}


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

    <label>Username :<input name="username" type="text" min="3" max="30" /></label>
    <label>Courriel :<input name="courriel" type="email" /></label>
    <label>Mot de passe :<input name="password" type="password" min="6" max="20" /></label>
    <input name="dateInscription" type="hidden" value="{{ 'now'|date('Y-m-d') }}" />
    <input name="privilege_idPrivilege" type="hidden" value="1">
    <input class="button-1" type="submit" value="Ajouter">
  </form>

</section>

{{ include('snippet/footer.php') }}