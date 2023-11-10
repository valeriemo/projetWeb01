{{ include('snippet/header.php', {title: 'Bienvenue'}) }}


    <main>
      <section class="banniere-video">
        <video
          loading="lazy"
          src="{{path}}assets/video/accroche_video_stampee.mp4"
          autoplay="true"
          loop="true"
        ></video>
        <h1>
          <span class="scribe">Bienvenue</span> dans l'excellence de l'enchère
          de timbres.
        </h1>
          <a class="button-1" href="{{path}}enchere/show">Parcourir les enchères</a>
      </section>

      <section class="boite-action">
        <h2 hidden>Rejoignez-nous</h2>
        <p>
          <span class="scribe">Rejoignez-nous</span> et soyez le maître de votre
          propre collection, où chaque timbre raconte une histoire et chaque
          enchère est une occasion de posséder un morceau de l'héritage postal
          mondial.
        </p>
        {% if guest == 1 %}
        <a class="button-1" href="{{path}}membre/login">Se connecter</a>
        {% else %}
        <a class="button-1" href="{{path}}membre/create">Créer un compte</a>
        {% endif %}
      </section>
    </main>

    
    {{ include('snippet/footer.php') }}
