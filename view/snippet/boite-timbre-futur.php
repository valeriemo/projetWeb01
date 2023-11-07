<article class="boite-timbre">
    {% if enchere.favoris == true %}
    <img class="timbre-signet favoris" src="{{path}}assets/img/svg/icone/bookmark-gold.svg" alt="signet" />
    {% else %}
    <img class="timbre-signet favoris" src="{{path}}assets/img/svg/icone/bookmark2" alt="signet" />
    {% endif %}

    {% if enchere.image is empty %}
    <picture>
        <img loading="lazy" src="{{path}}assets/img/jpeg/noImg.jpg" alt="timbre" />
    </picture>
    {% else %}
    <picture>
        <img loading="lazy" src="{{path}}assets/img/public/{{enchere.image}}" alt="image{{ enchere.nomTimbre }}" />
    </picture>
    {% endif %}

    <div class="timbre-info">
        <h4>{{ enchere.nomTimbre|capitalize }}</h4>
        <p>{{ enchere.paysOrigine|capitalize }}, {{ enchere.anneeEmission }}</p>

        {% if enchere.coupDeCoeur == 1 %}
        <p>Coup de coeur du Lord</p>
        {% endif %}

        <p>L'enchere commence le {{enchere.dateDebut}}</p>
    </div>
    </div>
</article>