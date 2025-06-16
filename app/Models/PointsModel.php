<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PointsModel extends Model
{
    protected $table = 'points';
    protected $guarded = ['id'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function geojson_points()
    {
        $points = $this
            ->select(DB::raw('
                id,
                ST_AsGeoJSON(geom) as geom,
                name,
                description,
                image,
                user_id,
                created_at,
                updated_at
            '))->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($points as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'user_id' => $p->user_id, // ✅ Tambahkan user_id
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at
                ],
            ];
            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

    public function geojson_point($id)
    {
        $points = $this
            ->select(DB::raw('
                id,
                ST_AsGeoJSON(geom) as geom,
                name,
                description,
                image,
                user_id,
                created_at,
                updated_at
            '))
            ->where('id', $id)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($points as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'user_id' => $p->user_id, // ✅ Tambahkan user_id
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at
                ],
            ];
            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
