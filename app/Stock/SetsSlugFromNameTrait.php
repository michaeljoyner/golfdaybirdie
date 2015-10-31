<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/5/15
 * Time: 9:58 AM
 */

namespace App\Stock;


use Illuminate\Support\Str;

trait SetsSlugFromNameTrait {

    public function setNameAttribute($name)
    {
        $counter = 0;
        $this->attributes['name'] = $name;

        if(isset($this->attributes['slug']) && $this->attributes['slug'] !== '') {
            return;
        }

        if($this->where('slug', Str::slug($name))->count() > 0) {
            $counter += 1;
            while($this->where('slug', Str::slug($name.$counter))->count() > 0) {
                $counter += 1;
            }
            $this->attributes['slug'] = Str::slug($name.$counter);
        } else {
            $this->attributes['slug'] = Str::slug($name);
        }

    }

}