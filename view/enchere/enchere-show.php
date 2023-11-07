{{ include('snippet/header.php', {title: 'Vos enchère'}) }}


<div class="page-double">
    <header>
        <div class="titre-section">
            <h2><span class="scribe">T</span>outes les enchères en cours</h2>
            <div></div>
        </div>

        <div class="head-enchere">
            <p>Enchères en cours/</p>
            <div>
                <div class="icone-style-2">
                    <figure>
                        <img src="{{path}}assets/img/svg/icone/gallery.svg" alt="icone gallerie" />
                    </figure>
                </div>
                <div class="icone-style-2">
                    <figure>
                        <img src="{{path}}assets/img/svg/icone/list.svg" alt="icone liste" />
                    </figure>
                </div>
            </div>
        </div>

        <div class="filtrage">
            <label for="filtrer">Filtrer par</label>
            <select name="filtrer" id="filtrer">
                <option value="alphabetique">Ordre alphabétique</option>
                <option value="nouveautes">Nouveautés</option>
                <option value="plusmises">Les plus misés</option>
                <option value="plusbas">Prix le plus bas</option>
                <option value="plushaut">Prix le plus haut</option>
            </select>
        </div>
    </header>

    <aside>
        <h3>Recherche avancée</h3>
        <section>
           
        </section>

        <section>
            <h4>Par pays d'origine</h4>
            <label for="pays" hidden>Chercher par pays d'origine</label>
            <input id="pays" type="search" placeholder="Écrire le pays" />
        </section>

        <section>
            <h4>Par prix</h4>
            <div>
                <label>Min.<input type="text" placeholder="0.00 $" /> </label>
                <label>Max.<input type="text" placeholder="0.00 $" /></label>
            </div>
        </section>

        <section>
            <h4>Par époque</h4>
            <ul>
                <li class="tags">
                    22ème siècle
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
            {% for enchere in encheres %}
            <ul>
                <li class="tags">
                    {{ enchere.condition }}
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
            {% endfor %}
                
        </section>
    </aside>

    <main class="grille-principale">
        {% for enchere in encheres %}

        {% if enchere.status == 'enCours' %}

        {{ include('snippet/boite-timbre.php') }}

        {% elseif enchere.status == 'futur' %}

        {{ include('snippet/boite-timbre-futur.php') }}

        {% endif %}
        
        {% endfor %}
    </main>
</div>

    {{ include('snippet/footer.php') }}