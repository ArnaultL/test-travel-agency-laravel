<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;

class StepController extends Controller
{
    /**
     * Get root to delete a Step
     */
    public function delete(Step $step) {
        $step->delete();

        return redirect('/travels')
            ->with('message', 'Votre étape a été supprimée');
    }
}
