<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'note'
    ];

    /**
     * Get the contact that owns the ContactNote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
