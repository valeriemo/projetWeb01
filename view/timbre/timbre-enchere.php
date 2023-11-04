{{ include('snippet/header.php', {title: 'Création de timbre'}) }}

<section>
    <h2>Désirez-vous mettre ce timbre en enchère maintenant ?</h2>
    <a href="{{path}}enchere/create/{{timbre}}">Mettre en enchère</a>
    <a href="{{path}}membre/index">Retour vers mon portail</a>
</section>


{{ include('snippet/footer.php') }}