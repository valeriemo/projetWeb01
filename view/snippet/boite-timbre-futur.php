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

                {% if enchere.prixMax == null %}
                <p>Prix d'enchère : <span>{{enchere.prixPlancher}} $</span></p>
                {% else %}
                <p>Prix d'enchère : <span>{{enchere.prixMax}} $</span></p>
                {% endif %}

                <div class="icone-text timbre">
                    <figure>
                        <div></div>
                        <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.78 57.22">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: #f3f0ed;
                                        stroke-width: 0px;
                                    }
                                </style>
                            </defs>
                            <g data-name="Layer 1">
                                <g>
                                    <path class="cls-1" d="m28.21,35.37h-7.96v-11.39c6.61-.61,11.47-6.46,10.86-13.07C30.5,4.3,24.65-.56,18.04.05,11.43.66,6.57,6.51,7.18,13.12c.53,5.76,5.1,10.32,10.86,10.86v8.85c-.42-.2-.88-.3-1.35-.32h-5.81c-.29,0-.57.12-.78.32L.32,42.64c-.21.21-.32.49-.32.78v12.69c0,.61.5,1.11,1.11,1.11h27.12c1.96,0,3.55-1.6,3.55-3.56,0-.92-.36-1.8-.99-2.46,1.32-1.37,1.32-3.54,0-4.9,1.33-1.37,1.33-3.54,0-4.9,1.36-1.42,1.32-3.67-.1-5.03-.66-.64-1.55-.99-2.47-.99h0ZM9.34,12.03c0-5.41,4.38-9.8,9.79-9.81,5.41,0,9.8,4.38,9.81,9.79,0,5.41-4.38,9.8-9.79,9.81,0,0,0,0,0,0-5.41,0-9.79-4.39-9.8-9.79ZM2.21,55v-11.13l9.1-9.15h5.35c.75,0,1.35.6,1.35,1.35h0v9.09c0,.75-.6,1.35-1.35,1.35-.75,0-1.35-.6-1.35-1.35v-2.95c0-.61-.5-1.11-1.11-1.11s-1.11.5-1.11,1.11v2.95c0,1.54,1.01,2.91,2.48,3.38,0,.07,0,.14,0,.21,0,.91.35,1.79.99,2.45-.64.67-.99,1.56-.99,2.48,0,.46.09.91.27,1.33H2.21Zm26.01-2.69c.74.06,1.3.7,1.25,1.45-.05.67-.58,1.2-1.25,1.25h-9.1c-.74-.06-1.3-.7-1.25-1.45.05-.67.58-1.2,1.25-1.25h9.1Zm1.33-3.58c0,.75-.6,1.35-1.35,1.35h-9.06c-.75,0-1.35-.6-1.35-1.35h0c0-.07,0-.14,0-.21.64-.21,1.2-.61,1.63-1.13h8.78c.74,0,1.34.6,1.35,1.33Zm0-4.91c0,.75-.6,1.35-1.35,1.35h-7.97v-2.68h7.97c.74,0,1.35.6,1.35,1.34h0Zm-9.31-3.54v-2.7h7.96c.75,0,1.35.6,1.35,1.35s-.6,1.35-1.35,1.35h-7.96Z" />
                                    <path class="cls-1" d="m20.25,18.34v-.2c1.94-.61,3.02-2.68,2.41-4.62-.46-1.46-1.77-2.48-3.29-2.57h-.22c-.81,0-1.48-.66-1.48-1.48s.66-1.48,1.48-1.48,1.48.66,1.48,1.48c0,.61.5,1.11,1.11,1.11s1.11-.5,1.11-1.11c0-1.61-1.05-3.04-2.6-3.52v-.19c0-.61-.5-1.11-1.11-1.11s-1.11.5-1.11,1.11v.19c-1.95.6-3.04,2.66-2.44,4.61.45,1.47,1.78,2.51,3.31,2.6h.23c.81,0,1.48.66,1.48,1.48s-.66,1.48-1.48,1.48-1.48-.66-1.48-1.48c0-.61-.5-1.11-1.11-1.11s-1.11.5-1.11,1.11c0,1.62,1.06,3.04,2.6,3.52v.2c0,.61.5,1.11,1.11,1.11s1.11-.5,1.11-1.11h0Z" />
                                </g>
                            </g>
                        </svg>
                    </figure>

                    {% if enchere.nbMise == 0 %}
                    <span>Soyez le 1er à miser</span>
                    {% else %}
                    <span>{{ enchere.nbMise}} offres</span>
                    {% endif %}

                    <p>L'enchere commence le {{enchere.dateDebut}}</p>
                </div>
                <a href="{{path}}enchere/timbre/{{enchere.idEnchere}}" class="button-1">Voir ce timbre</a>
            </div>
        </article>