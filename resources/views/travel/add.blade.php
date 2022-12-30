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
    <?php if($errors->any()): ?>
        <div class="notification is-warning">
            <button class="delete"></button>
            <?php foreach($errors->all() as $error): ?>
                <?= $error; ?>
            <?php endforeach;?>
        </div> 
    <?php endif; ?>
    <div class="box">
        <div class="columns">
            <div class="column is-half">
                <form method="post" action="/travels/add" novalidate>
                    <?= csrf_field() ?>
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input name="name" class="input" type="text" placeholder="" required>
                        </div>
                    </div>
                    <div id="box-step-container">
                    </div>
                    <div class="box">
                        <div class="control">
                            <a id="addStepBtn" class="button is-link">Ajouter une étape pour ce voyage</a>
                        </div>
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-primary">Créer un voyage</button>
                    </div>
                </form>
            </div>
            <div class="column"></div>
            <div class="column"></div>
        </div>
    </div>
    <div class="is-hidden">
        <div class="box box-step">
            <h3>Etape</h3>
            <div class="field">
                <label class="label">Type</label>
                <div class="control">
                    <div class="select">
                    <select class="typeSelector"name="step[0][type]">
                        <option>Choisir le type d'étape</option>
                        <?php foreach($allowedTypes as $frKeyType => $type): ?>
                        <option value="{{ $type }}">{{ $frKeyType }}</option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Numéro de transport</label>
                <div class="control">
                    <input name="step[0][transport_number]" class="input" type="text" placeholder="" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Place</label>
                <div class="control">
                    <input name="step[0][seat]" class="input" type="text" placeholder="">
                </div>
            </div>
            <div class="field">
                <label class="label">Date de départ</label>
                <div class="control">
                    <input name="step[0][departure_date]" class="input" type="datetime-local" placeholder="" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Date d'arrivée</label>
                <div class="control">
                    <input name="step[0][arrival_date]" class="input" type="datetime-local" placeholder="" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Point de départ</label>
                <div class="control">
                    <input name="step[0][departure]" class="input" type="text" placeholder="" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Point d'arrivée</label>
                <div class="control">
                    <input name="step[0][arrival]" class="input" type="text" placeholder="" required>
                </div>
            </div>
        </div>
        <div class="planeTypeFields">
            <div class="field">
                <label class="label">Gateway</label>
                <div class="control">
                    <input name="step[0][gateway]" class="input" type="text" placeholder="" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Bagages</label>
                <div class="control">
                    <input name="step[0][bagage_drop]" class="input" type="text" placeholder="" required>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function(){
            let counterStep = 0;
            const addStepBtn = document.querySelector("#addStepBtn");
            const boxStepContainer = document.querySelector("#box-step-container");
            const boxStep = document.querySelector(".box-step");
            const planeStep = document.querySelector(".planeTypeFields");
            const cloneBoxStep = () => {
                const iterateNameFieldsValue = (currentValue, currentIndex) =>  {
                    if(currentValue.hasChildNodes && (currentValue.childNodes.length == 5)) {
                        let inputElement = currentValue.childNodes[3].childNodes[1];
                        if (inputElement.childNodes[1]) { //is a select field
                            let selectElement = inputElement.childNodes[1];
                            selectElement.name = selectElement.name.replace("[0]","["+counterStep+"]");
                            addSpecificsPlaneFields(selectElement);
                        } else {
                            inputElement.name = inputElement.name.replace("[0]","["+counterStep+"]");
                        }
                    }
                }
                const addSpecificsPlaneFields = (selectElement) => {
                    let clonedPlaneStep;
                    selectElement.addEventListener(
                        "change",
                        (event) => {
                            if (event.target.value == 'plane') {
                                clonedPlaneStep = planeStep.cloneNode(true);
                                clonedPlaneStep.childNodes.forEach(
                                    (currentValue, currentIndex) => {
                                        iterateNameFieldsValue(currentValue, currentIndex);
                                    }
                                );
                                boxStepContainer.appendChild(clonedPlaneStep);
                            } else {
                                if (clonedPlaneStep) {
                                    clonedPlaneStep.remove();
                                }
                            }
                        }
                    )
                }
                counterStep++;
                let clonedBoxStep = boxStep.cloneNode(true);
                clonedBoxStep.childNodes.forEach(
                    function(currentValue, currentIndex) {
                        iterateNameFieldsValue(currentValue, currentIndex);
                    },
                );
                boxStepContainer.appendChild(clonedBoxStep);
            }
            addStepBtn.addEventListener(
                "click",
                (event) => {
                    cloneBoxStep();
                    event.preventDefault();
                }
            );
        })();
    </script>
</body>
</html>
