        {% for enchere in encheres %}

        <article class="boite-timbre">

            <div class="timbre-info">
                <h4>{{ enchere.nomTimbre }}</h4>
                <p>{{ enchere.paysOrigine }}, {{ enchere.anneeEmission }}</p>
                <!-- ici on va vouloir afficher le prix de la mise la plus élevée -->
                <p>Dernière enchere :<span> {{enchere.prixPlancher}} $</span></p>
                <p>Se termine dans :<span> {{enchere.prixPlancher}} $</span></p>
                <p>Nombre de mises:<span> {{enchere.prixPlancher}} $</span></p>
                </div>
            </div>
        </article>
        {% endfor %}

