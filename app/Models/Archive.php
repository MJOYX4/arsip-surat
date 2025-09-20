<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = ['nomor_surat','title','description','file_path','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
