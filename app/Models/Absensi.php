<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model {
    use HasFactory;

    protected $fillable = ['santri_id', 'sesi_absen_id', 'mentor_id', 'status', 'tanggal'];

    /*
    * Get the santri that owns the absensi.
    */
    public function santri(): BelongsTo {
        return $this->belongsTo(Santri::class);
    }

    /*
    * Get the sesi absen that owns the absensi.
    */
    public function sesiAbsen(): BelongsTo {
        return $this->belongsTo(SesiAbsen::class);
    }

    /*
    * Get the mentor that owns the absensi.
    */
    public function mentor(): BelongsTo {
        return $this->belongsTo(Mentor::class);
    }
}
