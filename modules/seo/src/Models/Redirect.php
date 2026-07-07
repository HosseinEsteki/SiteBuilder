<?php
namespace Seo\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = ['from', 'to', 'status_code'];
}
