<aside>
    <h3>Recherche avancée</h3>
    {% if errors %}
    <div class="show-errors">
        <ul>
            {% for error in errors %}
            <li class="error">{{error}}</li>
            {% endfor %}
        </ul>
    </div>
    {% endif %}
    <section>
        <form action="{{path}}enchere/search" method="post">
            <h4>Par nom</h4>
            <label hidden>Chercher le timbre</label>
            <input type="search" name="nomTimbre" placeholder="Écrire le nom du timbre" />
            <input class="button-1" type="submit" value="Chercher">
        </form>
    </section>

    <section>
        <form action="{{path}}enchere/search" method="post">
            <h4>Par pays d'origine</h4>
            <label hidden>Chercher par pays d'origine</label>
            <input type="search" name="paysOrigine" placeholder="Écrire le pays" />
            <input class="button-1" type="submit" value="Chercher">
        </form>
    </section>

    <section>
        <form action="{{path}}enchere/search" method="post">
            <h4>Par prix</h4>
            <div>
                <label>Min.<input type="text" name="prixMin" placeholder="0.00 $" /> </label>
                <label>Max.<input type="text" name="prixMax" placeholder="0.00 $" /></label>
            </div>
            <input class="button-1" type="submit" value="Chercher">
        </form>
    </section>

    <section>
        <h4>Par époque</h4>
        <ul>
            <li class="tags">
                21ème siècle
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
                1990s
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
                1980s
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
                1970s
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
                1960s
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
                1950s
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
                20ème siècle
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
            <li class="affichage">Afficher plus</li>
        </ul>
    </section>

    <section>
        <h4>Par condition</h4>
        <ul>
            {% for condition in conditions %}
            <li class="tags">
                {{ condition.nomCondition }}
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
            {% endfor %}
        </ul>

    </section>

</aside>