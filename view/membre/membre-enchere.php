{{ include('snippet/header.php', {title: 'Vos enchère'}) }}

<main>
<!-- ON VA VOULOIR PRÉSENTÉ UNE LISTE DE SES ENCHÈRES EN COURS AVEC LE DERNIER PRIX OFFERT ET LE TEMPS QU'IL RESTE A L'ENCHERE -->
    <section class="dashboard">
        <header class="titre-section">
            <h2>
                <span class="scribe">V</span>os timbres en cours d'enchères
            </h2>
            <div></div>
        </header>
{% if encheres is empty %}
    <h3>Aucune enchère en cours</h3>
    <a class="button-1" href="{{path}}membre/timbre">Voir vos timbres</a>
{% else %}
    <div class="grille-simple">
    {{ include('snippet/boite-enchere.php') }}

    </div>
{% endif %}

    </section>

</main>

{{ include('snippet/footer.php') }}