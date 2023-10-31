{{ include('snippet/header.php', {title: 'Bienvenue'}) }}


<h1>Bienvenue {{session.username}}</h1>

<section>

    <a class="button-1" href="{{path}}timbre/create">Créer un timbre</a>

</section>


</section>

{{ include('snippet/footer.php') }}