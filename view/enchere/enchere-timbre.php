{{ include('snippet/header.php', {title: 'Enchere'}) }}

<main>
    <div class="chemin-site">Enchères en cours/{{enchere[0].nomTimbre}}</div>

    <section class="page-timbre">
        {% if images == false %}
        <div>
            <img class="timbre-signet favoris" src="{{path}}assets/img/svg/icone/bookmark-gold.svg" alt="signet" />
            <picture>
                <img loading="lazy" src="{{path}}assets/img/jpeg/noImg.jpg" alt="timbre" />
            </picture>
        {% else %}
            {% for image in images %}
            <picture>
                <img loading="lazy" src="{{path}}assets/img/public/{{image.nomImage}}" alt="timbre" />
            </picture>
            {% endfor %}
        {% endif %}
            <span>Cliquez pour voir de plus près</span>

        </div>

        <div>
            <hgroup>
                <h2>{{enchere[0].nomTimbre}}</h2>
                <p>Collection germatique</p>
                {% if enchere[0].coupDeCoeur != null %}
                <p>Coup de coeur du Lord !</p>
                {% endif %}
            </hgroup>

            <div class="mises">
                <div>
                    <p>Prix d'enchère actuel :<span> C$578,00</span></p>
                </div>

                <div>
                    <!-- Mettre un écouteur d'événement sur le bouton pour afficher le modal de mise -->
                    <button data-miser class="button-2"><a href="{{path}}enchere/mise/{{enchere[0].idEnchere}}">Miser !</a></button>
                    <button class="button-1">Mettre dans ses favoris</button>
                </div>
            </div>

            <table>
                <tr>
                    <th>Condition :</th>
                    <td>{{condition.nomCondition}}</td>

                </tr>
                <tr>
                    <th>Pays d'origine :</th>
                    <td>{{enchere[0].paysOrigine}}</td>
                </tr>
                <tr>
                    <th>Date d'émission :</th>
                    <td>{{enchere[0].anneeEmission}}</td>
                </tr>
                <tr>
                    <th>Dimension :</th>
                    <td>{{enchere[0].dimension}}</td>
                </tr>
                <tr>
                    <th>Prix plancher</th>
                    <td>{{enchere[0].prixPlancher}}$</td>
                </tr>
            </table>

            <dl>
                <dt>
                    Détail :<svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.15 8.42">
                        <defs>
                            <style>
                                .icone_fleche {
                                    fill: #000000;
                                    fill-rule: evenodd;
                                    stroke-width: 0px;
                                }
                            </style>
                        </defs>
                        <g data-name="Layer 1">
                            <path class="icone_fleche" d="m15.15.87c0,.22-.1.42-.25.58l-6.72,6.72c-.33.33-.86.33-1.19,0,0,0,0,0,0,0L.26,1.45C-.07,1.13-.09.6.23.26c.32-.34.85-.35,1.19-.03.01.01.03.02.04.04l6.12,6.12L13.7.27c.32-.33.85-.34,1.19-.02.17.16.26.39.26.63h0Z" />
                        </g>
                    </svg>
                </dt>
                <dd>
                    <table class="detail-table">
                        <tr>
                            <th>Paiement :</th>
                            <td>
                                <img loading="lazy" src="{{path}}assets/img/svg/icone/paiment-secure.svg" alt="icone achat secure">
                                Les paiements sont sécurisé avec Lorem ipsum dolor sit, amet
                                consectetur adipisicing elit. Quaerat vitae, dignissimos id
                                deleniti esse dolo.
                            </td>
                        </tr>
                        <tr>
                            <th>Expédition et livraison :</th>
                            <td class="detail-table detail-colonne">
                                <div>
                                    <img loading="lazy" src="{{path}}assets/img/svg/icone/livraison.svg" alt="icone livraison rapide">
                                    Livraison rapide amet consectetur adipisicing elit.
                                    Quaerat vitae, dignissimos id deleniti esse dolo.
                                </div>
                                <div>
                                    <img loading="lazy" src="{{path}}assets/img/svg/icone/livraisonmonde.svg" alt="icone livraison monde">
                                    Livraison disponible partout dans le monde amet
                                    consectetur adipisicing elit. Quaerat vitae, dignissimos
                                    id deleniti esse dolo.
                                </div>
                            </td>
                        </tr>
                    </table>
                </dd>
            </dl>

            <ul>
                <li class="tags">
                    1950
                    <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.99 64.99">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #f3f0ed;
                                    stroke-width: 0px;
                                }
                            </style>
                        </defs>
                        <g data-name="Layer 1">
                            <path class="cls-1" d="m36.9,0L0,36.9l28.08,28.08,36.9-36.9V0h-28.08Zm10.86,9.84c4.05,0,7.38,3.33,7.38,7.38s-3.33,7.38-7.38,7.38-7.38-3.33-7.38-7.38,3.33-7.38,7.38-7.38Z" />
                        </g>
                    </svg>
                </li>
                <li class="tags">
                    Allemagne
                    <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.99 64.99">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #f3f0ed;
                                    stroke-width: 0px;
                                }
                            </style>
                        </defs>
                        <g data-name="Layer 1">
                            <path class="cls-1" d="m36.9,0L0,36.9l28.08,28.08,36.9-36.9V0h-28.08Zm10.86,9.84c4.05,0,7.38,3.33,7.38,7.38s-3.33,7.38-7.38,7.38-7.38-3.33-7.38-7.38,3.33-7.38,7.38-7.38Z" />
                        </g>
                    </svg>
                </li>
                <li class="tags">
                    Monument
                    <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.99 64.99">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #f3f0ed;
                                    stroke-width: 0px;
                                }
                            </style>
                        </defs>
                        <g data-name="Layer 1">
                            <path class="cls-1" d="m36.9,0L0,36.9l28.08,28.08,36.9-36.9V0h-28.08Zm10.86,9.84c4.05,0,7.38,3.33,7.38,7.38s-3.33,7.38-7.38,7.38-7.38-3.33-7.38-7.38,3.33-7.38,7.38-7.38Z" />
                        </g>
                    </svg>
                </li>
                <li class="tags">
                    Collection privé
                    <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.99 64.99">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #f3f0ed;
                                    stroke-width: 0px;
                                }
                            </style>
                        </defs>
                        <g data-name="Layer 1">
                            <path class="cls-1" d="m36.9,0L0,36.9l28.08,28.08,36.9-36.9V0h-28.08Zm10.86,9.84c4.05,0,7.38,3.33,7.38,7.38s-3.33,7.38-7.38,7.38-7.38-3.33-7.38-7.38,3.33-7.38,7.38-7.38Z" />
                        </g>
                    </svg>
                </li>
                <li class="tags">
                    Commémoratif
                    <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.99 64.99">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #f3f0ed;
                                    stroke-width: 0px;
                                }
                            </style>
                        </defs>
                        <g data-name="Layer 1">
                            <path class="cls-1" d="m36.9,0L0,36.9l28.08,28.08,36.9-36.9V0h-28.08Zm10.86,9.84c4.05,0,7.38,3.33,7.38,7.38s-3.33,7.38-7.38,7.38-7.38-3.33-7.38-7.38,3.33-7.38,7.38-7.38Z" />
                        </g>
                    </svg>
                </li>
                <li class="tags">
                    Germanique
                    <svg data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.99 64.99">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #f3f0ed;
                                    stroke-width: 0px;
                                }
                            </style>
                        </defs>
                        <g data-name="Layer 1">
                            <path class="cls-1" d="m36.9,0L0,36.9l28.08,28.08,36.9-36.9V0h-28.08Zm10.86,9.84c4.05,0,7.38,3.33,7.38,7.38s-3.33,7.38-7.38,7.38-7.38-3.33-7.38-7.38,3.33-7.38,7.38-7.38Z" />
                        </g>
                    </svg>
                </li>
            </ul>
        </div>
    </section>
    {{ include('snippet/footer.php') }}
