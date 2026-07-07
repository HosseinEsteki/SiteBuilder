<?php

namespace Public\Traits;

use Hekmatinasser\Verta\Verta;

trait HasPersianDate
{
    public function getCreatedAtShamsiAttribute()
    {
        return $this->created_at
            ? (new Verta($this->created_at))
            : null;
    }

    public function getUpdatedAtShamsiAttribute()
    {
        return $this->updated_at
            ? (new Verta($this->updated_at))->format('%d %B %Y - H:i')
            : null;
    }

    public function getCreatedAtAgoAttribute()
    {
        return $this->created_at
            ? Verta::instance($this->created_at)->formatDifference()
            : null;
    }

    public function getUpdatedAtAgoAttribute()
    {
        return $this->updated_at
            ? Verta::instance($this->updated_at)->formatDifference()
            : null;
    }

}
