<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyages</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <script src="app.js"></script>
</head>
<body>
<div class="box">
    <section class="section">
        <h1 class="title">Tous mes voyages ...</h1>
        <h2 class="subtitle">
            Ici figure la liste de mes <strong>voyages</strong>, et certaines de leurs informations.
        </h2>
        <a class="button is-link" href="{{ url('travels/add') }}">Ajouter un voyage</a>
    </section>
</div>

<?php if(session()->has('message')): ?>
    <div class="notification is-success">
    <button class="delete"></button>
        <?= session()->get('message'); ?>
    </div> 
<?php endif; ?>

<div class="box">
    <?php foreach($travels as $travel): ?>
        <div class="box">
            <section class="hero is-primary">
            <div class="hero-body" id="travel-<?= $travel->id; ?>">
                <p class="title">
                    {{ $travel->name }}
                </p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Numéro de Transport</th>
                            <th>Départ</th>
                            <th>Arrivée</th>
                            <th>Place</th>
                            <th>Infos Spécifiques</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($travel->steps as $step): ?>
                        <tr>
                            <th>{{ $step->type; }}</th>
                            <td>{{ $step->transport_number; }}</td>
                            <td>{{ $step->departure; }}</td>
                            <td>{{ $step->arrival; }}</td>
                            <td>{{ $step->seat; }}</td>
                            <td>
                                <?php foreach($step->plane_step as $planeStep): ?>
                                    {{ $planeStep?->bagage_drop; }}
                                    {{ $planeStep?->gateway; }}
                                <?php endforeach; ?>
                                <a class="button is-danger" href="{{ url('steps/delete') }}/{{$step->id}}">Supprimer cette étape</button>
                            </td>
                                
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </section>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
