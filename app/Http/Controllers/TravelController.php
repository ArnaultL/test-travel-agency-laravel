<?php

namespace App\Http\Controllers;

use App\Models\PlaneStep;
use App\Models\Travel;
use App\Models\Step;

class TravelController extends Controller
{
    /**
     * Allowed translated type
     */
    protected static array $allowedTypes = [
        'avion' =>'plane',
        'train' => 'train',
        'bus'   => 'bus'
    ];

    /**
     * Define view default route for travel
     *
     */
    public function index()
    {   
        return view('travel.index', [
            'travels' => Travel::all()->sortBy('departure_time')
        ]);
    }

    /**
     * Define view default form to add a Travel
     *
     */
    public function addForm()
    {
        return view('travel.add', [
            'allowedTypes' => self::$allowedTypes
        ]);
    }

    /**
     * Define post method to add Travel
     *
     */
    public function add()
    {
        $travelAttributes = request()->validate([
            'name' => 'required',
            'step' => 'sometimes|required|array',
            'step.*.type' => 'required|string|max:50',
            'step.*.seat' => 'sometimes|string|max:10',
            'step.*.transport_number' => 'required|string|max:20',
            'step.*.departure_date' => 'required|date',
            'step.*.arrival_date' => 'required|date',
            'step.*.departure' => 'required|string',
            'step.*.arrival' => 'required|string',
            'step.*.gateway' => 'sometimes|required|string',
            'step.*.bagage_drop' => 'sometimes|string',
        ]);

        $travel = new Travel();
        $travel->name = $travelAttributes['name'];
        $travel->save();

        if (!empty($travelAttributes['step'])) {
            foreach($travelAttributes['step'] as $stepAttributes) {
                $step = $this->makeStepObject($stepAttributes);
                $travel->steps()->save($step);
                if ($step->type === "plane") {
                    //Table per hierarchy
                    $this->tphMapping($step, $stepAttributes);
                }
            }
        }
        
        return redirect('/travels')
            ->with('message', 'Votre voyage a été ajouté');
    }

    /**
     * Micro Factory to Instantiate step object
     */
    protected function makeStepObject(array $stepAttributes): Step
    {
        $step = new Step();
        $step->type = $stepAttributes['type'];
        $step->seat = $stepAttributes['seat'];
        $step->transport_number = $stepAttributes['transport_number'];
        $step->departure_date = $stepAttributes['departure_date'];
        $step->arrival_date = $stepAttributes['arrival_date'];
        $step->departure = $stepAttributes['departure'];
        $step->arrival = $stepAttributes['arrival'];

        return $step;
    }

    /**
     * Map the connexion with plane step optionals parameters
     * https://stackoverflow.com/questions/190296/how-do-you-effectively-model-inheritance-in-a-database#answer-190306
     */
    protected function tphMapping(Step $step, array $stepAttributes): void
    {
        $planeStep = new PlaneStep();
        $planeStep->bagage_drop = $stepAttributes['bagage_drop'] ?? null;
        $planeStep->gateway = $stepAttributes['gateway'] ?? 'NA';
        $planeStep->step_id = $step->id;
        $planeStep->save();
    }
}
