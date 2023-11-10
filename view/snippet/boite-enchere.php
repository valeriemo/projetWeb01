        {% for enchere in encheres %}

        <article class="boite-timbre portail-enchere">

            <div class="timbre-info">
                <div>
                    {% if enchere.image == null %}
                    <picture>
                        <img src="{{path}}assets/img/jpeg/noImg.jpg" alt="sans image">
                    </picture>
                    {% else %}
                    <picture>
                        <img src="{{path}}assets/img/public/{{enchere.image}}" alt="image {{enchere.nomTimbre}}">
                    </picture>
                    {% endif %}
                </div>
                <div>
                    <h4>{{ enchere.nomTimbre|capitalize }}</h4>
                    <p>{{ enchere.paysOrigine|capitalize }}, {{ enchere.anneeEmission }}</p>
                    <p>Prix plancher :<span> {{enchere.prixPlancher}} $</span></p>
                    {% if enchere.prixMax == null %}
                    <p>Prix actuel :<span> {{enchere.prixPlancher}} $</span></p>
                    {% else %}
                    <p>Prix actuel :<span> {{enchere.prixMax}} $</span></p>
                    {% endif %}

                    <p>Se termine dans :</p>
                    <p><span> {{enchere.tempsRestant.d}} jours, {{enchere.tempsRestant.h}}H {{enchere.tempsRestant.i}}Min</span></p>
                    <p>Nombre de mises:<span> {{enchere.nbMise}}</span></p>
                    <a class="button-1" href="{{path}}enchere/timbre/{{enchere.idEnchere}}">Voir cette enchère</a>
                    {% if enchere.membre_idMembre == session.idMembre %}
                    <a class="button-1" href="{{path}}enchere/edit/{{enchere.idEnchere}}">Modifier cette enchère</a>
                    {% endif %}
                </div>

            </div>

        </article>
        {% endfor %}