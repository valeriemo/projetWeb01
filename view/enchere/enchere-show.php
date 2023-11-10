{{ include('snippet/header.php', {title: 'Vos enchère'}) }}


<div class="page-double">
    <header>
        <div class="titre-section">
            <h2><span class="scribe">E</span>nchères en cours</h2>
            <div></div>
            {% if message %}
            <p class="msg">{{ message }}</p>
            {% endif %}
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

    {{ include('snippet/aside.php') }}

    <main class="grille-principale">
        {% for enchere in encheres %}

        {% if enchere.status == 'enCours' %}

        {{ include('snippet/boite-timbre.php') }}

        {% endif %}
        
        {% endfor %}

    </main>
    
</div>

    {{ include('snippet/footer.php') }}