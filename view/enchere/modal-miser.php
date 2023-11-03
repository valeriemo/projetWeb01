<?php
$now = new DateTime();
$currentDateTime = $now->format('Y-m-d H:i:s');
?>


<!-- Je voudrais que ce soit une boite modal qui s'ouvre pour miser sur un timbre. -->
<section class="modal-miser">
    <form action="{{path}}enchere/miser/{{enchere.idEnchere}}" method="POST">
        <label>Inscrire votre mise :
            <input type="text">
        </label>
        <input type="hidden" value="<?= $currentDateTime ?>">
        <input type="hidden" value="{{enchere.idEnchere}}">
        <input type="hidden" value="{{session.idMembre}}">
        <input type="submit" value="Miser">
    </form>
</section>