<?php
namespace App\Models;

class Treatment extends Model {
    protected $table = "treatments";

    public function getKeeper()
    {
        $sql = "SELECT k.keeper_id 
        FROM keepers AS k
        INNER JOIN treatments AS t ON t.treatment_keeper_id = k.keeper_id
        WHERE t.treament_id = ?";

        $treatmentId = $this->treatment_id; 
        return $this->query($sql, [$treatmentId], true);
    }

    public function Animal()
    {
        $sql = "SELECT a.animal_id 
        FROM animals AS a
        INNER JOIN treatments AS t ON t.treatment_keeper_id = a.animal_id
        WHERE t.treament_id = ?";

        $treatmentId = $this->treatment_id; 
        return $this->query($sql, [$treatmentId], true);
    }
}