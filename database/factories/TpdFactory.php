<?php

namespace Database\Factories;

use App\Models\Master\MasterJnsProfesi;
use App\Models\Master\MasterPendidikan;
use App\Models\Master\MasterUnsurTpd;
use App\Models\Regional\Province;
use App\Models\Tpd;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tpd>
 */
class TpdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tpd::class;

    public function definition(): array
    {
        $provinsi = Province::pluck('no_province');

        $user = User::pluck('id');
        $jns_profesi = MasterJnsProfesi::pluck('id');
        $unsurTpd = MasterUnsurTpd::pluck('id');
        $pendidikan = MasterPendidikan::pluck('id')->toArray();
        return [
            'nama'         => fake()->name(),
            'nik'        => fake()->numerify(),
            'unsur_tpd'      => fake()->randomElements($unsurTpd)[0],
            'jns_profesi'      => fake()->randomElements($jns_profesi)[0],
            'jns_kelamin'      => fake()->randomElements(['1', '2'])[0],
            'jns_pendidikan'      => fake()->randomElements($pendidikan)[0],
            'kd_provinsi'      => fake()->randomElement($provinsi),
            'aktif'          => true,
            'foto'              =>'/foto_tpd/'.fake()->image(storage_path('app/foto_tpd'), 360, 360, 'animals', false),
            'created_by'      => fake()->randomElement($user),
            // 'is_published' => true,
        ];
    }
}
