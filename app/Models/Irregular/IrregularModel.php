<?php

namespace App\Models\Irregular;

use CodeIgniter\Model;

class IrregularModel extends Model
{

    public function getIrregular()
    {
        $builder = $this->db->table('irregular ir');
        $builder->select('ir.id, ir.infinitive, ir.past_simple, ir.past_participle, ir.spanish');
        $builder->limit(1);
        $builder->orderBy('id', 'RANDOM');

        return $query = $builder->get()->getResultArray();
    }

    public function getAllIrregular()
    {
        $builder = $this->db->table('irregular ir');
        $builder->select('ir.id, ir.infinitive, ir.past_simple, ir.past_participle, ir.spanish');

        return $query = $builder->get()->getResultArray();
    }

}