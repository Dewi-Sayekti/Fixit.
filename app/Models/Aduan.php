<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'zona_id',
        'gambar',
        'keterangan',
        'status',
        'bukti_selesai',
    ];

    /**
     * User (santri) yang membuat aduan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Zona lokasi aduan
     */
    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class);
    }

    /**
     * Semua rating yang terkait dengan aduan ini
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Cek apakah user tertentu sudah memberi rating pada aduan ini
     * Digunakan di view aduan.blade.php untuk menyembunyikan/menampilkan form rating
     */
    public function sudahRating(int $userId): bool
    {
        return $this->ratings()
            ->where('user_id', $userId)
            ->exists();
    }
}
